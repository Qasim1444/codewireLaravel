<template>
  <div class="course-card card card--hover">
    <div class="course-card__top">
      <span class="icon-tile"><AppIcon :name="course.icon" /></span>
      <span v-if="course.certificate" class="badge badge--outline">
        <AppIcon name="award" :size="14" /> Certificate
      </span>
    </div>

    <h3 class="course-card__title">{{ course.title }}</h3>
    <p class="course-card__tagline">{{ course.tagline }}</p>

    <ul class="course-card__meta">
      <li><AppIcon name="chevron-right" :size="14" /> {{ course.level }}</li>
      <li><AppIcon name="clock" :size="14" /> {{ course.duration }}</li>
      <li><AppIcon name="globe" :size="14" /> {{ course.mode }}</li>
      <li><AppIcon name="layers" :size="14" /> {{ course.projects }} hands-on projects</li>
    </ul>

    <div class="course-card__instructor">
      <span class="course-card__instructor-label">Instructor</span>
      <span class="course-card__instructor-name">{{ course.instructor }}</span>
    </div>

    <div class="btn-group course-card__actions">
      <Link :href="`/academy/${course.slug}`" class="btn btn--ghost btn--sm">
        View Course
      </Link>
      <Link href="/contact#enroll" class="btn btn--primary btn--sm">
        Enroll Now
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from './AppIcon.vue'
defineProps({ course: { type: Object, required: true } })
</script>

<style scoped>
.course-card {
  display: flex;
  flex-direction: column;
  height: 100%;
}
.course-card__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-5);
}
.course-card__title {
  font-size: 1.4rem;
  margin-bottom: var(--space-3);
}
.course-card__tagline {
  font-size: var(--fs-sm);
  color: var(--text-muted);
  margin-bottom: var(--space-5);
}
.course-card__meta {
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: var(--space-5);
}
.course-card__meta li {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.course-card__meta :deep(.icon) {
  color: var(--yellow);
  flex-shrink: 0;
}
.course-card__instructor {
  display: flex;
  flex-direction: column;
  gap: 2px;
  padding: var(--space-4) 0;
  margin-bottom: var(--space-5);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.course-card__instructor-label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
}
.course-card__instructor-name {
  font-weight: 600;
  color: var(--text-hi);
}
.course-card__actions {
  margin-top: auto;
}
</style>
