<template>
  <div class="about-page">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">About</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">
            The engineering partner behind the <span class="text-accent">products you rely on</span>
          </h1>
          <p class="lead" v-reveal="120">
            CodeWire Solutions is a senior software studio building custom web, mobile and
            AI products â€” and, through CodeWire Academy, training the next generation of
            engineers to build them too.
          </p>
        </div>
      </div>
    </section>

    <!-- STORY -->
    <section class="section section--flush-top">
      <div class="container">
        <div class="story">
          <div class="story__text" v-reveal>
            <span class="eyebrow">Our story</span>
            <h2 class="h2 balance">Built by engineers who care about the outcome</h2>
            <p>
              We started CodeWire Solutions in 2022 with a simple belief: great software
              comes from small, senior teams who take ownership â€” not layers of hand-offs.
              Since then weâ€™ve grown into a full-stack studio spanning web, mobile, DevOps,
              QA and design.
            </p>
            <p>
              We work as an extension of your team: understanding the problem, proposing
              honest trade-offs, and shipping products that hold up in the real world. And
              because we love this craft, we teach it too â€” CodeWire Academy passes on the
              exact skills our engineers use every day.
            </p>
            <ul class="feature-list story__list">
              <li><AppIcon name="check-circle" :size="18" /> Senior-led delivery on every project</li>
              <li><AppIcon name="check-circle" :size="18" /> Transparent process, no surprises</li>
              <li><AppIcon name="check-circle" :size="18" /> Long-term partnership, not one-off builds</li>
            </ul>
            <Link href="/services" class="link-arrow story__link">
              See what we do <AppIcon name="arrow-right" />
            </Link>
          </div>

          <aside class="story__stats card" v-reveal="120">
            <div class="story__stats-head">
              <span class="eyebrow">By the numbers</span>
              <span class="badge badge--outline">Est. 2022</span>
            </div>
            <div class="story__stats-grid">
              <StatItem
                v-for="s in stats"
                :key="s.label"
                :value="s.value"
                :suffix="s.suffix"
                :label="s.label"
                :sample="s.sample"
              />
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- VALUES -->
    <section class="section surface-elev">
      <div class="container">
        <SectionHeading center eyebrow="What we stand for" title="The principles behind every build">
          The values that shape how we work with clients, students and each other.
        </SectionHeading>
        <div class="grid grid-3">
          <article v-for="(v, i) in values" :key="v.title" class="card value" v-reveal="i * 60">
            <span class="icon-tile"><AppIcon :name="v.icon" /></span>
            <h3 class="value__title">{{ v.title }}</h3>
            <p class="value__text">{{ v.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- TIMELINE -->
    <section class="section">
      <div class="container">
        <SectionHeading eyebrow="The journey" title="How we got here">
          A short history of CodeWire â€” milestones shown are sample placeholders, clearly flagged.
        </SectionHeading>
        <ol class="timeline">
          <li v-for="(t, i) in timeline" :key="t.year" class="timeline__item" v-reveal="i * 70">
            <div class="timeline__marker" aria-hidden="true">
              <span class="timeline__dot" />
            </div>
            <div class="timeline__body">
              <span class="timeline__year">{{ t.year }}</span>
              <h3 class="timeline__title">
                {{ t.title }}
              </h3>
              <p class="timeline__text">{{ t.text }}</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <!-- TEAM -->
    <section class="section surface-elev">
      <div class="container">
        <SectionHeading center eyebrow="The people" title="Meet the team">
          A senior, multidisciplinary crew that designs, builds and ships together.
        </SectionHeading>
        <div class="grid grid-4 team-grid">
          <article v-for="(m, i) in team" :key="m.name" class="member" v-reveal="i * 50">
            <div class="member__photo">
              <img :src="m.image" :alt="m.name" loading="lazy" />
              <span v-if="m.lead" class="member__lead badge">Founder</span>
              <a
                v-if="m.linkedin"
                :href="m.linkedin"
                target="_blank"
                rel="noopener noreferrer"
                class="member__linkedin"
                :aria-label="`${m.name} on LinkedIn`"
              >
                <AppIcon name="linkedin" :size="18" />
              </a>
            </div>
            <h3 class="member__name">{{ m.name }}</h3>
            <p class="member__role">{{ m.role }}</p>
          </article>
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Work with us"
      title="Have a project in mind?"
      text="Whether youâ€™re building something new or scaling what you have, weâ€™d love to hear about it."
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import StatItem from '@/Components/ui/StatItem.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { team, values, timeline, stats } = defineProps({
  team: { type: Array, default: () => [] },
  values: { type: Array, default: () => [] },
  timeline: { type: Array, default: () => [] },
  stats: { type: Array, default: () => [] },
})
</script>

