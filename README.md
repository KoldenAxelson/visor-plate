# ⚡ VisorPlate - Luxury License Plate Solution

> Single-product e-commerce for velcro visor-mounted license plate holders. Production-ready code, pre-launch status.

**Product**: $35 | **Market**: Car enthusiasts, dealerships | **Status**: Payment live, awaiting deployment

---

## 🎯 Current Status

### ✅ Working Features
- 💳 **Stripe Checkout** - Full payment flow, webhooks, order emails
- 📦 **Orders** - CRUD, status tracking, US-only enforcement
- 🛒 **Shop Page** - Product carousel, quantity selection, checkout
- 📧 **Contact System** - Multi-type forms (general, wholesale, return, review) with rate limiting
- 🏠 **Landing Page** - Hero, gallery, state checker, installation guide
- ❓ **FAQ** - Alpine.js accordion
- 📱 **Social Interest** - Track platform interest, newsletter signups
- 🎨 **Design System** - Glassmorphism, copper gradients, luxury aesthetic
- ⚡ **Queue System** - Background email processing (database driver)
- 🚨 **Error Tracking** - Flare.io monitoring with custom context
- 💾 **Backups** - Daily automated S3 backups with 30-day retention
- 🧪 **Testing** - 32 feature tests for checkout/webhooks

### 🚧 Pre-Launch Checklist

**Security & Reliability (Must-Have):**
- [x] **Rate Limiting** - Contact forms throttled to 5/hour per IP ✅
- [x] **Queue Setup** - Emails/webhooks in background jobs (database driver) ✅
- [x] **Error Monitoring** - Flare.io tracking with custom context ✅
- [x] **Basic Tests** - 32 tests for checkout + webhooks ✅

**Quality of Life:**
- [ ] **Order Viewing** - Simple `/admin/orders` route (password protected)
- [ ] **Rollo Integration** - Label generation from orders
- [x] **Backup Strategy** - Daily S3 backups, 30-day retention ✅

**Infrastructure:**
- [ ] Purchase domain
- [ ] Setup hosting (Forge/DO/AWS)
- [ ] Switch to live Stripe keys
- [ ] Configure production webhook
- [ ] Setup email service (Mailgun/SendGrid)
- [ ] SSL certificate

---

## 🛠️ Tech Stack

**Backend**: Laravel 11 (PHP 8.4.1) • Livewire 3 • Stripe PHP SDK  
**Frontend**: Tailwind v4 CSS-first • Alpine.js • Vite  
**Payment**: Stripe Checkout (hosted) + Webhooks  
**Email**: Mailtrap (dev) → Mailgun/SendGrid (prod)

---

## ⚙️ Quick Setup

```bash
# Dependencies
composer install && npm install

# Environment
cp .env.example .env
php artisan key:generate
php artisan migrate

# Configure .env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
QUEUE_CONNECTION=database
FLARE_KEY=flr_... (optional for error tracking)
AWS_ACCESS_KEY_ID=... (for backups)
AWS_SECRET_ACCESS_KEY=...
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io

# Development
npm run dev
php artisan queue:work  # Required for emails
stripe listen --forward-to visor-plate.test/stripe/webhook
valet link

# Run tests
php artisan test  # 32 tests should pass
```

**Images**: All product images are in `public/images/` (tracked in git)

---

## 📁 Key Files & Features

```
app/
├── Http/Controllers/
│   ├── CheckoutController.php          # Stripe checkout + webhooks (Flare context)
│   └── SocialInterestController.php    # Social interest tracking
├── Jobs/
│   ├── SendOrderConfirmationEmail.php  # Queued order emails
│   ├── SendContactFormEmail.php        # Queued contact notifications
│   └── SendContactConfirmationEmail.php # Queued customer confirmations
├── Livewire/
│   ├── ContactForm.php                 # Multi-type contact form (rate limited, Flare context)
│   └── NewsletterSignup.php            # Email collection
├── Models/Order.php                     # Order model + helpers
├── Exceptions/Handler.php               # Flare error handling (ignores 404s, CSRF)
└── Console/Commands/
    └── CleanupOldReturns.php           # Auto-delete old return photos (90 days)

config/
├── backup.php                           # Spatie backup config (S3, retention)
└── filesystems.php                      # S3 disk configuration

tests/Feature/
├── CheckoutTest.php                     # 17 tests for checkout flow
└── WebhookTest.php                      # 15 tests for webhook handling

resources/
├── css/app.css                          # Tailwind v4 config + components
├── views/
│   ├── home.blade.php                  # Landing (carousel, state checker)
│   ├── shop.blade.php                  # Product page (Alpine checkout)
│   ├── faq.blade.php                   # FAQ accordion
│   ├── social-interest.blade.php       # Social interest + newsletter
│   ├── checkout/                       # Success/cancel pages
│   ├── emails/                         # Order/contact emails
│   └── livewire/                       # Livewire components

routes/web.php                           # All routes
routes/console.php                       # Scheduled tasks (backup, cleanup)
```

