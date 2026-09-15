<template>
  <div class="consult-page">
    <!-- HERO -->
    <section class="page-hero page-hero--compact">
      <div class="bg-grid" aria-hidden="true" />
      <div class="bg-glow consult-glow" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Book a Consultation</span>
        </nav>
        <div class="page-hero__inner">
          <span class="badge badge--dot" v-reveal>Free · No obligation</span>
          <h1 class="display consult-title" v-reveal="60">
            Book a free <span class="text-accent">consultation</span>
          </h1>
          <p class="lead" v-reveal="120">
            Tell us what you’re trying to build or learn. We’ll get back to you within one business
            day to arrange a call — no cost, no pressure, just a clear next step.
          </p>
        </div>
      </div>
    </section>

    <section class="section section--flush-top">
      <div class="container">
        <div class="consult-grid">
          <!-- LEFT: what to expect -->
          <aside class="consult-side" v-reveal>
            <h2 class="consult-side__title">What to expect</h2>
            <ol class="consult-steps">
              <li v-for="(step, i) in steps" :key="i" class="consult-step">
                <span class="consult-step__no">{{ i + 1 }}</span>
                <div>
                  <h3 class="consult-step__title">{{ step.title }}</h3>
                  <p class="consult-step__text">{{ step.text }}</p>
                </div>
              </li>
            </ol>

            <div class="consult-hours card">
              <h3 class="consult-hours__title"><AppIcon name="clock" :size="18" /> When we’re available</h3>
              <ul class="consult-hours__list">
                <li v-for="h in contact.hours" :key="h.days">
                  <span>{{ h.days }}</span>
                  <span :class="{ 'is-closed': h.time === 'Closed' }">{{ h.time }}</span>
                </li>
              </ul>
              <p class="consult-hours__note">
                Times are Pakistan Standard Time (PKT). We’ll confirm the exact slot by email.
              </p>
            </div>

            <div class="consult-alt">
              <span>Prefer to talk now?</span>
              <a :href="`https://wa.me/${contact.whatsapp}`" target="_blank" rel="noopener noreferrer" class="consult-alt__link">
                <AppIcon name="whatsapp" :size="16" /> WhatsApp
              </a>
              <a :href="`mailto:${contact.email}`" class="consult-alt__link">
                <AppIcon name="mail" :size="16" /> Email
              </a>
            </div>
          </aside>

          <!-- RIGHT: booking form -->
          <div id="book" class="consult-form card" v-reveal="80">
            <div class="consult-form__anchor" aria-hidden="true" />
            <h2 class="h3 consult-form__title">Request your consultation</h2>
            <p class="consult-form__sub">Fields marked <span class="req">*</span> are required.</p>

            <form novalidate @submit.prevent="submit">
              <div class="consult-form__row">
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

              <div class="consult-form__row">
                <div class="field">
                  <label for="phone">Phone / WhatsApp <span class="opt">(optional)</span></label>
                  <input id="phone" v-model.trim="form.phone" type="tel" class="input" autocomplete="tel" />
                </div>
                <div class="field">
                  <label for="company">Company <span class="opt">(optional)</span></label>
                  <input id="company" v-model.trim="form.company" type="text" class="input" autocomplete="organization" />
                </div>
              </div>

              <div class="field">
                <label for="topic">What would you like to discuss? <span class="req">*</span></label>
                <select id="topic" v-model="form.topic" class="select" :class="{ 'is-error': errors.topic }">
                  <option value="" disabled>Select a topic…</option>
                  <optgroup label="Services">
                    <option v-for="s in services" :key="s.slug" :value="s.title">{{ s.title }}</option>
                  </optgroup>
                  <optgroup label="Academy">
                    <option value="CodeWire Academy — Enrollment">CodeWire Academy — Enrollment</option>
                  </optgroup>
                  <option value="General enquiry">General enquiry</option>
                </select>
                <span v-if="errors.topic" class="field-error">{{ errors.topic }}</span>
              </div>

              <div class="consult-form__row">
                <div class="field">
                  <label for="date">Preferred date <span class="opt">(optional)</span></label>
                  <input id="date" v-model="form.date" type="date" class="input" :min="today" />
                </div>
                <div class="field">
                  <label for="time">Preferred time <span class="opt">(optional)</span></label>
                  <select id="time" v-model="form.time" class="select">
                    <option value="">No preference</option>
                    <option v-for="t in timeSlots" :key="t" :value="t">{{ t }}</option>
                  </select>
                </div>
              </div>

              <div class="field">
                <label for="method">Preferred contact method</label>
                <select id="method" v-model="form.method" class="select">
                  <option v-for="m in methods" :key="m" :value="m">{{ m }}</option>
                </select>
              </div>

              <div class="field">
                <label for="message">Tell us a bit more <span class="req">*</span></label>
                <textarea id="message" v-model.trim="form.message" class="textarea" :class="{ 'is-error': errors.message }" placeholder="Your goals, timeline, budget range or anything else that helps us prepare…" />
                <span v-if="errors.message" class="field-error">{{ errors.message }}</span>
              </div>

              <!-- Honeypot (spam trap) -->
              <input v-model="form.website" class="consult-form__hp" tabindex="-1" autocomplete="off" aria-hidden="true" />

              <button type="submit" class="btn btn--primary btn--lg btn--block" :disabled="submitting">
                <template v-if="submitting"><span class="spinner" /> Sending…</template>
                <template v-else>Request My Consultation <AppIcon name="calendar" :size="18" /></template>
              </button>

              <p class="consult-form__reassure">
                <AppIcon name="shield-check" :size="15" /> We’ll only use your details to arrange this consultation.
              </p>

              <transition name="fade">
                <p v-if="sent" class="consult-form__success">
                  <AppIcon name="check-circle" :size="18" /> Thanks — your request is in. We’ll email you within one business day to confirm a time.
                </p>
              </transition>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { reactive, ref, computed, onMounted } from 'vue'
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

