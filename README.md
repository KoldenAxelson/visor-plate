# VisorPlate - Premium No-Drill License Plate Solution

A luxury single-product e-commerce site for VisorPlate, the velcro-based front license plate holder designed for car enthusiasts who refuse to drill holes in their pristine bumpers.

**Product**: Velcro visor-mounted front license plate holder  
**Price**: $35  
**Target Market**: Car enthusiasts, show car owners, dealerships (wholesale)

---

## 🎯 Project Status

### ✅ Implemented
- Landing page with hero, features, gallery, state checker, installation guide
- Shop page with product carousel and details
- Contact form with wholesale inquiry support (Livewire)
- Email notifications (Mailtrap for dev)
- Custom 404 page
- Design system showcase page (`/design`)
- Luxury dark theme with glassmorphism
- Mobile responsive

### 🚧 To-Do
- Stripe Checkout integration
- Order database (emails, addresses, order history)
- Rollo Label Printer integration for shipping
- Production email service setup
- Domain purchase & deployment
- Wholesale pricing automation

---

## 🛠️ Tech Stack

### Backend
- **Laravel 11.x** (PHP 8.4.1)
- **Livewire 3.x** - Contact form, future checkout
- **Composer 2.9.2**
- **Laravel Valet** (local development)

### Frontend
- **Tailwind CSS v4** ⚠️ CSS-first config (no `tailwind.config.js`)
- **Alpine.js** - UI interactions (carousels, state checker)
- **Vite** - Asset bundling
- **Blade Templates** - Templating engine

### Email (Development)
- **Mailtrap** - Testing inbox
- **Production TBD** - Likely Mailgun or SendGrid (low volume expected)

---

## 🎨 Design Philosophy

