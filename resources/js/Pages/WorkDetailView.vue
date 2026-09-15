<template>
  <NotFoundInline
    v-if="!project"
    title="That case study doesnâ€™t exist"
    text="We couldnâ€™t find the project you were looking for. Browse our full portfolio instead."
    back-to="/work"
    back-label="Our Work"
  />

  <div v-else class="work-detail">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <Link href="/work">Our Work</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ project.name }}</span>
        </nav>
        <div class="page-hero__inner">
          <div class="work-detail__badges" v-reveal>
            <span class="badge">{{ project.category }}</span>
            <span class="work-detail__industry"><AppIcon name="briefcase" :size="15" /> {{ project.industry }}</span>
          </div>
          <h1 class="display work-detail__title" v-reveal="60">{{ project.name }}</h1>
          <p class="lead" v-reveal="120">{{ project.summary }}</p>
        </div>
      </div>
    </section>

    <!-- FEATURED IMAGE -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="work-detail__media" v-reveal>
          <img :src="project.image" :alt="`${project.name} â€” ${project.industry}`" />
        </div>

        <div class="work-detail__body">
          <div class="work-detail__main">
            <article class="wd-block" v-reveal>
              <h2 class="wd-block__title"><span class="dot" /> The challenge</h2>
              <p>{{ project.challenge }}</p>
            </article>
            <article class="wd-block" v-reveal>
              <h2 class="wd-block__title wd-block__title--accent"><span class="dot dot--accent" /> Our solution</h2>
              <p>{{ project.solution }}</p>
            </article>

            <article class="wd-block" v-reveal>
              <h2 class="wd-block__title">The results</h2>
              <div class="wd-results">
                <div v-for="r in project.results" :key="r" class="wd-result">
                  <AppIcon name="trending-up" :size="18" /> {{ r }}
                </div>
              </div>
            </article>

            <article v-if="project.featureGroups?.length" class="wd-block" v-reveal>
              <h2 class="wd-block__title">Feature breakdown</h2>
              <div class="wd-feature-groups">
                <div v-for="group in project.featureGroups" :key="group.title" class="wd-feature-group">
                  <h3 class="wd-feature-group__title">{{ group.title }}</h3>
                  <ul class="wd-feature-group__list">
                    <li v-for="item in group.items" :key="item">{{ item }}</li>
                  </ul>
                </div>
              </div>
            </article>

            <article v-if="project.architectureHighlights?.length" class="wd-block" v-reveal>
              <h2 class="wd-block__title wd-block__title--accent"><span class="dot dot--accent" /> Architecture &amp; engineering highlights</h2>
              <ul class="wd-list">
                <li v-for="item in project.architectureHighlights" :key="item">{{ item }}</li>
              </ul>
            </article>

            <article v-if="project.techTable?.length" class="wd-block" v-reveal>
              <h2 class="wd-block__title">Tech stack summary</h2>
              <div class="wd-tech-table">
                <div v-for="row in project.techTable" :key="row.layer" class="wd-tech-table__row">
                  <span class="wd-tech-table__layer">{{ row.layer }}</span>
                  <span class="wd-tech-table__value">{{ row.technology }}</span>
                </div>
              </div>
            </article>

            <article v-if="project.outcome" class="wd-block" v-reveal>
              <h2 class="wd-block__title">Outcome</h2>
              <p>{{ project.outcome }}</p>
            </article>
          </div>

          <aside class="work-detail__side" v-reveal="80">
            <div class="wd-facts card">
              <h3 class="wd-facts__title">Project details</h3>
              <ul class="wd-facts__list">
                <li><span>Client</span><strong>{{ project.industry }}</strong></li>
                <li><span>Category</span><strong>{{ project.category }}</strong></li>
              </ul>
              <h4 class="wd-facts__label">Tech stack</h4>
              <div class="cluster">
                <span v-for="t in project.tech" :key="t" class="tag">{{ t }}</span>
              </div>
              <a
                v-if="project.liveUrl && project.liveUrl !== '#'"
                :href="project.liveUrl"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn--ghost btn--block wd-facts__cta"
              >
                <AppIcon name="arrow-up-right" :size="16" /> Visit Live Site
              </a>
              <Link href="/consultation#book" class="btn btn--primary btn--block wd-facts__cta">
                Start your project
              </Link>
            </div>
          </aside>
        </div>

        <!-- Prev / Next -->
        <nav class="wd-nav" aria-label="Case study navigation">
          <Link v-if="prev" :href="`/work/${prev.slug}`" class="wd-nav__link wd-nav__link--prev">
            <AppIcon name="arrow-left" :size="18" />
            <span>
              <small>Previous</small>
              {{ prev.name }}
            </span>
          </Link>
          <span v-else />
          <Link v-if="next" :href="`/work/${next.slug}`" class="wd-nav__link wd-nav__link--next">
            <span>
              <small>Next</small>
              {{ next.name }}
            </span>
            <AppIcon name="arrow-right" :size="18" />
          </Link>
        </nav>
      </div>
    </section>

    <CtaBand
      eyebrow="Your project could be next"
      title="Letâ€™s build something worth showing off"
      text="Tell us what youâ€™re trying to achieve. Weâ€™ll bring the engineering, design and honesty to get it shipped."
      primary-label="Book a Consultation"
      primary-to="/consultation"
      secondary-label="See More Work"
      secondary-to="/work"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'