### 🔑 Core Features

**💳 Stripe Integration**
- US-only enforcement (3 layers: checkout config, server validation, webhook check)
- Webhooks: `checkout.session.completed`, `payment_intent.*`
- Test card: `4242 4242 4242 4242`

**📱 Social Interest Tracking**
- Footer social icons → `/social-interest?platform=X`
- Tracks first click per visitor (cookie + IP hash)
- Shows goal progress (X/500) + newsletter signup
- User can swap vote between platforms
- When goal hit → query `newsletter_signups` by source

**📧 Contact System**
- 4 types: general, wholesale, return, review
- Return photos: sanitized (EXIF stripped), stored 90 days, auto-cleaned
- Review photos: email-only attachment (not stored)
- Wholesale: requires company + quantity (min 100)

---

## ⚠️ Critical Gotchas

### 1️⃣ Tailwind v4 CSS-First
**DO NOT** create `tailwind.config.js`. Config is in `resources/css/app.css`:
```css
@import "tailwindcss";
@source "../views";
@source "../js";
```
Use `bg-linear-to-r` not `bg-gradient-to-r`.

### 2️⃣ CSRF Token Required
`resources/views/layouts/app.blade.php` must have in `<head>`:
```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```
Without this: "Unable to connect to payment processor"

### 3️⃣ Stripe Webhook CSRF Exception
`app/Http/Middleware/VerifyCsrfToken.php`:
```php
protected $except = ['stripe/webhook'];
```
Without this: 419 errors on webhooks

### 4️⃣ Email Folder Plural
Use `resources/views/emails/` (NOT `email`) - Laravel convention

### 5️⃣ DRY Button Loading States
Use `.btn-with-loading` pattern to prevent layout shift:
```blade
<button class="btn-primary-luxury btn-with-loading">
    <span class="btn-default-text" x-show="!loading">Text</span>
    <span class="btn-loading-text" x-show="loading">
        <svg class="btn-spinner">...</svg>
        Loading...
    </span>
</button>
```

### 6️⃣ Social Icons = Interest Tracker
Footer/success social icons → `/social-interest?platform=X` (NOT external links)  
They track interest + collect emails. No actual social media exists yet.

---

## 🎨 Design System

