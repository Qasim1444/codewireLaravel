<template>
  <div class="blog-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Blog</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Insights &amp; <span class="text-accent">ideas</span></h1>
          <p class="lead" v-reveal="120">
            Practical thinking on building, shipping and scaling software — plus lessons from
            the CodeWire Academy classroom. Written by our own engineers.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container">
        <!-- FEATURED -->
        <Link
          v-if="showFeatured"
          :to="`/blog/${featuredPost.slug}`"
          class="feature-post"
          v-reveal
        >
          <div class="feature-post__media">
            <img :src="featuredPost.image" :alt="featuredPost.title" loading="lazy" />
            <SampleFlag v-if="featuredPost.sample" class="feature-post__flag" />
          </div>
          <div class="feature-post__body">
            <div class="feature-post__badges">
              <span class="badge">Featured</span>
              <span class="tag">{{ featuredPost.category }}</span>
            </div>
            <h2 class="h2 feature-post__title balance">{{ featuredPost.title }}</h2>
            <p class="feature-post__excerpt">{{ featuredPost.excerpt }}</p>
            <div class="feature-post__meta">
              <span>{{ featuredPost.author }}</span>
              <span aria-hidden="true">Â·</span>
              <span>{{ formatDate(featuredPost.date) }}</span>
              <span aria-hidden="true">Â·</span>
              <span>{{ featuredPost.readTime }} min read</span>
            </div>
            <span class="link-arrow feature-post__cta">Read article <AppIcon name="arrow-right" /></span>
          </div>
        </Link>

        <!-- CONTROLS -->
        <div class="blog-controls" v-reveal>
          <div class="blog-search">
            <AppIcon name="search" :size="18" />
            <input v-model.trim="query" type="search" class="input blog-search__input" placeholder="Search articlesâ€¦" aria-label="Search articles" />
          </div>
          <div class="blog-cats" role="tablist" aria-label="Filter by category">
            <button
              v-for="cat in blogCategories"
              :key="cat"
              class="filter-chip"
              :class="{ 'filter-chip--active': activeCat === cat }"
              role="tab"
              :aria-selected="activeCat === cat"
              @click="activeCat = cat"
            >
              {{ cat }}
            </button>
          </div>
        </div>

        <!-- GRID -->
        <div v-if="visiblePosts.length" class="grid grid-3 blog-grid">
          <PostCard v-for="(post, i) in visiblePosts" :key="post.slug" v-reveal="i * 60" :post="post" />
        </div>
        <div v-else class="blog-empty">
          <span class="icon-tile"><AppIcon name="search" /></span>
          <h3>No articles found</h3>
          <p>Try a different keyword or category.</p>
          <button class="btn btn--ghost btn--sm" @click="resetFilters">Clear filters</button>
        </div>

        <!-- NEWSLETTER -->
        <div class="blog-news" v-reveal>
          <div class="blog-news__glow bg-glow" aria-hidden="true" />
          <div class="blog-news__content">
            <p class="eyebrow">Newsletter</p>
            <h2 class="h3 balance">Get new articles in your inbox</h2>
            <p class="muted">Occasional, practical and no spam. Unsubscribe anytime.</p>
          </div>
          <form class="blog-news__form" @submit.prevent="subscribe">
            <div class="blog-news__input">
              <label class="sr-only" for="blog-email">Email address</label>
              <input id="blog-email" v-model.trim="newsletterEmail" type="email" class="input" placeholder="you@company.com" required />
              <button type="submit" class="btn btn--primary">Subscribe</button>
            </div>
            <p v-if="subscribed" class="blog-news__ok"><AppIcon name="check-circle" :size="16" /> Thanks â€” youâ€™re on the list.</p>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import PostCard from '@/Components/ui/PostCard.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
const { posts, blogCategories, featuredPost } = defineProps({
  posts: { type: Array, default: () => [] },
  blogCategories: { type: Array, default: () => [] },
  featuredPost: { type: Object, default: null },
})
function formatDate(iso) {
  if (!iso) return ''
  return new Date(iso).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
}

const query = ref('')
const activeCat = ref('All')
const newsletterEmail = ref('')
const subscribed = ref(false)

const showFeatured = computed(() => !query.value && activeCat.value === 'All')

const matched = computed(() => {
  const q = query.value.toLowerCase()
  return posts.filter((p) => {
    const catOk = activeCat.value === 'All' || p.category === activeCat.value
    const qOk =
      !q ||
      p.title.toLowerCase().includes(q) ||
      p.excerpt.toLowerCase().includes(q) ||
      p.category.toLowerCase().includes(q)
    return catOk && qOk
  })
})

