<template>
  <div class="academy-page">
    <!-- HERO -->
    <section class="academy-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow academy-hero__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Academy</span>
        </nav>
        <div class="academy-hero__inner">
          <span class="badge badge--dot" v-reveal>CodeWire Academy</span>
          <h1 class="display" v-reveal="60">
            Learn to build real software â€” from people who <span class="text-accent">ship it</span>
          </h1>
          <p class="lead" v-reveal="120">
            Career-focused, hands-on technology courses taught by CodeWireâ€™s own working
            engineers. Real projects, real code review, real skills you can put to work.
          </p>
          <div class="btn-group" v-reveal="180">
            <Link href="/contact#enroll" class="btn btn--primary btn--lg">
              Enroll Now <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <a href="#courses" class="btn btn--ghost btn--lg">Browse Courses</a>
          </div>
        </div>

        <div class="grid grid-4 academy-hero__stats" v-reveal="220">
          <StatItem
            v-for="s in academyStats"
            :key="s.label"
            :value="s.value"
            :suffix="s.suffix"
            :label="s.label"
            :sample="s.sample"
          />
        </div>
      </div>
    </section>

    <!-- WHY -->
    <section class="section">
      <div class="container">
        <SectionHeading center eyebrow="Why learn with us" title="Training built like a real dev team">
          No fluff, no endless theory â€” you learn the way our engineers actually work.
        </SectionHeading>
        <div class="grid grid-4">
          <article v-for="(f, i) in features" :key="f.title" class="card academy-feature" v-reveal="i * 60">
            <span class="icon-tile"><AppIcon :name="f.icon" /></span>
            <h3 class="academy-feature__title">{{ f.title }}</h3>
            <p class="academy-feature__text">{{ f.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- COURSES -->
    <section id="courses" class="section surface-elev">
      <div class="container">
        <SectionHeading eyebrow="Our courses" title="Four career-focused tracks">
          Each course is project-based, mentor-led and ends with work you can show employers or clients.
        </SectionHeading>

        <div class="course-blocks">
          <article
            v-for="(c, i) in courses"
            :id="c.slug"
            :key="c.slug"
            class="course-detail card"
            v-reveal="i * 60"
          >
            <div class="course-detail__head">
              <span class="icon-tile"><AppIcon :name="c.icon" /></span>
              <div>
                <h3 class="course-detail__title">{{ c.title }}</h3>
                <p class="course-detail__tagline">{{ c.tagline }}</p>
              </div>
              <span v-if="c.certificate" class="badge badge--outline course-detail__cert">
                <AppIcon name="award" :size="14" /> Certificate
              </span>
            </div>

            <ul class="course-detail__meta">
              <li><span>Level</span><strong>{{ c.level }}</strong></li>
              <li><span>Duration</span><strong>{{ c.duration }}</strong></li>
              <li><span>Format</span><strong>{{ c.mode }}</strong></li>
              <li><span>Projects</span><strong>{{ c.projects }} hands-on</strong></li>
            </ul>

            <div class="course-detail__cols">
              <div>
                <h4 class="course-detail__label">What youâ€™ll learn</h4>
                <div class="cluster">
                  <span v-for="sk in c.skills" :key="sk" class="tag">{{ sk }}</span>
                </div>
              </div>
              <div>
                <h4 class="course-detail__label">By the end, you can</h4>
                <ul class="course-outcomes">
                  <li v-for="o in c.outcomes" :key="o"><AppIcon name="check-circle" :size="16" /> {{ o }}</li>
                </ul>
              </div>
            </div>

            <div class="course-detail__foot">
              <div class="course-detail__instructor">
                <span class="course-detail__instructor-label">Instructor</span>
                <span class="course-detail__instructor-name">{{ c.instructor }}</span>
                <span class="course-detail__instructor-role">{{ c.instructorRole }}</span>
              </div>
              <div class="course-detail__actions">
                <Link :href="`/academy/${c.slug}`" class="btn btn--ghost">
                  View Full Course
                </Link>
                <Link href="/contact#enroll" class="btn btn--primary">
                  Enroll Now <AppIcon name="arrow-right" class="icon-arrow" />
                </Link>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- STUDENT VOICES -->
    <section class="section">
      <div class="container">
        <SectionHeading center eyebrow="Student voices" title="What our learners say">
          Sample testimonials for layout â€” weâ€™ll publish verified student reviews before launch.
        </SectionHeading>
        <div class="grid grid-3">
          <TestimonialCard
            v-for="(t, i) in studentTestimonials"
            :key="i"
            v-reveal="i * 70"
            :item="t"
          />
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Seats are limited"
      title="Ready to start your tech career?"
      text="Tell us which track interests you and weâ€™ll share the next cohort dates, syllabus and enrollment details."
      primary-label="Enroll Now"
      primary-to="/contact#enroll"
      secondary-label="Ask a Question"
      secondary-to="/contact"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import StatItem from '@/Components/ui/StatItem.vue'
import TestimonialCard from '@/Components/ui/TestimonialCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { courses, studentTestimonials, academyStats } = defineProps({
  courses: { type: Array, default: () => [] },
  studentTestimonials: { type: Array, default: () => [] },
  academyStats: { type: Array, default: () => [] },
})

