<template>
  <NotFoundInline
    v-if="!course"
    title="That course doesnâ€™t exist"
    text="We couldnâ€™t find the course you were looking for. Browse the full CodeWire Academy catalog instead."
    back-to="/academy"
    back-label="All Courses"
  />

  <div v-else class="course-detail-page">
    <!-- HERO -->
    <section class="course-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow course-hero__glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <Link href="/academy">Academy</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ course.title }}</span>
        </nav>
        <div class="course-hero__inner">
          <div class="course-hero__head" v-reveal>
            <span class="icon-tile"><AppIcon :name="course.icon" /></span>
            <span class="badge badge--dot">CodeWire Academy</span>
          </div>
          <h1 class="display course-hero__title" v-reveal="60">{{ course.title }}</h1>
          <p class="lead" v-reveal="120">{{ course.tagline }}</p>
          <ul class="course-hero__meta" v-reveal="180">
            <li><AppIcon name="chevron-right" :size="15" /> {{ course.level }}</li>
            <li><AppIcon name="clock" :size="15" /> {{ course.duration }}</li>
            <li><AppIcon name="globe" :size="15" /> {{ course.mode }}</li>
            <li><AppIcon name="layers" :size="15" /> {{ course.projects }} hands-on projects</li>
            <li v-if="course.certificate"><AppIcon name="award" :size="15" /> Certificate</li>
          </ul>
          <div class="btn-group" v-reveal="220">
            <Link href="/contact#enroll" class="btn btn--primary btn--lg">
              Enroll Now <AppIcon name="arrow-right" class="icon-arrow" />
            </Link>
            <Link href="/contact" class="btn btn--ghost btn--lg">Ask a Question</Link>
          </div>
        </div>
      </div>
    </section>

    <!-- BODY -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="course-body">
          <div class="course-body__main">
            <!-- What you'll learn -->
            <div class="course-block" v-reveal>
              <h2 class="h3">What youâ€™ll learn</h2>
              <div class="cluster course-skills">
                <span v-for="sk in course.skills" :key="sk" class="tag">{{ sk }}</span>
              </div>
            </div>

            <!-- Outcomes -->
            <div class="course-block" v-reveal>
              <h2 class="h3">By the end, youâ€™ll be able to</h2>
              <ul class="course-outcomes">
                <li v-for="o in course.outcomes" :key="o"><AppIcon name="check-circle" :size="18" /> {{ o }}</li>
              </ul>
            </div>

            <!-- Curriculum (indicative) -->
            <div class="course-block" v-reveal>
              <div class="course-block__head">
                <h2 class="h3">Indicative curriculum</h2>
              </div>
              <p class="course-block__note">
                A representative module breakdown. The finalized syllabus and cohort schedule are
                shared before enrollment.
              </p>
              <ol class="curriculum">
                <li v-for="(sk, i) in course.skills" :key="sk" class="curriculum__item">
                  <span class="curriculum__no">{{ String(i + 1).padStart(2, '0') }}</span>
                  <div>
                    <h3 class="curriculum__title">{{ sk }}</h3>
                    <p class="curriculum__text">Hands-on lessons and a guided exercise applying {{ sk.toLowerCase() }} to a real project.</p>
                  </div>
                </li>
              </ol>
            </div>

            <!-- Instructor -->
            <div class="course-block course-instructor card" v-reveal>
              <span class="course-instructor__label">Your instructor</span>
              <h3 class="course-instructor__name">{{ course.instructor }}</h3>
              <p class="course-instructor__role">{{ course.instructorRole }} Â· CodeWire Solutions</p>
              <p class="course-instructor__bio">
                Taught by a working CodeWire engineer who builds {{ course.instructorRole.toLowerCase() }}
                projects day to day â€” so every lesson ties back to how things are done on a real team.
              </p>
            </div>
          </div>

          <!-- Sidebar -->
          <aside class="course-side" v-reveal="80">
            <div class="course-side__card card">
              <h3 class="course-side__title">Course at a glance</h3>
              <ul class="course-side__facts">
                <li><span>Level</span><strong>{{ course.level }}</strong></li>
                <li><span>Duration</span><strong>{{ course.duration }}</strong></li>
                <li><span>Format</span><strong>{{ course.mode }}</strong></li>
                <li><span>Projects</span><strong>{{ course.projects }} hands-on</strong></li>
                <li><span>Certificate</span><strong>{{ course.certificate ? 'Yes' : 'â€”' }}</strong></li>
                <li><span>Instructor</span><strong>{{ course.instructor }}</strong></li>
              </ul>
              <Link href="/contact#enroll" class="btn btn--primary btn--block">
                Enroll Now
              </Link>
              <p class="course-side__hint">
                <AppIcon name="calendar" :size="14" /> Cohort dates shared on enquiry.
              </p>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- RELATED -->
    <section v-if="related.length" class="section surface-elev">
      <div class="container">
        <SectionHeading eyebrow="Keep exploring" title="Other courses" />
        <div class="grid grid-3">
          <CourseCard v-for="(c, i) in related" :key="c.slug" v-reveal="i * 60" :course="c" />
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Seats are limited"
      :title="`Ready to start ${course.title}?`"
      text="Tell us youâ€™re interested and weâ€™ll share the next cohort dates, full syllabus and enrollment details."
      primary-label="Enroll Now"
      primary-to="/contact#enroll"
      secondary-label="Browse All Courses"
      secondary-to="/academy"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CourseCard from '@/Components/ui/CourseCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'

