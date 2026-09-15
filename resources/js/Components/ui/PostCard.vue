<template>
  <Link :href="`/blog/${post.slug}`" class="post-card">
    <div class="post-card__media">
      <img :src="post.image" :alt="post.title" loading="lazy" />
      <span class="post-card__cat badge">{{ post.category }}</span>
      <SampleFlag v-if="post.sample" class="post-card__flag" />
    </div>
    <div class="post-card__body">
      <div class="post-card__meta">
        <span>{{ formatDate(post.date) }}</span>
        <span aria-hidden="true">·</span>
        <span>{{ post.readTime }} min read</span>
      </div>
      <h3 class="post-card__title">{{ post.title }}</h3>
      <p class="post-card__excerpt">{{ post.excerpt }}</p>
      <div class="post-card__foot">
        <span class="post-card__author">{{ post.author }}</span>
        <span class="link-arrow post-card__more">Read <AppIcon name="arrow-right" /></span>
      </div>
    </div>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from './AppIcon.vue'
import SampleFlag from './SampleFlag.vue'
defineProps({ post: { type: Object, required: true } })
function formatDate(iso) {
  if (!iso) return ''
  return new Date(iso).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })
}
</script>

<style scoped>
.post-card {
  display: flex;
  flex-direction: column;
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  overflow: hidden;
  height: 100%;
  box-shadow: var(--shadow-sm);
  transition: transform var(--dur) var(--ease), border-color var(--dur) var(--ease), box-shadow var(--dur) var(--ease);
}
.post-card:hover {
  transform: translateY(-6px);
  border-color: var(--yellow);
  box-shadow: var(--shadow-md);
}
.post-card__media {
  position: relative;
  aspect-ratio: 16 / 9;
  overflow: hidden;
}
.post-card__media img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform var(--dur-slow) var(--ease);
}
.post-card:hover .post-card__media img {
  transform: scale(1.06);
}
.post-card__cat {
  position: absolute;
  top: 14px;
  left: 14px;
  background: rgba(11, 11, 11, 0.82);
  color: var(--yellow);
  border-color: transparent;
}
.post-card__flag {
  position: absolute;
  top: 14px;
  right: 14px;
}
.post-card__body {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  padding: var(--space-5);
  flex: 1;
}
.post-card__meta {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: var(--fs-xs);
  color: var(--text-faint);
}
.post-card__title {
  font-size: 1.3rem;
  line-height: 1.3;
}
.post-card__excerpt {
  font-size: var(--fs-sm);
  color: var(--text-muted);
  flex: 1;
}
.post-card__foot {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-top: var(--space-4);
  border-top: 1px solid var(--border);
  font-size: var(--fs-sm);
}
.post-card__author {
  color: var(--text-body);
  font-weight: 500;
}
.post-card:hover .post-card__more {
  color: var(--yellow);
}
</style>
