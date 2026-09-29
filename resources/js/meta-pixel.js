/**
 * Meta Pixel wiring for the Inertia app.
 *
 * The base code itself lives in resources/views/app.blade.php and is only
 * executed here, once marketing consent has been granted. Every helper is a
 * no-op when the pixel is not configured or consent is missing, so calling
 * them from pages is always safe.
 */
import { router } from '@inertiajs/vue3'
import { marketingAllowed, onConsentChange } from './consent'

let pageViewsSent = 0

/** Is a pixel id configured for this site? */
function configured() {
  return typeof window.__META_PIXEL_ID__ === 'string' && window.__META_PIXEL_ID__ !== ''
}

/** May we track right now? */
export function trackingEnabled() {
  return configured() && marketingAllowed()
}

/** Load + init the pixel on first use. */
function ensureLoaded() {
  if (!trackingEnabled()) return false
  if (typeof window.__loadMetaPixel__ === 'function') window.__loadMetaPixel__()
  return typeof window.fbq === 'function'
}

/**
 * Low-level tracker. `eventId` is the Pixel/CAPI deduplication key.
 * @param {string} eventName
 * @param {object} [params]
 * @param {string} [eventId]
 */
export function track(eventName, params = {}, eventId = undefined) {
  if (!ensureLoaded()) return false
  const options = eventId ? { eventID: eventId } : {}
  window.fbq('track', eventName, params, options)
  return true
}

/** A deduplication id shared by the browser Pixel event and the server CAPI event. */
export function newEventId() {
  if (window.crypto?.randomUUID) return window.crypto.randomUUID()

  // RFC 4122 v4 fallback for older browsers.
  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, (c) => {
    const r = (Math.random() * 16) | 0
    const v = c === 'x' ? r : (r & 0x3) | 0x8
    return v.toString(16)
  })
}

function trackPageView() {
  if (!ensureLoaded()) return
  window.fbq('track', 'PageView')
  pageViewsSent += 1
}

/** Service / portfolio detail pages. */
export function trackViewContent({ contentName, contentType, contentIds } = {}) {
  track(
    'ViewContent',
    Object.fromEntries(
      Object.entries({
        content_name: contentName,
        content_type: contentType,
        content_ids: contentIds,
      }).filter(([, v]) => v !== undefined && v !== null && v !== ''),
    ),
  )
}

/** A successfully submitted enquiry - never a mere button click. */
export function trackLead(eventId, params = {}) {
  return track('Lead', params, eventId)
}

/** A consultation booking that has actually been confirmed. */
export function trackSchedule(eventId, params = {}) {
  return track('Schedule', params, eventId)
}

/**
 * Contact intent: WhatsApp, email and telephone links anywhere on the site.
 * Delegated from the document so no markup has to change.
 */
function channelFor(href) {
  const value = href.toLowerCase()
  if (value.startsWith('tel:')) return 'phone'
  if (value.startsWith('mailto:')) return 'email'
  if (value.includes('wa.me') || value.includes('api.whatsapp.com') || value.startsWith('whatsapp:')) {
    return 'whatsapp'
  }
  return null
}

function handleContactClick(event) {
  const link = event.target instanceof Element ? event.target.closest('a[href]') : null
  if (!link) return

  const channel = channelFor(link.getAttribute('href') || '')
  if (!channel) return

  track('Contact', { content_category: channel })
}

/**
 * Called once from app.js, BEFORE createInertiaApp, so the initial
 * `inertia:navigate` event is captured and PageView fires exactly once per
 * navigation (including the first page load).
 */
export function setupMetaPixel() {
  if (!configured()) return

  router.on('navigate', () => trackPageView())

  document.addEventListener('click', handleContactClick, true)

  // If consent arrives after the page has already loaded, catch up with the
  // PageView the visitor would otherwise have missed.
  onConsentChange((consent) => {
    if (consent?.marketing && pageViewsSent === 0) trackPageView()
  })
}
