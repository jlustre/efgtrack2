# EFGTrack - Team Mentoring Portal

A Laravel + Livewire (TALL stack) application to manage recruits, onboarding, mentoring, and training for team members. Features a modern, responsive design with an advanced theming system and professional authentication interface.

---

## 🚀 Features

### Core Functionality

-   Recruit CRM (profile, status, files, tags)
-   Mentoring assignments & touchpoints
-   Onboarding & training checklists
-   Licensing & contracting tracker
-   Activity & appointment logging
-   Reports & dashboards (pipeline, training, mentor scorecards)
-   Resources library for scripts, guides, and compliance docs

### UI/UX Enhancements

-   **Advanced Theme System**: Dynamic color scheme selection with real-time preview
-   **Modular Landing Page**: 13+ reusable components for easy maintenance
-   **Modern Authentication**: Professional login/register pages with glass effects
-   **Legal Compliance**: Integrated privacy policy and terms of service pages
-   **Responsive Design**: Mobile-first approach with glass morphism effects

---

## 🛠 Tech Stack

-   **Backend**: Laravel 11
-   **Frontend**: Blade + Livewire + Alpine.js
-   **Styling**: Tailwind CSS with custom CSS variables
-   **Database**: MySQL with SQLite support
-   **Auth**: Laravel Breeze (Livewire) with enhanced UI
-   **Roles/Permissions**: spatie/laravel-permission
-   **Theme System**: Custom CSS variable-based theming
-   **Background Images**: Unsplash integration for professional aesthetics

---

## 📦 Installation

```bash
# 1. Clone repo
git clone https://github.com/yourname/efgtrack.git
cd efgtrack

# 2. Install dependencies
composer install
npm install

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate --seed

# 5. Build assets and run development server
npm run dev
php artisan serve
```

**Additional Setup Steps:**

```bash
# Clear caches after major changes
php artisan view:clear
php artisan config:clear
php artisan cache:clear

# Set up telescope for debugging (optional)
php artisan telescope:install
```

---

## 🎨 Theme System

The application features an advanced theme system with the following capabilities:

### Available Themes

-   **Blue Ocean**: Professional blue gradient theme
-   **Forest Green**: Natural green gradient theme
-   **Purple Sunset**: Creative purple gradient theme
-   **Orange Fire**: Energetic orange gradient theme
-   **Pink Rose**: Elegant pink gradient theme
-   **Red Passion**: Bold red gradient theme

### Theme Features

-   **Real-time Preview**: Live theme switching without page reload
-   **Database Persistence**: User theme preferences stored in database
-   **CSS Variables**: Dynamic color system using CSS custom properties
-   **Component Integration**: Theme system integrated across all components

### Theme Implementation

-   Location: `resources/views/components/theme/`
-   Main files: `theme-system.blade.php`, `theme-selector-ui.blade.php`
-   Database: `theme_settings` column in users table
-   JavaScript: Alpine.js for interactive theme switching

---

## 🔐 Authentication System

### Enhanced Authentication Pages

-   **Modern Design**: Glass morphism effects with professional background images
-   **Responsive Layout**: Mobile-first design approach
-   **Background Integration**: Unsplash professional business imagery
-   **Legal Compliance**: Integrated links to privacy policy and terms of service

### Authentication Features

-   Login with remember me functionality
-   Registration with email verification
-   Password reset with secure token system
-   Legal document links (Privacy Policy, Terms of Service)
-   Professional branding with EFGTrack logo

### Layout Structure

-   **Guest Layout**: `resources/views/layouts/guest.blade.php`
-   **Auth Pages**: `resources/views/livewire/pages/auth/`
-   **Legal Layout**: `resources/views/layouts/legal.blade.php`
-   **Legal Pages**: `resources/views/legal/`

---

## 👥 Default Roles

-   **Owner**: Full access, settings, reports
-   **Admin**: Manage content, imports/exports
-   **Mentor**: Manages assigned mentees
-   **Recruit**: Access to own training/tasks

---

## 📊 Roadmap

### ✅ Completed (Phase 0 - UI/UX Foundation)

-   Enhanced theme system with 6 color schemes
-   Modular landing page with 13+ reusable components
-   Modern authentication pages with glass effects
-   Legal page integration (Privacy Policy, Terms of Service)
-   Professional background imagery and responsive design
-   Navigation consistency across all layouts

### 🔄 Current Phase (Phase 1)

-   Auth system integration and user management
-   Basic recruit CRM functionality
-   Mentoring assignment system
-   Onboarding checklists implementation

### 📅 Upcoming Phases

-   **Phase 2**: Training modules & quizzes, licensing tracker
-   **Phase 3**: Appointments, reminders, resources library
-   **Phase 4**: Integrations (calendar, email, SMS), PWA features

---

## 🏗️ Architecture

### Component Structure

```
resources/views/
├── components/
│   ├── landing/           # Landing page components (13+ modules)
│   ├── theme/            # Theme system components
│   ├── legal/            # Legal page components
│   └── ui/               # Reusable UI components
├── layouts/
│   ├── app.blade.php     # Main application layout
│   ├── guest.blade.php   # Authentication layout
│   └── legal.blade.php   # Legal pages layout
├── livewire/pages/
│   ├── auth/            # Authentication pages
│   └── dashboard/       # Dashboard components
└── legal/               # Legal document pages
```

### Key Files and Directories

-   **Theme System**: `app/Http/Controllers/ThemeController.php`
-   **Database**: `database/migrations/*theme*` files
-   **Styling**: Custom CSS variables in theme components
-   **Assets**: `resources/css/app.css`, `resources/js/app.js`

---

## � Documentation

### Core Documentation

-   **[README.md](README.md)** - Main project overview and setup instructions
-   **[CHANGELOG.md](CHANGELOG.md)** - Detailed version history and technical changes
-   **[UI_UX_ENHANCEMENTS.md](UI_UX_ENHANCEMENTS.md)** - Comprehensive UI/UX system documentation

### Architecture Documentation

-   **[LANDING_PAGE_REFACTORING.md](LANDING_PAGE_REFACTORING.md)** - Modular component architecture details
-   **[experior_mentoring_portal_guide.md](experior_mentoring_portal_guide.md)** - Business requirements and implementation plan

### Quick Reference

-   **Theme System**: See `UI_UX_ENHANCEMENTS.md` → Advanced Theme System
-   **Component Structure**: See `LANDING_PAGE_REFACTORING.md` → Component Breakdown
-   **Authentication**: See `UI_UX_ENHANCEMENTS.md` → Authentication System Redesign
-   **Development Process**: See `CHANGELOG.md` → Development Process Documentation

---

## �🔐 Security

-   Role-based permissions (spatie/laravel-permission)
-   Activity logging (spatie/laravel-activitylog)
-   2FA recommended
-   File storage encryption + signed URLs
-   Enhanced authentication with professional UI
-   Legal compliance with privacy policy and terms of service

---

## 📄 License

Private use only. Not for redistribution.
