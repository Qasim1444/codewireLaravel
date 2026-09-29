# Meta Pixel + Conversions API

Browser-side Meta Pixel and server-side Conversions API (CAPI) for
codewiresolutions.com, wired into the existing Inertia/Vue app. Both sides send
the same `event_id` for a conversion so Meta deduplicates the pair.

---

## 1. Files

### Backend

| File | Purpose |
| --- | --- |
| `config/services.php` | `services.meta.*` config block (pixel id, CAPI token, graph version, test event code, queue + consent flags). |
| `app/Services/MetaConversionsService.php` | Builds, hashes and POSTs events to `https://graph.facebook.com/{version}/{pixel_id}/events`. Never throws, never logs the token or customer data. |
| `app/Jobs/SendMetaConversionEvent.php` | Queued delivery of one already-hashed event (3 tries, 10s/60s backoff). |
| `app/Support/MarketingConsent.php` | Single source of truth for "may we track?". Reads the `marketing_consent` form field, falling back to the `cw_consent` cookie. |
| `app/Http/Controllers/ContactController.php` | Validates `event_id` (UUID), `event_source_url`, `marketing_consent`; sends the `Lead` event **after** the enquiry is saved. Duplicate-guarded via the cache. |
| `app/Http/Middleware/HandleInertiaRequests.php` | Shares `tracking.metaPixelId` and `tracking.requireConsent` with the frontend. The CAPI token is **not** shared. |
| `app/Console/Commands/SendMetaScheduleEvent.php` | `php artisan meta:schedule {contact}` — sends `Schedule` for a consultation that was actually confirmed. |
| `bootstrap/app.php` | Excludes `cw_consent` from cookie encryption so JS and PHP can both read it. |
| `.env.example` | Placeholder credentials. |

### Frontend

| File | Purpose |
| --- | --- |
| `resources/views/app.blade.php` | Official Meta Pixel base code, wrapped in `window.__loadMetaPixel__()` so it does **not** run before consent. Also exposes `__META_PIXEL_ID__` / `__META_REQUIRE_CONSENT__`. |
| `resources/js/consent.js` | Reusable consent store — `getConsent`, `setConsent`, `marketingAllowed`, `onConsentChange`, `resetConsent`. Writes the first-party `cw_consent` cookie (365 days, SameSite=Lax). |
| `resources/js/Components/ui/CookieConsent.vue` | Small "Essential only / Accept all" banner, mounted once in `AppLayout.vue`. Reopens on a `cw:open-consent` window event. |
| `resources/js/meta-pixel.js` | `setupMetaPixel()`, `track`, `trackViewContent`, `trackLead`, `trackSchedule`, `newEventId`. Everything is a no-op without a pixel id or consent. |
| `resources/js/app.js` | Calls `setupMetaPixel()` before `createInertiaApp` so the first Inertia `navigate` event is captured. |
| `resources/js/Pages/ContactView.vue` | Generates the UUID, posts it as `event_id`, fires the browser `Lead` **only** after the request succeeds. |
| `resources/js/Pages/ConsultationView.vue` | Same, for the consultation request form. |
| `resources/js/Pages/ServiceDetailView.vue`, `WorkDetailView.vue` | `ViewContent` on mount. |

### Tests

`tests/Feature/MetaConversionsApiTest.php` — 14 tests using `Http::fake()`.

---

## 2. Events

| Event | Where | Side |
| --- | --- | --- |
| `PageView` | Initial load and every Inertia navigation (`router.on('navigate')`, fired exactly once per navigation). | Pixel |
| `ViewContent` | Service detail (`/services/{slug}`) and project detail (`/work/{slug}`). | Pixel |
| `Contact` | Any `tel:`, `mailto:`, `wa.me` / `api.whatsapp.com` link, via one delegated document click listener — no markup changes needed. | Pixel |
| `Lead` | **After** `/contact` saves the enquiry (both the contact form and the consultation form). | Pixel **and** CAPI, same `event_id` |
| `Schedule` | `php artisan meta:schedule {contact}`, run once a consultation is genuinely confirmed. | CAPI |

Button clicks are never treated as leads: `Contact` is intent, `Lead` fires only
on a `2xx` response from `POST /contact`.

**Why `Schedule` is a command.** The consultation form only *requests* a slot —
the page itself says the team will confirm a time by email. There is no
in-app confirmation step, so firing `Schedule` on submit would report an
unconfirmed booking. Run `php artisan meta:schedule <contact id>` when the
booking is confirmed (the id is in the notification email / `contacts` table).
It is duplicate-guarded for 30 days per contact.

---

## 3. Setup

### 3.1 Get the Pixel / Dataset ID

