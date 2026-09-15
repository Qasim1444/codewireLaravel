<template>
  <div class="home">
    <!-- ===================== HERO ===================== -->
    <section class="hero">
      <div class="container hero__layout">

        <!-- â”€â”€ LEFT: Text content â”€â”€ -->
        <div class="hero__content">
          <h1 class="display hero__title reveal" v-reveal="80">
Smart Software Real Growth
          </h1>
          <p class="lead hero__lead reveal" v-reveal="160">
            CodeWire Solutions designs, builds and scales web, mobile and AI products â€”
            from first prototype to production. A senior team, fixed timelines and honest
            communication, start to finish.
          </p>
          <div class="btn-group hero__cta reveal" v-reveal="240">
            <Link href="/contact#start" class="btn btn--primary btn--lg">
              Start a Project <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/work" class="btn btn--ghost btn--lg">View Our Work</Link>
          </div>
          <ul class="hero__points reveal" v-reveal="320">
            <li v-for="p in heroPoints" :key="p"><AppIcon name="check" :size="16" /> {{ p }}</li>
          </ul>
        </div>

        <!-- â”€â”€ RIGHT: Abstract geometric visual â”€â”€ -->
        <div class="hero__visual reveal" v-reveal="180" aria-hidden="true">

          <!-- Large outlined numeral â€” confidence anchor -->
          <span class="hv-numeral">50<sup>+</sup></span>

          <!-- SVG geometry layer -->
          <svg class="hv-svg" viewBox="0 0 480 480" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Outer thin ring -->
            <circle cx="240" cy="240" r="220" stroke="currentColor" stroke-width="0.75" stroke-dasharray="6 10" opacity="0.18"/>
            <!-- Middle ring -->
            <circle cx="240" cy="240" r="160" stroke="currentColor" stroke-width="1" opacity="0.12"/>
            <!-- Inner ring with gap -->
            <circle cx="240" cy="240" r="100" stroke="currentColor" stroke-width="1.5" stroke-dasharray="4 8" opacity="0.2"/>
            <!-- Yellow arc â€” 270Â° sweep -->
            <path
              d="M240 80 A160 160 0 1 1 80.5 285"
              stroke="#ffc400" stroke-width="2" stroke-linecap="round" opacity="0.7"
            />
            <!-- Cross-hair lines -->
            <line x1="20"  y1="240" x2="460" y2="240" stroke="currentColor" stroke-width="0.6" opacity="0.1"/>
            <line x1="240" y1="20"  x2="240" y2="460" stroke="currentColor" stroke-width="0.6" opacity="0.1"/>
            <!-- Corner tick marks -->
            <line x1="60"  y1="60"  x2="90"  y2="60"  stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="60"  y1="60"  x2="60"  y2="90"  stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="420" y1="60"  x2="390" y2="60"  stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="420" y1="60"  x2="420" y2="90"  stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="60"  y1="420" x2="90"  y2="420" stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="60"  y1="420" x2="60"  y2="390" stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="420" y1="420" x2="390" y2="420" stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <line x1="420" y1="420" x2="420" y2="390" stroke="currentColor" stroke-width="1.2" opacity="0.22"/>
            <!-- Yellow accent dot -->
            <circle cx="240" cy="80"  r="5" fill="#ffc400"/>
            <!-- Small pulse ring on accent dot -->
            <circle cx="240" cy="80"  r="11" stroke="#ffc400" stroke-width="1" opacity="0.35"/>
          </svg>

          <!-- Stat chips â€” positioned at compass points -->
          <div class="hv-chip hv-chip--top">
            <strong>50+</strong>
            <span>Projects delivered</span>
          </div>
          <div class="hv-chip hv-chip--right">
            <strong>98%</strong>
            <span>On-time rate</span>
          </div>
          <div class="hv-chip hv-chip--bottom">
            <strong>5.0</strong>
            <span>Avg. client rating</span>
          </div>
          <div class="hv-chip hv-chip--left">
            <strong>6+</strong>
            <span>Years in market</span>
          </div>

        </div>
        <!-- /hero__visual -->

      </div>

    </section>

    <!-- ===================== STATS / SOCIAL PROOF ===================== -->
    <section class="section section--tight surface-elev stats-band">
      <div class="container">
        <p class="eyebrow eyebrow--center" v-reveal>By the numbers</p>
        <div class="grid grid-4 stats-band__grid">
          <StatItem
            v-for="(s, i) in stats"
            :key="s.label"
            v-reveal="i * 70"
            :value="s.value"
            :suffix="s.suffix"
            :label="s.label"
            
          />
        </div>
      </div>
    </section>

    <!-- ===================== SERVICES ===================== -->
    <section class="section">
      <div class="container">
        <div class="between services__head">
          <SectionHeading
            eyebrow="What we do"
            title="End-to-end product engineering"
          >
            From first prototype to production scale â€” one senior team across the whole stack.
          </SectionHeading>
          <Link href="/services" class="btn btn--ghost services__head-cta">
            All Services <AppIcon name="arrow-right" class="icon-arrow" />
          </Link>
        </div>
        <div class="grid grid-3">
          <ServiceCard
            v-for="(s, i) in servicesPreview"
            :key="s.slug"
            v-reveal="i * 60"
            :service="s"
          />
        </div>
      </div>
    </section>

    <!-- ===================== FEATURED WORK ===================== -->
    <section class="section surface-elev">
      <div class="container">
        <SectionHeading
          center
          eyebrow="Selected work"
          title="Products weâ€™ve helped bring to life"
        >
          A look at the real products we have designed, built and launched — across web, mobile, e-commerce, AI and more.

        </SectionHeading>
        <div class="grid grid-3">
          <ProjectCard
            v-for="(p, i) in featuredProjects"
            :key="p.slug"
            v-reveal="i * 70"
            :project="p"
          />
        </div>
        <div class="section-cta" v-reveal>
          <Link href="/work" class="btn btn--ghost">
            Explore all case studies <AppIcon name="arrow-right" class="icon-arrow" />
          </Link>
        </div>
      </div>
    </section>

    <!-- ===================== WHY CODEWIRE ===================== -->
    <section class="section">
      <div class="container">
        <SectionHeading
          eyebrow="Why CodeWire"
          title="A partner you can actually build with"
        >
          We combine senior engineering with honest communication â€” so you get software
          that works, on a timeline you can trust.
        </SectionHeading>
        <div class="grid grid-3">
          <article
            v-for="(d, i) in differentiators"
            :key="d.title"
            class="card why-card"
            v-reveal="i * 60"
          >
            <span class="icon-tile"><AppIcon :name="d.icon" /></span>
            <h3 class="why-card__title">{{ d.title }}</h3>
            <p class="why-card__text">{{ d.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- ===================== PROCESS ===================== -->
    <section class="section surface-elev process">
      <div class="container">
        <SectionHeading
          center
          eyebrow="How we work"
          title="A proven six-step process"
        >
          Transparent, collaborative and built around your goals â€” from first call to long-term support.
        </SectionHeading>
        <div class="grid grid-3 process__grid">
          <article
            v-for="(step, i) in processSteps"
            :key="step.no"
            class="process-step"
            v-reveal="i * 60"
          >
<span class="big-number process-step__no" style="color: #ffc400;">
    {{ step.no }}
</span>            <h3 class="process-step__title">{{ step.title }}</h3>
            <p class="process-step__text">{{ step.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- ===================== TECH STACK ===================== -->
  

    <!-- ===================== TESTIMONIALS ===================== -->
    <section class="section surface-elev testi-section">
      <div class="container">
        <div class="testi-head" v-reveal>
          <SectionHeading
            eyebrow="What clients say"
            title="Trusted by the teams we work with"
          >
            Real reviews from clients and students we have worked with.
          </SectionHeading>
          <div class="testi-nav">
            <button class="testi-nav__btn" id="testi-prev" aria-label="Previous review">
              <AppIcon name="arrow-left" :size="18" />
            </button>
            <button class="testi-nav__btn" id="testi-next" aria-label="Next review">
              <AppIcon name="arrow-right" :size="18" />
            </button>
          </div>
        </div>

        <Swiper
          class="testi-swiper"
          :modules="swiperModules"
          :slides-per-view="1"
          :space-between="28"
          :loop="true"
          :pagination="{ clickable: true, el: '.testi-pagination' }"
          :navigation="{ prevEl: '#testi-prev', nextEl: '#testi-next' }"
          :breakpoints="{
            640:  { slidesPerView: 1 },
            768:  { slidesPerView: 2 },
            1100: { slidesPerView: 3 },
          }"
        >
          <SwiperSlide v-for="(t, i) in clientTestimonials" :key="i">
            <TestimonialCard :item="t" />
          </SwiperSlide>
        </Swiper>

        <div class="testi-pagination"></div>
      </div>
    </section>

    

    <!-- ===================== LATEST INSIGHTS ===================== -->
    <section class="section surface-elev">
      <div class="container">
        <div class="between services__head">
          <SectionHeading eyebrow="Insights" title="From the CodeWire blog">
            Practical thinking on building, shipping and scaling software.
          </SectionHeading>
          <Link href="/blog" class="btn btn--ghost services__head-cta">
            All Articles <AppIcon name="arrow-right" class="icon-arrow" />
          </Link>
        </div>
        <div class="grid grid-3">
          <PostCard v-for="(post, i) in recentPosts" :key="post.slug" v-reveal="i * 70" :post="post" />
        </div>
      </div>
    </section>

    <!-- ===================== FINAL CTA ===================== -->
    <CtaBand />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import StatItem from '@/Components/ui/StatItem.vue'
import ServiceCard from '@/Components/ui/ServiceCard.vue'
import ProjectCard from '@/Components/ui/ProjectCard.vue'
import TestimonialCard from '@/Components/ui/TestimonialCard.vue'
import PostCard from '@/Components/ui/PostCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'

import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/pagination'

const {
  homeServices,
  featuredProjects,
  stats,
  clientTestimonials,
  recentPosts,
  techCategories,
  differentiators,
  processSteps,
  courses,
} = defineProps({
  homeServices: { type: Array, default: () => [] },
  featuredProjects: { type: Array, default: () => [] },
  stats: { type: Array, default: () => [] },
  clientTestimonials: { type: Array, default: () => [] },
  recentPosts: { type: Array, default: () => [] },
  techCategories: { type: Array, default: () => [] },
  differentiators: { type: Array, default: () => [] },
  processSteps: { type: Array, default: () => [] },
  courses: { type: Array, default: () => [] },
})

const swiperModules = [Navigation, Pagination]


const heroTech = ['Vue', 'React', 'Next.js', 'Node.js', 'Laravel', 'Python', 'AWS', 'React Native']
const servicesPreview = homeServices.slice(0, 6)
const courseTitles = courses.map((c) => c.title)
</script>

<style scoped>
/* ================================================================
   HERO â€” Two-column layout
   Left: text content  |  Right: animated dashboard visual
   Background untouched (inherits from page)
   ================================================================ */

.hero {
  position: relative;
  padding-top: calc(var(--header-h) + clamp(3rem, 8vw, 6.5rem));
  padding-bottom: clamp(3rem, 6vw, 5rem);
  overflow: hidden;
}

/* ---------- Two-column grid ---------- */
.hero__layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  align-items: center;
  gap: clamp(3rem, 6vw, 6rem);
}

/* ---------- Left: text content ---------- */
.hero__content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  text-align: left;
}
.hero__title {
  margin: var(--space-5) 0;
  max-width: 18ch;
}
.hero__lead {
  max-width: 52ch;
  margin-bottom: var(--space-6);
}
.hero__cta {
  justify-content: flex-start;
}
.hero__points {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  margin-top: var(--space-6);
}
.hero__points li {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.hero__points :deep(.icon) {
  color: var(--yellow);
  flex-shrink: 0;
}

/* ---------- Right: geometric visual ---------- */
.hero__visual {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 460px;
  color: var(--text-hi);
  overflow: hidden; /* prevent chips from creating horizontal scroll / red lines */
}

/* Large ghost numeral â€” background anchor */
.hv-numeral {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-display);
  font-size: clamp(9rem, 18vw, 14rem);
  font-weight: 700;
  letter-spacing: -0.05em;
  color: transparent;
  -webkit-text-stroke: 1px rgba(11, 11, 11, 0.07);
  user-select: none;
  pointer-events: none;
  line-height: 1;
}
.hv-numeral sup {
  font-size: 0.38em;
  vertical-align: super;
  -webkit-text-stroke: 1px rgba(11, 11, 11, 0.07);
}

/* SVG rings + geometry */
.hv-svg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  color: var(--text-hi);
  pointer-events: none;
  animation: hv-slow-spin 60s linear infinite;
}
@keyframes hv-slow-spin {
  from { transform: rotate(0deg); }
  to   { transform: rotate(360deg); }
}

