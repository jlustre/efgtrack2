# EFGTrack - Team Mentoring Portal - Implementation Plan

A practical, mobile‑first plan to build your member team portal with the **TALL stack** (Tailwind CSS, Alpine.js, Laravel, Livewire).

---

## 1) Objectives & Success Metrics

**Primary goals**

-   Track recruit onboarding, licensing progress, and training completion
-   Run a mentor program with clear assignments, goals, and milestones
-   Visualize team KPIs: activity, pipeline, licenses, production (non‑commission numbers OK), rank/achievements
-   Keep the UI fast, responsive, and field‑friendly (mobile first)

**Key KPIs**

-   New recruits added / active this week
-   % recruits with completed onboarding checklist
-   Licensing pipeline: Pre‑exam → Passed exam → Contracted → Active
-   Activity metrics: calls, appointments set/held, follow‑ups, submissions (count only)
-   Training compliance: % modules completed, quiz scores
-   Mentorship health: mentor:mentee ratio, touchpoints logged per mentee

---

## 2) User Personas & Roles

-   **Owner/Coach** (you): Full access; sees all teams, reports, settings.
-   **Mentor**: Manages assigned mentees; logs touchpoints; reviews progress; can comment/coach.
-   **Recruit/Trainee (Licensed or Pre‑licensed)**: Sees personal tasks, training plan, files, schedule; logs activity.
-   **Admin (optional)**: Back‑office tasks, content management, imports/exports.

**Permissions (high‑level)**

-   Owner: CRUD all + settings + exports
-   Admin: CRUD most + content + imports
-   Mentor: R on team + CRUD mentee records they own
-   Recruit: R/W only self data (activity logs, files upload, quizzes)

Use **spatie/laravel-permission** for roles & policies.

---

## 3) Information Architecture & Navigation (mobile‑first)

**Top‑level nav**

-   Dashboard
-   Recruits
-   Mentoring
-   Training
-   Activity & Appointments
-   Licensing & Contracting
-   Resources (docs, playbooks, scripts)
-   Reports
-   Settings

**Quick‑actions (FAB on mobile)**: Add recruit, log activity, schedule appointment, record mentorship touchpoint.

---

## 4) Core Modules (features & data captured)

### 4.1 Recruits CRM

-   Profile: name, contact, state(s), timezone, status (Lead, Pre‑Licensing, Licensed, Contracted, Active, Inactive)
-   Source, referral/upline, join date, E&O expiration, background check status
-   Files: IDs, certificates, training proofs
-   Notes & timeline (activitylog)
-   Tags (e.g., Spanish‑speaking, Annuities focus)

**Views**: List (filter by status/state/mentor), Kanban by status, detail page with tabs.

### 4.2 Mentoring

-   Mentor ⇒ Mentees assignments (start/end dates)
-   Touchpoints: date, type (call, Zoom, ride‑along), notes, outcome, next step
-   Goals per mentee: first 30/60/90 days; SMART goals & automatic reminders
-   Mentor scorecard: weekly touchpoints target, mentee progress roll‑up

### 4.3 Onboarding & Training

-   **Checklists**: Pre‑licensing (course signup, hours completed, fingerprints), Licensing (exam date, pass fail), Contracting (carrier packets, AML, E&O), Launch (first 10 appointments, script practice)
-   **Learning paths**: modules, lessons, quizzes (MCQ/short answer), minimum passing score, retakes
-   **Certificates**: auto‑issue on completion

### 4.4 Activity & Appointments

-   Log calls, texts, emails, meetings; link to recruit
-   Appointments: discovery, FNA, policy delivery, mentor shadowing
-   Reminders & follow‑ups; calendar sync optional later

### 4.5 Licensing & Contracting Tracker

-   States, exam provider info, exam dates/results, license number/expiry
-   Carriers contracted, dates, required trainings (AML, product), renewal reminders

### 4.6 Resources Library

-   Scripts, product one‑pagers, compliance docs, videos, links
-   Versioning and pinning “starter pack” for new recruits

### 4.7 Reporting & Leaderboards

-   Pipeline funnels, conversion rates, training completion heatmaps
-   Mentor leaderboards (mentees progressing, touchpoints)
-   Export CSV/PDF

### 4.8 Notifications & Reminders

-   Email/Browser/Push (later): overdue tasks, upcoming exams, expiring licenses, missed checkpoints

---

## 5) Data Model (initial tables & key fields)

> Prefix all tables with singular nouns; use soft deletes; add `team_id` if you plan multi‑team in future.

**users**

-   id, name, email, phone, timezone, role (via roles tables), mentor_id (nullable), state_primary
-   profile fields: avatar_path, bio

