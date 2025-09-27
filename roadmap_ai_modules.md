# EFGTrack - Team Mentoring Portal — Comprehensive Development Roadmap (TALL + AI)

This roadmap turns the module list into a **phase-by-phase plan** with clear deliverables, acceptance criteria, suggested data changes, Livewire components, and **AI-powered additions**. It assumes **TALL stack** (Tailwind, Alpine, Laravel, Livewire) and **MySQL**.

---

## 0) Architecture & Foundations

-   Project skeleton (Laravel Breeze + Livewire + Tailwind + Alpine)
-   spatie/laravel-permission (roles), spatie/laravel-activitylog (audit)
-   Redis, Horizon, Telescope
-   AI Abstraction Layer (interface + drivers)
-   Feature flags

## 1) Recruit CRM

-   Recruits CRUD + Kanban
-   Notes, tags, files
-   Filters and exports

## 2) Onboarding & Training

-   Checklists with progress tracking
-   Evidence uploads
-   Training paths, lessons, quizzes (later)

## 3) Mentoring

-   Mentor ⇔ Mentee assignments
-   Touchpoint logs
-   30/60/90-day goals

## 4) Activity & Appointments

-   Activity logger
-   Appointment scheduler + reminders

## 5) Licensing & Contracting

-   Licensing pipeline
-   Carrier contracting tracker
-   Expiry reminders

## 6) Resources Library

-   Upload/link docs & videos
-   Search + tags
-   Starter packs

## 7) Reports & Dashboards

-   Funnel metrics
-   Checklist progress
-   Mentor leaderboards
-   License expirations

## 8) Notifications & Reminders

-   In-app + email notifications
-   Daily/weekly digests

## 9) AI Foundation (RAG & Indexing)

-   Ingest resources (PDF, Docx, etc.)
-   Split + embed chunks → vector DB
-   KnowledgeBase service for retrieval

## 10) AI Assistants v1

-   Onboarding Copilot (checklist guidance)
-   Mentor Coach (progress summaries)
-   Resource Q&A (library search with citations)

## 11) AI Automation v2

-   Risk scoring (flag inactive recruits)
-   Smart scheduling assistant
-   Compliance linting (advisory only)

## 12) PWA & Mobile Polish

-   PWA manifest
-   Offline logging + sync
-   Sticky bottom bar

## 13) Integrations & DevOps

-   Email + SMS providers
-   Calendar sync (Google/Outlook)
-   Dockerized local dev
-   Backups + monitoring

---

## Non-Functional Requirements

-   Performance: P95 < 1.2s
-   Security: 2FA, encryption at rest, signed URLs
-   Privacy: minimize PII, retention policies
-   Reliability: retries, DLQ
-   Observability: logs + activity tracking

## Metrics & KPIs

-   Recruit conversion rates
-   Checklist completion velocity
-   Mentor touchpoints per week
-   Training quiz pass rates
-   At-risk recruits recovery rate

## Backlog & Nice-to-Haves

-   Gamification (badges, streaks)
-   Voice notes → AI summary
-   CSV importers
-   i18n (English/Spanish)
-   Theming (dark/light)

## Appendices

-   Appendix A: Prompt patterns
-   Appendix B: Indexing practices
-   Appendix C: Initial dev checklist
