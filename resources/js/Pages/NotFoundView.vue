<template>
  <section class="notfound">
    <div class="bg-grid" aria-hidden="true" />
    <div class="bg-glow notfound__glow" aria-hidden="true" />
    <div class="container">
      <div class="notfound__inner" v-reveal>
        <span class="badge badge--dot">Error 404</span>
        <p class="notfound__code" aria-hidden="true">4<span class="text-accent">0</span>4</p>
        <h1 class="h2 balance notfound__title">This page took a wrong turn</h1>
        <p class="notfound__text">
          The page you’re looking for doesn’t exist, moved, or never shipped. Let’s get you
          back on track.
        </p>
        <div class="btn-group notfound__actions">
          <Link href="/" class="btn btn--primary btn--lg">
            <AppIcon name="arrow-left" :size="18" /> Back to Home
          </Link>
          <Link href="/contact" class="btn btn--ghost btn--lg">Contact Us</Link>
        </div>

        <div class="notfound__links">
          <span class="notfound__links-label">Popular pages</span>
          <nav class="notfound__links-list">
            <Link href="/services" class="link-arrow">Services <AppIcon name="arrow-right" /></Link>
            <Link href="/work" class="link-arrow">Our Work <AppIcon name="arrow-right" /></Link>
            <Link href="/academy" class="link-arrow">Academy <AppIcon name="arrow-right" /></Link>
            <Link href="/blog" class="link-arrow">Blog <AppIcon name="arrow-right" /></Link>
          </nav>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import AppIcon from '@/Components/ui/AppIcon.vue'
</script>

<style scoped>
.notfound {
  position: relative;
  overflow: hidden;
  min-height: 78vh;
  display: grid;
  place-items: center;
  padding: calc(var(--header-h) + clamp(3rem, 8vw, 6rem)) 0 clamp(3rem, 8vw, 6rem);
  text-align: center;
}
.notfound__glow { top: -160px; left: 50%; transform: translateX(-50%); }
.notfound__inner {
  position: relative;
  z-index: 1;
  max-width: 620px;
  margin: 0 auto;
}
.notfound__code {
  font-family: var(--font-display);
  font-weight: 800;
  line-height: 1;
  font-size: clamp(6rem, 22vw, 12rem);
  letter-spacing: -0.04em;
  margin: var(--space-5) 0 var(--space-4);
  color: var(--text-hi);
}
.notfound__title { margin-bottom: var(--space-4); }
.notfound__text {
  color: var(--text-body);
  font-size: var(--fs-lead);
  max-width: 46ch;
  margin: 0 auto var(--space-7);
}
.notfound__actions { justify-content: center; }
.notfound__links {
  margin-top: clamp(2.5rem, 5vw, 4rem);
  padding-top: var(--space-6);
  border-top: 1px solid var(--border);
}
.notfound__links-label {
  display: block;
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-faint);
  margin-bottom: var(--space-4);
}
.notfound__links-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: var(--space-5);
}
.notfound__links-list .link-arrow { color: var(--text-hi); }
.notfound__links-list .link-arrow:hover { color: var(--yellow); }
</style>