const features = [
  { icon: 'users', title: 'Taught by engineers', text: 'Your instructors build production software every day â€” not just slides.' },
  { icon: 'layers', title: 'Project-based', text: 'You learn by shipping real projects, reviewed the way we review our own code.' },
  { icon: 'award', title: 'Certificate', text: 'Finish with a CodeWire Academy certificate and a portfolio to prove it.' },
  { icon: 'trending-up', title: 'Career support', text: 'Guidance on portfolios, interviews and landing your first role or clients.' },
]
</script>

<style scoped>
.academy-hero {
  position: relative;
  overflow: hidden;
  padding-top: calc(var(--header-h) + clamp(2.5rem, 6vw, 5rem));
  padding-bottom: clamp(3rem, 6vw, 5rem);
}
.academy-hero__glow {
  top: -200px;
  right: -140px;
}
.academy-hero__inner {
  position: relative;
  z-index: 1;
  max-width: 880px;
}
.academy-hero__inner .display {
  margin: var(--space-5) 0;
  max-width: 18ch;
}
.academy-hero__inner .lead {
  margin-bottom: var(--space-6);
  margin-top: var(--space-4);
}
.academy-hero__inner .btn-group {
  margin-top: var(--space-6);
}
.academy-hero__stats {
  position: relative;
  z-index: 1;
  margin-top: clamp(3rem, 6vw, 5rem);
  padding-top: var(--space-7);
  border-top: 1px solid var(--border);
}

.academy-feature__title {
  font-size: 1.15rem;
  margin: var(--space-4) 0 var(--space-3);
}
.academy-feature__text {
  font-size: var(--fs-sm);
  color: var(--text-muted);
}

/* Course detail */
.course-blocks {
  display: flex;
  flex-direction: column;
  gap: var(--space-6);
}
.course-detail {
  scroll-margin-top: calc(var(--header-h) + 20px);
  padding: clamp(1.75rem, 3.5vw, 2.75rem);
}
.course-detail__head {
  display: flex;
  align-items: flex-start;
  gap: var(--space-4);
  margin-bottom: var(--space-6);
}
.course-detail__title {
  font-size: 1.6rem;
}
.course-detail__tagline {
  color: var(--text-muted);
  margin-top: 4px;
}
.course-detail__cert {
  margin-left: auto;
  flex-shrink: 0;
}
.course-detail__meta {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-4);
  padding: var(--space-5) 0;
  margin-bottom: var(--space-6);
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.course-detail__meta li {
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.course-detail__meta span {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-faint);
}
.course-detail__meta strong {
  font-weight: 600;
  color: var(--text-hi);
  font-size: var(--fs-sm);
}
.course-detail__cols {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(1.5rem, 3vw, 3rem);
  margin-bottom: var(--space-6);
}
.course-detail__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.course-outcomes {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}
.course-outcomes li {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.course-outcomes :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 1px; }
.course-detail__foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-5);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
  flex-wrap: wrap;
}
.course-detail__instructor {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.course-detail__instructor-label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-faint);
}
.course-detail__instructor-name {
  font-weight: 700;
  color: var(--text-hi);
  font-family: var(--font-display);
}
.course-detail__instructor-role {
  font-size: var(--fs-sm);
  color: var(--yellow);
}
.course-detail__actions {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3);
}

@media (max-width: 760px) {
  .course-detail__head { flex-wrap: wrap; }
  .course-detail__cert { margin-left: 0; }
  .course-detail__meta { grid-template-columns: repeat(2, 1fr); }
  .course-detail__cols { grid-template-columns: 1fr; }
  .course-detail__foot { flex-direction: column; align-items: flex-start; }
}
@media (max-width: 480px) {
  .academy-hero__inner .display { font-size: clamp(2.4rem, 9vw, 3.5rem); }
  .course-detail__meta { grid-template-columns: 1fr 1fr; }
  .course-detail__actions { width: 100%; }
  .course-detail__actions .btn { flex: 1; justify-content: center; }
}
</style>