**Luxury Automotive Aesthetic**
- Dark theme (black/gray backgrounds)
- Copper (#b87333) to gold (#c29049) gradients
- Glassmorphism effects (backdrop blur, subtle borders)
- NO drop shadows (uses gradient borders and glow effects instead)
- Premium typography (font-light, generous letter-spacing)
- Smooth animations (350ms bezier curves)

**Key Principle**: Shadow-free depth through gradient borders, glass panels, and subtle glows.

---

## 📁 Project Structure

```
visor-plate/
├── app/
│   └── Livewire/
│       └── ContactForm.php           # Contact/wholesale form handler
├── public/
│   └── images/                       # Product photos (not in git)
│       ├── hero.jpg
│       ├── Display.jpg, Front-in.jpg, etc.
│       └── EDIT_1.jpg through EDIT_8.jpg
├── resources/
│   ├── css/
│   │   └── app.css                   # ⚠️ Tailwind v4 CSS-first config
│   ├── js/
│   │   └── app.js                    # Alpine.js init
│   └── views/
│       ├── emails/                   # ⚠️ Must be plural "emails" not "email"
│       │   ├── contact.blade.php
│       │   └── contact-confirmation.blade.php
│       ├── errors/
│       │   └── 404.blade.php
│       ├── layouts/
│       │   └── app.blade.php         # ⚠️ Master layout (see gotchas)
│       ├── livewire/
│       │   └── contact-form.blade.php
│       ├── home.blade.php            # Landing page
│       ├── shop.blade.php            # Product page
│       └── design.blade.php          # Design system showcase
├── routes/
│   └── web.php
├── .env                              # Email config, not in git
└── README.md                         # You are here
```

---

## ⚙️ Local Setup

### Prerequisites
- PHP 8.4.1+
- Composer 2.9.2+
- Node.js & npm
- Laravel Valet

### Installation

```bash
# Clone repo
git clone [your-repo-url]
cd visor-plate

# Install dependencies
composer install
npm install

# Copy environment file
cp .env.example .env
php artisan key:generate

# Configure Mailtrap in .env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS="hello@visorplate.com"

# Build assets
npm run dev

# Link domain (Valet)
valet link

# Visit site
open http://visor-plate.test
```

### Important: Add Product Images

Images are NOT in git. You need to add them to `public/images/`:
- `hero.jpg` - Homepage background
- `Display.jpg`, `Front-in.jpg`, `Slide.jpg`, `Back.jpg`, `Install.jpg` - Product details
- `EDIT_1.jpg` through `EDIT_8.jpg` - Lifestyle gallery

---

## 🔧 Critical Gotchas & Quirks

### 1. Tailwind CSS v4 (CSS-First Config)

**DO NOT** create a `tailwind.config.js` file. Tailwind v4 uses CSS-first configuration.

**Configuration is in**: `resources/css/app.css`
```css
@import "tailwindcss";
@source "../views";
@source "../js";
```

**Vite config**: Already has `@tailwindcss/vite` plugin  
**Gradients**: Use `bg-linear-to-r` not `bg-gradient-to-r`

If you break this, nothing will work. Don't ask me how I know.

### 2. Layout File Supports Both Blade & Livewire

`resources/views/layouts/app.blade.php` must have BOTH:
```blade
<main class="pt-16">
    @yield('content')      {{-- For traditional Blade pages --}}
    {{ $slot ?? '' }}      {{-- For Livewire components --}}
</main>
```

**Why**: Home/shop use `@extends`, contact form uses Livewire's `->layout()`. Without both, Livewire pages show only header/footer.

### 3. Email Folder Must Be Plural

Folder: `resources/views/emails/` (NOT `email`)

Laravel Mail looks for `emails/contact.blade.php`. If it's `email/contact.blade.php`, emails fail silently.

### 4. Luxury Button Disabled State

The `.btn-primary-luxury` class has custom disabled styling:
```css
.btn-primary-luxury:disabled {
    background: #6b5742;  /* Desaturated copper */
    color: #3d3228;
    border-color: #6b5742;
    cursor: not-allowed;
}
```

Shows filled but darker/desaturated when disabled (vs the normal outline → fill on hover).

### 5. Mailtrap Rate Limiting

Free tier limits emails/second. The contact form sends 2 emails (one to you, one to customer). 

**Current solution**: Only sends to business owner in dev. Customer confirmation email is production-only:
```php
if (app()->environment('production')) {
    Mail::send('emails.contact-confirmation', ...);
}
```

### 6. Alpine.js + Livewire Play Nice

Alpine handles UI (carousels, animations, state checker). Livewire handles server-side (forms, email). They work together - don't fight it.

### 7. Images Not in Git

Product photos are user-uploaded and large. Back them up separately. `.gitignore` excludes them.

---

## 🎨 Design System

All custom CSS is in `resources/css/app.css` with reusable utility classes:

### Key Components
- `.glass-card` - Glassmorphism panels
- `.btn-primary-luxury` - Copper gradient fill button
- `.input-standard` - Glass form inputs
- `.badge-copper-blur` - Copper accent badges
- `.text-gradient-copper` - Copper to gold text gradient
- `.carbon-fiber` - Carbon fiber texture
- `.premium-grain` - Subtle noise overlay

### Color System (CSS Variables)
```css
--accent-copper: #b87333
--accent-gold: #c29049
--bg-luxury-black: #0d0d0d
--bg-elevated: #1c1c1e
```

**Showcase**: Visit `/design` to see all components in action. (Easter egg - linked in footer)

---

## 📧 Contact Form (Livewire)

**Route**: `/contact`  
**Component**: `app/Livewire/ContactForm.php`  
**View**: `resources/views/livewire/contact-form.blade.php`

### Features
- Toggle between General Contact / Wholesale Inquiry
- Real-time validation (validates as you type)
- Wholesale minimum: 200 units
- Spam protection (honeypot field)
- Email notifications with HTML templates
- Success animation + form reset
- Auto-scroll to top on success
- Disabled state during submission

### Email Flow (Development)
1. User submits form
2. Email sent to `MAIL_FROM_ADDRESS` (you)
3. ~~Confirmation email to customer~~ (production only to avoid rate limits)
4. Emails appear in Mailtrap inbox

### Wholesale Behavior
When user selects "Wholesale Inquiry":
- Company name field appears (required)
- Quantity field appears (minimum 200 units)
- Email subject changes to "New Wholesale Inquiry"
- Email template highlights wholesale details

---

## 🚀 Production Deployment

**Status**: Not deployed yet (waiting for domain purchase post-completion)

### Deployment Options Being Considered
- **Laravel Forge** - Simple, Laravel-focused (if pricing works)
- **Vercel** - Serverless option
- **AWS** - If more control needed
- **Digital Ocean** - Budget-friendly VPS

**Requirements**:
- Low cost (100 visitors/month expected)
- Easy scaling if needed (unlikely but nice to have)
- SSL certificate
- Email service integration
- Consistent uptime

### Production Checklist
- [ ] Buy domain name
- [ ] Choose hosting provider
- [ ] Set up production email service (Mailgun/SendGrid)
- [ ] Configure `.env` for production
- [ ] Upload product images to server
- [ ] Set up SSL certificate
- [ ] Configure error monitoring (Sentry/Bugsnag optional)
- [ ] Test payment flow end-to-end
- [ ] Enable customer confirmation emails
- [ ] Set up order database
- [ ] Integrate Rollo printer for shipping labels

### Expected Traffic
- **Optimistic**: 1,000 visitors/month
- **Realistic**: 100 visitors/month
- **Conversion**: ~5% (50 orders/month if optimistic)
- **Wholesale inquiries**: ~40/month (manual outreach to dealerships)
- **Contact form**: ~10 emails/month from customers

**Email volume**: Low. Most services' free tiers will suffice initially.

---

## 🗺️ Routes

```php
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

Route::get('/design', function () {
    return view('design');
})->name('design');

Route::get('/contact', ContactForm::class)->name('contact');
```

Simple, clean, exactly what's needed.

---

## 📊 State Checker (Alpine.js)

Interactive tool on homepage (`#state-checker`) shows which states require front plates.

**29 States Require Front Plates**:  
California, Colorado, Connecticut, Hawaii, Idaho, Illinois, Iowa, Maine, Maryland, Massachusetts, Minnesota, Missouri, Montana, Nebraska, Nevada, New Hampshire, New Jersey, New York, North Dakota, Oregon, Rhode Island, South Dakota, Texas, Vermont, Virginia, Washington, Wisconsin, Wyoming, DC

**21 States Rear-Only**:  
Alabama, Arizona, Arkansas, Delaware, Florida, Georgia, Indiana, Kansas, Kentucky, Louisiana, Michigan, Mississippi, New Mexico, North Carolina, Oklahoma, Pennsylvania, South Carolina, Tennessee, West Virginia, Ohio, Alaska, Utah

---

## 🎯 Development Workflow

### Making Changes

```bash
# Start Vite dev server
npm run dev

# Watch for changes (auto-recompile)
# Visit visor-plate.test in browser
# Make changes to Blade/CSS/JS
# Browser auto-refreshes
```

### Common Commands

```bash
# Clear caches
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Check routes
php artisan route:list

# Test email config
php artisan tinker
>>> Mail::raw('Test', fn($msg) => $msg->to('test@example.com'));

# Rebuild assets for production
npm run build
```

### Adding New Pages

1. Create Blade view in `resources/views/`
2. Add route in `routes/web.php`
3. Use `@extends('layouts.app')` for traditional pages
4. Or use Livewire component for interactive pages

---

## 🧪 Testing

**Current**: Manual testing only  
**Future**: Consider automated tests for checkout flow once Stripe is integrated

### Manual Test Checklist
- [ ] Landing page loads, all images present
- [ ] Carousel auto-advances every 5s
- [ ] State checker dropdown works
- [ ] Shop page product carousel navigates
- [ ] Contact form validates in real-time
- [ ] Wholesale toggle shows/hides fields
- [ ] Email sends successfully (check Mailtrap)
- [ ] Success message displays and form resets
- [ ] Mobile responsive on iPhone/Android
- [ ] 404 page shows for invalid routes

---

## 💡 Future Features (Post-Launch)

### Immediate (Pre-Launch)
- Stripe Checkout integration
- Order database schema
- Rollo printer API connection
- Production email service
- Domain & deployment

### Nice to Have
- Customer accounts (order tracking)
- Admin dashboard (view orders, inquiries)
- Email newsletter signup
- Product reviews/testimonials
- FAQ page (beyond contact page FAQs)
- Blog for SEO (car care tips, legal requirements)
- Instagram feed integration
- Analytics (Google Analytics/Plausible)

### Wholesale Features
- Auto-quote generation for bulk orders
- Tiered pricing (200+, 500+, 1000+)
- Dealer portal (track orders, reorder)
- Custom branding options for dealerships

---

## 🤝 Contributing

This is a solo project, but if you're reading this and have suggestions, feel free to open an issue. Just know response time may vary based on how busy I am shipping VisorPlates!

---

## 📄 License

Proprietary - All Rights Reserved

---

## 🎨 Design Inspiration

Want to use this site's design as inspiration? Check out `/design` to see the full component library. The glassmorphism + copper gradient aesthetic is 🔥 if I do say so myself.

---

## 📞 Contact

For business inquiries: `support@visorplate.com` (once we're live)  
For code questions: Open an issue on GitHub

---

**Last Updated**: January 2026  
**Version**: 1.1 (MVP + Contact Form)  
**Status**: Pre-launch development