const steps = [
  { title: 'Tell us about it', text: 'Share your goals, timeline and any constraints using the form.' },
  { title: 'We reply within a business day', text: 'With initial thoughts and a proposed time to talk.' },
  { title: 'A free call', text: 'No cost and no obligation — just an honest conversation about your project.' },
  { title: 'A clear next step', text: 'We follow up with scope, approach and a transparent estimate.' },
]
const timeSlots = [
  'Morning (9:00 AM – 12:00 PM)',
  'Afternoon (12:00 PM – 3:00 PM)',
  'Late afternoon (3:00 PM – 6:00 PM)',
]
const methods = ['Email', 'Phone call', 'WhatsApp', 'Video call']

const form = reactive({
  name: '',
  email: '',
  phone: '',
  company: '',
  topic: '',
  date: '',
  time: '',
  method: 'Email',
  message: '',
  website: '', // honeypot
})
const errors = reactive({})
const submitting = ref(false)
const sent = ref(false)

// Min selectable date = today (computed in the browser; no fabricated availability).
const today = computed(() => new Date().toISOString().slice(0, 10))

onMounted(() => {
  // Allow ?topic= to preselect the discussion topic.
  const t = new URLSearchParams(window.location.search).get('topic')
  if (typeof t === 'string' && t) form.topic = t
})

