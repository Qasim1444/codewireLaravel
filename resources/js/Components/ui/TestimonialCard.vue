<template>
  <figure class="testimonial card">
    <div class="testimonial__top">
      <span class="testimonial__quote"><AppIcon name="quote" :size="30" /></span>
      <div class="testimonial__stars" :aria-label="`${rating} out of 5 stars`">
        <AppIcon v-for="n in rating" :key="n" name="star" :size="16" />
      </div>
    </div>

    <blockquote class="testimonial__text">"{{ item.quote }}"</blockquote>

    <figcaption class="testimonial__foot">
      <div class="testimonial__avatar" aria-hidden="true">{{ initials }}</div>
      <div class="testimonial__who">
        <span class="testimonial__name">{{ item.name }}</span>
        <span class="testimonial__role">{{ item.title }}<template v-if="item.company">, {{ item.company }}</template></span>
        <span v-if="item.location" class="testimonial__location">
          <span v-if="item.flag" class="testimonial__flag">{{ item.flag }}</span>
          {{ item.location }}
        </span>
      </div>
    </figcaption>
  </figure>
</template>

<script setup>
import { computed } from 'vue'
import AppIcon from './AppIcon.vue'
import SampleFlag from './SampleFlag.vue'

const props = defineProps({ item: { type: Object, required: true } })
const rating = computed(() => props.item.rating || 5)
const initials = computed(() =>
  (props.item.name || '?')
    .split(' ')
    .map((w) => w[0])
    .slice(0, 2)
    .join('')
    .toUpperCase()
)
</script>

<style scoped>
.testimonial {
  display: flex;
  flex-direction: column;
  height: 100%;
}
.testimonial__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-4);
}
.testimonial__quote {
  color: var(--yellow);
  opacity: 0.9;
}
.testimonial__stars {
  display: inline-flex;
  gap: 3px;
  color: var(--yellow);
}
.testimonial__text {
  font-size: var(--fs-lg);
  line-height: 1.6;
  color: var(--text-body);
  margin: 0 0 var(--space-6);
  flex: 1;
}
.testimonial__foot {
  display: flex;
  align-items: center;
  gap: 14px;
  padding-top: var(--space-5);
  border-top: 1px solid var(--border);
}
.testimonial__avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: linear-gradient(135deg, var(--yellow) 0%, #e6a800 100%);
  color: #0b0b0b;
  font-weight: 700;
  font-size: 1rem;
  font-family: var(--font-display);
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(255, 196, 0, 0.3);
}
.testimonial__who {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.testimonial__name {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-weight: 600;
  color: var(--text-hi);
}
.testimonial__role {
  font-size: var(--fs-sm);
  color: var(--text-muted);
}
.testimonial__location {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: var(--fs-xs);
  color: var(--text-faint);
  margin-top: 2px;
}
.testimonial__flag {
  font-size: 14px;
  line-height: 1;
}
</style>
