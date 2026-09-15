<template>
  <div class="tech-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Technologies</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">The tools we <span class="text-accent">build with</span></h1>
          <p class="lead" v-reveal="120">
            We choose technology to fit the problem, not the other way around. Here’s the stack our
            engineers reach for across web, mobile, cloud and AI work.
          </p>
        </div>
      </div>
    </section>

    <!-- CATEGORIES -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="grid grid-3">
          <article
            v-for="(cat, i) in techCategories"
            :key="cat.key"
            class="tech-card card card--hover"
            v-reveal="i * 60"
          >
            <span class="icon-tile"><AppIcon :name="cat.icon" /></span>
            <h2 class="tech-card__title">{{ cat.label }}</h2>
            <div class="cluster tech-card__items">
              <span v-for="t in cat.items" :key="t" class="tag">{{ t }}</span>
            </div>
          </article>
        </div>

        <p class="tech-note" v-reveal>
          <AppIcon name="message" :size="16" />
          Don’t see your stack? We’re pragmatic about tools — tell us what you’re running and we’ll
          tell you honestly whether it’s a fit.
        </p>
      </div>
    </section>

    <CtaBand
      eyebrow="Not sure what you need?"
      title="We’ll recommend the right stack for your project"
      text="Book a free consultation and we’ll suggest an architecture and toolset that fits your goals, team and budget."
      primary-label="Get a Free Consultation"
      primary-to="/consultation"
      secondary-label="See Our Services"
      secondary-to="/services"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { techCategories } = defineProps({
  techCategories: { type: Array, default: () => [] },
})
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }
.tech-card { padding: clamp(1.5rem, 3vw, 2rem); }
.tech-card .icon-tile { margin-bottom: var(--space-5); }
.tech-card__title { font-size: 1.3rem; margin-bottom: var(--space-5); }
.tech-card__items { gap: 8px; }
.tech-note {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  text-align: center;
  max-width: 60ch;
  margin: clamp(2.5rem, 5vw, 4rem) auto 0;
  color: var(--text-muted);
  font-size: var(--fs-sm);
}
.tech-note :deep(.icon) { color: var(--yellow); flex-shrink: 0; }
</style>
