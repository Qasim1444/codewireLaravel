<template>
  <div class="careers-page">
    <!-- HERO -->
    <section class="page-hero">
      <div class="bg-grid" aria-hidden="true" />
      <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb" v-reveal>
          <Link href="/">Home</Link>
          <span class="sep">/</span>
          <span aria-current="page">Careers</span>
        </nav>
        <div class="page-hero__inner">
          <h1 class="display" v-reveal="60">Build your career at <span class="text-accent">CodeWire</span></h1>
          <p class="lead" v-reveal="120">
            We’re a small, senior team that ships real products and invests in people. If you
            care about craft, ownership and doing honest work — we’d love to meet you.
          </p>
        </div>
      </div>
    </section>

    <!-- CULTURE / PERKS -->
    <section class="section">
      <div class="container">
        <SectionHeading eyebrow="Life at CodeWire" title="Work that respects your time and growth">
          No bureaucracy, no busywork — just meaningful projects, modern tools and room to grow.
        </SectionHeading>
        <div class="grid grid-3">
          <article v-for="(p, i) in perks" :key="p.title" class="card perk" v-reveal="i * 60">
            <span class="icon-tile"><AppIcon :name="p.icon" /></span>
            <h3 class="perk__title">{{ p.title }}</h3>
            <p class="perk__text">{{ p.text }}</p>
          </article>
        </div>
      </div>
    </section>

    <!-- OPEN ROLES (empty state) -->
    <section class="section surface-elev">
      <div class="container container--narrow">
        <div class="roles-empty" v-reveal>
          <span class="badge badge--outline"><AppIcon name="briefcase" :size="14" /> Open positions</span>
          <h2 class="h2 balance roles-empty__title">No open positions right now — but talent always gets a look</h2>
          <p class="roles-empty__text">
            We hire when the right person appears, not just when a role is posted. Send us your CV
            and a note about what you do best, and we’ll reach out when there’s a fit.
          </p>
          <div class="btn-group roles-empty__actions">
            <a href="#apply" class="btn btn--primary">Send Us Your CV <AppIcon name="arrow-right" class="icon-arrow" /></a>
            <a :href="cvMailto" class="btn btn--ghost"><AppIcon name="mail" :size="18" /> Email Your CV</a>
          </div>
        </div>
      </div>
    </section>

    <!-- APPLICATION FORM -->
    <section id="apply" class="section application">
      <div class="container container--narrow">
        <SectionHeading center eyebrow="Open application" title="Introduce yourself">
          Tell us a little about you. Add a link to your CV, portfolio or GitHub — or email the
          file directly and we’ll match it to your application.
        </SectionHeading>

        <form class="application__form card" novalidate @submit.prevent="submit" v-reveal>
          <div class="application__row">
            <div class="field">
              <label for="c-name">Full name <span class="req">*</span></label>
              <input id="c-name" v-model.trim="form.name" type="text" class="input" :class="{ 'is-error': errors.name }" autocomplete="name" />
              <span v-if="errors.name" class="field-error">{{ errors.name }}</span>
            </div>
            <div class="field">
              <label for="c-email">Email <span class="req">*</span></label>
              <input id="c-email" v-model.trim="form.email" type="email" class="input" :class="{ 'is-error': errors.email }" autocomplete="email" />
              <span v-if="errors.email" class="field-error">{{ errors.email }}</span>
            </div>
          </div>

          <div class="application__row">
            <div class="field">
              <label for="c-role">Role you’re interested in <span class="req">*</span></label>
              <select id="c-role" v-model="form.role" class="select" :class="{ 'is-error': errors.role }">
                <option value="" disabled>Select a role…</option>
                <option v-for="r in roles" :key="r" :value="r">{{ r }}</option>
              </select>
              <span v-if="errors.role" class="field-error">{{ errors.role }}</span>
            </div>
            <div class="field">
              <label for="c-link">Portfolio / CV / GitHub link <span class="opt">(optional)</span></label>
              <input id="c-link" v-model.trim="form.link" type="url" class="input" placeholder="https://…" />
            </div>
          </div>

          <div class="field">
            <label for="c-msg">Tell us about yourself <span class="req">*</span></label>
            <textarea id="c-msg" v-model.trim="form.message" class="textarea" :class="{ 'is-error': errors.message }" placeholder="What you do, what you’re great at, and what you’re looking for…" />
            <span v-if="errors.message" class="field-error">{{ errors.message }}</span>
          </div>

          <input v-model="form.website" class="application__hp" tabindex="-1" autocomplete="off" aria-hidden="true" />

          <button type="submit" class="btn btn--primary btn--lg btn--block" :disabled="submitting">
            <template v-if="submitting"><span class="spinner" /> Sending…</template>
            <template v-else>Submit Application <AppIcon name="send" :size="18" /></template>
          </button>
          <p class="application__note">
            <AppIcon name="mail" :size="14" /> To attach a CV file, email it to
            <a :href="cvMailto">{{ contact.email }}</a> after submitting.
          </p>
        </form>
      </div>
    </section>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import AppIcon from '@/Components/ui/AppIcon.vue'
