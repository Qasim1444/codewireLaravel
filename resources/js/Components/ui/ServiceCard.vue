<template>
  <Link :href="`/services/${service.slug}`" class="service-card card card--hover card--interactive">
    <span class="icon-tile"><AppIcon :name="service.icon" /></span>
    <h3 class="service-card__title">{{ service.title }}</h3>
    <p class="service-card__text">{{ service.short }}</p>
    <span class="link-arrow service-card__link">
      Learn more <AppIcon name="arrow-right" />
    </span>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from './AppIcon.vue'
defineProps({ service: { type: Object, required: true } })
</script>

<style scoped>
.service-card {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  height: 100%;
}
.service-card__title {
  font-size: 1.3rem;
  margin: var(--space-5) 0 var(--space-3);
}
.service-card__text {
  font-size: var(--fs-sm);
  color: var(--text-muted);
  margin-bottom: var(--space-5);
  flex: 1;
}
.service-card__link {
  margin-top: auto;
  color: var(--text-hi);
}
.service-card:hover .service-card__link {
  color: var(--yellow);
}
</style>
