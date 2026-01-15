# ⚡ VisorPlate - Luxury License Plate Solution

> Single-product e-commerce for velcro visor-mounted license plate holders. Production-ready code, launch imminent.

**Product**: $35 | **Market**: Car enthusiasts, dealerships | **Status**: Ready for production deployment

---

## 🎯 Current Status

### ✅ Complete & Production Ready
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

### 🖨️ Rollo Integration (95% Complete)
- ✅ All artisan commands built (`orders:pending`, `order:print`, etc.)
- ✅ ShipStation API integration complete
- ✅ Tracking email system working
- ✅ Database schema updated
- ⏳ **Waiting on**: ShipStation support for test environment setup
- 📝 **Status**: Fully functional, just needs production testing with real labels
- 📂 **Documentation**: See `HANDOFF-DOCUMENT.md` for complete details

### 🚀 Production Launch Tasks

**Sequential tasks to go live** (each is a separate session):

1. **task-01-domain-and-hosting.md** - Domain purchase, hosting setup
2. **task-02-code-deployment.md** - Deploy code, SSL, environment config
3. **task-03-production-services.md** - Stripe live keys, email service, monitoring
4. **task-04-automation-setup.md** - Queue workers, cron jobs
5. **task-05-final-testing.md** - End-to-end testing, smoke tests
6. **task-06-launch-day.md** - Go live, post-launch monitoring

**Estimated Total Time**: 4-6 hours spread across 6 focused sessions

---

## 🛠️ Tech Stack

**Backend**: Laravel 11 (PHP 8.4.1) • Livewire 3 • Stripe PHP SDK  
**Frontend**: Tailwind v4 CSS-first • Alpine.js • Vite  
**Payment**: Stripe Checkout (hosted) + Webhooks  
**Email**: Mailtrap (dev) → Mailgun/SendGrid (prod)  
**Shipping**: ShipStation + Rollo X1040 thermal printer  
**Operations**: Terminal commands (see OPERATIONS-CHEATSHEET.md)

---

## ⚙️ Quick Setup (Development)

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
FLARE_KEY=flr_...
AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
SHIPSTATION_API_KEY=...
SHIPSTATION_API_SECRET=...
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
│   ├── SendContactConfirmationEmail.php # Queued customer confirmations
│   └── SendTrackingEmail.php           # Queued tracking notifications
├── Services/
│   └── RolloPrinter.php                # ShipStation API integration
├── Console/Commands/Orders/            # 9 order management commands
│   ├── PendingOrders.php
│   ├── PrintPendingOrders.php
│   ├── ShipOrder.php
│   ├── ShowOrder.php
│   ├── LookupOrder.php
│   ├── GetTracking.php
│   ├── TodayOrders.php
│   ├── PrintOrder.php
│   └── ResendTracking.php
├── Console/Commands/
│   └── CleanupOldReturns.php           # Auto-delete old return photos (90 days)
├── Livewire/
│   ├── ContactForm.php                 # Multi-type contact form (rate limited)
│   └── NewsletterSignup.php            # Email collection
├── Models/Order.php                     # Order model + helpers
└── Exceptions/Handler.php               # Flare error handling

config/
├── backup.php                           # Spatie backup config (S3, retention)
├── services.php                         # ShipStation + Stripe config
└── logging.php                          # Rollo + standard logging

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
│   ├── emails/                         # Order/contact/tracking emails
│   └── livewire/                       # Livewire components

routes/web.php                           # All routes
routes/console.php                       # Scheduled tasks
OPERATIONS-CHEATSHEET.md                 # Daily operations reference
HANDOFF-DOCUMENT.md                      # Rollo integration details
QUICK-START-CARD.md                      # Quick Rollo reference
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

**📧 Contact System**
- 4 types: general, wholesale, return, review
- Return photos: sanitized (EXIF stripped), stored 90 days, auto-cleaned
- Review photos: email-only attachment (not stored)
- Wholesale: requires company + quantity (min 100)

**🖨️ Order Management (Terminal-First)**
- Stripe dashboard for payment details
- Flare.io for error monitoring
- Terminal commands for operations (see OPERATIONS-CHEATSHEET.md)
- ShipStation + Rollo for label printing
- Cron job auto-prints labels @ 8am weekdays (when ready)

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

### 4️⃣ Stripe API Shipping Address Location
Webhook must check BOTH locations:
```php
$shippingAddress = $session->shipping_details 
    ?? $session->collected_information->shipping_details 
    ?? null;
```
Stripe moved this in recent API updates.

### 5️⃣ Email Folder Plural
Use `resources/views/emails/` (NOT `email`) - Laravel convention

### 6️⃣ DRY Button Loading States
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

### 7️⃣ Queue Workers Required
Emails won't send without queue workers running:
```bash
php artisan queue:work  # Development
# Production: Use Supervisor (see task-04-automation-setup.md)
```

### 8️⃣ Social Icons = Interest Tracker
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

**orders** - Stripe checkout sessions, shipping addresses, order status, tracking  
**social_interest_logs** - First-click tracking per platform (IP hash + cookie)  
**newsletter_signups** - Email collection with source tracking  
**users** - Standard Laravel (unused currently)

