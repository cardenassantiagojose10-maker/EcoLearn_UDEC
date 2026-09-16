<div align="center">

# EcoLearn UDEC

**Knowledge Management Platform for Environmental Education**

[![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=flat-square&logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=flat-square&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

*Universidad de Cundinamarca — Programa de Ingeniería de Sistemas*

</div>

---

## Table of Contents

- [Overview](#overview)
- [Architecture](#architecture)
- [Tech Stack](#tech-stack)
- [EcoBot — Bilingual Chatbot](#ecobot--bilingual-chatbot)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Variables](#environment-variables)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [API Reference](#api-reference)
- [Default Credentials](#default-credentials)
- [Philosophical Framework](#philosophical-framework)

---

## Overview

**EcoLearn UDEC** is a full-stack web application for knowledge management in environmental education, developed as an academic project at the Universidad de Cundinamarca. The platform enables students to access structured courses, manage personal tasks, track academic progress, and interact with a bilingual AI-assisted chatbot.

### Core Features

| Feature | Description |
|---|---|
| Authentication | Session-based login/register with role management (student / admin) |
| Course Catalog | Structured environmental education courses with modular content |
| Evaluations | Quiz system with score tracking and pass/fail thresholds |
| Task Manager | Personal CRUD task board with completion tracking |
| Progress Dashboard | Visual statistics of completed courses and evaluation scores |
| Admin Panel | Course and user management behind a role-protected admin middleware |
| EcoBot | Bilingual rule-based chatbot (ES / EN) integrated as a floating widget |
| REST API | Sanctum-authenticated API endpoints for task management |

---

## Architecture

The application follows a **Model-View-Controller (MVC)** pattern with dual communication channels: traditional server-rendered web views and a Sanctum-secured REST API.

```
┌─────────────────────────────────────────────────────────┐
│                      CLIENT LAYER                       │
│  Browser (Bootstrap 5 + Vanilla JS + Blade Templates)   │
└───────────────────────┬─────────────────────────────────┘
                        │  HTTP / AJAX / JSON
┌───────────────────────▼─────────────────────────────────┐
│                    LARAVEL 12 CORE                       │
│                                                          │
│  ┌─────────────┐   ┌──────────────┐   ┌──────────────┐  │
│  │   Routes    │──▶│  Controllers │──▶│    Models    │  │
│  │  web.php    │   │  Web / Admin │   │  Eloquent    │  │
│  │  api.php    │   │  API / Chat  │   │  ORM         │  │
│  └─────────────┘   └──────┬───────┘   └──────┬───────┘  │
│                           │                  │           │
│  ┌────────────────────────▼──────────────────▼────────┐  │
│  │              Blade View Engine                      │  │
│  │         layouts / components / pages                │  │
│  └─────────────────────────────────────────────────────┘  │
└───────────────────────┬─────────────────────────────────┘
                        │  PDO / Eloquent
┌───────────────────────▼─────────────────────────────────┐
│                    DATA LAYER                            │
│                 MySQL 8.0 (Appv1)                        │
└─────────────────────────────────────────────────────────┘
```

### Controller Namespaces

```
App\Http\Controllers\
├── Web\
│   ├── AuthViewController      # Login, register, logout
│   ├── DashboardController     # User dashboard
│   ├── CourseController        # Course catalog
│   ├── EvaluationController    # Quiz submission and results
│   ├── TaskViewController      # Task CRUD (web)
│   ├── ProgressController      # Progress statistics
│   ├── ProfileController       # Profile management
│   └── ChatbotController       # EcoBot bilingual responses
├── Admin\
│   ├── AdminDashboardController
│   ├── AdminCourseController
│   └── AdminUserController
├── API\
│   ├── AuthController          # API token auth (Sanctum)
│   └── TaskController          # API task endpoints
└── ContactoController
```

---

## Tech Stack

### Backend

| Technology | Version | Purpose |
|---|---|---|
| PHP | 8.2+ | Server-side language |
| Laravel Framework | 12.x | MVC framework, routing, ORM |
| Laravel Sanctum | 4.3 | API token authentication |
| Laravel Tinker | 2.10 | REPL for debugging |

### Frontend

| Technology | Version | Purpose |
|---|---|---|
| Bootstrap | 5.3.3 | Responsive UI components |
| Bootstrap Icons | Latest CDN | Icon library |
| Vite | 7.x | Asset bundler |
| Tailwind CSS | 4.0 | Utility CSS (auxiliary pages) |
| Vanilla JavaScript | ES2020+ | Chatbot logic, DOM manipulation |
| Google Fonts (Inter) | — | Typography |

### Database & Infrastructure

| Technology | Purpose |
|---|---|
| MySQL 8.0 | Relational database |
| XAMPP | Local development server (Apache + MySQL) |
| Composer | PHP dependency management |
| npm | JavaScript dependency management |

---

## EcoBot — Bilingual Chatbot

EcoBot is a rule-based conversational assistant integrated as a floating widget across all authenticated pages of the platform.

### Technical Implementation

**Architecture:** Client-server, fully self-contained within the Laravel application. No external AI API is required.

**Frontend** (`resources/views/components/chatbot.blade.php`):
- Floating toggle button with CSS animations
- Persistent philosophical banner
- Message rendering with lightweight Markdown (bold/italic)
- Animated typing indicator
- Language toggle button (ES ↔ EN)
- `fetch()` API for asynchronous communication

**Backend** (`app/Http/Controllers/Web/ChatbotController.php`):
- Structured PHP response arrays for ES and EN
- Keyword-matching engine using `str_contains()`
- Request validation (max 500 characters)
- Throttle protection (30 requests/minute)
- JSON responses with language metadata

### Communication Flow

```
User types message
       │
       ▼
JavaScript fetch() — POST /chatbot/respond
  headers: { X-CSRF-TOKEN, Content-Type: application/json }
  body:    { message: string, lang: "es" | "en" }
       │
       ▼
ChatbotController@respond
  1. Validate request
  2. Lowercase message
  3. Check language-switch commands
  4. Iterate keyword groups for active language
  5. Return first matched response as JSON
       │
       ▼
{ text: string, lang: "es" | "en" }
       │
       ▼
Frontend renders Markdown → HTML in chat bubble
```

### Supported Topics (ES / EN)

`greeting` · `about` · `courses` · `tasks` · `progress` · `declaration` · `ethics` · `autonomy` · `wellbeing` · `human_dev` · `social_resp` · `help` · `farewell`

### Language Switching

| Command | Action |
|---|---|
| `english` / `en` | Switches interface and responses to English |
| `español` / `es` / `spanish` | Switches interface and responses to Spanish |
| Language button (header) | Toggles language without typing |

---

## Prerequisites

Ensure the following are installed before setting up the project:

- **PHP** >= 8.2 with extensions: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`
- **Composer** >= 2.x
- **Node.js** >= 18.x and **npm** >= 9.x
- **MySQL** >= 8.0 (via XAMPP, WAMP, or standalone)
- **Apache** or **PHP built-in server**

---

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/<your-username>/EcoLearn_UDEC.git
cd EcoLearn_UDEC
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

Then edit `.env` with your database credentials (see [Environment Variables](#environment-variables)).

### 5. Run database migrations and seeders

```bash
php artisan migrate --seed
```

### 6. Build frontend assets

```bash
# Development (with hot reload)
npm run dev

# Production build
npm run build
```

### 7. Start the development server

```bash
php artisan serve --port=8080
```

Navigate to `http://localhost:8080`.

---

## Environment Variables

The following variables must be configured in your `.env` file:

```env
# Application
APP_NAME="EcoLearn UDEC"
APP_ENV=local
APP_KEY=                          # Generated by php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8080

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Appv1
DB_USERNAME=root
DB_PASSWORD=                      # Leave empty for XAMPP default

# Cache & Queue (database driver for local dev)
CACHE_STORE=database
QUEUE_CONNECTION=database

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
```

> **Note:** Never commit your `.env` file to version control. The `.gitignore` already excludes it.

---

## Database Setup

### Schema Overview

| Table | Description |
|---|---|
| `users` | Authenticated users with `name`, `email`, `password`, `role` |
| `courses` | Environmental education courses with JSON `content` |
| `tasks` | User tasks with `title`, `description`, `is_done` flag |
| `evaluation_attempts` | Quiz attempts with JSON `answers`, `score`, `total` |
| `personal_access_tokens` | Sanctum API tokens |
| `cache` | Database-driven cache |
| `jobs` | Queue job table |

### Entity Relationships

```
users ──< tasks                 (one-to-many)
users ──< evaluation_attempts   (one-to-many)
courses ──< evaluation_attempts (one-to-many)
```

### Running Migrations

```bash
# Fresh migration with seed data
php artisan migrate:fresh --seed

# Run pending migrations only
php artisan migrate
```

---

## Running the Application

### Option A — PHP Built-in Server (Recommended for local dev)

```bash
php artisan serve --port=8080
```

### Option B — XAMPP

1. Copy the project folder to `C:\xampp\htdocs\EcoLearn_UDEC`
2. Start Apache and MySQL from the XAMPP Control Panel
3. Navigate to `http://localhost/EcoLearn_UDEC/public`

### Option C — Composer Dev Script (Concurrent processes)

```bash
composer dev
```

Starts PHP server + queue listener + Vite watcher concurrently.

---

## Project Structure

```
EcoLearn_UDEC/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Admin panel controllers
│   │   │   ├── API/                # REST API controllers
│   │   │   └── Web/                # Web controllers (incl. ChatbotController)
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/
│   └── Models/
│       ├── User.php
│       ├── Course.php
│       ├── Task.php
│       └── EvaluationAttempt.php
│
├── database/
│   ├── migrations/                 # Schema definitions
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── CourseSeeder.php        # Sample course data
│
├── resources/
│   ├── css/app.css                 # Tailwind entry point
│   ├── js/
│   │   ├── app.js
│   │   └── bootstrap.js            # Axios + CSRF config
│   └── views/
│       ├── components/
│       │   └── chatbot.blade.php   # EcoBot widget (HTML + CSS + JS)
│       ├── layouts/
│       │   ├── ecolearn.blade.php  # Main layout (sidebar + topbar)
│       │   ├── admin.blade.php     # Admin layout
│       │   └── app.blade.php       # Task manager layout
│       ├── courses/
│       ├── tasks/
│       ├── dashboard/
│       ├── profile/
│       ├── progress/
│       └── admin/
│
├── routes/
│   ├── web.php                     # Web + chatbot routes
│   └── api.php                     # Sanctum API routes
│
├── public/
│   ├── index.php                   # Application entry point
│   ├── .htaccess
│   └── build/                      # Compiled Vite assets
│
├── .env.example
├── composer.json
├── package.json
└── vite.config.js
```

---

## API Reference

Base URL: `http://localhost:8080/api`

### Authentication Endpoints

| Method | Endpoint | Auth | Description |
|---|---|---|---|
| `POST` | `/api/register` | None | Register a new user |
| `POST` | `/api/login` | None | Obtain Sanctum token |
| `POST` | `/api/logout` | Token | Revoke current token |

### Task Endpoints (Sanctum protected)

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/tasks` | List authenticated user's tasks |
| `POST` | `/api/tasks` | Create a new task |
| `GET` | `/api/tasks/{id}` | Get a specific task |
| `PUT` | `/api/tasks/{id}` | Update a task |
| `DELETE` | `/api/tasks/{id}` | Delete a task |

**Authentication header:**
```
Authorization: Bearer <sanctum_token>
```

### Chatbot Endpoint

| Method | Endpoint | Auth | Throttle |
|---|---|---|---|
| `POST` | `/chatbot/respond` | Session (CSRF) | 30 req/min |

**Request body:**
```json
{
  "message": "hola",
  "lang": "es"
}
```

**Response:**
```json
{
  "text": "¡Hola! Soy EcoBot...",
  "lang": "es"
}
```

---

## Default Credentials

After running `php artisan migrate --seed`, the following accounts are available:

| Role | Email | Password |
|---|---|---|
| Admin | `admin@ecolearn.cl` | `admin123` |
| Student | `student@ecolearn.cl` | `password` |

> **Change these credentials immediately in any non-local environment.**

---

## Philosophical Framework

EcoLearn UDEC is guided by the **Transhuman Person Declaration** of the Universidad de Cundinamarca:

> *"Soy LIBRE, AUTÓNOMO Y RESPONSABLE a través del diálogo y la construcción, como ideal regulativo; me dirijo, controlo y dicto mis propias leyes."*

> *"I am FREE, AUTONOMOUS AND RESPONSIBLE through dialogue and construction, as a regulative ideal; I lead, control and dictate my own laws."*

This declaration is integrated into EcoBot as:
- The **automatic welcome message** on first chat open (ES and EN)
- A **permanent banner** displayed inside the chat widget at all times
- **Contextual responses** when users ask about the declaration, autonomy, ethics, or philosophy

The platform's content, structure, and learning model reflect the principles of **human development**, **ethical responsibility**, **personal autonomy**, and **positive social transformation**.

---

## License

This project is developed for academic purposes at the **Universidad de Cundinamarca — UDEC**.
Distributed under the [MIT License](https://opensource.org/licenses/MIT).

---

<div align="center">

Developed by **[Tu Nombre]** · UDEC Systems Engineering · 2025

</div>