1. Open [Meta Events Manager](https://business.facebook.com/events_manager2).
2. Select your business, then **Data sources** in the left sidebar.
3. Pick the pixel (now called a **dataset**). The numeric ID is under its name,
   and also on **Settings → Dataset ID**.
4. Copy it into `META_PIXEL_ID`.

### 3.2 Generate the Conversions API access token

1. Events Manager → your dataset → **Settings**.
2. Scroll to **Conversions API → Generate access token** (under "Set up manually").
3. Copy the token once — it is not shown again — into `META_CAPI_ACCESS_TOKEN`.
4. Alternatively create a System User token in Business Settings with the
   `ads_management` permission scoped to the dataset.

This token is server-side only. It is never rendered into HTML, never shared
through Inertia props, never put into a `VITE_*` variable, and never logged.

### 3.3 Find the Test Event Code

1. Events Manager → your dataset → **Test events** tab.
2. The code shown as `TEST#####` under "Test server events".
3. Copy it into `META_TEST_EVENT_CODE` **while testing only**.

### 3.4 Fill in `.env`

```dotenv
META_PIXEL_ID=1234567890123456
META_CAPI_ACCESS_TOKEN=EAAG...your-token...
META_GRAPH_VERSION=v26.0
META_TEST_EVENT_CODE=TEST12345
META_CAPI_QUEUE=true
META_REQUIRE_CONSENT=true
```

Then:

```bash
php artisan config:clear
npm run build
```

`META_CAPI_QUEUE=true` dispatches `SendMetaConversionEvent` onto the existing
`database` queue, so a worker must be running:

```bash
php artisan queue:work
```

Set `META_CAPI_QUEUE=false` to send inline (the request waits up to ~8s, but the
form still succeeds if Meta is down).

---

## 4. Testing

### 4.1 Automated

```bash
php artisan test --filter=MetaConversionsApiTest
```

Covers: successful `Lead` delivery, the exact `event_id` and SHA-256 hashing,
`test_event_code` present only when configured, missing credentials producing no
request at all, consent being respected (field and cookie), duplicate
submissions not re-sending the conversion, queued delivery, and both an HTTP 400
from Meta and a connection exception leaving the contact form working.

### 4.2 Browser events

1. Install the [Meta Pixel Helper](https://chromewebstore.google.com/detail/meta-pixel-helper/fdgfkebogiimcoedlicjlajpkdmockpc) Chrome extension.
2. Load the site and click **Accept all** in the consent banner — nothing fires
   before that.
3. The helper should show `PageView`. Navigate between pages (Inertia) and
   confirm one `PageView` per navigation, no duplicates.
4. Open a service or project detail page → `ViewContent`.
5. Click the WhatsApp bubble, a `tel:` or `mailto:` link → `Contact`.
6. Submit the contact form → `Lead`, with an `eventID` on it.

### 4.3 Server events

1. Set `META_TEST_EVENT_CODE`, run `php artisan config:clear`, and if queueing is
   on, start `php artisan queue:work`.
2. Open Events Manager → **Test events**.
3. Submit the contact form.
4. The `Lead` event appears with **Server** as the source (plus the **Browser**
   one).
5. `storage/logs/laravel.log` records `Meta CAPI: events delivered.` with the
   event name, event id and `events_received` — and nothing else.

### 4.4 Verify deduplication

1. In **Test events**, expand the `Lead` entry. Both the browser and server rows
   carry the **same Event ID**.
2. After ~20 minutes, **Events Manager → Overview → Lead → View details →
   Deduplication**: the browser/server pair should show as deduplicated, and the
   `Lead` count should equal the number of form submissions, not double it.
3. Quick check from the console on the contact page: the UUID posted as
   `event_id` in the `POST /contact` payload (Network tab) must match the
   `eventID` on the `fbq('track', 'Lead', …)` call.

Deduplication requires both events to share `event_name` **and** `event_id`,
within 48 hours — which is what this implementation sends.

---

## 5. Going to production

1. **Clear the test code** — `META_TEST_EVENT_CODE=` (empty). When empty, the
   field is omitted from the payload entirely; leaving it set keeps events in
   test mode and they will not be attributed.
2. `php artisan config:clear && php artisan config:cache`
3. Keep `META_REQUIRE_CONSENT=true` unless you have a different legal basis —
   with it set, neither the pixel nor CAPI runs until the visitor accepts.
4. Ensure a queue worker is supervised if `META_CAPI_QUEUE=true`.
5. `npm run build` and deploy `public/build`.

---

## 6. Privacy notes

- Email, phone and name leave the server SHA-256 hashed and normalised
  (lowercased/trimmed email, digits-only phone), per Meta's matching rules.
- `client_ip_address`, `client_user_agent`, `fbp` and `fbc` are sent unhashed, as
  Meta requires. `fbc` is synthesised from an `fbclid` query parameter when the
  cookie does not exist yet.
- Queued jobs carry the already-hashed payload, so no raw customer data is
  written to the queue table.
- Logs contain event names, event ids and Meta's own error messages only — never
  the access token, never customer data.
- Declining marketing consent skips the pixel load, the browser events and the
  CAPI call entirely.
