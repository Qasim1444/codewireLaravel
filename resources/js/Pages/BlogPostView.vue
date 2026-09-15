<template>
  <NotFoundInline
    v-if="!post"
    title="That article doesnâ€™t exist"
    text="We couldnâ€™t find the article you were looking for. Head back to the blog to keep reading."
    back-to="/blog"
    back-label="The Blog"
  />

  <article v-else class="post">
    <!-- HEADER -->
    <header class="post-head">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container container--narrow">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <Link href="/blog">Blog</Link>
          <span class="sep">/</span>
          <span aria-current="page">{{ post.title }}</span>
        </nav>

        <div class="post-head__meta" v-reveal>
          <Link :href="`/blog?category=${encodeURIComponent(post.category)}`" class="badge">
            {{ post.category }}
          </Link>
        </div>

        <h1 class="display post-head__title" v-reveal="60">{{ post.title }}</h1>
        <p class="lead post-head__excerpt" v-reveal="120">{{ post.excerpt }}</p>

        <div class="post-head__byline" v-reveal="180">
          <span class="post-head__avatar" aria-hidden="true">{{ authorInitials }}</span>
          <div class="post-head__byline-text">
            <span class="post-head__author">{{ post.author }}</span>
            <span class="post-head__sub">
              {{ post.authorRole }} Â· {{ formatDate(post.date) }} Â· {{ post.readTime }} min read
            </span>
          </div>
        </div>
      </div>
    </header>

    <!-- FEATURED IMAGE -->
    <div class="container container--narrow">
      <div class="post-media" v-reveal>
        <img :src="post.image" :alt="post.title" />
      </div>
    </div>

    <!-- BODY -->
    <div class="container container--narrow">
      <div class="post-body">
        <template v-for="(block, i) in post.body" :key="i">
          <p v-if="block.type === 'p'" class="post-body__p" v-reveal>{{ block.text }}</p>
          <h2 v-else-if="block.type === 'h2'" class="post-body__h2" v-reveal>{{ block.text }}</h2>
          <ul v-else-if="block.type === 'ul'" class="post-body__ul" v-reveal>
            <li v-for="(item, j) in block.items" :key="j">
              <AppIcon name="check" :size="18" /> {{ item }}
            </li>
          </ul>
          <blockquote v-else-if="block.type === 'quote'" class="post-body__quote" v-reveal>
            <AppIcon name="quote" :size="28" />
            <p>{{ block.text }}</p>
          </blockquote>
        </template>
      </div>

      <!-- AUTHOR BIO + SHARE -->
      <div class="post-foot">
        <div class="post-author card" v-reveal>
          <span class="post-author__avatar" aria-hidden="true">{{ authorInitials }}</span>
          <div>
            <span class="post-author__label">Written by</span>
            <h3 class="post-author__name">{{ post.author }}</h3>
            <p class="post-author__role">{{ post.authorRole }} Â· CodeWire Solutions</p>
          </div>
        </div>
        <Link href="/blog" class="link-arrow post-foot__back">
          <AppIcon name="arrow-left" :size="18" /> All articles
        </Link>
      </div>
    </div>

    <!-- RELATED -->
    <section v-if="related.length" class="section surface-elev">
      <div class="container">
        <SectionHeading eyebrow="Keep reading" title="Related articles" />
        <div class="grid grid-3">
          <PostCard v-for="(p, i) in related" :key="p.slug" v-reveal="i * 60" :post="p" />
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Have a project in mind?"
      title="Letâ€™s turn the idea into something real"
      text="Reading about it is a good start. Talking it through is better â€” book a free consultation and weâ€™ll help you scope it."
      primary-label="Get a Free Consultation"
      primary-to="/consultation"
      secondary-label="Explore Services"
      secondary-to="/services"
    />
  </article>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import SampleFlag from '@/Components/ui/SampleFlag.vue'
import PostCard from '@/Components/ui/PostCard.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
import NotFoundInline from '@/Components/ui/NotFoundInline.vue'

