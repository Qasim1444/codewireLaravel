/**
 * v-reveal — scroll-triggered reveal animation.
 * Adds `.reveal` immediately, then `.reveal--in` when the element
 * scrolls into view. Optional binding value = stagger delay in ms,
 * or an options object { delay, once }.
 *
 * Usage:
 *   <div v-reveal>...</div>
 *   <div v-reveal="120">...</div>          // 120ms delay
 *   <div v-reveal="{ delay: 200 }">...</div>
 */

const prefersReduced =
  typeof window !== 'undefined' &&
  window.matchMedia &&
  window.matchMedia('(prefers-reduced-motion: reduce)').matches

let observer = null
const seen = new WeakSet()

function ensureObserver() {
  if (observer || typeof IntersectionObserver === 'undefined') return
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('reveal--in')
          if (entry.target.__revealOnce !== false) {
            observer.unobserve(entry.target)
          }
        } else if (entry.target.__revealOnce === false) {
          entry.target.classList.remove('reveal--in')
        }
      })
    },
    { threshold: 0.12, rootMargin: '0px 0px -8% 0px' }
  )
}

export default {
  mounted(el, binding) {
    // Do not double-apply base class if author already set a variant
    if (!el.classList.contains('reveal')) el.classList.add('reveal')

    let delay = 0
    let once = true
    const v = binding.value
    if (typeof v === 'number') delay = v
    else if (v && typeof v === 'object') {
      delay = v.delay || 0
      once = v.once !== false
    }
    if (delay) el.style.transitionDelay = `${delay}ms`
    el.__revealOnce = once

    if (prefersReduced) {
      el.classList.add('reveal--in')
      return
    }
    ensureObserver()
    if (observer) {
      observer.observe(el)
      seen.add(el)
    } else {
      el.classList.add('reveal--in')
    }
  },
  unmounted(el) {
    if (observer && seen.has(el)) observer.unobserve(el)
  },
}
