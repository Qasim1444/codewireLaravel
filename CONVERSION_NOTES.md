# CodeWire — Vue/Vite SPA → Laravel 13 + Inertia.js Conversion Notes

## Summary

The Vite + Vue 3 + vue-router + Pinia SPA at
`C:\Users\MCS\Downloads\codewiresulotionstemplatee-main` has been converted into a
Laravel 13 + Inertia.js (Vue 3) app at `C:\Users\MCS\Downloads\codewire-laravel`.

- `npm run build` succeeds cleanly.
- `composer install` succeeds cleanly.
- `php artisan serve` sanity check: all routes below return HTTP 200 and the
  response contains the Inertia root `<div id="app" ...>`.

## Routes created (routes/web.php)

| Path | Name | Inertia page | Notes |
|---|---|---|---|
| `/` | home | HomeView | homeServices, featuredProjects, stats, clientTestimonials, recentPosts, techCategories, differentiators, processSteps, courses |
| `/about` | about | AboutView | team, values, timeline, stats |
| `/services` | services | ServicesView | services |
| `/services/{slug}` | service-detail | ServiceDetailView | service (by slug), services, slug |
| `/work` | work | WorkView | projects, projectCategories |
| `/work/{slug}` | work-detail | WorkDetailView | project (by slug), projects, slug |
| `/academy` | academy | AcademyView | courses, academyStats, studentProjects |
| `/academy/{slug}` | course-detail | CourseDetailView | course (by slug), courses, slug |
| `/blog` | blog | BlogView | posts, blogCategories, featuredPost |
| `/blog/{slug}` | blog-post | BlogPostView | post (by slug), relatedPosts, slug |
| `/technologies` | technologies | TechnologiesView | techCategories |
| `/student-projects` | student-projects | StudentProjectsView | studentProjects |
| `/reviews` | reviews | ReviewsView | clientTestimonials, studentTestimonials |
| `/resources` | resources | ResourcesView | resources, resourceTypes |
| `/faq` | faq | FaqView | faqGroups, allFaqs |
| `/consultation` | consultation | ConsultationView | services |
| `/careers` | careers | CareersView | values |
| `/contact` | contact | ContactView | services |
| `*` (fallback) | not-found | NotFoundView | — |

Site-wide data (`company`, `contact`, `socials`, `nav`, `footerColumns` from the
original `src/data/site.js`) is shared globally to every page via
`app/Http/Middleware/HandleInertiaRequests.php` as the `site` prop, and consumed
in `AppHeader.vue`/`AppFooter.vue` via `usePage().props.site`.

## Data conversion

All 12 files under the source project's `src/data/*.js` were mechanically
exported to JSON (via a throwaway Node ESM script) and converted to PHP arrays
under `config/data/*.php` (same shape, keys, and values as the original JS
modules — verified by diffing key counts). `app/Support/SiteData.php` is a thin
static accessor that mirrors the original `getService`/`getProject`/
`getCourse`/`getPost`/`relatedPosts` helper functions from the JS data files, so
the Blade/route layer can look items up by slug the same way the original
router's `meta.title` functions did.

## Component/page porting

- `src/App.vue` → `resources/js/Layouts/AppLayout.vue` (header, `<slot/>`,
  footer, WhatsApp widget). Page transition animation (`<transition mode="out-in">`
  around `RouterView`) was dropped since Inertia's default page-swap has no
  direct equivalent without extra library code; all other App.vue markup/CSS
  was preserved.
- `src/components/layout/*.vue` → `resources/js/Components/layout/*.vue`
- `src/components/ui/*.vue` → `resources/js/Components/ui/*.vue`
- `src/directives/reveal.js` → `resources/js/directives/reveal.js`, registered
  globally on the Inertia app instance in `resources/js/app.js` exactly as it
  was registered on the Vue app in the original `main.js`.
- Every routed page in `src/views/*.vue` referenced by `src/router/index.js`
  was copied into `resources/js/Pages/*.vue` and mechanically edited:
  - `<script setup>` imports of `@/data/*.js` were replaced with
    `defineProps({...})` reading the same variable names from Inertia props
    (Vue 3.5 reactive-props-destructure keeps templates unchanged).
  - `RouterLink`/`router-link` → Inertia's `<Link>`, and the `to`/`:to` prop was
    renamed to `href`/`:href`. A few `:to="{ path, hash }"` object-literals were
    flattened into plain `"path#hash"` strings (Inertia's `Link` only takes a
    URL string).
  - `useRoute()`/`route.params.slug` in the five "detail" pages
    (Service/Course/Work/BlogPost detail + `ConsultationView`/`ContactView`'s
    query/hash reads) were replaced with the prop passed in directly from the
    route controller, or `window.location.search`/`window.location.hash` for
    the two query/hash-based prefill cases.
  - `AppHeader.vue`'s active-nav-link highlighting (previously via
    `router-link-active`) was reimplemented with a small `isActive()` helper
    driven by Inertia's `usePage().url`.
  - Import paths `@/components/...` were normalized to the actual
    `resources/js/Components/...` casing used on disk.