function validate() {
  Object.keys(errors).forEach((k) => delete errors[k])
  if (!form.name) errors.name = 'Please enter your name.'
  if (!form.email) errors.email = 'Please enter your email.'
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) errors.email = 'That email doesn’t look right.'
  if (!form.topic) errors.topic = 'Please choose a topic.'
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
    subject: `Consultation request — ${form.topic}`,
    preferredDate: form.date || 'No preference',
    preferredTime: form.time || 'No preference',
    contactMethod: form.method,
    message: form.message,
    source: 'website-consultation-form',
  }

  try {
    // NOTE: confirm endpoint path + field names with the CodeWire backend.
    await axios.post(`${company.apiBase}/contacts`, payload, { timeout: 12000 })
    sent.value = true
    Swal.fire({
      icon: 'success',
      title: 'Consultation requested',
      text: 'Thanks for reaching out — we’ll email you within one business day to confirm a time.',
      confirmButtonColor: '#ffc400',
    })
    Object.keys(form).forEach((k) => (form[k] = ''))
    form.method = 'Email'
  } catch (err) {
    Swal.fire({
      icon: 'error',
      title: 'Something went wrong',
      html: `We couldn’t send your request just now. Please email us directly at <a href="mailto:${contact.email}" style="color:#b58900;font-weight:600">${contact.email}</a>.`,
      confirmButtonColor: '#ffc400',
    })
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
.page-hero--compact { padding-bottom: clamp(1.5rem, 3vw, 2.5rem); }
.consult-glow { top: -180px; left: -120px; }
.consult-page .badge--dot { margin-bottom: var(--space-5); }
.consult-title { margin-bottom: var(--space-4); }

.consult-grid {
  display: grid;
  grid-template-columns: 0.85fr 1.15fr;
  gap: clamp(1.5rem, 4vw, 3rem);
  align-items: start;
}

/* Steps */
.consult-side__title { font-size: 1.4rem; margin-bottom: var(--space-6); }
.consult-steps {
  display: flex;
  flex-direction: column;
  gap: var(--space-5);
  margin-bottom: var(--space-7);
}
.consult-step { display: flex; gap: var(--space-4); }
.consult-step__no {
  flex-shrink: 0;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: var(--yellow-tint);
  color: var(--yellow);
  font-family: var(--font-display);
  font-weight: 700;
}
.consult-step__title { font-size: 1.05rem; margin-bottom: 2px; }
.consult-step__text { font-size: var(--fs-sm); color: var(--text-muted); line-height: 1.6; }

.consult-hours { padding: var(--space-5); margin-bottom: var(--space-6); }
.consult-hours__title {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 1.05rem;
  margin-bottom: var(--space-4);
}
.consult-hours__title :deep(.icon) { color: var(--yellow); }
.consult-hours__list li {
  display: flex;
  justify-content: space-between;
  padding: 9px 0;
  border-bottom: 1px solid var(--border);
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.consult-hours__list li:last-child { border-bottom: none; }
.consult-hours__list .is-closed { color: var(--text-faint); }
.consult-hours__note { font-size: var(--fs-xs); color: var(--text-faint); margin-top: var(--space-3); line-height: 1.5; }

.consult-alt {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  gap: var(--space-4);
  font-size: var(--fs-sm);
  color: var(--text-muted);
}
.consult-alt__link {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: var(--text-hi);
  font-weight: 600;
}
.consult-alt__link:hover { color: var(--yellow); }
.consult-alt__link :deep(.icon) { color: var(--yellow); }

/* Form */
.consult-form { position: relative; padding: clamp(1.75rem, 3.5vw, 2.75rem); }
.consult-form__anchor { position: absolute; top: calc(-1 * (var(--header-h) + 20px)); }
.consult-form__title { margin-bottom: var(--space-2); }
.consult-form__sub { color: var(--text-muted); font-size: var(--fs-sm); margin-bottom: var(--space-6); }
.consult-form__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
  margin-bottom: var(--space-5);
}
.consult-form form > .field { margin-bottom: var(--space-5); }
.opt { color: var(--text-faint); font-weight: 400; }
.input.is-error, .textarea.is-error, .select.is-error { border-color: #ff6b6b; }
.consult-form__hp { position: absolute; left: -9999px; width: 1px; height: 1px; opacity: 0; }
.consult-form__reassure {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  margin-top: var(--space-4);
  font-size: var(--fs-xs);
  color: var(--text-faint);
}
.consult-form__reassure :deep(.icon) { color: var(--yellow); }
.consult-form__success {
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

.fade-enter-active, .fade-leave-active { transition: opacity var(--dur) var(--ease); }
.fade-enter-from, .fade-leave-to { opacity: 0; }

@media (max-width: 900px) {
  .consult-grid { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  .consult-form__row { grid-template-columns: 1fr; }
}
</style>