**Philosophy**: Shadow-free luxury via gradient borders, glassmorphism, glow effects  
**Colors**: Copper (#b87333) → Gold (#c29049) on black backgrounds  
**Typography**: Light weights, wide tracking (0.05em luxury, 0.12em caps)

**Key Components** (`app.css`):
- `.glass-card` - Glassmorphism panels
- `.btn-primary-luxury` - Copper gradient fill
- `.copper-border-card` - Gradient border depth
- `.text-gradient-copper` - Copper/gold text
- `.social-icon-link` + `.social-icon` - Hover: copper gradient fill

**View all**: `/design` route

---

## 🗺️ Important Routes

```
GET  /                      # Landing page
GET  /shop                  # Product + checkout
GET  /faq                   # FAQ accordion
GET  /contact               # Contact form (Livewire)
GET  /wholesale             # → /contact?mode=wholesale
GET  /design                # Design system showcase

POST /checkout/create       # Stripe session (AJAX)
GET  /checkout/success      # Order confirmation
GET  /checkout/cancel       # Checkout cancelled

GET  /social-interest       # Social tracking + newsletter
POST /social-interest/swap  # Switch platform vote
POST /stripe/webhook        # Stripe webhook (CSRF exempt)
```

---

## 📊 Database Schema

**orders** - Stripe checkout sessions, shipping addresses, order status  
**social_interest_logs** - First-click tracking per platform (IP hash + cookie)  
**newsletter_signups** - Email collection with source tracking  
**users** - Standard Laravel (unused currently)

**Scheduled Tasks** (`routes/console.php`):
- `returns:cleanup` - Daily 3AM, deletes return photos >90 days old
- `backup:run` - Daily 3AM, creates database + file backups
- `backup:clean` - Daily 4AM, removes backups older than retention policy
- `backup:monitor` - Daily 5AM, checks backup health (local + S3)

---

## 🚀 Production Deployment Checklist

**Required Services:**
- [ ] Queue workers running (Supervisor recommended)
- [ ] Cron job configured for scheduled tasks
- [ ] Flare.io account + API key
- [ ] AWS S3 bucket for backups
- [ ] Production email service (Mailgun/SendGrid)

**Supervisor Config for Queue Workers:**
```ini
[program:visorplate-queue]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
user=forge
numprocs=1
redirect_stderr=true
stdout_logfile=/path/to/worker.log
```

**Cron Job:**
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

**Environment Variables Required:**
- `APP_ENV=production`
- `QUEUE_CONNECTION=database`
- `FLARE_KEY=flr_...`
- `AWS_ACCESS_KEY_ID=...`
- `AWS_SECRET_ACCESS_KEY=...`
- `AWS_BUCKET=visorplate-backups`
- Live Stripe keys
- Production email credentials

---

## 🧪 Development Commands

```bash
# Daily dev
npm run dev
php artisan queue:work  # Required - emails won't send without this
stripe listen --forward-to visor-plate.test/stripe/webhook

# Clear caches
php artisan view:clear && php artisan config:clear

# View routes/orders
php artisan route:list
php artisan tinker >>> App\Models\Order::all()

# Testing
php artisan test  # Run all 32 tests
php artisan test --filter CheckoutTest  # Specific test

# Queue management
php artisan queue:work  # Process jobs
php artisan queue:failed  # View failed jobs
php artisan queue:retry all  # Retry failed jobs

# Backups
php artisan backup:run  # Manual backup
php artisan backup:list  # View backups
php artisan backup:monitor  # Check backup health

# Return photo cleanup
php artisan returns:cleanup --dry-run

# Production build
npm run build
```

---

## 🚀 Priority Order for Launch Prep

**Completed:**
1. ~~**Rate limiting**~~ ✅ Complete
2. ~~**Queue setup**~~ ✅ Complete
3. ~~**Basic tests**~~ ✅ Complete (32 tests passing)
4. ~~**Error tracking**~~ ✅ Complete (Flare.io)
5. ~~**Backup strategy**~~ ✅ Complete (S3, 30-day retention)

**Remaining:**
6. **Order view** (30 min) - See `task-order-view.md`
7. **Rollo integration** (2-3 hrs, future) - See `task-rollo-integration.md`

**Infrastructure (Final steps):**
- Domain purchase + DNS
- Hosting setup (Forge/DO/AWS)
- Live Stripe keys + production webhook
- Production email service (Mailgun/SendGrid)
- SSL certificate
- Supervisor for queue workers

---

## 🐛 Common Issues

**"Unable to connect to payment processor"**  
→ Missing `<meta name="csrf-token">` in layout

**Webhooks return 419**  
→ Not excluded from CSRF in `VerifyCsrfToken.php`

**Button hover stutters**  
→ Not using `.btn-with-loading` pattern

**Emails not sending**  
→ Queue worker not running. Start with `php artisan queue:work`  
→ Check Mailtrap credentials, verify folder is `emails/` (plural)

**Orders not saving after payment**  
→ Webhook not receiving. Run `stripe listen` locally

**Contact form spam**  
→ Rate limiting active (5/hour per IP). Clear with `RateLimiter::clear('contact-form:IP')`

**Tests failing**  
→ Run `php artisan config:clear` and retry  
→ Ensure `.env` has Stripe test keys

**Backups not running**  
→ Check cron job is active: `crontab -l`  
→ Verify AWS credentials in `.env`  
→ Run `php artisan backup:monitor` for health check

---

**Last Updated**: January 14, 2026  
**Version**: 2.0 (Production-ready with testing, queues, monitoring, backups)  
**For**: Project handoff to future developers/AI
