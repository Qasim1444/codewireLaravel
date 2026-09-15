<template>
  <div class="reviews-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Reviews</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">What people <span class="text-accent">say</span></h1>
          <p class="lead" v-reveal="120">
            Feedback from the clients we build for and the students we train. We only publish reviews
            we can stand behind.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container">

        <!-- TABS -->
        <div class="reviews-tabs" role="tablist" v-reveal>
          <button
            v-for="t in tabs"
            :key="t.key"
            class="reviews-tab"
            :class="{ 'is-active': active === t.key }"
            role="tab"
            :aria-selected="active === t.key"
            @click="active = t.key"
          >
            <AppIcon :name="t.icon" :size="16" /> {{ t.label }}
            <span class="reviews-tab__count">{{ t.items.length }}</span>
          </button>
        </div>

        <!-- GRID -->
        <div class="grid grid-3 reviews-grid">
          <TestimonialCard
            v-for="(item, i) in activeItems"
            :key="active + i"
            v-reveal="i * 60"
            :item="item"
          />
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Letâ€™s write the next one together"
      title="Become a client â€” or a graduate"
      text="Whether you want software built or the skills to build it yourself, weâ€™d love to help. Start with a free conversation."
      primary-label="Get a Free Consultation"
      primary-to="/consultation"
      secondary-label="Explore the Academy"
      secondary-to="/academy"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import TestimonialCard from '@/Components/ui/TestimonialCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { clientTestimonials, studentTestimonials } = defineProps({
  clientTestimonials: { type: Array, default: () => [] },
  studentTestimonials: { type: Array, default: () => [] },
})

const tabs = [
  { key: 'clients', label: 'Client reviews', icon: 'briefcase', items: clientTestimonials },
  { key: 'students', label: 'Student reviews', icon: 'graduation-cap', items: studentTestimonials },
]
const active = ref('clients')
const activeItems = computed(() => tabs.find((t) => t.key === active.value)?.items || [])
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }

.reviews-notice {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: var(--space-5);
  margin-bottom: clamp(2rem, 4vw, 3rem);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius-lg);
}
.reviews-notice :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 2px; }
.reviews-notice p { color: var(--text-body); font-size: var(--fs-sm); line-height: 1.6; }
.reviews-notice strong { color: var(--text-hi); }

.reviews-tabs {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-bottom: clamp(2rem, 4vw, 3rem);
}
.reviews-tab {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  font-size: var(--fs-sm);
  font-weight: 600;
  color: var(--text-body);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-pill);
  transition: color var(--dur) var(--ease), border-color var(--dur) var(--ease), background var(--dur) var(--ease);
}
.reviews-tab:hover { color: var(--text-hi); border-color: var(--border-strong); }
.reviews-tab.is-active {
  color: var(--accent-ink);
  background: var(--yellow);
  border-color: var(--yellow);
}
.reviews-tab__count {
  display: inline-grid;
  place-items: center;
  min-width: 20px;
  height: 20px;
  padding: 0 6px;
  font-size: var(--fs-xs);
  border-radius: var(--radius-pill);
  background: rgba(0, 0, 0, 0.14);
}
.reviews-tab:not(.is-active) .reviews-tab__count {
  background: var(--bg-elev-2);
  color: var(--text-muted);
}
</style>
