# ⚡ VisorPlate - Luxury License Plate Solution

> Single-product e-commerce for velcro visor-mounted license plate holders. Production-ready code, pre-launch status.

**Product**: $35 | **Market**: Car enthusiasts, dealerships | **Status**: Payment live, awaiting deployment

---

## 🎯 Current Status

### ✅ Working Features
- 💳 **Stripe Checkout** - Full payment flow, webhooks, order emails
- 📦 **Orders** - CRUD, status tracking, US-only enforcement
- 🛒 **Shop Page** - Product carousel, quantity selection, checkout
- 📧 **Contact System** - Multi-type forms (general, wholesale, return, review)
- 🏠 **Landing Page** - Hero, gallery, state checker, installation guide
- ❓ **FAQ** - Alpine.js accordion
- 📱 **Social Interest** - Track platform interest, newsletter signups
- 🎨 **Design System** - Glassmorphism, copper gradients, luxury aesthetic

### 🚧 Pre-Launch Checklist
- [ ] Purchase domain
- [ ] Setup hosting (Forge/DO/AWS)
- [ ] Switch to live Stripe keys
- [ ] Configure production webhook
- [ ] Setup email service (Mailgun/SendGrid)
- [ ] Configure Rollo printer integration
- [ ] Test end-to-end with real card
- [ ] Admin dashboard for order management

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
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io

# Development
npm run dev
stripe listen --forward-to visor-plate.test/stripe/webhook
valet link
```

**Images**: All product images are in `public/images/` (tracked in git)

---

## 📁 Key Files & Features

```
app/
├── Http/Controllers/
│   ├── CheckoutController.php          # Stripe checkout + webhooks
│   └── SocialInterestController.php    # Social interest tracking
├── Livewire/
│   ├── ContactForm.php                 # Multi-type contact form
│   └── NewsletterSignup.php            # Email collection
├── Models/Order.php                     # Order model + helpers
└── Console/Commands/
    └── CleanupOldReturns.php           # Auto-delete old return photos (90 days)

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

---

## 🧪 Development Commands

```bash
# Daily dev
npm run dev
stripe listen --forward-to visor-plate.test/stripe/webhook

# Clear caches
php artisan view:clear && php artisan config:clear

# View routes/orders
php artisan route:list
php artisan tinker >>> App\Models\Order::all()

# Test return cleanup
php artisan returns:cleanup --dry-run

# Production build
npm run build
```

---

## 🚀 When Ready to Launch

1. Domain + hosting setup
2. Live Stripe keys + production webhook endpoint
3. Production email service (Mailgun/SendGrid)
4. SSL certificate
5. Test full payment flow with real card
6. Admin dashboard for orders
7. Rollo printer integration
8. Analytics setup

---

## 🐛 Common Issues

**"Unable to connect to payment processor"**  
→ Missing `<meta name="csrf-token">` in layout

**Webhooks return 419**  
→ Not excluded from CSRF in `VerifyCsrfToken.php`

**Button hover stutters**  
→ Not using `.btn-with-loading` pattern

**Emails not sending**  
→ Check Mailtrap credentials, verify folder is `emails/` (plural)

**Orders not saving after payment**  
→ Webhook not receiving. Run `stripe listen` locally

---

**Last Updated**: January 13, 2026  
**Version**: 1.5  
**For**: Project handoff to future developers/AI
