<template>
  <section class="detail-missing">
    <div class="container container--narrow">
      <div class="detail-missing__inner" v-reveal>
        <span class="icon-tile"><AppIcon name="search" /></span>
        <h1 class="h2 balance">{{ title }}</h1>
        <p class="detail-missing__text">{{ text }}</p>
        <div class="btn-group detail-missing__actions">
          <Link :href="backTo" class="btn btn--primary">
            <AppIcon name="arrow-left" :size="18" /> {{ backLabel }}
          </Link>
          <Link href="/contact" class="btn btn--ghost">Contact Us</Link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from './AppIcon.vue'

defineProps({
  title: { type: String, default: 'We couldn’t find that page' },
  text: {
    type: String,
    default: 'It may have moved or never existed. Use the link below to get back on track.',
  },
  backTo: { type: [String, Object], default: '/' },
  backLabel: { type: String, default: 'Go back' },
})
</script>

<style scoped>
.detail-missing {
  padding: calc(var(--header-h) + clamp(3rem, 8vw, 6rem)) 0 clamp(3rem, 8vw, 6rem);
  text-align: center;
}
.detail-missing__inner {
  max-width: 560px;
  margin: 0 auto;
}
.detail-missing .icon-tile {
  margin: 0 auto var(--space-5);
}
.detail-missing__text {
  color: var(--text-body);
  max-width: 46ch;
  margin: var(--space-4) auto var(--space-7);
}
.detail-missing__actions {
  justify-content: center;
}
</style>
