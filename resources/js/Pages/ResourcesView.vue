<template>
  <div class="res-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Resources</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Guides &amp; <span class="text-accent">downloads</span></h1>
          <p class="lead" v-reveal="120">
            Practical checklists, templates and guides drawn from how we actually build. Free, no
            fluff, straight to the point.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container">

                <!-- FILTER -->
        <div class="res-filter" role="tablist" v-reveal>
          <button
            v-for="type in resourceTypes"
            :key="type"
            class="res-filter__btn"
            :class="{ 'is-active': activeType === type }"
            role="tab"
            :aria-selected="activeType === type"
            @click="activeType = type"
          >
            {{ type }}
          </button>
        </div>

        <!-- GRID -->
        <div v-if="filtered.length" class="grid grid-3 res-grid">
          <article
            v-for="(r, i) in filtered"
            :key="r.title"
            class="res-card card card--hover"
            v-reveal="i * 60"
          >
            <div class="res-card__top">
              <span class="icon-tile icon-tile--sm"><AppIcon :name="r.icon" :size="20" /></span>
              <span class="res-card__format">{{ r.format }}</span>
            </div>
            <h2 class="res-card__title">{{ r.title }}</h2>
            <p class="res-card__desc">{{ r.description }}</p>
            <div class="res-card__foot">
              <span class="badge badge--outline">{{ r.type }}</span>
            </div>
            <button class="btn btn--ghost btn--sm btn--block res-card__cta" type="button" disabled>
              <AppIcon name="clock" :size="16" /> Coming soon
            </button>
          </article>
        </div>

        <!-- EMPTY STATE -->
        <div v-else class="res-empty" v-reveal>
          <span class="icon-tile"><AppIcon name="search" /></span>
          <p>No resources in this category yet â€” check back soon.</p>
          <button class="btn btn--ghost btn--sm" type="button" @click="activeType = 'All'">
            Show all resources
          </button>
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Want the real thing?"
      title="Skip the guide â€” talk to the team"
      text="Sometimes a 20-minute conversation beats any download. Book a free consultation and get advice specific to your project."
      primary-label="Get a Free Consultation"
      primary-to="/consultation"
      secondary-label="Read the Blog"
      secondary-to="/blog"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { resources, resourceTypes } = defineProps({
  resources: { type: Array, default: () => [] },
  resourceTypes: { type: Array, default: () => [] },
})

const activeType = ref('All')
const filtered = computed(() =>
  activeType.value === 'All' ? resources : resources.filter((r) => r.type === activeType.value)
)
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }

.res-notice {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: var(--space-5);
  margin-bottom: clamp(1.5rem, 3vw, 2.5rem);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius-lg);
}
.res-notice :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 2px; }
.res-notice p { color: var(--text-body); font-size: var(--fs-sm); line-height: 1.6; }
.res-notice strong { color: var(--text-hi); }

.res-filter {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-bottom: clamp(2rem, 4vw, 3rem);
}
.res-filter__btn {
  padding: 8px 18px;
  font-size: var(--fs-sm);
  font-weight: 600;
  color: var(--text-body);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-pill);
  transition: color var(--dur) var(--ease), border-color var(--dur) var(--ease), background var(--dur) var(--ease);
}
.res-filter__btn:hover { color: var(--text-hi); border-color: var(--border-strong); }
.res-filter__btn.is-active {
  color: var(--accent-ink);
  background: var(--yellow);
  border-color: var(--yellow);
}

.res-card { display: flex; flex-direction: column; padding: clamp(1.5rem, 3vw, 2rem); }
.res-card__top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-5);
}
.icon-tile--sm { width: 44px; height: 44px; border-radius: var(--radius-sm); }
.res-card__format {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
}
.res-card__title { font-size: 1.25rem; margin-bottom: var(--space-3); }
.res-card__desc { font-size: var(--fs-sm); color: var(--text-muted); line-height: 1.6; flex: 1; }
.res-card__foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-3);
  margin: var(--space-5) 0 var(--space-4);
}
.res-card__cta { margin-top: auto; }
.res-card__cta:disabled { opacity: 0.55; cursor: not-allowed; }

.res-empty {
  text-align: center;
  padding: clamp(2.5rem, 6vw, 4rem) 0;
}
.res-empty .icon-tile { margin: 0 auto var(--space-4); }
.res-empty p { color: var(--text-muted); margin-bottom: var(--space-5); }
</style>
