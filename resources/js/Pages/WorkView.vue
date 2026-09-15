<template>
  <div class="work-page">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Our Work</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Work that <span class="text-accent">speaks for itself</span></h1>
          <p class="lead" v-reveal="120">
            A look at the kinds of products we build and the outcomes they drive â€” across
            web, mobile, e-commerce, AI and more.
          </p>
        </div>
      </div>
    </section>

    <!-- FILTER + CASE STUDIES -->
    <section class="section section--flush-top work-body">
      <div class="container">
        <div class="filter-bar" role="tablist" aria-label="Filter projects by category" v-reveal>
          <button
            v-for="cat in projectCategories"
            :key="cat"
            class="filter-chip"
            :class="{ 'filter-chip--active': active === cat }"
            role="tab"
            :aria-selected="active === cat"
            @click="active = cat"
          >
            {{ cat }}
            <span class="filter-chip__count">{{ countFor(cat) }}</span>
          </button>
        </div>

        <TransitionGroup name="grid" tag="div" class="work-list">
          <article
            v-for="(p, i) in filtered"
            :id="p.slug"
            :key="p.slug"
            class="case"
            :class="{ 'case--rev': i % 2 === 1 }"
          >
            <div class="case__media">
              <img :src="p.image" :alt="`${p.name} â€” ${p.industry}`" loading="lazy" />
              <span class="case__cat badge">{{ p.category }}</span>
              <SampleFlag v-if="p.sample" class="case__flag" />
            </div>
            <div class="case__content">
              <div class="case__meta">
                <AppIcon name="briefcase" :size="15" /> {{ p.industry }}
              </div>
              <h2 class="h3 case__title">{{ p.name }}</h2>
              <p class="case__summary">{{ p.summary }}</p>

              <div class="case__cs">
                <div>
                  <h3 class="case__label">Challenge</h3>
                  <p>{{ p.challenge }}</p>
                </div>
                <div>
                  <h3 class="case__label case__label--accent">Solution</h3>
                  <p>{{ p.solution }}</p>
                </div>
              </div>

              <div class="case__results">
                <div v-for="r in p.results" :key="r" class="case__result">
                  <AppIcon name="trending-up" :size="16" /> {{ r }}
                </div>
              </div>

              <div class="cluster case__tech">
                <span v-for="t in p.tech" :key="t" class="tag">{{ t }}</span>
              </div>

              <Link :href="`/work/${p.slug}`" class="link-arrow case__link">
                Read full case study <AppIcon name="arrow-right" />
              </Link>
            </div>
          </article>
        </TransitionGroup>

        <p v-if="!filtered.length" class="work-empty">
          No projects in this category yet â€” <Link href="/contact" class="link-arrow">start a new one <AppIcon name="arrow-right" /></Link>
        </p>
      </div>
    </section>

    <CtaBand
      eyebrow="Your project could be next"
      title="Letâ€™s build something worth showing off"
      text="Tell us what youâ€™re trying to achieve. Weâ€™ll bring the engineering, design and honesty to get it shipped."
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { projects, projectCategories } = defineProps({
  projects: { type: Array, default: () => [] },
  projectCategories: { type: Array, default: () => [] },
})

const active = ref('All')
const filtered = computed(() =>
  active.value === 'All' ? projects : projects.filter((p) => p.category === active.value)
)
function countFor(cat) {
  return cat === 'All' ? projects.length : projects.filter((p) => p.category === cat).length
}
</script>

<style scoped>
.work-notice {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-top: var(--space-5);
  font-size: var(--fs-sm);
  color: var(--text-muted);
}
.work-notice :deep(.icon) { color: var(--yellow); }

/* Filter bar */
.filter-bar {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
}
.filter-chip {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  font-size: var(--fs-sm);
  font-weight: 500;
  color: var(--text-body);
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid var(--border);
  border-radius: var(--radius-pill);
  cursor: pointer;
  transition: all var(--dur-fast) var(--ease);
}
.filter-chip:hover {
  border-color: var(--border-strong);
  color: var(--text-hi);
}
.filter-chip--active {
  background: var(--yellow);
  border-color: var(--yellow);
  color: var(--accent-ink);
  font-weight: 600;
}
.filter-chip__count {
  font-size: var(--fs-xs);
  opacity: 0.6;
}
.filter-chip--active .filter-chip__count {
  opacity: 0.8;
}

/* Case list */
.work-list {
  display: flex;
  flex-direction: column;
  gap: clamp(3rem, 7vw, 6rem);
}
.case {
  scroll-margin-top: calc(var(--header-h) + 20px);
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: center;
}
.case--rev .case__media {
  order: 2;
}
.case__media {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid var(--border);
  aspect-ratio: 4 / 3;
}
.case__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.case__cat {
  position: absolute;
  top: 16px;
  left: 16px;
  background: rgba(11, 11, 11, 0.72);
  color: var(--yellow);
  border-color: transparent;
  backdrop-filter: blur(6px);
}
.case__flag {
  position: absolute;
  top: 16px;
  right: 16px;
}
.case__meta {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: var(--fs-xs);
  letter-spacing: var(--ls-wide);
  text-transform: uppercase;
  color: var(--yellow);
  margin-bottom: var(--space-3);
}
.case__title {
  margin-bottom: var(--space-3);
}
.case__summary {
  color: var(--text-body);
  font-size: var(--fs-lead);
  margin-bottom: var(--space-6);
}
.case__cs {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
  margin-bottom: var(--space-6);
}
.case__cs p {
  font-size: var(--fs-sm);
  color: var(--text-muted);
  line-height: 1.65;
}
.case__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-2);
}
.case__label--accent {
  color: var(--yellow);
}
.case__results {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-bottom: var(--space-5);
}
.case__result {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 8px 14px;
  font-size: var(--fs-sm);
  font-weight: 600;
  color: var(--text-hi);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius-pill);
}
.case__result :deep(.icon) { color: var(--yellow); }

.case__tech {
  margin-bottom: var(--space-5);
}
.case__link {
  color: var(--text-hi);
}
.case__link:hover {
  color: var(--yellow);
}

.work-empty {
  text-align: center;
  color: var(--text-muted);
  padding: var(--space-8) 0;
}
.work-empty .link-arrow { display: inline-flex; }

/* Filter transition */
.grid-move,
.grid-enter-active,
.grid-leave-active {
  transition: all 0.4s var(--ease);
}
.grid-enter-from,
.grid-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
.grid-leave-active {
  position: absolute;
}

@media (max-width: 900px) {
  .case {
    grid-template-columns: 1fr;
  }
  .case--rev .case__media {
    order: 0;
  }
  .case__cs {
    grid-template-columns: 1fr;
  }
}
@media (prefers-reduced-motion: reduce) {
  .grid-move, .grid-enter-active, .grid-leave-active { transition: none; }
}
</style>