const props = defineProps({
  project: { type: Object, default: null },
  projects: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})
const projects = props.projects
const project = computed(() => props.project)
const index = computed(() => projects.findIndex((p) => p.slug === props.slug))
const prev = computed(() => (index.value > 0 ? projects[index.value - 1] : null))
const next = computed(() =>
  index.value >= 0 && index.value < projects.length - 1 ? projects[index.value + 1] : null
)
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }
.work-detail__badges {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: var(--space-4);
  margin-bottom: var(--space-4);
}
.work-detail__industry {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--yellow);
}
.work-detail__title { max-width: 16ch; }

.work-detail__media {
  aspect-ratio: 16 / 8;
  border-radius: var(--radius-xl);
  overflow: hidden;
  border: 1px solid var(--border);
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
}
.work-detail__media img { width: 100%; height: 100%; object-fit: cover; }

.work-detail__body {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}
.wd-block { margin-bottom: clamp(2rem, 4vw, 3rem); }
.wd-block__title {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--text-hi);
  margin-bottom: var(--space-4);
}
.wd-block__title--accent { color: var(--yellow); }
.wd-block p { color: var(--text-body); line-height: 1.75; max-width: 62ch; }
.dot { width: 8px; height: 8px; border-radius: 50%; background: var(--text-faint); }
.dot--accent { background: var(--yellow); }
.wd-results { display: flex; flex-wrap: wrap; gap: var(--space-3); }
.wd-result {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 16px;
  font-size: var(--fs-sm);
  font-weight: 600;
  color: var(--text-hi);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius-pill);
}
.wd-result :deep(.icon) { color: var(--yellow); }
.wd-list { color: var(--text-body); line-height: 1.75; max-width: 62ch; padding-left: 1.2em; }
.wd-list li { margin-bottom: var(--space-3); }
.wd-feature-groups {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: var(--space-5);
}
.wd-feature-group {
  padding: var(--space-5);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius);
}
.wd-feature-group__title {
  font-size: var(--fs-sm);
  color: var(--yellow);
  margin-bottom: var(--space-3);
}
.wd-feature-group__list { color: var(--text-body); line-height: 1.65; padding-left: 1.1em; }
.wd-feature-group__list li { margin-bottom: 6px; }
.wd-tech-table { border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
.wd-tech-table__row {
  display: grid;
  grid-template-columns: 1fr 2fr;
  gap: var(--space-4);
  padding: 12px 16px;
  border-bottom: 1px solid var(--border);
  font-size: var(--fs-sm);
}
.wd-tech-table__row:last-child { border-bottom: none; }
.wd-tech-table__layer { color: var(--text-muted); font-weight: 600; }
.wd-tech-table__value { color: var(--text-hi); }
@media (max-width: 560px) {
  .wd-tech-table__row { grid-template-columns: 1fr; gap: 4px; }
}
.wd-block__note {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: var(--space-4);
  font-size: var(--fs-xs);
  color: var(--text-faint);
}
.wd-block__note :deep(.icon) { color: var(--yellow); }

.wd-facts {
  padding: clamp(1.5rem, 3vw, 2rem);
  position: sticky;
  top: calc(var(--header-h) + 20px);
}
.wd-facts__title { font-size: 1.2rem; margin-bottom: var(--space-5); }
.wd-facts__list { margin-bottom: var(--space-6); }
.wd-facts__list li {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-4);
  padding: 12px 0;
  border-bottom: 1px solid var(--border);
  font-size: var(--fs-sm);
}
.wd-facts__list span { color: var(--text-muted); }
.wd-facts__list strong { color: var(--text-hi); font-weight: 600; text-align: right; }
.wd-facts__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.wd-facts__cta { margin-top: var(--space-6); }

/* Prev / next */
.wd-nav {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-4);
  margin-top: clamp(3rem, 6vw, 5rem);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
}
.wd-nav__link {
  display: flex;
  align-items: center;
  gap: var(--space-4);
  padding: var(--space-5);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  transition: border-color var(--dur) var(--ease), transform var(--dur) var(--ease);
}
.wd-nav__link:hover { border-color: var(--yellow); transform: translateY(-3px); }
.wd-nav__link small {
  display: block;
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: 4px;
}
.wd-nav__link span { font-weight: 600; color: var(--text-hi); }
.wd-nav__link--next { justify-content: flex-end; text-align: right; grid-column: 2; }
.wd-nav__link :deep(.icon) { color: var(--yellow); flex-shrink: 0; }

@media (max-width: 900px) {
  .work-detail__body { grid-template-columns: 1fr; }
  .wd-facts { position: static; }
}
@media (max-width: 560px) {
  .wd-nav { grid-template-columns: 1fr; }
  .wd-nav__link--next { grid-column: 1; }
}
</style>