**recruits** (if keeping users only for login, recruits can be separate; otherwise recruits ⊆ users)

-   id, user_id (nullable if not yet invited), owner_id, mentor_id, status, source, referral_id
-   states_json, tags_json, eo_expiry, bg_check_status, joined_at

**mentorships**

-   id, mentor_id, mentee_id (→ users or recruits), started_at, ended_at, active

**mentorship_touchpoints**

-   id, mentorship_id, type, occurred_at, notes, outcome, next_action, next_action_due

**checklists**

-   id, name (e.g., “Pre‑Licensing”), slug, sort_order

**checklist_items**

-   id, checklist_id, title, description, required, sort_order

**checklist_progress**

-   id, checklist_id, recruit_id, item_id, completed_at, evidence_file_id

**training_paths**

-   id, title, description, is_default

**training_modules**

-   id, training_path_id, title, description, order

**lessons**

-   id, training_module_id, title, content_html, video_url, attachment_path, order

**quizzes**

-   id, lesson_id, title, pass_score

**quiz_questions**

-   id, quiz_id, type (mcq, short), prompt, options_json, answer_key

**quiz_attempts**

-   id, quiz_id, user_id, score, passed, attempted_at

**activities**

-   id, recruit_id, user_id, type (call, sms, email, mtg), notes, occurred_at, duration_min

**appointments**

-   id, recruit_id, user_id, type, starts_at, ends_at, location, notes, status

**licenses**

-   id, recruit_id, state, number, issued_at, expires_at, status

**carrier_contracts**

-   id, recruit_id, carrier_name, status, contracted_at, terminated_at, notes

**resources**

-   id, title, type (pdf, doc, link, video), path_or_url, version, pinned

**notifications**

-   id, user_id, type, payload_json, read_at, sent_at

**tags** / **taggables** (polymorphic)

**files** (if using media library)

**activity_log** (via spatie/laravel-activitylog)

---

## 6) UX & UI Design Notes (Tailwind + Livewire + Alpine)

-   **Mobile‑first grid**: single‑column flows; 12‑col grid from `md:` up
-   **Cards & tabs**: segment long profiles into tabs (Profile | Checklist | Training | Activity | Files)
-   **Sticky bottom bar (mobile)**: Log Activity • Add Appointment • Add Note • Complete Task
-   **Kanban** for recruit status; draggable with Livewire sortable
-   **Progress rings/bars** for checklists & training completion
-   **Empty states** with CTA buttons (e.g., “Create your first checklist”)
-   **Skeleton loaders** for perceived speed

**Visual language**

-   Primary: emerald‑600, Secondary: slate, Accents: amber for alerts
-   Consistent icon set (Heroicons)

---

## 7) Development Environment Setup (Laravel 11 + Livewire v3)

1. **New project**
    ```bash
    laravel new efgtrack --git
    cd efgtrack
    php artisan key:generate
    ```
2. **Auth scaffolding (Breeze + Blade + Livewire)**
    ```bash
    composer require laravel/breeze --dev
    php artisan breeze:install livewire
    npm install
    npm run dev
    ```
3. **Packages**
    ```bash
    composer require livewire/livewire spatie/laravel-permission spatie/laravel-activitylog
    composer require league/commonmark guzzlehttp/guzzle
    npm i -D tailwindcss @tailwindcss/forms @tailwindcss/typography @tailwindcss/aspect-ratio
    ```
4. **Tailwind init**
    ```bash
    npx tailwindcss init -p
    ```
    Add `forms`, `typography`, `aspect-ratio` plugins.
5. **DB & queues**: MySQL, Redis (for queues & cache)
    ```bash
    php artisan queue:table && php artisan migrate
    php artisan storage:link
    ```
6. **Seed roles** (Owner, Admin, Mentor, Recruit) and a few demo records.

---

## 8) Livewire Components (starter set)

-   `Recruits/Index`, `Recruits/Show`, `Recruits/Edit`
-   `Recruits/KanbanBoard`
-   `Mentoring/Assignments`, `Mentoring/TouchpointForm`
-   `Training/ChecklistManager`, `Training/PathViewer`, `Training/QuizRunner`
-   `Activities/Logger`, `Appointments/Scheduler`
-   `Reports/Dashboard`, `Reports/Leaderboards`
-   `Resources/Library`

Use **Action modals** for quick‑create forms; emit events between components.

---

## 9) Example Migrations (snippets)