const props = defineProps({
  post: { type: Object, default: null },
  relatedPosts: { type: Array, default: () => [] },
  slug: { type: String, default: '' },
})

function formatDate(iso) {
  if (!iso) return ''
  return new Date(iso).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
}

const post = computed(() => props.post)
const related = computed(() => props.relatedPosts)
const authorInitials = computed(() =>
  (post.value?.author || '?')
    .split(' ')
    .map((w) => w[0])
    .slice(0, 2)
    .join('')
    .toUpperCase()
)
</script>

<style scoped>
.post-head {
  position: relative;
  overflow: hidden;
  padding-top: calc(var(--header-h) + clamp(2rem, 5vw, 3.5rem));
  padding-bottom: clamp(1.5rem, 3vw, 2.5rem);
}
.post-head__meta {
  display: flex;
  align-items: center;
  gap: var(--space-4);
  margin-bottom: var(--space-5);
}
.post-head__meta .badge:hover { color: var(--yellow); border-color: var(--yellow); }
.post-head__title { margin-bottom: var(--space-5); }
.post-head__excerpt {
  color: var(--text-body);
  margin-top: var(--space-4);
}
.post-head__byline {
  display: flex;
  align-items: center;
  gap: 14px;
  margin-top: var(--space-6);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
}
.post-head__avatar,
.post-author__avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: var(--yellow-tint);
  color: var(--yellow);
  font-weight: 700;
  font-family: var(--font-display);
  flex-shrink: 0;
}
.post-head__byline-text { display: flex; flex-direction: column; gap: 2px; }
.post-head__author { font-weight: 600; color: var(--text-hi); }
.post-head__sub { font-size: var(--fs-sm); color: var(--text-muted); }

/* Featured image */
.post-media {
  aspect-ratio: 16 / 8;
  border-radius: var(--radius-xl);
  overflow: hidden;
  border: 1px solid var(--border);
  margin: clamp(1.5rem, 3vw, 2.5rem) 0 clamp(2rem, 4vw, 3rem);
}
.post-media img { width: 100%; height: 100%; object-fit: cover; }

/* Body */
.post-body { padding-bottom: var(--space-7); }
.post-body__p {
  color: var(--text-body);
  line-height: 1.85;
  font-size: 1.075rem;
  margin-bottom: var(--space-5);
}
.post-body__h2 {
  font-size: clamp(1.4rem, 3vw, 1.85rem);
  margin: clamp(2rem, 4vw, 3rem) 0 var(--space-4);
  scroll-margin-top: calc(var(--header-h) + 20px);
}
.post-body__ul {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  margin: 0 0 var(--space-6);
  padding: var(--space-5) var(--space-6);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
}
.post-body__ul li {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  color: var(--text-body);
  line-height: 1.6;
}
.post-body__ul :deep(.icon) { color: var(--yellow); flex-shrink: 0; margin-top: 3px; }
.post-body__quote {
  position: relative;
  margin: clamp(2rem, 4vw, 3rem) 0;
  padding: var(--space-6) var(--space-6) var(--space-6) var(--space-7);
  border-left: 3px solid var(--yellow);
  background: var(--yellow-tint);
  border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
}
.post-body__quote :deep(.icon) {
  position: absolute;
  top: var(--space-5);
  left: calc(var(--space-6) - 4px);
  color: var(--yellow);
  opacity: 0.35;
}
.post-body__quote p {
  font-family: var(--font-display);
  font-size: clamp(1.25rem, 2.5vw, 1.6rem);
  line-height: 1.45;
  color: var(--text-hi);
  padding-left: var(--space-6);
}

/* Foot */
.post-foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: var(--space-5);
  padding: var(--space-7) 0;
  border-top: 1px solid var(--border);
}
.post-author { display: flex; align-items: center; gap: var(--space-4); padding: var(--space-5); }
.post-author__label {
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
}
.post-author__name { font-size: 1.2rem; margin: 2px 0; }
.post-author__role { font-size: var(--fs-sm); color: var(--yellow); }
.post-foot__back { color: var(--text-hi); }
.post-foot__back:hover { color: var(--yellow); }
</style>