const props = defineProps({
  course: { type: Object, default: null },
  courses: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})
const courses = props.courses
const course = computed(() => props.course)
const related = computed(() =>
  course.value ? courses.filter((c) => c.slug !== course.value.slug).slice(0, 3) : []
)
</script>

<style scoped>
.course-hero {
  position: relative;
  overflow: hidden;
  padding-top: calc(var(--header-h) + clamp(2.5rem, 6vw, 5rem));
  padding-bottom: clamp(2.5rem, 5vw, 4rem);
  background: var(--bg-base);
}
.course-hero__glow { top: -180px; right: -120px; }
.course-hero__inner { position: relative; z-index: 1; max-width: 820px; }
.course-hero__head { display: flex; align-items: center; gap: var(--space-4); margin-bottom: var(--space-5); }
.course-hero__title { margin: 0 0 var(--space-4); max-width: 16ch; }
.course-hero__meta {
  display: flex;
  flex-wrap: wrap;
  gap: var(--space-3) var(--space-5);
  margin: var(--space-6) 0;
  padding: var(--space-5) 0;
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.course-hero__meta li {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.course-hero__meta :deep(.icon) { color: var(--yellow); flex-shrink: 0; }

/* Body layout */
.course-body {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}
.course-block { margin-bottom: clamp(2.5rem, 5vw, 4rem); }
.course-block__head { display: flex; align-items: center; gap: var(--space-4); flex-wrap: wrap; }
.course-block .h3 { margin-bottom: var(--space-5); }
.course-block__head .h3 { margin-bottom: 0; }
.course-block__note { color: var(--text-muted); font-size: var(--fs-sm); margin: var(--space-3) 0 var(--space-5); max-width: 60ch; }
.course-skills { margin-top: var(--space-2); }
.course-outcomes { display: flex; flex-direction: column; gap: var(--space-4); }
.course-outcomes li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  color: var(--text-body);
}
.course-outcomes :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 2px; }

/* Curriculum */
.curriculum { display: flex; flex-direction: column; gap: var(--space-4); }
.curriculum__item {
  display: grid;
  grid-template-columns: 48px 1fr;
  gap: var(--space-4);
  padding: var(--space-5);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius);
}
.curriculum__no {
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--yellow);
  font-size: 1.1rem;
}
.curriculum__title { font-size: 1.05rem; margin-bottom: 4px; }
.curriculum__text { font-size: var(--fs-sm); color: var(--text-muted); }

/* Instructor */
.course-instructor { padding: clamp(1.75rem, 3vw, 2.5rem); }
.course-instructor__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
}
.course-instructor__name { font-size: 1.4rem; margin: var(--space-3) 0 2px; }
.course-instructor__role { color: var(--yellow); font-size: var(--fs-sm); margin-bottom: var(--space-4); }
.course-instructor__bio { color: var(--text-body); line-height: 1.7; }

/* Sidebar */
.course-side__card {
  padding: clamp(1.75rem, 3vw, 2.25rem);
  position: sticky;
  top: calc(var(--header-h) + 20px);
}
.course-side__title { font-size: 1.2rem; margin-bottom: var(--space-5); }
.course-side__facts { margin-bottom: var(--space-6); }
.course-side__facts li {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-4);
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
  font-size: var(--fs-sm);
}
.course-side__facts li:last-child { border-bottom: none; }
.course-side__facts span { color: var(--text-muted); }
.course-side__facts strong { color: var(--text-hi); font-weight: 600; text-align: right; }
.course-side__hint {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  margin-top: var(--space-4);
  font-size: var(--fs-xs);
  color: var(--text-faint);
}
.course-side__hint :deep(.icon) { color: var(--yellow); }

@media (max-width: 900px) {
  .course-body { grid-template-columns: 1fr; }
  .course-side__card { position: static; }
}
</style>