const visiblePosts = computed(() =>
  showFeatured.value ? matched.value.filter((p) => p.slug !== featuredPost.slug) : matched.value
)

function resetFilters() {
  query.value = ''
  activeCat.value = 'All'
}
function subscribe() {
  if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(newsletterEmail.value)) {
    subscribed.value = true
    newsletterEmail.value = ''
  }
}
</script>

<style scoped>
/* Featured post */
.feature-post {
  display: grid;
  grid-template-columns: 1.1fr 1fr;
  gap: clamp(1.5rem, 4vw, 3.5rem);
  align-items: center;
  padding: clamp(1.25rem, 2.5vw, 2rem);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-xl);
  margin-bottom: clamp(2.5rem, 5vw, 4rem);
  transition: border-color var(--dur) var(--ease);
}
.feature-post:hover { border-color: var(--border-strong); }
.feature-post__media {
  position: relative;
  aspect-ratio: 16 / 11;
  border-radius: var(--radius-lg);
  overflow: hidden;
}
.feature-post__media img { width: 100%; height: 100%; object-fit: cover; transition: transform var(--dur-slow) var(--ease); }
.feature-post:hover .feature-post__media img { transform: scale(1.04); }
.feature-post__flag { position: absolute; top: 14px; right: 14px; }
.feature-post__badges { display: flex; gap: var(--space-3); margin-bottom: var(--space-4); }
.feature-post__title { margin-bottom: var(--space-4); }
.feature-post__excerpt { color: var(--text-body); font-size: var(--fs-lead); margin-bottom: var(--space-5); }
.feature-post__meta {
  display: flex; flex-wrap: wrap; align-items: center; gap: 8px;
  font-size: var(--fs-sm); color: var(--text-muted); margin-bottom: var(--space-5);
}
.feature-post__cta { color: var(--yellow); }

/* Controls */
.blog-controls {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-5);
  margin-bottom: clamp(2rem, 4vw, 3rem);
  flex-wrap: wrap;
}
.blog-search {
  position: relative;
  display: flex;
  align-items: center;
  min-width: 260px;
  flex: 1;
  max-width: 340px;
}
.blog-search :deep(.icon) {
  position: absolute;
  left: 16px;
  color: var(--text-faint);
  pointer-events: none;
}
.blog-search__input { padding-left: 46px; }
.blog-cats { display: flex; flex-wrap: wrap; gap: var(--space-2); }
.filter-chip {
  padding: 9px 16px;
  font-size: var(--fs-sm);
  color: var(--text-body);
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid var(--border);
  border-radius: var(--radius-pill);
  cursor: pointer;
  transition: all var(--dur-fast) var(--ease);
}
.filter-chip:hover { border-color: var(--border-strong); color: var(--text-hi); }
.filter-chip--active { background: var(--yellow); border-color: var(--yellow); color: var(--accent-ink); font-weight: 600; }

.blog-grid { margin-bottom: clamp(3rem, 6vw, 5rem); }

/* Empty */
.blog-empty {
  text-align: center;
  padding: clamp(3rem, 7vw, 5rem) 0;
}
.blog-empty .icon-tile { margin: 0 auto var(--space-5); }
.blog-empty h3 { font-size: 1.4rem; margin-bottom: var(--space-3); }
.blog-empty p { color: var(--text-muted); margin-bottom: var(--space-5); }

/* Newsletter */
.blog-news {
  position: relative;
  overflow: hidden;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-6);
  align-items: center;
  padding: clamp(2rem, 4vw, 3.5rem);
  background: var(--bg-elev);
  border: 1px solid var(--border-strong);
  border-radius: var(--radius-xl);
}
.blog-news__glow { top: -60%; right: -10%; opacity: 0.3; }
.blog-news__content { position: relative; z-index: 1; }
.blog-news__content .h3 { margin: var(--space-3) 0; }
.blog-news__form { position: relative; z-index: 1; }
.blog-news__input { display: flex; gap: var(--space-3); }
.blog-news__input .input { flex: 1; }
.blog-news__input .btn { white-space: nowrap; }
.blog-news__ok {
  display: flex; align-items: center; gap: 6px;
  margin-top: var(--space-3); font-size: var(--fs-sm); color: var(--yellow);
}

@media (max-width: 860px) {
  .feature-post { grid-template-columns: 1fr; }
  .feature-post__media { order: -1; }
  .blog-news { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  .blog-controls { flex-direction: column; align-items: stretch; }
  .blog-search { max-width: none; min-width: 0; }
  .blog-news__input { flex-direction: column; }
  .blog-news__input .btn { width: 100%; justify-content: center; }
  .filter-chip { font-size: 12px; padding: 7px 12px; }
}
</style>
