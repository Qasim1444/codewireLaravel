<template>
  <span class="sample-flag" :title="title">
    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z"/></svg>
    {{ label }}
  </span>
</template>

<script setup>
defineProps({
  label: { type: String, default: 'Sample — replace' },
  title: {
    type: String,
    default: 'Placeholder content for design purposes. Replace with verified data before launch.',
  },
})
</script>
