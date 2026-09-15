<template>
  <div class="services-page">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Services</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Software that fits how you <span class="text-accent">actually work</span></h1>
          <p class="lead" v-reveal="120">
            From custom web and mobile apps to AI, cloud and QA — we cover the full product
            lifecycle with one senior team, so nothing falls through the cracks.
          </p>
          <div class="btn-group" v-reveal="180">
            <Link href="/contact" class="btn btn--primary">
              Get a Free Consultation <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/work" class="btn btn--ghost">See the results</Link>
          </div>
        </div>

        <!-- Jump nav -->
        <div class="services-jump" v-reveal="220">
          <a v-for="s in services" :key="s.slug" :href="`#${s.slug}`" class="tag services-jump__tag">
            {{ s.title }}
          </a>
        </div>
      </div>
    </section>

    <!-- SERVICE BLOCKS -->
    <section
      v-for="(s, i) in services"
      :id="s.slug"
      :key="s.slug"
      class="section service-block"
      :class="i % 2 === 1 ? 'surface-elev' : ''"
    >
      <div class="container">
        <div class="service-block__grid" :class="{ 'service-block__grid--rev': i % 2 === 1 }">
          <div class="service-block__intro" v-reveal>
            <span class="icon-tile"><AppIcon :name="s.icon" /></span>
            <span class="service-block__index">Service {{ String(i + 1).padStart(2, '0') }}</span>
            <h2 class="h2">{{ s.title }}</h2>
            <p class="service-block__short">{{ s.short }}</p>

            <div class="service-block__pt">
              <h3 class="service-block__ptitle"><span class="dot" /> The challenge</h3>
              <p>{{ s.problem }}</p>
            </div>
            <div class="service-block__pt">
              <h3 class="service-block__ptitle service-block__ptitle--accent"><span class="dot dot--accent" /> How we help</h3>
              <p>{{ s.solution }}</p>
            </div>
          </div>

          <div class="service-block__detail" v-reveal="80">
            <div class="card service-block__card">
              <h3 class="service-block__caption">What’s included</h3>
              <ul class="feature-list">
                <li v-for="f in s.features" :key="f">
                  <AppIcon name="check-circle" :size="18" /> {{ f }}
                </li>
              </ul>
              <h3 class="service-block__caption">Typical stack</h3>
              <div class="cluster">
                <span v-for="t in s.tech" :key="t" class="tag">{{ t }}</span>
              </div>
              <div class="service-block__links">
                <Link :href="`/services/${s.slug}`" class="link-arrow service-block__link service-block__link--primary">
                  See full details <AppIcon name="arrow-right" />
                </Link>
                <Link href="/contact#start" class="link-arrow service-block__link">
                  Discuss a project <AppIcon name="arrow-right" />
                </Link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Not sure where to start?"
      title="Tell us the problem — we’ll map the solution"
      text="Book a free, no-pressure consultation. We’ll help you scope the work and recommend the right approach, even if that turns out not to be us."
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { services } = defineProps({
  services: { type: Array, default: () => [] },
})
</script>

<style scoped>
.services-jump {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
  margin-top: clamp(2.5rem, 5vw, 4rem);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
}
.services-jump__tag {
  cursor: pointer;
}

.service-block {
  scroll-margin-top: calc(var(--header-h) + 20px);
}
.service-block__grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(2rem, 5vw, 4.5rem);
  align-items: center;
}
.service-block__grid--rev .service-block__intro {
  order: 2;
}
.service-block__index {
  display: block;
  margin: var(--space-5) 0 var(--space-3);
  font-size: var(--fs-xs);
  letter-spacing: var(--ls-wide);
  text-transform: uppercase;
  color: var(--yellow);
}
.service-block__short {
  font-size: var(--fs-lead);
  color: var(--text-body);
  margin: var(--space-4) 0 var(--space-6);
}
.service-block__pt {
  margin-bottom: var(--space-5);
}
.service-block__pt p {
  color: var(--text-muted);
  font-size: var(--fs-sm);
  line-height: 1.7;
}
.service-block__ptitle {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-3);
}
.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--text-faint);
}
.dot--accent {
  background: var(--yellow);
}

.service-block__card {
  padding: clamp(1.75rem, 3vw, 2.5rem);
}
.service-block__caption {
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.service-block__caption:not(:first-child) {
  margin-top: var(--space-6);
}
.feature-list {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-3) var(--space-4);
}
.feature-list li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.feature-list :deep(.icon) {
  color: var(--yellow);
  flex-shrink: 0;
  margin-top: 1px;
}
.service-block__link {
  margin-top: var(--space-6);
}
.service-block__links {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-4) var(--space-6);
  margin-top: var(--space-6);
}
.service-block__links .service-block__link {
  margin-top: 0;
}
.service-block__link--primary {
  color: var(--text-hi);
}
.service-block__link--primary:hover {
  color: var(--yellow);
}

@media (max-width: 900px) {
  .service-block__grid {
    grid-template-columns: 1fr;
  }
  .service-block__grid--rev .service-block__intro {
    order: 0;
  }
  .feature-list {
    grid-template-columns: 1fr 1fr;
  }
}
@media (max-width: 560px) {
  .feature-list {
    grid-template-columns: 1fr;
  }
  .services-jump {
    gap: var(--space-2);
  }
}
</style>
