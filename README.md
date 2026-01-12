# VisorPlate - Premium No-Drill License Plate Solution

> **README Purpose**: This document serves dual purposes: (1) GitHub project overview for developers, and (2) briefing document for future AI iterations on project status, what's implemented, what needs work, and critical gotchas. Keep it concise, scannable, and updated.

A luxury single-product e-commerce site for VisorPlate - velcro visor-mounted front license plate holders for car enthusiasts.

**Product**: $35 | **Market**: Car enthusiasts, show cars, dealerships | **Status**: Payment system live, ready for production

---

## 🎯 Project Status

### ✅ Complete & Working
- **Stripe Checkout** - Full payment processing, webhooks, order confirmation emails
- **Order Database** - Complete CRUD, status tracking, US-only restrictions
- **Shop Page** - Product carousel, dynamic checkout, DRY loading states
- **Contact Form** - Livewire form with wholesale inquiry toggle
- **Landing Page** - Hero, features gallery, state checker tool
- **Design System** - Luxury dark theme, glassmorphism, copper gradients
- **Email System** - Order confirmations, contact notifications (Mailtrap dev)

### 🚧 Next Priorities
1. **Admin Dashboard** - View/manage orders, mark as shipped
2. **Rollo Printer Integration** - Auto-generate shipping labels
3. **Production Deployment** - Domain, hosting, live Stripe keys
4. **Production Email** - Switch from Mailtrap to Mailgun/SendGrid

### 💭 Future Enhancements
- Order tracking (customer lookup by email)
- Wholesale pricing automation
- Analytics integration
- Customer accounts

---

## 🛠️ Tech Stack

**Backend**: Laravel 11 (PHP 8.4.1) • Livewire 3 • Stripe PHP SDK  
**Frontend**: Tailwind CSS v4 (CSS-first) • Alpine.js • Vite  
**Payment**: Stripe Checkout (hosted) • Webhooks  
**Email**: Mailtrap (dev) → Mailgun/SendGrid (production)

---

## ⚙️ Quick Setup

```bash
# Install dependencies
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

# Develop
npm run dev
stripe listen --forward-to visor-plate.test/stripe/webhook
valet link
```

**Add Product Images**: Place in `public/images/` (not in git)
- `hero.jpg`, `Display.jpg`, `Front-in.jpg`, `Slide.jpg`, `Back.jpg`, `Install.jpg`
- `EDIT_1.jpg` through `EDIT_8.jpg`

---

## 🔧 Critical Gotchas

### 1. Tailwind v4 CSS-First Config
**DO NOT** create `tailwind.config.js`. Config is in `resources/css/app.css`:
```css
@import "tailwindcss";
@source "../views";
@source "../js";
```
Use `bg-linear-to-r` not `bg-gradient-to-r`.

### 2. CSRF Token Required in Layout
`resources/views/layouts/app.blade.php` must have:
```blade
<meta name="csrf-token" content="{{ csrf_token() }}">
```
Without this, checkout fails with "Unable to connect to payment processor."

### 3. Stripe Webhook CSRF Exception
`app/Http/Middleware/VerifyCsrfToken.php`:
```php
protected $except = ['stripe/webhook'];
```
Without this, webhooks fail with 419 errors.

### 4. Layout Supports Both Blade & Livewire
```blade
<main>
    @yield('content')      {{-- Blade pages --}}
    {{ $slot ?? '' }}      {{-- Livewire --}}
</main>
```

### 5. Email Folder Must Be Plural
`resources/views/emails/` (NOT `email`) - Laravel looks for plural.

### 6. DRY Button Loading States
Buttons with loading states use `.btn-with-loading` pattern to prevent layout shift:
```blade
<button class="btn-primary-luxury btn-with-loading" data-text="Text">
    <span class="btn-default-text" x-show="!loading">Text</span>
    <span class="btn-loading-text" x-show="loading">
        <svg class="btn-spinner">...</svg>
        Loading...
    </span>
</button>
```

### 7. Carousel Auto-Play Stops on Interaction
Homepage carousel auto-advances until user clicks, then stops permanently. Uses `userInteracted` flag.

---

## 📁 Key Files

```
app/
├── Http/Controllers/CheckoutController.php    # Stripe checkout, webhooks
├── Models/Order.php                           # Order model, helpers
└── Livewire/ContactForm.php                   # Contact/wholesale form

resources/
├── css/app.css                                # Tailwind config + custom components
├── views/
│   ├── checkout/                              # Success/cancel pages
│   ├── emails/                                # Order/contact emails
│   ├── home.blade.php                         # Landing (state checker, carousel)
│   └── shop.blade.php                         # Product page (Alpine checkout)

database/migrations/*_create_orders_table.php  # Order schema

routes/web.php                                 # All routes
```