/* Stat chips â€” positioned at 4 compass points */
.hv-chip {
  position: absolute;
  display: flex;
  flex-direction: column;
  gap: 2px;
  padding: 12px 18px;
  background: var(--bg-elev);
  border: 1px solid var(--border-strong);
  border-radius: var(--radius);
  box-shadow: var(--shadow-sm);
  text-align: center;
  min-width: 110px;
  transition: transform var(--dur) var(--ease), box-shadow var(--dur) var(--ease);
  animation: hv-chip-in 0.6s var(--ease) both;
}
.hv-chip:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-md);
  border-color: var(--yellow);
}
.hv-chip strong {
  font-family: var(--font-display);
  font-size: 1.6rem;
  font-weight: 700;
  letter-spacing: -0.02em;
  color: var(--text-hi);
  line-height: 1;
}
.hv-chip span {
  font-size: 10.5px;
  font-weight: 500;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: var(--text-muted);
}
/* Yellow accent line on top */
.hv-chip::before {
  content: '';
  position: absolute;
  top: -1px;
  left: 20%;
  right: 20%;
  height: 2px;
  background: var(--yellow);
  border-radius: 0 0 2px 2px;
  opacity: 0;
  transition: opacity var(--dur) var(--ease);
}
.hv-chip:hover::before { opacity: 1; }

