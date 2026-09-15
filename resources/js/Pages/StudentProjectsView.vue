<template>
  <div class="sp-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <Link href="/academy">Academy</Link>
          <span class="sep">/</span>
          <span aria-current="page">Student Projects</span>
        </nav>
        <div class="page-hero__inner">
          <span class="badge badge--dot" v-reveal>CodeWire Academy</span>
          <h1 class="display sp-title" v-reveal="60">Built by our <span class="text-accent">students</span></h1>
          <p class="lead" v-reveal="120">
            Every CodeWire Academy track ends with real, deployable projects â€” not just tutorials.
            Hereâ€™s a preview of the kind of work our students ship.
          </p>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <!-- PROJECTS -->
        <div class="grid grid-3 sp-grid">
          <article
            v-for="(proj, i) in studentProjects"
            :key="proj.title"
            class="sp-card card card--hover"
            v-reveal="i * 60"
          >
            <div class="sp-card__media">
              <img :src="proj.image" :alt="proj.title" loading="lazy" />
            </div>
            <div class="sp-card__body">
              <span class="sp-card__course"><AppIcon name="graduation-cap" :size="14" /> {{ proj.course }}</span>
              <h2 class="sp-card__title">{{ proj.title }}</h2>
              <p class="sp-card__student">By {{ proj.student }}</p>
              <div class="cluster sp-card__tech">
                <span v-for="t in proj.tech" :key="t" class="tag">{{ t }}</span>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Your project could be here"
      title="Learn to build things worth showing"
      text="Join a CodeWire Academy cohort and graduate with a portfolio of real, reviewed projects â€” not just a certificate."
      primary-label="Explore Courses"
      primary-to="/academy"
      secondary-label="Ask About Enrollment"
      secondary-to="/contact#enroll"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { studentProjects } = defineProps({
  studentProjects: { type: Array, default: () => [] },
})
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }
.sp-page .badge--dot { margin-bottom: var(--space-5); }
.sp-title { margin-bottom: var(--space-4); }

.sp-notice {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: var(--space-5);
  margin-bottom: clamp(2rem, 4vw, 3rem);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius-lg);
}
.sp-notice :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 2px; }
.sp-notice p { color: var(--text-body); font-size: var(--fs-sm); line-height: 1.6; }
.sp-notice strong { color: var(--text-hi); }

.sp-card { padding: 0; overflow: hidden; }
.sp-card__media {
  position: relative;
  aspect-ratio: 16 / 10;
  overflow: hidden;
}
.sp-card__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--dur-slow) var(--ease);
}
.sp-card:hover .sp-card__media img { transform: scale(1.06); }
.sp-card__flag { position: absolute; top: 14px; right: 14px; }
.sp-card__body { padding: var(--space-5); }
.sp-card__course {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--yellow);
  margin-bottom: var(--space-3);
}
.sp-card__title { font-size: 1.25rem; margin-bottom: 4px; }
.sp-card__student { font-size: var(--fs-sm); color: var(--text-muted); margin-bottom: var(--space-4); }
.sp-card__tech { gap: 8px; }
</style>