import SectionHeading from '@/Components/ui/SectionHeading.vue'
import { usePage } from '@inertiajs/vue3'
const page = usePage()
const contact = page.props.site.contact
const company = page.props.site.company

const perks = [
  { icon: 'code', title: 'Real, modern work', text: 'Ship production software on a current stack — no legacy drudgery or throwaway projects.' },
  { icon: 'globe', title: 'Remote-friendly', text: 'Work where you do your best thinking, with flexible hours built around real life.' },
  { icon: 'trending-up', title: 'Room to grow', text: 'Mentorship from senior engineers and genuine ownership of what you build.' },
  { icon: 'users', title: 'Small, senior team', text: 'Your voice matters here. Fewer layers, faster decisions, more impact.' },
  { icon: 'sparkles', title: 'Always learning', text: 'We make time to explore new tools and level up together, not just deliver.' },
  { icon: 'shield-check', title: 'Honest culture', text: 'Clear expectations, respectful feedback and no surprises — with each other or clients.' },
]

const roles = [
  'Frontend Developer',
  'Backend Developer',
  'Full-Stack Developer',
  'Mobile Developer',
  'UI/UX Designer',
  'QA Engineer',
  'DevOps Engineer',
  'Academy Instructor',
  'Internship',
  'Other',
]

const cvMailto = `mailto:${contact.email}?subject=${encodeURIComponent('CV / Application — CodeWire Solutions')}`

const form = reactive({ name: '', email: '', role: '', link: '', message: '', website: '' })
const errors = reactive({})
const submitting = ref(false)

function validate() {
  Object.keys(errors).forEach((k) => delete errors[k])
  if (!form.name) errors.name = 'Please enter your name.'
  if (!form.email) errors.email = 'Please enter your email.'
  else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) errors.email = 'That email doesn’t look right.'
  if (!form.role) errors.role = 'Please choose a role.'
  if (!form.message || form.message.length < 10) errors.message = 'Please add a little more detail.'
  return Object.keys(errors).length === 0
}

async function submit() {
  if (form.website) return
  if (!validate()) return
  submitting.value = true
  const payload = {
    name: form.name,
    email: form.email,
    subject: `Career application — ${form.role}`,
    message: `${form.message}\n\nLink: ${form.link || 'n/a'}`,
    source: 'website-careers-form',
  }
  try {
    await axios.post(`${company.apiBase}/contacts`, payload, { timeout: 12000 })
    Swal.fire({
      icon: 'success',
      title: 'Application received',
      text: 'Thanks for your interest — we’ll be in touch if there’s a fit. Remember to email your CV file.',
      confirmButtonColor: '#ffc400',
    })
    Object.keys(form).forEach((k) => (form[k] = ''))
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Couldn’t submit',
      html: `Please email your details to <a href="mailto:${contact.email}" style="color:#b58900;font-weight:600">${contact.email}</a> instead.`,
      confirmButtonColor: '#ffc400',
    })
  } finally {
    submitting.value = false
  }
}
</script>

<style scoped>
.perk__title { font-size: 1.2rem; margin: var(--space-5) 0 var(--space-3); }
.perk__text { font-size: var(--fs-sm); color: var(--text-muted); }

.roles-empty {
  text-align: center;
  padding: clamp(2rem, 5vw, 3.5rem);
  border: 1px dashed var(--border-strong);
  border-radius: var(--radius-xl);
  background: rgba(255, 255, 255, 0.02);
}
.roles-empty .badge { margin-bottom: var(--space-5); }
.roles-empty__title { max-width: 22ch; margin: 0 auto var(--space-4); }
.roles-empty__text { color: var(--text-body); max-width: 54ch; margin: 0 auto var(--space-6); }
.roles-empty__actions { justify-content: center; }

.application__form { padding: clamp(1.75rem, 3.5vw, 2.75rem); }
.application__row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-5);
  margin-bottom: var(--space-5);
}
.application__form > .field { margin-bottom: var(--space-5); }
.opt { color: var(--text-faint); font-weight: 400; }
.input.is-error, .textarea.is-error, .select.is-error { border-color: #ff6b6b; }
.application__hp { position: absolute; left: -9999px; width: 1px; height: 1px; opacity: 0; }
.application__note {
  display: flex;
  align-items: center;
  gap: 6px;
  justify-content: center;
  margin-top: var(--space-5);
  font-size: var(--fs-sm);
  color: var(--text-muted);
}
.application__note a { color: var(--yellow); }
.application__note :deep(.icon) { color: var(--yellow); }
.spinner {
  width: 16px; height: 16px;
  border: 2px solid rgba(11, 11, 11, 0.3);
  border-top-color: var(--accent-ink);
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }

@media (max-width: 560px) {
  .application__row { grid-template-columns: 1fr; }
}
</style>