<style scoped>
/* Story */
.story {
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: clamp(2rem, 5vw, 4rem);
  align-items: start;
}
.story__text p {
  color: var(--text-body);
  margin-top: var(--space-4);
  line-height: 1.7;
}
.story__text .h2 { margin-top: var(--space-3); }
.story__list { margin: var(--space-6) 0; }
.feature-list {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}
.feature-list li {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--text-hi);
  font-weight: 500;
}
.feature-list :deep(.icon) { color: var(--yellow); flex-shrink: 0; }
.story__link { color: var(--yellow); }

.story__stats {
  padding: clamp(1.75rem, 3vw, 2.5rem);
  position: sticky;
  top: calc(var(--header-h) + 20px);
}
.story__stats-head {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: var(--space-6);
}
.story__stats-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(1.25rem, 3vw, 2rem) var(--space-5);
}
.story__stats-note {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: var(--space-6);
  padding-top: var(--space-5);
  border-top: 1px solid var(--border);
  font-size: var(--fs-xs);
  color: var(--text-faint);
}
.story__stats-note :deep(.icon) { color: var(--yellow); flex-shrink: 0; }

/* Values */
.value__title { font-size: 1.2rem; margin: var(--space-5) 0 var(--space-3); }
.value__text { font-size: var(--fs-sm); color: var(--text-muted); }

/* Timeline */
.timeline {
  position: relative;
  margin-top: var(--space-4);
  padding-left: 0;
}
.timeline::before {
  content: '';
  position: absolute;
  left: 7px;
  top: 6px;
  bottom: 6px;
  width: 2px;
  background: linear-gradient(var(--yellow), transparent);
}
.timeline__item {
  position: relative;
  display: grid;
  grid-template-columns: 40px 1fr;
  gap: var(--space-4);
  padding-bottom: clamp(1.75rem, 4vw, 2.75rem);
}
.timeline__item:last-child { padding-bottom: 0; }
.timeline__marker {
  display: flex;
  justify-content: center;
  padding-top: 4px;
}
.timeline__dot {
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: var(--yellow);
  box-shadow: 0 0 0 4px var(--yellow-tint);
  z-index: 1;
}
.timeline__year {
  display: inline-block;
  font-family: var(--font-display);
  font-weight: 700;
  color: var(--yellow);
  font-size: 1.1rem;
  margin-bottom: var(--space-2);
}
.timeline__title {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: 10px;
  font-size: 1.2rem;
  margin-bottom: var(--space-2);
}
.timeline__text { color: var(--text-muted); font-size: var(--fs-sm); max-width: 60ch; }

/* Team */
.team-grid { margin-top: var(--space-2); }
.member__photo {
  position: relative;
  aspect-ratio: 1 / 1;
  border-radius: var(--radius-lg);
  overflow: hidden;
  border: 1px solid var(--border);
  margin-bottom: var(--space-4);
}
.member__photo img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: grayscale(1);
  transition: filter var(--dur) var(--ease), transform var(--dur-slow) var(--ease);
}
.member:hover .member__photo img { filter: grayscale(0); transform: scale(1.03); }
.member__lead {
  position: absolute;
  top: 12px;
  left: 12px;
}
.member__linkedin {
  position: absolute;
  bottom: 12px;
  right: 12px;
  display: grid;
  place-items: center;
  width: 38px;
  height: 38px;
  border-radius: var(--radius-sm);
  background: rgba(11, 11, 11, 0.7);
  color: var(--text-hi);
  backdrop-filter: blur(6px);
  opacity: 0;
  transform: translateY(6px);
  transition: all var(--dur-fast) var(--ease);
}
.member:hover .member__linkedin { opacity: 1; transform: translateY(0); }
.member__linkedin:hover { background: var(--yellow); color: var(--accent-ink); }
.member__name { font-size: 1.1rem; margin-bottom: 2px; }
.member__role { font-size: var(--fs-sm); color: var(--yellow); }

@media (max-width: 900px) {
  .story { grid-template-columns: 1fr; }
  .story__stats { position: static; }
}
@media (max-width: 560px) {
  .story__stats-grid { grid-template-columns: 1fr 1fr; }
  .member__name { font-size: 1rem; }
}
</style>
