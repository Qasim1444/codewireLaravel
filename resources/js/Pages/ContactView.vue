<template>
  <div class="contact-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Contact</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Let’s build something <span class="text-accent">great</span></h1>
          <p class="lead" v-reveal="120">
            Tell us about your project or the course you’re interested in. We’ll get back to you
            within one business day — no pushy sales, just a clear next step.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container">
        <div class="contact-grid">
          <!-- FORM -->
          <div id="start" class="contact-form card" v-reveal>
            <div id="enroll" class="contact-form__anchor" aria-hidden="true" />
            <h2 class="h3 contact-form__title">Send us a message</h2>
            <p class="contact-form__sub">Fields marked <span class="req">*</span> are required.</p>

            <form novalidate @submit.prevent="submit">
              <div class="contact-form__row">
                <div class="field">
                  <label for="name">Full name <span class="req">*</span></label>
                  <input id="name" v-model.trim="form.name" type="text" class="input" :class="{ 'is-error': errors.name }" autocomplete="name" />
                  <span v-if="errors.name" class="field-error">{{ errors.name }}</span>
                </div>
                <div class="field">
                  <label for="email">Email <span class="req">*</span></label>
                  <input id="email" v-model.trim="form.email" type="email" class="input" :class="{ 'is-error': errors.email }" autocomplete="email" />
                  <span v-if="errors.email" class="field-error">{{ errors.email }}</span>
                </div>
              </div>

              <div class="contact-form__row">
                <div class="field">
                  <label for="phone">Phone <span class="opt">(optional)</span></label>
                  <input id="phone" v-model.trim="form.phone" type="tel" class="input" autocomplete="tel" />
                </div>
                <div class="field">
                  <label for="company">Company <span class="opt">(optional)</span></label>
                  <input id="company" v-model.trim="form.company" type="text" class="input" autocomplete="organization" />
                </div>
              </div>

              <div class="field">
                <label for="service">What can we help with? <span class="req">*</span></label>
                <select id="service" v-model="form.service" class="select" :class="{ 'is-error': errors.service }">
                  <option value="" disabled>Select an option…</option>
                  <optgroup label="Services">
                    <option v-for="s in services" :key="s.slug" :value="s.title">{{ s.title }}</option>
                  </optgroup>
                  <optgroup label="Academy">
                    <option value="CodeWire Academy — Enrollment">CodeWire Academy — Enrollment</option>
                  </optgroup>
                  <option value="General enquiry">General enquiry</option>
                </select>
                <span v-if="errors.service" class="field-error">{{ errors.service }}</span>
              </div>

              <div class="field">
                <label for="message">Message <span class="req">*</span></label>
                <textarea id="message" v-model.trim="form.message" class="textarea" :class="{ 'is-error': errors.message }" placeholder="A few lines about your project, goals or timeline…" />
                <span v-if="errors.message" class="field-error">{{ errors.message }}</span>
              </div>

              <!-- Honeypot (spam trap) -->
              <input v-model="form.website" class="contact-form__hp" tabindex="-1" autocomplete="off" aria-hidden="true" />

              <button type="submit" class="btn btn--primary btn--lg btn--block" :disabled="submitting">
                <template v-if="submitting"><span class="spinner" /> Sending…</template>
                <template v-else>Send Message <AppIcon name="send" :size="18" /></template>
              </button>

              <transition name="fade">
                <p v-if="sent" class="contact-form__success">
                  <AppIcon name="check-circle" :size="18" /> Thanks — your message is on its way. We’ll reply within one business day.
                </p>
              </transition>
            </form>
          </div>

          <!-- DETAILS -->
          <aside class="contact-info" v-reveal="80">
            <div class="contact-info__block card">
              <h2 class="h3">Contact details</h2>
              <ul class="contact-info__list">
                <li>
                  <span class="icon-tile icon-tile--sm"><AppIcon name="mail" :size="18" /></span>
                  <div>
                    <span class="contact-info__label">Email</span>
                    <a :href="`mailto:${contact.email}`">{{ contact.email }}</a>
                  </div>
                </li>
                <li>
                  <span class="icon-tile icon-tile--sm"><AppIcon name="phone" :size="18" /></span>
                  <div>
                    <span class="contact-info__label">Phone</span>
                    <a :href="`tel:${contact.phoneHref}`">{{ contact.phone }}</a>
                  </div>
                </li>
                <li>
                  <span class="icon-tile icon-tile--sm"><AppIcon name="map-pin" :size="18" /></span>
                  <div>
                    <span class="contact-info__label">Office</span>
                    <span class="contact-info__text">{{ contact.address.line1 }}<br />{{ contact.address.line2 }}, {{ contact.address.country }}</span>
                  </div>
                </li>
              </ul>

              <a :href="`https://wa.me/${contact.whatsapp}`" target="_blank" rel="noopener noreferrer" class="btn btn--ghost btn--block contact-info__wa">
                <AppIcon name="whatsapp" :size="18" /> Chat on WhatsApp
              </a>
            </div>

            <div class="contact-info__block card">
              <h3 class="contact-info__hours-title"><AppIcon name="clock" :size="18" /> Business hours</h3>
              <ul class="contact-info__hours">
                <li v-for="h in contact.hours" :key="h.days">
                  <span>{{ h.days }}</span>
                  <span :class="{ 'contact-info__closed': h.time === 'Closed' }">{{ h.time }}</span>
                </li>
              </ul>
            </div>

            <div class="contact-info__map card">
              <iframe
                :src="mapSrc"
                title="CodeWire Solutions location — Vehari, Pakistan"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                allowfullscreen
              />
            </div>
          </aside>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { reactive, ref, onMounted } from 'vue'
