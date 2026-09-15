<template>
  <Link href="/" class="logo" :class="`logo--${variant}`" aria-label="CodeWire Solutions — home">
    <img
      class="logo__img"
      src="/images/logo.png"
      alt="CodeWire Solutions logo"
      width="38"
      height="38"
      loading="eager"
      decoding="async"
    />
    <span v-if="showText" class="logo__text">
      <span class="logo__name">CODEWIRE</span>
      <span class="logo__sub">SOLUTIONS</span>
    </span>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
  variant: { type: String, default: 'light' },
  showText: { type: Boolean, default: true },
})
</script>

<style scoped>
.logo {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  line-height: 1;
  text-decoration: none;
  flex-shrink: 0;
}

.logo__img {
  width: 54px;
  height: 54px;
  object-fit: contain;
  flex-shrink: 0;
  display: block;
  /* remove any white-box appearance from PNG background */
  mix-blend-mode: multiply;
}

/* In dark backgrounds (footer) multiply looks wrong — reset it */
.logo--light .logo__img {
  mix-blend-mode: normal;
}

.logo:hover .logo__img {
  transform: scale(1.08);
  transition: transform var(--dur) var(--ease);
}

.logo__text {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.logo__name {
  font-family: var(--font-display);
  font-weight: 700;
  font-size: 1.15rem;
  letter-spacing: 0.14em;
  color: var(--text-hi);
  line-height: 1;
}

.logo__sub {
  font-family: var(--font-body);
  font-weight: 600;
  font-size: 0.6rem;
  letter-spacing: 0.42em;
  color: var(--text-muted);
}

.logo--dark .logo__name {
  color: #fff;
}
.logo--dark .logo__sub {
  color: rgba(255, 255, 255, 0.5);
}
</style>
