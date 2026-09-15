<template>
  <footer class="footer section--dark">
    <div class="container container--wide">
      <!-- Newsletter band -->
      

      <!-- Main -->
      <div class="footer__main">
        <div class="footer__brand">
          <SiteLogo />
          <p class="footer__desc">{{ company.description }}</p>
          <ul class="footer__contact">
            <li>
              <AppIcon name="mail" :size="16" />
              <a :href="`mailto:${contact.email}`">{{ contact.email }}</a>
            </li>
            <li>
              <AppIcon name="phone" :size="16" />
              <a :href="`tel:${contact.phoneHref}`">{{ contact.phone }}</a>
            </li>
            <li>
              <AppIcon name="map-pin" :size="16" />
              <span>{{ contact.address.line2 }}, {{ contact.address.country }}</span>
            </li>
          </ul>
          <div class="footer__socials">
            <a
              v-for="s in socials"
              :key="s.name"
              :href="s.url"
              class="footer__social"
              target="_blank"
              rel="noopener noreferrer"
              :aria-label="s.name"
            >
              <AppIcon :name="s.icon" :size="18" />
            </a>
          </div>
        </div>

        <nav class="footer__cols" aria-label="Footer">
          <div v-for="col in footerColumns" :key="col.title" class="footer__col">
            <h3 class="footer__col-title">{{ col.title }}</h3>
            <ul>
              <li v-for="link in col.links" :key="link.label">
                <Link :href="link.to">{{ link.label }}</Link>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- Bottom bar -->
      <div class="footer__bar">
        <p>© {{ year }} {{ company.name }}. All rights reserved.</p>
        <div class="footer__legal">
          <Link href="/contact">Privacy Policy</Link>
          <span aria-hidden="true">·</span>
          <Link href="/contact">Terms of Service</Link>
        </div>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import SiteLogo from '../ui/SiteLogo.vue'
import AppIcon from '../ui/AppIcon.vue'

const page = usePage()
const company = computed(() => page.props.site.company)
const contact = computed(() => page.props.site.contact)
const socials = computed(() => page.props.site.socials)
const footerColumns = computed(() => page.props.site.footerColumns)

const email = ref('')
const subscribed = ref(false)
const error = ref('')
const year = computed(() => 2026)

function subscribe() {
  error.value = ''
  const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())
  if (!valid) {
    error.value = 'Please enter a valid email address.'
    return
  }
  subscribed.value = true
  email.value = ''
}
</script>

<style scoped>
.footer {
  background: var(--bg-base);
  border-top: 1px solid var(--border);
  padding-top: var(--space-8);
}

/* Newsletter */
.footer__news {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: var(--space-6);
  align-items: center;
  padding: var(--space-7);
  background: var(--bg-elev);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  position: relative;
  overflow: hidden;
}
.footer__news-title {
  font-size: var(--fs-h3);
  color: var(--text-hi);
  margin-top: var(--space-2);
  max-width: 22ch;
}
.footer__news-input {
  display: flex;
  gap: var(--space-3);
}
.footer__news-input .input {
  flex: 1;
}
.footer__news-input .btn {
  white-space: nowrap;
}
.footer__news-msg {
  display: flex;
  align-items: center;
  gap: 6px;
  margin-top: var(--space-3);
  font-size: var(--fs-sm);
}
.footer__news-msg--ok {
  color: var(--yellow);
}
.footer__news-msg--err {
  color: #ff6b6b;
}
.footer__news-hint {
  margin-top: var(--space-3);
  font-size: var(--fs-xs);
  color: var(--text-faint);
}

/* Main */
.footer__main {
  display: grid;
  grid-template-columns: 1.4fr 2fr;
  gap: var(--space-8);
  padding: var(--space-8) 0;
}
.footer__desc {
  color: var(--text-muted);
  font-size: var(--fs-sm);
  line-height: 1.7;
  margin: var(--space-5) 0;
  max-width: 42ch;
}
.footer__contact {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
  margin-bottom: var(--space-5);
}
.footer__contact li {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: var(--fs-sm);
  color: var(--text-body);
}
.footer__contact :deep(.icon) {
  color: var(--yellow);
  flex-shrink: 0;
}
.footer__contact a:hover {
  color: var(--yellow);
}
.footer__socials {
  display: flex;
  gap: var(--space-3);
}
.footer__social {
  width: 42px;
  height: 42px;
  display: grid;
  place-items: center;
  border: 1px solid var(--border);
  border-radius: 50%;
  color: var(--text-body);
  transition: color var(--dur-fast) var(--ease), border-color var(--dur-fast) var(--ease), transform var(--dur-fast) var(--ease);
}
.footer__social:hover {
  color: var(--yellow);
  border-color: var(--yellow);
  transform: translateY(-3px);
}

.footer__cols {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: var(--space-6);
}
.footer__col-title {
  font-size: var(--fs-sm);
  text-transform: uppercase;
  letter-spacing: var(--ls-wide);
  color: var(--text-hi);
  margin-bottom: var(--space-5);
}
.footer__col ul {
  display: flex;
  flex-direction: column;
  gap: var(--space-3);
}
.footer__col a {
  font-size: var(--fs-sm);
  color: var(--text-muted);
  transition: color var(--dur-fast) var(--ease);
}
.footer__col a:hover {
  color: var(--yellow);
}

/* Bottom bar */
.footer__bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: var(--space-4);
  padding: var(--space-5) 0;
  border-top: 1px solid var(--border);
  font-size: var(--fs-sm);
  color: var(--text-muted);
}
.footer__legal {
  display: flex;
  align-items: center;
  gap: var(--space-3);
}
.footer__legal a:hover {
  color: var(--yellow);
}

@media (max-width: 992px) {
  .footer__news {
    grid-template-columns: 1fr;
  }
  .footer__main {
    grid-template-columns: 1fr;
    gap: var(--space-7);
  }
  .footer__cols {
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-6) var(--space-4);
  }
}
@media (max-width: 640px) {
  .footer__news-input {
    flex-direction: column;
  }
  .footer__cols {
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-5) var(--space-4);
  }
  .footer__bar {
    flex-direction: column;
    align-items: flex-start;
    gap: var(--space-3);
  }
}
@media (max-width: 400px) {
  .footer__cols {
    grid-template-columns: 1fr;
  }
}
</style>