**Scheduled Tasks** (`routes/console.php`):
- `returns:cleanup` - Daily 3AM, deletes return photos >90 days old
- `backup:run` - Daily 3AM, creates database + file backups
- `backup:clean` - Daily 4AM, removes backups older than retention policy
- `backup:monitor` - Daily 5AM, checks backup health (local + S3)
- `orders:print-pending` - Weekdays 8AM, auto-print labels if Rollo online

---

## 🚀 Production Deployment Overview

**See task documents for detailed steps:**

### Task 1: Domain & Hosting (30-60 min)
- Purchase domain (VisorPlate.com recommended)
- Choose hosting (Forge + DigitalOcean recommended)
- Initial server setup

### Task 2: Code Deployment (45-90 min)
- Deploy code to server
- Configure SSL certificate
- Set environment variables
- Build production assets

### Task 3: Production Services (30-45 min)
- Switch to live Stripe keys
- Configure production webhook
- Setup email service (Mailgun/SendGrid)
- Configure Flare.io for production

### Task 4: Automation Setup (30-45 min)
- Configure Supervisor for queue workers
- Setup cron jobs for scheduled tasks
- Test background job processing

### Task 5: Final Testing (45-60 min)
- End-to-end checkout flow
- Webhook delivery verification
- Email delivery testing
- Error monitoring verification

### Task 6: Launch Day (30-45 min)
- Final pre-launch checks
- DNS propagation
- Go live
- Post-launch monitoring

**Total Estimated Time**: 4-6 hours across 6 focused sessions

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
php artisan test --filter CheckoutTest

# Queue management
php artisan queue:work
php artisan queue:failed
php artisan queue:retry all

# Backups
php artisan backup:run
php artisan backup:list
php artisan backup:monitor

# Order operations (Rollo)
php artisan orders:pending
php artisan order:show 123
php artisan order:lookup customer@email.com
php artisan orders:print-pending

# Return photo cleanup
php artisan returns:cleanup --dry-run

# Production build
npm run build
```

---

## 📋 Daily Operations

**For daily business operations**, see **OPERATIONS-CHEATSHEET.md** in project root.

Quick reference:
```bash
# Morning routine (if 8am cron didn't run)
php artisan orders:pending

# Customer service
php artisan order:lookup customer@email.com

# System health
php artisan backup:monitor && php artisan queue:monitor
```

**Management approach**: Terminal commands + Stripe dashboard + Flare.io (no admin UI needed for low-volume operations)

---

## 🛠 Common Issues

**"Unable to connect to payment processor"**  
→ Missing `<meta name="csrf-token">` in layout

**Webhooks return 419**  
→ Not excluded from CSRF in `VerifyCsrfToken.php`

**Button hover stutters**  
→ Not using `.btn-with-loading` pattern

**Emails not sending**  
→ Queue worker not running. Start with `php artisan queue:work`  
→ Check email credentials, verify folder is `emails/` (plural)

**Orders not saving after payment**  
→ Webhook not receiving. Run `stripe listen` locally

**Orders missing shipping address**  
→ Check webhook for both `shipping_details` and `collected_information->shipping_details`

**Contact form spam**  
→ Rate limiting active (5/hour per IP). Clear with `RateLimiter::clear('contact-form:IP')`

**Tests failing**  
→ Run `php artisan config:clear` and retry  
→ Ensure `.env` has Stripe test keys

**Backups not running**  
→ Check cron job is active: `crontab -l`  
→ Verify AWS credentials in `.env`  
→ Run `php artisan backup:monitor` for health check

**Rollo not printing**  
→ See HANDOFF-DOCUMENT.md for troubleshooting  
→ Verify ShipStation Connect running  
→ Check printer connection in Connect app

---

## 📚 Additional Documentation

- **OPERATIONS-CHEATSHEET.md** - Daily business operations reference
- **HANDOFF-DOCUMENT.md** - Complete Rollo integration details
- **QUICK-START-CARD.md** - Quick Rollo reference for next Claude
- **task-rollo-integration.md** - Rollo implementation specs
- **task-01 through task-06** - Production deployment guides

---

## 🎯 Launch Readiness

### ✅ Complete
- [x] Core functionality (checkout, orders, emails)
- [x] Rate limiting and security
- [x] Queue system for background jobs
- [x] Error monitoring (Flare.io)
- [x] Automated backups (S3)
- [x] Test coverage (32 tests)
- [x] Rollo integration (95%, waiting on ShipStation support)

### 🚀 Ready for Production
- [ ] Domain purchased
- [ ] Hosting configured
- [ ] Code deployed
- [ ] SSL certificate
- [ ] Live Stripe keys
- [ ] Production email service
- [ ] Queue workers (Supervisor)
- [ ] Cron jobs configured
- [ ] End-to-end testing complete
- [ ] DNS propagated
- [ ] Site live!

**Follow the task documents in sequence to complete deployment.**

---

**Last Updated**: January 15, 2026  
**Version**: 2.2 (Production launch ready)  
**Status**: Development complete, ready for deployment  
**Next Action**: Start with task-01-domain-and-hosting.md
