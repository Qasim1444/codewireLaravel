<template>
  <header class="header" :class="{ 'header--solid': scrolled || menuOpen }">
    <div class="container container--wide header__inner">
      <SiteLogo />

      <nav class="header__nav" aria-label="Primary">
        <Link
          v-for="item in nav"
          :key="item.to"
          :href="item.to"
          class="header__link"
          :class="{ 'Link-active': isActive(item.to) }"
        >
          {{ item.label }}
        </Link>
      </nav>

      <div class="header__actions">
        <Link href="/contact#start" class="btn btn--primary btn--sm header__cta">
          Start a Project
        </Link>
        <button
          class="header__burger"
          :aria-expanded="menuOpen"
          aria-controls="mobile-menu"
          aria-label="Toggle menu"
          @click="toggle"
        >
          <AppIcon :name="menuOpen ? 'x' : 'menu'" :size="26" />
        </button>
      </div>
    </div>

    <!-- Mobile menu -->
    <transition name="fade">
      <div v-if="menuOpen" class="header__overlay" @click="close" />
    </transition>
    <transition name="slide">
      <nav v-if="menuOpen" id="mobile-menu" class="header__panel section--dark" aria-label="Mobile">
        <Link
          v-for="item in nav"
          :key="item.to"
          :href="item.to"
          class="header__panel-link"
          :class="{ 'Link-active': isActive(item.to) }"
          @click="close"
        >
          {{ item.label }}
          <AppIcon name="arrow-up-right" :size="18" />
        </Link>
        <Link href="/contact#start" class="btn btn--primary btn--block header__panel-cta" @click="close">
          Start a Project
        </Link>
      </nav>
    </transition>
  </header>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import SiteLogo from '../ui/SiteLogo.vue'
import AppIcon from '../ui/AppIcon.vue'

const page = usePage()
const nav = computed(() => page.props.site?.nav ?? [])

const scrolled = ref(false)
const menuOpen = ref(false)

function isActive(to) {
  const path = page.url.split(/[?#]/)[0]
  const target = String(to).split(/[?#]/)[0]
  if (target === '/') return path === '/'
  return path === target || path.startsWith(target + '/')
}

function onScroll() {
  scrolled.value = window.scrollY > 24
}
function toggle() {
  menuOpen.value = !menuOpen.value
}
function close() {
  menuOpen.value = false
}
function onKey(e) {
  if (e.key === 'Escape') close()
}

watch(menuOpen, (open) => {
  document.body.style.overflow = open ? 'hidden' : ''
})
watch(() => page.url, close)

onMounted(() => {
  onScroll()
  window.addEventListener('scroll', onScroll, { passive: true })
  window.addEventListener('keydown', onKey)
})
onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
  window.removeEventListener('keydown', onKey)
  document.body.style.overflow = ''
})
</script>

<style scoped>
.header {
  background-color: white !important;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: var(--z-header);
  height: var(--header-h);
  display: flex;
  align-items: center;
  transition: background var(--dur) var(--ease), border-color var(--dur) var(--ease), backdrop-filter var(--dur) var(--ease);
  border-bottom: 1px solid transparent;
}
.header--solid {
  background: rgba(255, 255, 255, 0.85);
  backdrop-filter: blur(14px) saturate(150%);
  border-bottom-color: var(--border);
}
.header__inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
  gap: var(--space-5);
}
.header__nav {
  display: flex;
  align-items: center;
  gap: clamp(1rem, 2vw, 2rem);
}
.header__link {
  position: relative;
  font-size: var(--fs-sm);
  font-weight: 500;
  color: var(--text-body);
  padding: 6px 0;
}
.header__link::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 2px;
  background: var(--yellow);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform var(--dur-fast) var(--ease);
}
.header__link:hover {
  color: var(--text-hi);
}
.header__link:hover::after,
.header__link.Link-active::after {
  transform: scaleX(1);
}
.header__link.Link-active {
  color: var(--text-hi);
}
.header__actions {
  display: flex;
  align-items: center;
  gap: var(--space-4);
}
.header__burger {
  display: none;
  color: var(--text-hi);
  padding: 4px;
}

/* Mobile menu */
.header__overlay {
  position: fixed;
  inset: 0;
  top: var(--header-h);
  background: rgba(0, 0, 0, 0.6);
  z-index: var(--z-overlay);
}
.header__panel {
  position: fixed;
  top: var(--header-h);
  right: 0;
  width: min(360px, 88vw);
  height: calc(100vh - var(--header-h));
  background: var(--bg-elev);
  border-left: 1px solid var(--border);
  z-index: var(--z-modal);
  padding: var(--space-6) var(--gutter);
  display: flex;
  flex-direction: column;
  gap: 6px;
  overflow-y: auto;
}
.header__panel-link {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 4px;
  font-family: var(--font-display);
  font-size: 1.25rem;
  color: var(--text-hi);
  border-bottom: 1px solid var(--border);
}
.header__panel-link :deep(.icon) {
  color: var(--text-faint);
  transition: color var(--dur-fast) var(--ease), transform var(--dur-fast) var(--ease);
}
.header__panel-link:hover {
  color: var(--yellow);
}
.header__panel-link:hover :deep(.icon) {
  color: var(--yellow);
  transform: translate(3px, -3px);
}
.header__panel-link.Link-active {
  color: var(--yellow);
}
.header__panel-cta {
  margin-top: var(--space-5);
}

/* Transitions */
.fade-enter-active,
.fade-leave-active {
  transition: opacity var(--dur) var(--ease);
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
.slide-enter-active,
.slide-leave-active {
  transition: transform var(--dur) var(--ease);
}
.slide-enter-from,
.slide-leave-to {
  transform: translateX(100%);
}

@media (max-width: 992px) {
  .header__nav,
  .header__cta {
    display: none;
  }
  .header__burger {
    display: inline-flex;
  }
}
@media (max-width: 480px) {
  .header__cta {
    display: none;
  }
}
</style>
