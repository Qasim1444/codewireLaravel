<template>
  <NotFoundInline
    v-if="!service"
    title="That service doesn’t exist"
    text="We couldn’t find the service you were looking for. Browse everything we offer instead."
    back-to="/services"
    back-label="All Services"
  />

  <div v-else class="service-detail">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow service-detail__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <Link href="/services">Services</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ service.title }}</span>
        </nav>
        <div class="page-hero__inner">
          <span class="icon-tile service-detail__icon" v-reveal><AppIcon :name="service.icon" /></span>
          <h1 class="display service-detail__title" v-reveal="60">{{ service.title }}</h1>
          <p class="lead" v-reveal="120">{{ service.short }}</p>
          <div class="btn-group" v-reveal="180">
            <Link href="/consultation#book" class="btn btn--primary btn--lg">
              Get a Free Consultation <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/work" class="btn btn--ghost btn--lg">See related work</Link>
          </div>
        </div>
      </div>
    </section>

    <!-- PROBLEM / SOLUTION -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="ps-grid">
          <article class="ps-card card" v-reveal>
            <h2 class="ps-card__title"><span class="dot" /> The challenge</h2>
            <p>{{ service.problem }}</p>
          </article>
          <article class="ps-card card ps-card--accent" v-reveal="80">
            <h2 class="ps-card__title"><span class="dot dot--accent" /> How we help</h2>
            <p>{{ service.solution }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- WHAT'S INCLUDED + STACK -->
    <section class="section surface-elev">
      <div class="container">
        <div class="incl-grid">
          <div v-reveal>
            <SectionHeading eyebrow="What’s included" :title="`Everything in our ${service.title.toLowerCase()}`" />
            <ul class="feature-list incl-list">
              <li v-for="f in service.features" :key="f">
                <AppIcon name="check-circle" :size="18" /> {{ f }}
              </li>
            </ul>
          </div>
          <aside class="incl-side card" v-reveal="80">
            <h3 class="incl-side__label">Typical stack</h3>
            <div class="cluster incl-side__tech">
              <span v-for="t in service.tech" :key="t" class="tag">{{ t }}</span>
            </div>
            <div class="incl-side__divider" />
            <h3 class="incl-side__label">Why CodeWire</h3>
            <ul class="incl-side__why">
              <li><AppIcon name="check" :size="16" /> Senior engineers on every project</li>
              <li><AppIcon name="check" :size="16" /> Clear scope and honest estimates</li>
              <li><AppIcon name="check" :size="16" /> You own the code and the IP</li>
            </ul>
            <Link href="/consultation#book" class="btn btn--primary btn--block incl-side__cta">
              Start a project
            </Link>
          </aside>
        </div>
      </div>
    </section>

    <!-- RELATED SERVICES -->
    <section v-if="related.length" class="section">
      <div class="container">
        <SectionHeading eyebrow="Explore more" title="Related services">
          We cover the whole product lifecycle — here’s what pairs well with this.
        </SectionHeading>
        <div class="grid grid-3">
          <ServiceCard v-for="(s, i) in related" :key="s.slug" v-reveal="i * 60" :service="s" />
        </div>
      </div>
    </section>

    <CtaBand
      :eyebrow="`Ready to talk ${service.title.toLowerCase()}?`"
      title="Tell us the problem — we’ll map the solution"
      text="Book a free, no-pressure consultation. We’ll help you scope the work and recommend the right approach."
      primary-label="Book a Consultation"
      primary-to="/consultation"
      secondary-label="View Our Work"
      secondary-to="/work"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import ServiceCard from '@/Components/ui/ServiceCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'

const props = defineProps({
  service: { type: Object, default: null },
  services: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})
const services = props.services
const service = computed(() => props.service)
const related = computed(() =>
  service.value ? services.filter((s) => s.slug !== service.value.slug).slice(0, 3) : []
)
</script>

<style scoped>
.service-detail__glow { top: -180px; right: -120px; }
.service-detail__icon { margin-bottom: var(--space-5); }
.service-detail__title { max-width: 16ch; }

/* Problem / solution */
.ps-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
}
.ps-card { padding: clamp(1.75rem, 3vw, 2.5rem); }
.ps-card--accent { border-color: var(--yellow-tint-2); }
.ps-card__title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-4);
}
.ps-card p { color: var(--text-body); line-height: 1.7; }
.dot { width: 8px; height: 8px; border-radius: 50%; background: var(--text-faint); }
.dot--accent { background: var(--yellow); }

/* Included */
.incl-grid {
  display: grid;
  grid-template-columns: 1.2fr 0.8fr;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}
.incl-list {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4) var(--space-5);
}
.incl-list li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  color: var(--text-body);
  font-size: var(--fs-sm);
}
.incl-list :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 1px; }
.incl-side {
  padding: clamp(1.75rem, 3vw, 2.5rem);
  position: sticky;
  top: calc(var(--header-h) + 20px);
}
.incl-side__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.incl-side__divider { height: 1px; background: var(--border); margin: var(--space-6) 0; }
.incl-side__why { display: flex; flex-direction: column; gap: var(--space-3); }
.incl-side__why li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.incl-side__why :deep(.icon) { color: var(--yellow); flex-shrink: 0; }
.incl-side__cta { margin-top: var(--space-6); }

@media (max-width: 900px) {
  .ps-grid { grid-template-columns: 1fr; }
  .incl-grid { grid-template-columns: 1fr; }
  .incl-side { position: static; }
}
@media (max-width: 560px) {
  .incl-list { grid-template-columns: 1fr; }
}
</style>