```php
// database/migrations/2025_01_01_000001_create_recruits_table.php
Schema::create('recruits', function (Blueprint $table) {
    $table->id();
    $table->foreignId('owner_id')->constrained('users');
    $table->foreignId('user_id')->nullable()->constrained('users');
    $table->foreignId('mentor_id')->nullable()->constrained('users');
    $table->string('status')->default('lead');
    $table->string('source')->nullable();
    $table->json('states_json')->nullable();
    $table->json('tags_json')->nullable();
    $table->date('joined_at')->nullable();
    $table->date('eo_expiry')->nullable();
    $table->string('bg_check_status')->nullable();
    $table->timestamps();
    $table->softDeletes();
});
```

```php
// mentorships
Schema::create('mentorships', function (Blueprint $table) {
    $table->id();
    $table->foreignId('mentor_id')->constrained('users');
    $table->foreignId('mentee_id')->constrained('users');
    $table->date('started_at')->nullable();
    $table->date('ended_at')->nullable();
    $table->boolean('active')->default(true);
    $table->timestamps();
});
```

```php
// checklist_items & progress
Schema::create('checklists', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->unsignedInteger('sort_order')->default(0);
    $table->timestamps();
});

Schema::create('checklist_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('checklist_id')->constrained();
    $table->string('title');
    $table->text('description')->nullable();
    $table->boolean('required')->default(true);
    $table->unsignedInteger('sort_order')->default(0);
    $table->timestamps();
});

Schema::create('checklist_progress', function (Blueprint $table) {
    $table->id();
    $table->foreignId('checklist_id')->constrained();
    $table->foreignId('recruit_id')->constrained();
    $table->foreignId('item_id')->constrained('checklist_items');
    $table->timestamp('completed_at')->nullable();
    $table->foreignId('evidence_file_id')->nullable();
    $table->timestamps();
});
```

---

## 10) Sample Onboarding Checklists (ready to seed)

**Pre‑Licensing**

1. Enroll in approved pre‑licensing course
2. Complete hours (upload proof)
3. Schedule exam
4. Fingerprinting / background check
5. Ethics/AML training (initial)

**Licensing**

1. Take exam (record score)
2. Pass exam & apply for license
3. License issued (enter number & expiry)

**Contracting**

1. E&O coverage upload
2. Carrier contracting packet A/B
3. AML/Product training (carrier‑specific)
4. Direct deposit form

**Launch**

1. Install apps / CRM access
2. Script practice with mentor
3. Set 10 appointments
4. First joint field training

---

## 11) Reports & Dashboards (initial widgets)

-   **Funnel**: Lead → Pre‑Licensing → Licensed → Contracted → Active (counts + conversion %)
-   **Checklist progress**: bar by cohort (last 30/60/90 days)
-   **Mentor touchpoints**: last 14 days sparkline by mentor
-   **Licenses expiring**: next 60/90 days list
-   **Training completion**: heatmap by module

---

## 12) Security & Compliance Considerations

-   Least‑privilege roles; per‑record policies (only owner/mentor/self can access)
-   Encrypt file storage at rest; use signed URLs; size & type limits
-   Audit trail for sensitive changes (activitylog)
-   PII hygiene: collect only what you need; purge on inactive > X months
-   Backups, .env secrets management, rotate keys; enforce 2FA (Breeze supports)

---

## 13) Roadmap (phased delivery)

**Phase 1 (2–3 weeks)**

-   Auth, roles, recruits CRUD, checklists, mentorship assignments, activity logger, basic dashboard

**Phase 2**

-   Training paths, lessons, quizzes, certificates; licensing/contracting tracker; reports v1

**Phase 3**

-   Appointments + reminders; resources library; exports; notifications

**Phase 4**

-   Integrations: Google Calendar, email (Postmark/SES), SMS (Twilio); mobile PWA polish

---

## 14) Developer Experience & QA

-   Factories & seeders for demo data; Pest tests for policies & Livewire actions
-   CI: run `phpstan`, `pint`, tests on PR; Dusk for core flows
-   Observability: Laravel Telescope (local), Horizon for queues

---

## 15) Nice‑to‑Have Enhancements

-   **Filament Admin** for back‑office CRUD and reports
-   **Importers**: CSV import for recruits
-   **PWA**: offline activity logging; background sync
-   **Gamification**: badges for milestones; streaks for daily learning
-   **Multi‑team** (future): add `teams` table; scoping by team_id

---

## 16) Next Steps (actionable)

1. Scaffold project with Breeze Livewire; install packages & seed roles
2. Build Recruits module (index/kanban/show)
3. Implement Checklists and Mentorships
4. Add Activity Logger & basic Dashboard widgets
5. Iterate UI for mobile polish (sticky actions, quick‑log)

> When you’re ready, I can generate the first migrations, seeders, and Livewire stubs for the initial modules.
