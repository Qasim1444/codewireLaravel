/**
 * Minimal, reusable cookie-consent store.
 *
 * The choice is kept in a first-party cookie so that Laravel can read it too
 * (see App\Support\MarketingConsent). Nothing here stores personal data - just
 * the visitor's own preference.
 */

export const CONSENT_COOKIE = 'cw_consent'
const MAX_AGE_DAYS = 365

/** @typedef {{ necessary: true, marketing: boolean, ts: number }} Consent */

const listeners = new Set()

function readCookie(name) {
  const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'))
  return match ? decodeURIComponent(match[1]) : null
}

function writeCookie(name, value, days) {
  const expires = new Date(Date.now() + days * 864e5).toUTCString()
  const secure = window.location.protocol === 'https:' ? '; Secure' : ''
  document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/; SameSite=Lax${secure}`
}

/**
 * The stored choice, or null when the visitor has not decided yet.
 * @returns {Consent|null}
 */
export function getConsent() {
  const raw = readCookie(CONSENT_COOKIE)
  if (!raw) return null

  try {
    const parsed = JSON.parse(raw)
    if (!parsed || typeof parsed !== 'object') return null
    return { necessary: true, marketing: parsed.marketing === true, ts: parsed.ts || 0 }
  } catch {
    return null
  }
}

/** Has the visitor made a choice at all? */
export function hasDecided() {
  return getConsent() !== null
}

/**
 * Is marketing tracking allowed right now?
 * When the app is configured not to require consent, this is always true.
 */
export function marketingAllowed() {
  if (window.__META_REQUIRE_CONSENT__ === false) return true
  return getConsent()?.marketing === true
}

/**
 * Record the visitor's choice and notify subscribers.
 * @param {{ marketing: boolean }} choice
 */
export function setConsent({ marketing }) {
  const consent = { necessary: true, marketing: marketing === true, ts: Date.now() }
  writeCookie(CONSENT_COOKIE, JSON.stringify(consent), MAX_AGE_DAYS)
  listeners.forEach((fn) => {
    try {
      fn(consent)
    } catch (e) {
      // A misbehaving listener must not break the consent flow.
      console.error(e)
    }
  })
  return consent
}

/** Clear the stored choice (used by the "cookie settings" control). */
export function resetConsent() {
  writeCookie(CONSENT_COOKIE, '', -1)
  listeners.forEach((fn) => fn(null))
}

/**
 * Subscribe to consent changes. Returns an unsubscribe function.
 * @param {(consent: Consent|null) => void} fn
 */
export function onConsentChange(fn) {
  listeners.add(fn)
  return () => listeners.delete(fn)
}
