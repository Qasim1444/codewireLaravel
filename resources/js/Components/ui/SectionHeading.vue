<template>
  <div class="section-head" :class="{ 'section-head--center': center }">
    <span v-if="eyebrow" class="eyebrow">{{ eyebrow }}</span>
    <h2 class="h2 balance">
      <slot name="title">{{ title }}</slot>
    </h2>
    <p v-if="lead || $slots.default" class="lead">
      <slot>{{ lead }}</slot>
    </p>
  </div>
</template>

<script setup>
defineProps({
  eyebrow: { type: String, default: '' },
  title: { type: String, default: '' },
  lead: { type: String, default: '' },
  center: { type: Boolean, default: false },
})
</script>