/* Positioning */
.hv-chip--top    { top: 4%;  left: 50%; transform: translateX(-50%); animation-delay: 0.1s; }
.hv-chip--right  { top: 50%; right: 4%; transform: translateY(-50%); animation-delay: 0.2s; }
.hv-chip--bottom { bottom: 4%; left: 50%; transform: translateX(-50%); animation-delay: 0.3s; }
.hv-chip--left   { top: 50%; left: 4%; transform: translateY(-50%); animation-delay: 0.4s; }

/* Hover overrides so transform keeps position */
.hv-chip--top:hover    { transform: translateX(-50%) translateY(-4px); }
.hv-chip--right:hover  { transform: translateY(-50%) translateX(-4px); }
.hv-chip--bottom:hover { transform: translateX(-50%) translateY(4px); }
.hv-chip--left:hover   { transform: translateY(-50%) translateX(4px); }

@keyframes hv-chip-in {
  from { opacity: 0; transform: scale(0.88); }
  to   { opacity: 1; }
}
/* fix: chip-in keyframe must not fight position transforms */
.hv-chip--top    { animation-name: hv-chip-in-top; }
.hv-chip--right  { animation-name: hv-chip-in-right; }
.hv-chip--bottom { animation-name: hv-chip-in-bottom; }
.hv-chip--left   { animation-name: hv-chip-in-left; }

