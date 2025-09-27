# EFGTrack - Team Mentoring Portal

A Laravel + Livewire (TALL stack) application to manage recruits, onboarding, mentoring, and training for team members.

---

## 🚀 Features

-   Recruit CRM (profile, status, files, tags)
-   Mentoring assignments & touchpoints
-   Onboarding & training checklists
-   Licensing & contracting tracker
-   Activity & appointment logging
-   Reports & dashboards (pipeline, training, mentor scorecards)
-   Resources library for scripts, guides, and compliance docs

---

## 🛠 Tech Stack

-   **Backend**: Laravel 11
-   **Frontend**: Blade + Livewire + Alpine.js
-   **Styling**: Tailwind CSS
-   **Database**: MySQL
-   **Auth**: Laravel Breeze (Livewire)
-   **Roles/Permissions**: spatie/laravel-permission

---

## 📦 Installation

```bash
# 1. Clone repo
git clone https://github.com/yourname/efgtrack.git
cd efgtrack

# 2. Install dependencies
composer install
npm install

# 3. Env setup
cp .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate --seed

# 5. Run dev server
npm run dev
php artisan serve
```

---

## 👥 Default Roles

-   **Owner**: Full access, settings, reports
-   **Admin**: Manage content, imports/exports
-   **Mentor**: Manages assigned mentees
-   **Recruit**: Access to own training/tasks

---

## 📊 Roadmap

-   Phase 1: Auth, recruits, mentoring, onboarding checklists
-   Phase 2: Training modules & quizzes, licensing tracker
-   Phase 3: Appointments, reminders, resources
-   Phase 4: Integrations (calendar, email, SMS), PWA polish

---

## 🔐 Security

-   Role-based permissions (spatie/laravel-permission)
-   Activity logging (spatie/laravel-activitylog)
-   2FA recommended
-   File storage encryption + signed URLs

---

## 📄 License

Private use only. Not for redistribution.