## Pages intentionally NOT ported

The following files exist in `src/views/*.vue` but are **not referenced by
`src/router/index.js`** in the source project (no route ever renders them —
they look like abandoned/demo scratch pages), so they were left out of the
conversion entirely: `Best-experts.vue`, `Counter-Blue.vue`, `contact.vue`
(lowercase, distinct from `ContactView.vue`), `Footer-Intech.vue`,
`It-ServicesView.vue`, `It-Solutions.vue`, `It-Staff.vue`, `ItSuccess.vue`,
`Our-Customers.vue`, `PageView1.vue`, `PageView2.vue`, `Project-Completed.vue`,
`SliderView.vue`. If any of these turn out to be needed, they can be ported the
same way as the routed pages — the FontAwesome and SweetAlert2 packages they
use are already installed.

`src/components/HelloWorld.vue`, `TheWelcome.vue`, `WelcomeItem.vue`, and the
`icons/Icon*.vue` set are Vite/Vue starter-template boilerplate, unused by any
routed page, and were not copied over. `src/stores/counter.js` (Pinia) is also
unused boilerplate — Pinia was dropped entirely, matching the task's guidance.

## Known pre-existing bug fixed during porting

`src/views/StudentProjectsView.vue` in the **original** source project has
mismatched `<section>`/`<div>` tags (a `<section>` is closed twice without a
matching second opening tag). This doesn't break in Vue's runtime-in-browser
compiler used by Vite dev/prod builds there, but Laravel's stricter/newer Vue
SFC compiler pipeline rejected it outright. It was fixed in
`resources/js/Pages/StudentProjectsView.vue` by adding the missing
`<section class="section"><div class="container">` wrapper — purely a markup
fix, no visual/behavioral change intended beyond what the original author most
likely meant.

## Dependencies installed (package.json)

`vue`, `@inertiajs/vue3`, `@vitejs/plugin-vue` (v6, required for Vite 8
compatibility — v5 only supports Vite 5/6), `laravel-vite-plugin`, `bootstrap`,
`@fortawesome/*` (core, free-brands, free-solid, vue-fontawesome),
`@popperjs/core`, `animate.css`, `sweetalert2`, `swiper`, `vue3-carousel`,
`axios`. `vue-router` and `pinia` were dropped (unused after conversion).
`vue-owl-carousel`, `vue-slider-component`, `vue-testimonials` from the
original `package.json` were **not** installed — grep confirmed none of the
routed pages/components actually import them (only listed as unused deps
originally).

CSS: Bootstrap CSS, animate.css, and Swiper CSS are imported in
`resources/css/app.css`, followed by the original project's
`src/assets/styles/{tokens,base,utilities}.css` (copied verbatim into
`resources/css/styles/`), which is where essentially all of the site's actual
visual design lives. JS vendor globals (Bootstrap's JS bundle, axios on
`window`) are wired in `resources/js/bootstrap-vendor.js`, imported once from
`resources/js/app.js`.

## TODOs / follow-ups

1. **Page transitions**: the original fade/slide `<transition>` around
   `RouterView` was not reimplemented (Inertia needs a small addition,
   e.g. `@inertiajs/vue3` progress bar is already built-in, but matching the
   exact custom transition would need extra work with `router.on('start'/'finish')`
   events or a library like `@inertiajs/progress`).
2. **Unported orphan pages**: see list above — port them the same way if they
   turn out to be needed rather than leftover scratch pages.
3. The production build reports one chunk over 500kb
   (`public/build/assets/app-*.js`, ~640kb / ~197kb gzip) — consider route-level
   code-splitting (`resolve` in `app.js` could lazy-import per page) if initial
   load time matters; functionality is unaffected.
4. `SiteData::relatedPosts()` reimplements the original `posts.js`
   `relatedPosts()` tag-overlap heuristic in PHP; behavior should match but
   wasn't exhaustively unit-tested against the JS version.
5. Laravel 13's default `resources/css/app.css`/Tailwind scaffolding was
   removed in favor of the ported site's own CSS system — if Tailwind utility
   classes are wanted later for new admin/back-office screens, `@tailwindcss/vite`
   would need to be reinstalled.

## How to run

```bash
cd C:\Users\MCS\Downloads\codewire-laravel
composer install
npm install
npm run build      # production assets
php artisan serve  # http://127.0.0.1:8000

# or, for local development with HMR:
npm run dev         # in one terminal
php artisan serve   # in another
```