@keyframes hv-chip-in-top {
  from { opacity: 0; transform: translateX(-50%) translateY(12px); }
  to   { opacity: 1; transform: translateX(-50%) translateY(0); }
}
@keyframes hv-chip-in-right {
  from { opacity: 0; transform: translateY(-50%) translateX(-12px); }
  to   { opacity: 1; transform: translateY(-50%) translateX(0); }
}
@keyframes hv-chip-in-bottom {
  from { opacity: 0; transform: translateX(-50%) translateY(-12px); }
  to   { opacity: 1; transform: translateX(-50%) translateY(0); }
}
@keyframes hv-chip-in-left {
  from { opacity: 0; transform: translateY(-50%) translateX(12px); }
  to   { opacity: 1; transform: translateY(-50%) translateX(0); }
}

/* ---------- Responsive ---------- */
@media (max-width: 960px) {
  .hero__layout {
    grid-template-columns: 1fr;
    text-align: center;
  }
  .hero__content {
    align-items: center;
    text-align: center;
  }
  .hero__title { max-width: 100%; }
  .hero__cta   { justify-content: center; }
  .hero__points {
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
  }
  .hero__visual {
    display: none;
  }
}

@media (max-width: 640px) {
  .testi-head {
    flex-direction: column;
    align-items: flex-start;
    gap: var(--space-4);
  }
  .academy-teaser__inner {
    padding: clamp(1.5rem, 4vw, 2.5rem);
  }
}

/* ---------------- STATS ---------------- */
.stats-band__grid {
  text-align: center;
}
.stats-band__note {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-top: var(--space-6);
  font-size: var(--fs-xs);
  color: var(--text-faint);
  text-align: center;
}
.stats-band__note :deep(.icon) { color: var(--yellow); flex-shrink: 0; }

