<template>
  <div ref="root" class="stat">
    <div class="stat-value">{{ display }}<span class="unit">{{ suffix }}</span></div>
    <div class="stat-label">
      {{ label }}
      <SampleFlag v-if="sample" label="sample" class="stat__flag" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import SampleFlag from './SampleFlag.vue'

const props = defineProps({
  value: { type: Number, required: true },
  suffix: { type: String, default: '' },
  label: { type: String, default: '' },
  sample: { type: Boolean, default: false },
  duration: { type: Number, default: 1500 },
})

const root = ref(null)
const display = ref(0)
let observer = null
let started = false

const reduced =
  typeof window !== 'undefined' &&
  window.matchMedia &&
  window.matchMedia('(prefers-reduced-motion: reduce)').matches

function animate() {
  if (started) return
  started = true
  if (reduced) {
    display.value = props.value
    return
  }
  const start = performance.now()
  const from = 0
  const to = props.value
  function tick(now) {
    const t = Math.min((now - start) / props.duration, 1)
    const eased = 1 - Math.pow(1 - t, 3) // easeOutCubic
    display.value = Math.round(from + (to - from) * eased)
    if (t < 1) requestAnimationFrame(tick)
    else display.value = to
  }
  requestAnimationFrame(tick)
}

onMounted(() => {
  if (typeof IntersectionObserver === 'undefined') {
    animate()
    return
  }
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) {
          animate()
          observer.disconnect()
        }
      })
    },
    { threshold: 0.4 }
  )
  if (root.value) observer.observe(root.value)
})

onBeforeUnmount(() => observer && observer.disconnect())
</script>

<style scoped>
.stat__flag {
  margin-left: 6px;
  vertical-align: middle;
}
</style>
