<template>
  <a class="skip-link" href="#main">Skip to content</a>
  <AppHeader />
  <main id="main">
    <slot />
  </main>
  <AppFooter />

  <!-- ── WhatsApp floating widget ── -->
  <a
    class="wa-widget"
    href="https://wa.me/923087933900"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Chat with us on WhatsApp"
  >
    <span class="wa-widget__pulse" aria-hidden="true"></span>
    <svg class="wa-widget__icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path d="M12.002 2C6.477 2 2 6.477 2 12.002c0 1.765.462 3.422 1.268 4.86L2 22l5.29-1.247A9.959 9.959 0 0 0 12.002 22C17.525 22 22 17.525 22 12.002 22 6.477 17.525 2 12.002 2Zm5.613 13.647c-.234.66-1.37 1.264-1.877 1.307-.484.041-.94.21-3.17-.66-2.683-1.044-4.4-3.78-4.532-3.957-.13-.176-1.065-1.416-1.065-2.703 0-1.286.674-1.917.912-2.176.237-.26.52-.325.693-.325l.499.01c.16.006.376-.061.588.449.22.528.748 1.826.813 1.959.065.134.108.29.022.467-.086.176-.13.285-.26.439l-.39.455c-.13.13-.265.27-.114.53.15.26.668 1.102 1.435 1.785.987.879 1.818 1.15 2.078 1.28.26.13.41.108.562-.065.152-.174.648-.757.822-1.017.173-.26.347-.216.585-.13.238.087 1.51.713 1.77.843.26.13.433.195.497.304.065.108.065.63-.17 1.29Z"/>
    </svg>
    <span class="wa-widget__tooltip">Chat on WhatsApp</span>
  </a>
</template>

<script setup>
import AppHeader from '../Components/layout/AppHeader.vue'
import AppFooter from '../Components/layout/AppFooter.vue'
</script>

<style>
#main {
  min-height: 60vh;
}

/* ── WhatsApp widget ── */
.wa-widget {
  position: fixed;
  bottom: 28px;
  right: 28px;
  z-index: var(--z-top);
  width: 56px;
  height: 56px;
  border-radius: 50%;
  background: #25d366;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 20px rgba(37, 211, 102, 0.45), 0 2px 8px rgba(0,0,0,0.15);
  transition: transform 0.2s var(--ease), box-shadow 0.2s var(--ease);
  text-decoration: none;
}
.wa-widget:hover {
  transform: scale(1.1);
  box-shadow: 0 8px 32px rgba(37, 211, 102, 0.55), 0 4px 12px rgba(0,0,0,0.18);
}
.wa-widget:hover .wa-widget__tooltip {
  opacity: 1;
  transform: translateX(0);
  pointer-events: auto;
}

.wa-widget__icon {
  width: 30px;
  height: 30px;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
}

.wa-widget__pulse {
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: rgba(37, 211, 102, 0.4);
  animation: wa-pulse 2.4s ease-out infinite;
}
@keyframes wa-pulse {
  0%   { transform: scale(1);   opacity: 0.7; }
  70%  { transform: scale(1.7); opacity: 0; }
  100% { transform: scale(1.7); opacity: 0; }
}

.wa-widget__tooltip {
  position: absolute;
  right: calc(100% + 12px);
  top: 50%;
  transform: translateX(6px) translateY(-50%);
  white-space: nowrap;
  background: #0b0b0b;
  color: #fff;
  font-family: var(--font-body);
  font-size: 13px;
  font-weight: 500;
  padding: 7px 14px;
  border-radius: var(--radius-pill);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.2s var(--ease), transform 0.2s var(--ease);
}
.wa-widget__tooltip::after {
  content: '';
  position: absolute;
  right: -6px;
  top: 50%;
  transform: translateY(-50%);
  border: 6px solid transparent;
  border-right-width: 0;
  border-left-color: #0b0b0b;
}

@media (max-width: 480px) {
  .wa-widget {
    bottom: 20px;
    right: 20px;
    width: 50px;
    height: 50px;
  }
  .wa-widget__icon { width: 26px; height: 26px; }
  .wa-widget__tooltip { display: none; }
}
</style>
