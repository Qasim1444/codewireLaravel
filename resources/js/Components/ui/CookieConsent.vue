<template>
  <transition name="consent-fade">
    <div
      v-if="visible"
      class="consent"
      role="dialog"
      aria-live="polite"
      aria-label="Cookie preferences"
    >
      <div class="consent__body">
        <p class="consent__text">
          We use essential cookies to run this site. With your permission we also use
          marketing cookies (Meta Pixel) to measure how well our ads work. You can change
          your mind at any time.
        </p>
        <div class="consent__actions">
          <button type="button" class="btn btn--ghost btn--sm" @click="choose(false)">
            Essential only
          </button>
          <button type="button" class="btn btn--primary btn--sm" @click="choose(true)">
            Accept all
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { hasDecided, setConsent } from '@/consent'

const visible = ref(false)

onMounted(() => {
  // Nothing to ask when no marketing tag is configured, consent is not
  // required, or the visitor already chose.
  if (!window.__META_PIXEL_ID__) return
  if (window.__META_REQUIRE_CONSENT__ === false) return
  visible.value = !hasDecided()

  // Allow a "Cookie settings" link anywhere on the site to reopen this banner.
  window.addEventListener('cw:open-consent', () => {
    visible.value = true
  })
})

function choose(marketing) {
  setConsent({ marketing })
  visible.value = false
}
</script>

<style scoped>
.consent {
  position: fixed;
  left: 16px;
  right: 16px;
  bottom: 16px;
  z-index: calc(var(--z-top) + 1);
  max-width: 720px;
  margin: 0 auto;
  padding: 16px 18px;
  border-radius: var(--radius, 12px);
  background: #121212;
  border: 1px solid rgba(255, 255, 255, 0.12);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.45);
}
.consent__body {
  display: flex;
  align-items: center;
  gap: 18px;
  flex-wrap: wrap;
}
.consent__text {
  flex: 1 1 320px;
  margin: 0;
  color: #d7d7d7;
  font-size: 0.875rem;
  line-height: 1.55;
}
.consent__actions {
  display: flex;
  gap: 10px;
  flex-shrink: 0;
}
.consent__actions .btn {
  white-space: nowrap;
}

.consent-fade-enter-active,
.consent-fade-leave-active {
  transition: opacity 0.25s ease, transform 0.25s ease;
}
.consent-fade-enter-from,
.consent-fade-leave-to {
  opacity: 0;
  transform: translateY(12px);
}

@media (max-width: 560px) {
  .consent__actions {
    width: 100%;
  }
  .consent__actions .btn {
    flex: 1;
  }
}
</style>
