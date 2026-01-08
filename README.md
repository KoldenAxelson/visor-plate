# Visor Plate - Landing Page & Shop

A premium single-product e-commerce site for Visor Plate, a no-drill front license plate solution for car enthusiasts.

---

## 📋 Table of Contents
- [Project Overview](#project-overview)
- [Tech Stack](#tech-stack)
- [File Structure](#file-structure)
- [Features Implemented](#features-implemented)
- [Setup Instructions](#setup-instructions)
- [Design Decisions](#design-decisions)
- [To-Do List](#to-do-list)
- [Key Links & Resources](#key-links--resources)

---

## 🎯 Project Overview

**Product:** Visor Plate - A velcro-based front license plate holder that attaches to sun visors  
**Price:** $35  
**Target Audience:** Car enthusiasts and show car owners who want legal compliance without drilling holes in their bumpers  

**Value Proposition:**
- Primary: Preserve vehicle aesthetics (no drilling)
- Secondary: Legal compliance (all 29 front-plate states)
- Tertiary: Quick install/removal for car shows
- Bonus: Avoid $200 tickets

---

## 🛠️ Tech Stack

**Backend:**
- Laravel 11.x (PHP 8.4.1)
- Composer 2.9.2
- Laravel Herd (local development server)
- **Livewire** (Coming with Stripe integration)

**Frontend:**
- Tailwind CSS v4 (CSS-first configuration)
- Alpine.js (lightweight JavaScript framework)
- Vite (asset bundling)
- Blade templates (Laravel templating engine)

**Design Philosophy:**
- Dark theme (black/gray backgrounds)
- Red accent color (#ef4444 to #dc2626)
- Bold typography (text-5xl to text-8xl)
- Generous spacing (py-32 sections)
- Premium automotive aesthetic
- Clean outline buttons (no drop shadows)

---

## 🔄 Why Livewire? (Coming Soon)

**Current Stack:**
- **Alpine.js** handles UI interactions (carousels, dropdowns, animations)
- Great for client-side only features
- No database interaction needed

**Adding Livewire for:**
- **Stripe Payment Processing** - Handle checkout flow with server-side validation
- **Contact Forms** - Real-time validation, email sending, spam protection
- **Wholesale Inquiries** - Form validation, database storage, notification emails
- **Future Features** - Order tracking, customer accounts, admin dashboard

**Why Livewire over plain Laravel forms?**
- ✅ Real-time validation (no page refresh)
- ✅ Better UX (SPA-like feel)
- ✅ Write PHP instead of JavaScript
- ✅ Built-in CSRF protection
- ✅ Easy file uploads
- ✅ Works seamlessly with Alpine.js

**When will it be added?**
When we implement Stripe payments - it provides the cleanest way to handle checkout flow, validation, and payment processing without building complex JavaScript.

**Installation:**
```bash
composer require livewire/livewire
```

That's it! Livewire is a Laravel package that adds reactive components without the complexity of Vue/React.

---

## 📁 File Structure

```
visor-plate/
├── app/
│   └── Livewire/                # Livewire components (coming with Stripe)
│       ├── Checkout.php         # Payment processing
│       ├── ContactForm.php      # Contact form handler
│       └── WholesaleForm.php    # Wholesale inquiry handler
├── public/
│   └── images/                  # All product images
│       ├── hero.jpg             # Homepage hero background
│       ├── Display.jpg          # Main product shot
│       ├── Front-in.jpg         # Installation view
│       ├── Slide.jpg            # Sliding mechanism
│       ├── Back.jpg             # Velcro backing
│       ├── Install.jpg          # Visor mount view
│       ├── EDIT_1.jpg through EDIT_8.jpg  # Lifestyle shots
│       └── Plate.jpg
├── resources/
│   ├── css/
│   │   └── app.css             # Tailwind v4 config
│   ├── js/
│   │   └── app.js              # Alpine.js initialization
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php   # Master layout template
│       ├── errors/
│       │   └── 404.blade.php   # Custom 404 page
│       ├── livewire/            # Livewire component views (coming soon)
│       ├── home.blade.php      # Landing page
│       └── shop.blade.php      # Product/checkout page
├── routes/
│   └── web.php                 # Route definitions
├── vite.config.js              # Vite configuration
├── package.json                # Frontend dependencies
└── composer.json               # Backend dependencies
```

---

## ✅ Features Implemented

### Homepage (`/`)
- ✅ Full-screen hero section with background image
- ✅ "The Enthusiast's Dilemma" - 3 problem cards
- ✅ Premium product showcase with 4 key features
- ✅ Lifestyle image carousel (8 images, auto-advance every 5s)
- ✅ Interactive state checker (Alpine.js) - 50 states
- ✅ "How It Works" 3-step installation guide
- ✅ Pricing section with feature checklist
- ✅ Mobile responsive design

### Shop Page (`/shop`)
- ✅ Product detail carousel (5 images)
- ✅ Sticky sidebar on desktop
- ✅ Product information and pricing
- ✅ Key benefits section
- ✅ "What's Included" list
- ✅ Quantity selector (ready for wholesale)
- ✅ Trust badges (Free Shipping, Fast Delivery, Secure Checkout)
- ✅ 30-day money back guarantee
- ✅ "Why Choose" benefits section

### Global Features
- ✅ Fixed navigation with Shop button
- ✅ Cross-page navigation (works from any page)
- ✅ Comprehensive footer with links
- ✅ Custom 404 error page
- ✅ Smooth, professional button hover effects (no layout shift)
- ✅ Consistent red gradient accents throughout

### Interactive Components (Alpine.js)
1. **Lifestyle Carousel** (Homepage)
   - 8 images (EDIT_1 through EDIT_8)
   - Auto-advance every 5 seconds
   - Manual navigation (prev/next buttons)
   - Dot indicators
   - Desktop thumbnail strip
   - Slide counter

2. **Product Carousel** (Shop Page)
   - 5 detail images
   - Thumbnail navigation
   - Prev/next buttons
   - Image counter
   - Sticky on scroll (desktop)

3. **State Checker Tool**
   - Dropdown with all 50 US states
   - Dynamic result display (red for required, gray for rear-only)
   - Warning about toll roads/state lines

---

## 🚀 Setup Instructions

### Prerequisites
- PHP 8.4.1+
- Composer 2.9.2+
- Node.js & npm
- Laravel Herd (or Valet)

### Installation

1. **Clone/setup Laravel project** (if starting fresh)
```bash
composer create-project laravel/laravel visor-plate
cd visor-plate
```

2. **Install frontend dependencies**
```bash
npm install
```

3. **Copy files to correct locations**
```bash
# Layout
cp layouts-app-fixed.blade.php resources/views/layouts/app.blade.php

# Pages
cp home.blade.php resources/views/home.blade.php
cp shop.blade.php resources/views/shop.blade.php

# Error pages
mkdir -p resources/views/errors
cp 404.blade.php resources/views/errors/404.blade.php

# Routes (merge with existing)
# Copy route definitions from web-shop.php to routes/web.php
```

4. **Add images**
```bash
# Copy all images to public/images/
cp *.jpg public/images/
```

5. **Start development server**
```bash
npm run dev           # Terminal 1 - Vite
herd link            # OR setup Herd via GUI
```

6. **Access site**
- Homepage: `http://visor-plate.test`
- Shop: `http://visor-plate.test/shop`

### Important: Tailwind CSS v4 Configuration

This project uses **Tailwind CSS v4** which has a different setup than v3:

**Do NOT create `tailwind.config.js`** - v4 uses CSS-first configuration

Key files:
- `resources/css/app.css` - Contains `@import 'tailwindcss'` and `@source` directives
- `vite.config.js` - Has `@tailwindcss/vite` plugin

**Never replace these files** unless you know what you're doing!

---

## 🎨 Design Decisions

### Button Hover Effects
**Philosophy:** Smooth, subtle interactions without layout shift. Clean, modern outline style (no drop shadows).

**Approach:**
- ❌ NO `transform scale()` effects (causes jank)
- ❌ NO drop shadows (looks dated/2010s)
- ✅ Outline to filled transitions
- ✅ Smooth color inversions
- ✅ Border color transitions

**Red Button Pattern (Primary CTA):**
```blade
class="border-2 border-red-600 text-red-500 px-12 py-5 rounded-xl text-xl font-bold transition-all duration-300 hover:bg-red-600 hover:text-white hover:border-red-600"
```
- Normal: Red outline, red text, transparent background
- Hover: Fills with red, text turns white

**Outline Button Pattern (Secondary):**
```blade
class="border-2 border-white/30 text-white px-12 py-5 rounded-xl text-xl font-bold transition-all duration-300 hover:bg-white/10 hover:border-white/50"
```
- Normal: Semi-transparent white outline
- Hover: Slightly filled background, brighter border

### Color Palette
- **Base:** Black (#000) and dark grays (gray-900)
- **Accent:** Red gradients (red-600 to red-700)
- **Text:** White primary, gray-300/400 secondary
- **Borders:** Gray-800 default, red-600 on hover

### Typography Scale
- **Mega Headlines:** text-7xl to text-8xl
- **Section Titles:** text-5xl to text-6xl
- **Body Copy:** text-lg to text-xl
- **Small Text:** text-sm

### Spacing System
- **Section Padding:** py-32 (very generous)
- **Component Gaps:** gap-6 to gap-16
- **Max Widths:** 
  - Content: max-w-7xl
  - Focused sections: max-w-4xl
  - Forms/Cards: max-w-2xl

### Responsive Breakpoints
- Mobile-first approach
- `sm:` 640px
- `md:` 768px
- `lg:` 1024px
- `xl:` 1280px

---

## 📝 To-Do List

### Immediate (Before Launch)
- [ ] **Install Livewire** (`composer require livewire/livewire`)
- [ ] **Connect Stripe for payments** (using Livewire checkout component)
- [ ] Set up order confirmation emails
- [ ] Create contact form (Livewire component)
- [ ] Create wholesale inquiry form (Livewire component)
- [ ] Add real testimonials/reviews (if available)
- [ ] Optimize images (compression, WebP format)
- [ ] Add SEO meta tags
- [ ] Set up Google Analytics
- [ ] Test across browsers (Chrome, Safari, Firefox, Edge)
- [ ] Mobile device testing (iOS, Android)

### Nice to Have
- [ ] Add FAQ section
- [ ] Product video demonstration
- [ ] Live chat integration
- [ ] Email newsletter signup
- [ ] Social media links
- [ ] Blog for content marketing
- [ ] Customer testimonials page
- [ ] Instagram feed integration

### Technical
- [ ] Set up production deployment (Forge, Vapor, etc.)
- [ ] Configure email service (Mailgun, SendGrid, etc.)
- [ ] Set up error monitoring (Sentry, Bugsnag)
- [ ] SSL certificate
- [ ] Database for order tracking (optional)
- [ ] Admin panel for order management (optional)

---

## 🔗 Key Links & Resources

### Development
- **Local URL:** `http://visor-plate.test`
- **Shop Page:** `http://visor-plate.test/shop`

### Documentation
- [Laravel Docs](https://laravel.com/docs)
- [Livewire Docs](https://livewire.laravel.com/docs) ← **Read this when adding Stripe**
- [Tailwind CSS v4 Docs](https://tailwindcss.com/docs)
- [Alpine.js Docs](https://alpinejs.dev)
- [Stripe Checkout Docs](https://stripe.com/docs/checkout)

### State License Plate Requirements
**29 States Require Front Plates:**
California, Colorado, Connecticut, Hawaii, Idaho, Illinois, Iowa, Maine, Maryland, Massachusetts, Minnesota, Missouri, Montana, Nebraska, Nevada, New Hampshire, New Jersey, New York, North Dakota, Oregon, Rhode Island, South Dakota, Texas, Vermont, Virginia, Washington, Wisconsin, Wyoming, DC

**21 States Rear-Only:**
Alabama, Arizona, Arkansas, Delaware, Florida, Georgia, Indiana, Kansas, Kentucky, Louisiana, Michigan, Mississippi, New Mexico, North Carolina, Oklahoma, Pennsylvania, South Carolina, Tennessee, West Virginia, Ohio, Alaska, Utah

---

## 💡 Key Implementation Notes

### Navigation Links
All internal links use `{{ url('/#section') }}` format to work across pages:
```blade
<a href="{{ url('/#features') }}">Features</a>  <!-- Works from shop page -->
<a href="{{ route('shop') }}">Shop</a>           <!-- Named route -->
```

### Image Assets
All images in `public/images/` are accessed via:
```blade
{{ asset('images/filename.jpg') }}
```

### Alpine.js Components
Defined in `<script>` tags at bottom of pages:
- `carousel()` - Lifestyle image carousel
- `productCarousel()` - Product detail carousel
- `stateChecker()` - State requirements tool

### Livewire Components (Coming Soon)
Livewire will handle server-side interactions while Alpine handles UI:
- **Livewire:** Form validation, payment processing, database operations
- **Alpine:** Animations, transitions, client-side UI state
- **Together:** Best of both worlds - reactive UI with server-side power

Example of both working together:
```blade
<!-- Livewire handles the checkout -->
<div>
    <button wire:click="processPayment">Pay Now</button>
    
    <!-- Alpine handles the success animation -->
    <div x-data="{ show: false }" 
         x-show="show" 
         x-init="$wire.on('payment-success', () => show = true)">
        Payment successful! ✓
    </div>
</div>
```

### Blade Layouts
Master layout in `resources/views/layouts/app.blade.php`
```blade
@extends('layouts.app')
@section('title', 'Page Title')
@section('content')
    <!-- Page content -->
@endsection
```

### Error Pages
Laravel automatically uses `resources/views/errors/404.blade.php` for 404 errors

---

## 🚨 Important Notes

1. **Never scale elements on hover** - causes layout shift and feels janky
2. **No drop shadows on buttons** - use clean outline style instead
3. **Tailwind v4 uses CSS config** - don't create tailwind.config.js (use `bg-linear-to-*` not `bg-gradient-to-*`)
4. **All CTA buttons link to shop** - not #pricing anchor
5. **404 page must be in errors/ directory** - not root views/
6. **Images are user-uploaded** - not in git, back them up!
7. **Alpine for UI, Livewire for data** - Use Alpine for animations/interactions, Livewire for forms/payments
8. **Livewire components go in app/Livewire/** - with views in resources/views/livewire/

---

## 🤝 Wholesale Inquiries

The site is designed to handle both:
- **Individual sales** ($35 each)
- **Bulk wholesale** (dealerships buying 200+ units)

Wholesale inquiries currently link to `/wholesale` (404 page) - this will be built as a **Livewire component** that handles:
- Form validation (company name, email, quantity)
- Minimum order quantity enforcement (200+ units)
- Email notifications to sales team
- Database storage of inquiries
- Automatic response emails to customers

---

## 📊 Current Status

**Phase:** MVP Complete - Ready for Livewire + Stripe Integration  
**Next Steps:**
1. Install Livewire (`composer require livewire/livewire`)
2. Create Livewire checkout component
3. Integrate Stripe payment processing
4. Build contact and wholesale forms with Livewire

**Timeline:** 
- Livewire installation: ~5 minutes
- Stripe + checkout component: ~1-2 hours
- Forms: ~30-60 minutes each

**Why This Order:**
Livewire provides the cleanest way to handle payment forms, validation, and database interactions without writing complex JavaScript.  

---

## 📸 Image Inventory

**Homepage Carousel (Lifestyle):**
- EDIT_1.jpg through EDIT_8.jpg

**Product Detail (Shop Page):**
- Display.jpg (main product shot)
- Front-in.jpg (installation view)
- Slide.jpg (sliding mechanism)
- Back.jpg (velcro backing)
- Install.jpg (visor mounting)

**Background:**
- hero.jpg (homepage hero section)

**Unused/Additional:**
- Plate.jpg

---

## 🎯 Success Metrics (Once Live)

Track:
- Conversion rate (visitors → buyers)
- Average order value
- Cart abandonment rate
- Wholesale inquiry rate
- Traffic sources (social, organic, direct)
- Mobile vs desktop conversions

---

## 💬 Support & Contact

For technical questions about this codebase, refer to:
- This README
- Laravel documentation
- Tailwind CSS v4 migration guide
- Alpine.js examples

---

**Last Updated:** January 2026  
**Version:** 1.0 (MVP)  
**Status:** Development → Ready for Stripe Integration
