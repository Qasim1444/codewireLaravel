<template>
  <section class="cta-band" :class="{ 'cta-band--flush': flush }">
    <div class="container">
      <div class="cta-band__inner section--dark" v-reveal>
        <p v-if="eyebrow" class="eyebrow eyebrow--center">{{ eyebrow }}</p>
        <h2 class="cta-band__title balance">{{ title }}</h2>
        <p v-if="text" class="cta-band__text balance">{{ text }}</p>
        <div class="btn-group cta-band__actions">
          <Link :href="primaryTo" class="btn btn--primary btn--lg">
            {{ primaryLabel }} <AppIcon name="arrow-right" class="icon-arrow" />
          </Link>
          <Link v-if="secondaryLabel" :href="secondaryTo" class="btn btn--ghost btn--lg">
            {{ secondaryLabel }}
          </Link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from './AppIcon.vue'

defineProps({
  eyebrow: { type: String, default: "Let's build together" },
  title: { type: String, default: 'Have a project in mind? Let’s make it real.' },
  text: {
    type: String,
    default:
      'Tell us about your project and get a clear, honest plan — scope, timeline and a transparent estimate. No obligation.',
  },
  primaryLabel: { type: String, default: 'Start a Project' },
  primaryTo: { type: [String, Object], default: '/contact#start' },
  secondaryLabel: { type: String, default: 'View Our Work' },
  secondaryTo: { type: [String, Object], default: '/work' },
  flush: { type: Boolean, default: false },
})
</script>

<style scoped>
.cta-band {
  padding: var(--section-y) 0;
}
.cta-band--flush {
  padding-bottom: 0;
}
.cta-band__inner {
  position: relative;
  overflow: hidden;
  text-align: center;
  padding: clamp(3rem, 6vw, 5.5rem) var(--gutter);
  background: var(--bg-elev);
  border: 1px solid var(--border-strong);
  border-radius: var(--radius-xl);
}
.cta-band__title {
  position: relative;
  font-size: var(--fs-h1);
  color: var(--text-hi);
  max-width: 20ch;
  margin: var(--space-4) auto 0;
}
.cta-band__text {
  position: relative;
  color: var(--text-body);
  font-size: var(--fs-lead);
  max-width: 52ch;
  margin: var(--space-4) auto 0;
}
.cta-band__actions {
  position: relative;
  justify-content: center;
  margin-top: var(--space-6);
}
</style>