import { usePage } from '@inertiajs/vue3'
import axios from 'axios'
import Swal from 'sweetalert2'
import AppIcon from '@/Components/ui/AppIcon.vue'

const props = defineProps({
  services: { type: Array, default: () => [] },
})
const services = props.services
const page = usePage()
const contact = page.props.site.contact
const company = page.props.site.company

const form = reactive({
  name: '',
  email: '',
  phone: '',
  company: '',
  service: '',
  message: '',
  website: '', // honeypot
})
const errors = reactive({})
const submitting = ref(false)
const sent = ref(false)

const mapSrc =
  'https://www.google.com/maps?q=Vehari,Punjab,Pakistan&z=12&output=embed'

onMounted(() => {
  // Preselect intent based on the anchor used to reach the page.
  if (window.location.hash === '#enroll') form.service = 'CodeWire Academy — Enrollment'
})

function validate() {
  Object.keys(errors).forEach((k) => delete errors[k])
  if (!form.name) errors.name = 'Please enter your name.'
  if (!form.email) errors.email = 'Please enter your email.'
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) errors.email = 'That email doesn’t look right.'
  if (!form.service) errors.service = 'Please choose an option.'
  if (!form.message || form.message.length < 10) errors.message = 'Please add a little more detail (10+ characters).'
  return Object.keys(errors).length === 0
}

async function submit() {
  sent.value = false
  if (form.website) return // silently drop bots
  if (!validate()) return

  submitting.value = true
  const payload = {
    name: form.name,
    email: form.email,
    phone: form.phone,
    company: form.company,
    subject: form.service,
    message: form.message,
    source: 'website-contact-form',
  }

  try {
    // NOTE: confirm endpoint path + field names with the CodeWire backend.
    await axios.post(`${company.apiBase}/contacts`, payload, { timeout: 12000 })
    sent.value = true
    Swal.fire({
      icon: 'success',
      title: 'Message sent',
      text: 'Thanks for reaching out — we’ll get back to you within one business day.',
      confirmButtonColor: '#ffc400',
    })
    Object.keys(form).forEach((k) => (form[k] = ''))
  } catch (err) {
    Swal.fire({
      icon: 'error',
      title: 'Something went wrong',
      html: `We couldn’t send your message just now. Please email us directly at <a href="mailto:${contact.email}" style="color:#b58900;font-weight:600">${contact.email}</a>.`,
      confirmButtonColor: '#ffc400',
    })
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
.page-hero--compact {
  padding-bottom: clamp(1.5rem, 3vw, 2.5rem);
}
.contact-grid {
  display: grid;
  grid-template-columns: 1.35fr 0.65fr;
  gap: clamp(1.5rem, 3vw, 2.5rem);
  align-items: start;
}

/* Form */
.contact-form {
  position: relative;
  padding: clamp(1.75rem, 3.5vw, 2.75rem);
}
.contact-form__anchor {
  position: absolute;
  top: calc(-1 * (var(--header-h) + 20px));
}
.contact-form__title { margin-bottom: var(--space-2); }
.contact-form__sub { color: var(--text-muted); font-size: var(--fs-sm); margin-bottom: var(--space-6); }
.contact-form__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
  margin-bottom: var(--space-5);
}
.contact-form form > .field { margin-bottom: var(--space-5); }
.opt { color: var(--text-faint); font-weight: 400; }
.input.is-error, .textarea.is-error, .select.is-error { border-color: #ff6b6b; }
.contact-form__hp {
  position: absolute;
  left: -9999px;
  width: 1px;
  height: 1px;
  opacity: 0;
}
.contact-form__success {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: var(--space-5);
  padding: var(--space-4);
  background: var(--yellow-tint);
  border: 1px solid var(--yellow-tint-2);
  border-radius: var(--radius);
  color: var(--yellow-bright);
  font-size: var(--fs-sm);
}
.spinner {
  width: 16px;
  height: 16px;
  border: 2px solid rgba(11, 11, 11, 0.3);
  border-top-color: var(--accent-ink);
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

/* Info */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
}
.contact-info__block { padding: var(--space-6); }
.contact-info__list {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
  margin: var(--space-5) 0 var(--space-6);
}
.contact-info__list li {
  display: flex;
  gap: 14px;
  align-items: flex-start;
}
.icon-tile--sm { width: 42px; height: 42px; border-radius: var(--radius-sm); }
.icon-tile--sm :deep(.icon) { width: 18px; height: 18px; }
.contact-info__label {
  display: block;
  font-size: var(--fs-xs);
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--text-faint);
  margin-bottom: 2px;
}
.contact-info__list a:hover { color: var(--yellow); }
.contact-info__text { color: var(--text-body); font-size: var(--fs-sm); line-height: 1.6; }
.contact-info__wa { margin-top: var(--space-2); }

.contact-info__hours-title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 1.1rem;
  margin-bottom: var(--space-5);
}
.contact-info__hours-title :deep(.icon) { color: var(--yellow); }
.contact-info__hours li {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid var(--border);
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.contact-info__hours li:last-child { border-bottom: none; }
.contact-info__closed { color: var(--text-faint); }

.contact-info__map {
  padding: 0;
  overflow: hidden;
  height: 240px;
}
.contact-info__map iframe {
  width: 100%;
  height: 100%;
  border: 0;
  filter: grayscale(0.4) invert(0.9) hue-rotate(180deg) contrast(0.9);
}

.fade-enter-active, .fade-leave-active { transition: opacity var(--dur) var(--ease); }
.fade-enter-from, .fade-leave-to { opacity: 0; }

@media (max-width: 900px) {
  .contact-grid { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  .contact-form__row { grid-template-columns: 1fr; gap: var(--space-4); }
  .contact-info__map { height: 200px; }
  .contact-form { padding: clamp(1.25rem, 4vw, 1.75rem); }
}
</style>
