<template>
  <div class="faq-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">FAQ</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Questions, <span class="text-accent">answered</span></h1>
          <p class="lead" v-reveal="120">
            Straight answers about how we work, what things cost, and how the Academy runs. Can’t
            find what you need? Just ask.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container container--narrow">
        <div v-for="group in faqGroups" :key="group.key" class="faq-group">
          <h2 class="faq-group__title" v-reveal>
            <span class="icon-tile icon-tile--sm"><AppIcon :name="group.icon" :size="18" /></span>
            {{ group.label }}
          </h2>

          <div class="faq-list">
            <div
              v-for="(item, i) in group.items"
              :key="i"
              class="faq-item"
              :class="{ 'is-open': isOpen(group.key, i) }"
              v-reveal="i * 40"
            >
              <h3>
                <button
                  class="faq-item__q"
                  :aria-expanded="isOpen(group.key, i)"
                  :aria-controls="`faq-${group.key}-${i}`"
                  @click="toggle(group.key, i)"
                >
                  <span>{{ item.q }}</span>
                  <AppIcon name="chevron-down" :size="20" class="faq-item__chev" />
                </button>
              </h3>
              <transition
                @enter="startEnter"
                @after-enter="endEnter"
                @before-leave="startLeave"
                @leave="endLeave"
              >
                <div v-show="isOpen(group.key, i)" :id="`faq-${group.key}-${i}`" class="faq-item__a">
                  <p>{{ item.a }}</p>
                </div>
              </transition>
            </div>
          </div>
        </div>
      </div>
    </section>

    <CtaBand
      eyebrow="Still have a question?"
      title="Ask us directly — we reply fast"
      text="Send us a message or book a free consultation. We’ll get back to you within one business day."
      primary-label="Get a Free Consultation"
      primary-to="/consultation"
      secondary-label="Contact Us"
      secondary-to="/contact"
    />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import AppIcon from '@/Components/ui/AppIcon.vue'
import CtaBand from '@/Components/ui/CtaBand.vue'
const { faqGroups } = defineProps({
  faqGroups: { type: Array, default: () => [] },
  allFaqs: { type: Array, default: () => [] },
})

// Open the very first question by default.
const open = ref(`${faqGroups[0]?.key}-0`)

function key(groupKey, i) {
  return `${groupKey}-${i}`
}
function isOpen(groupKey, i) {
  return open.value === key(groupKey, i)
}
function toggle(groupKey, i) {
  open.value = isOpen(groupKey, i) ? null : key(groupKey, i)
}

// Height-based expand/collapse transition.
function startEnter(el) {
  el.style.height = '0'
  el.style.opacity = '0'
  requestAnimationFrame(() => {
    el.style.height = el.scrollHeight + 'px'
    el.style.opacity = '1'
  })
}
function endEnter(el) {
  el.style.height = 'auto'
}
function startLeave(el) {
  el.style.height = el.scrollHeight + 'px'
  el.style.opacity = '1'
  // force reflow so the transition runs
  void el.offsetHeight
}
function endLeave(el) {
  el.style.height = '0'
  el.style.opacity = '0'
}
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }

.faq-group { margin-bottom: clamp(2.5rem, 5vw, 4rem); }
.faq-group__title {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: clamp(1.3rem, 3vw, 1.7rem);
  margin-bottom: var(--space-5);
}
.icon-tile--sm { width: 40px; height: 40px; border-radius: var(--radius-sm); }

.faq-list { display: flex; flex-direction: column; gap: var(--space-3); }
.faq-item {
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  transition: border-color var(--dur) var(--ease);
}
.faq-item.is-open { border-color: var(--yellow-tint-2); }
.faq-item__q {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-4);
  width: 100%;
  text-align: left;
  padding: var(--space-5);
  font-family: var(--font-display);
  font-size: 1.075rem;
  font-weight: 600;
  color: var(--text-hi);
}
.faq-item__chev {
  flex-shrink: 0;
  color: var(--yellow);
  transition: transform var(--dur) var(--ease);
}
.faq-item.is-open .faq-item__chev { transform: rotate(180deg); }
.faq-item__a {
  overflow: hidden;
  transition: height var(--dur) var(--ease), opacity var(--dur) var(--ease);
}
.faq-item__a p {
  padding: 0 var(--space-5) var(--space-5);
  color: var(--text-body);
  line-height: 1.7;
}
</style>