---

## 🎨 Design System

**Philosophy**: Shadow-free luxury through gradient borders, glassmorphism, and glow effects.  
**Colors**: Copper (#b87333) → Gold (#c29049) gradients on black/gray backgrounds.

**Key Components** (in `app.css`):
- `.glass-card` - Glassmorphism panels
- `.btn-primary-luxury` - Copper gradient fill button
- `.btn-with-loading` + `.btn-default-text` / `.btn-loading-text` - DRY loading states
- `.btn-spinner` / `.btn-spinner-lg` - Consistent spinners
- `.text-gradient-copper` - Copper to gold text
- `.badge-copper-blur` - Accent badges

**Showcase**: Visit `/design` for all components.

---

## 💳 Stripe Integration

**Flow**: User clicks checkout → Alpine.js calls `/checkout/create` → Stripe session → Stripe hosted checkout → User pays → Webhook confirms → Order saved → Email sent → Success page

**US-Only Restrictions** (3 layers):
1. `billing_address_collection: 'required'` - Forces billing address
2. `shipping_address_collection: ['US']` - Only US shipping
3. Server-side checks in success page + webhook - Safety net

**Test Card**: `4242 4242 4242 4242` (any future date, any CVC)

**Webhooks**: `checkout.session.completed`, `payment_intent.succeeded`, `payment_intent.payment_failed`

---

## 📧 Email System

**Development**: Mailtrap for testing  
**Production**: Switch to Mailgun or SendGrid (low volume expected)

**Templates**:
- `emails/order-confirmation.blade.php` - Sent after successful payment
- `emails/contact.blade.php` - Contact form submissions to you
- `emails/contact-confirmation.blade.php` - Production only (rate limit avoidance)

---

## 🗺️ Routes

```php
GET  /                      # Landing page
GET  /shop                  # Product page with checkout
GET  /design                # Design system showcase
GET  /contact               # Contact form (Livewire)

POST /checkout/create       # Create Stripe session (AJAX)
GET  /checkout/success      # Order confirmation page
GET  /checkout/cancel       # Checkout cancelled page

POST /stripe/webhook        # Stripe webhook (CSRF exempt)
```

---

## 🚀 Production Checklist

**Pre-Launch**:
- [ ] Domain purchase
- [ ] Hosting setup (Forge/DO/AWS)
- [ ] Switch to live Stripe keys (`STRIPE_KEY`, `STRIPE_SECRET`)
- [ ] Production webhook endpoint in Stripe dashboard
- [ ] Production email service (Mailgun/SendGrid)
- [ ] Upload product images to server
- [ ] SSL certificate setup
- [ ] Test end-to-end payment flow with real card
- [ ] Enable customer confirmation emails

**Post-Launch**:
- [ ] Admin dashboard for order management
- [ ] Rollo printer integration
- [ ] Order tracking system
- [ ] Analytics setup

---

## 🧪 Development Workflow

```bash
# Daily development
npm run dev                                              # Vite dev server
stripe listen --forward-to visor-plate.test/stripe/webhook  # Webhook testing

# Common commands
php artisan view:clear && php artisan config:clear       # Clear caches
php artisan route:list                                   # View routes
php artisan tinker >>> App\Models\Order::all()           # View orders
npm run build                                            # Production build
```

---

## 📊 Expected Traffic

**Realistic**: 100 visitors/month, ~5 orders/month  
**Optimistic**: 1,000 visitors/month, ~50 orders/month  
**Wholesale**: ~40 inquiries/month (manual outreach to dealerships)

**Email volume**: Low. Free tiers sufficient initially.

---

## 🔍 Common Issues & Solutions

**"Unable to connect to payment processor"**  
→ Missing CSRF meta tag in layout. Add `<meta name="csrf-token">` to `<head>`.

**Webhooks returning 419 error**  
→ Not excluded from CSRF. Add `'stripe/webhook'` to `VerifyCsrfToken.php`.

**Button hover stutters**  
→ Not using `.btn-with-loading` pattern. See Gotcha #6.

**Emails not sending**  
→ Check Mailtrap credentials in `.env`. Verify folder is `emails/` (plural).

**Orders not saving after payment**  
→ Webhook not receiving events. Run `stripe listen` during development.

---

**Last Updated**: January 12, 2026  
**Version**: 1.3 (Stripe + UX Polish)  
**Status**: Production-ready payment system, awaiting deployment

---

## 💡 For Future AI Iterations

When updating this README:
- Keep it under 400 lines
- Focus on what's done, what's next, and critical gotchas
- Remove verbose explanations (create separate guides instead)
- Update version number and status at bottom
- Maintain dual purpose: GitHub overview + AI briefing doc