/* ---------------- SERVICES HEAD ---------------- */
.services__head {
  align-items: flex-end;
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
}
.services__head :deep(.section-head) {
  margin-bottom: 0;
}
.section-cta {
  display: flex;
  justify-content: center;
  margin-top: var(--space-7);
}

/* ---------------- WHY ---------------- */
.why-card__title {
  font-size: 1.25rem;
  margin: var(--space-5) 0 var(--space-3);
}
.why-card__text {
  font-size: var(--fs-sm);
  color: var(--text-muted);
}

/* ---------------- PROCESS ---------------- */
.process__grid {
  gap: var(--space-6);
}
.process-step {
  padding-top: var(--space-5);
  border-top: 2px solid var(--border);
  transition: border-color var(--dur) var(--ease);
}
.process-step:hover {
  border-top-color: var(--yellow);
}
.process-step__no {
  display: block;
  margin-bottom: var(--space-4);
}
.process-step__title {
  font-size: 1.35rem;
  margin-bottom: var(--space-3);
}
.process-step__text {
  font-size: var(--fs-sm);
  color: var(--text-muted);
}

/* ---------------- TECH ---------------- */
.tech-card__head {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-bottom: var(--space-5);
}
.tech-card__label {
  font-size: 1.15rem;
}

/* ---------------- ACADEMY TEASER ---------------- */
.academy-teaser__inner {
  position: relative;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1.3fr 0.7fr;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: center;
  padding: clamp(2.5rem, 5vw, 4.5rem);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-xl);
}
.academy-teaser__content { position: relative; z-index: 1; }
.academy-teaser__content .h2 { margin: var(--space-4) 0; max-width: 20ch; }
.academy-teaser__content .lead { margin-bottom: var(--space-6); }
.academy-teaser__list {
  position: relative;
  z-index: 1;
  display: flex;
  flex-direction: column;
  gap: var(--space-4);
}
.academy-teaser__list li {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: var(--space-4) var(--space-5);
  background: var(--bg-base);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  font-weight: 500;
  color: var(--text-hi);
}
.academy-teaser__list :deep(.icon) { color: var(--yellow); flex-shrink: 0; }

/* ---------------- RESPONSIVE ---------------- */
@media (max-width: 900px) {
  .academy-teaser__inner {
    grid-template-columns: 1fr;
  }
  .services__head {
    flex-direction: column;
    align-items: flex-start;
    gap: var(--space-5);
  }
}

/* ================================================================
   TESTIMONIALS SLIDER
   ================================================================ */
.testi-head {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  gap: var(--space-5);
  margin-bottom: clamp(2rem, 4vw, 3rem);
}
.testi-head :deep(.section-head) { margin-bottom: 0; }

/* Arrow buttons */
.testi-nav {
  display: flex;
  gap: 10px;
  flex-shrink: 0;
}
.testi-nav__btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  border: 1px solid var(--border-strong);
  background: var(--bg-elev);
  color: var(--text-body);
  cursor: pointer;
  transition: background var(--dur-fast) var(--ease),
              border-color var(--dur-fast) var(--ease),
              color var(--dur-fast) var(--ease),
              transform var(--dur-fast) var(--ease);
}
.testi-nav__btn:hover {
  background: var(--yellow);
  border-color: var(--yellow);
  color: #0b0b0b;
  transform: scale(1.08);
}
.testi-nav__btn:disabled,
.testi-nav__btn.swiper-button-disabled {
  opacity: 0.35;
  pointer-events: none;
}

/* Swiper container */
.testi-swiper {
  overflow: visible;
  padding-bottom: 4px; /* room for card shadow */
}
.testi-swiper :deep(.swiper-slide) {
  height: auto;        /* equal-height cards */
}
.testi-swiper :deep(.testimonial) {
  height: 100%;
}

/* Pagination dots */
.testi-pagination {
  display: flex;
  justify-content: center;
  gap: 8px;
  margin-top: var(--space-7);
}
.testi-pagination :deep(.swiper-pagination-bullet) {
  width: 8px;
  height: 8px;
  border-radius: 99px;
  background: var(--border-strong);
  opacity: 1;
  transition: width var(--dur) var(--ease),
              background var(--dur) var(--ease);
  cursor: pointer;
  margin: 0 !important;
}
.testi-pagination :deep(.swiper-pagination-bullet-active) {
  width: 24px;
  background: var(--yellow);
}

@media (max-width: 640px) {
  .testi-head {
    flex-direction: column;
    align-items: flex-start;
  }
}</style>
