<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Project Description

# E-Learning Platform (Laravel)

## Overview

This repository contains an e-learning platform built using **default Laravel scaffolding** (Blade templates, controllers, and routes). The project intentionally avoids frontend starter kits such as Inertia, Livewire, Jetstream, or Breeze in order to keep the architecture explicit, framework-native, and easy to understand.

The system supports role-based access, background processing, scheduled tasks, realtime-ready features, activity tracking, and AI integration, relying primarily on Laravel’s core capabilities.

---

## Technology Stack

* Laravel (default installation)
* Blade templating engine
* Eloquent ORM
* MySQL / PostgreSQL (configurable)
* Redis (optional, for performance and realtime state)

---

## Authentication & Authorization

The application implements **custom authentication logic** without using Laravel starter kits.

### Roles

The system defines three core user roles:

* Admin
* Instructor
* Student

Roles are stored directly on the `users` table and enforced through middleware and authorization logic.

### Access Control

* Route-level role checks using middleware
* Controller-level authorization using Gates and Policies
* Role-based redirection after login

This approach provides full control over authentication behavior and avoids abstraction layers that can obscure logic.

---

## Core Application Capabilities

### Background Processing

Laravel’s queue system is used to execute time-consuming tasks asynchronously, ensuring fast HTTP responses and better user experience. Typical background tasks include notifications, reminders, AI requests, and logging.

### Scheduling & Reminders

The built-in task scheduler is used for time-based actions such as assignment reminders, progress notifications, and system maintenance jobs. Scheduled tasks are executed via cron.

### Notifications

Laravel’s native notification system is used to deliver messages through supported channels such as database storage, email, and broadcast. Notification logic is decoupled from controllers and handled through dedicated notification classes.

### Activity Logging

User and system actions are recorded to provide audit trails and analytics. This includes learning activity, assessments, administrative actions, and content updates.

### Realtime-Ready Architecture

The application is designed to support realtime features such as chat, live quizzes, and instant notifications. Laravel’s event and broadcasting systems are used to publish updates, while the frontend subscribes to these events as needed.

### AI Chatbot Integration

The platform integrates an external AI service to provide a conversational assistant for learners. Requests to the AI service are handled asynchronously and can be cached or rate-limited to ensure reliability and cost control.

---

## Project Structure

The project follows Laravel’s standard directory structure:

* `app/Http/Controllers` – Request handling and application logic
* `app/Models` – Eloquent models
* `app/Jobs` – Background job definitions
* `app/Notifications` – Notification classes
* `app/Policies` – Authorization policies
* `routes/` – Web and API route definitions
* `resources/views` – Blade templates

This structure keeps responsibilities clearly separated and maintainable.

---

## Design Principles

* Prefer Laravel core features over third-party abstractions
* Keep authentication and authorization explicit
* Separate concerns using jobs, events, and services
* Design for scalability without premature complexity
* Maintain readability and debuggability

---

## Intended Use

This project is suitable as:

* A production-ready learning management system foundation
* An academic or capstone project
* A base for extending realtime and AI-assisted learning features

---

## Notes

Further enhancements such as granular permissions, advanced analytics, and additional realtime features can be layered on top of the current architecture without major refactoring.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


## core UI packages

composer require rappasoft/laravel-livewire-tables
composer require consoletvs/charts

