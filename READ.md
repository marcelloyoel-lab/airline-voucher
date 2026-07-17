# Airline Voucher Seat Assignment

A full-stack web application built with **React** and **Laravel** for managing airline promotional voucher seat assignments.

The application allows airline crew members to generate **three unique random seats** for a flight while ensuring voucher assignments cannot be generated more than once for the same flight number and date.

---

## Tech Stack

### Frontend

- React 19
- Vite 8
- Axios
- Bootstrap 5

### Backend

- PHP 8.2+
- Laravel 12
- Laravel Sanctum
- SQLite
- PHPUnit

---

## Features

- Generate exactly three unique random seats
- Prevent duplicate voucher generation for the same flight and date
- Aircraft-specific seat generation
  - ATR
  - Airbus 320
  - Boeing 737 Max
- Backend input validation using Laravel Form Requests
- Service layer for seat generation and business logic
- RESTful API architecture
- SQLite database
- Responsive user interface
- Error handling with meaningful validation messages

---

## Project Structure

```
project/
├── frontend/          # React application
└── backend/           # Laravel REST API
```

---

## Requirements

Before running the project, make sure the following are installed:

- PHP 8.2 or newer
- Composer
- Node.js
- npm
- SQLite

---

# Backend Setup

Navigate to the backend folder.

```bash
cd backend
```

Install PHP dependencies.

```bash
composer install
```

Create the environment file.

```bash
cp .env.example .env
```

Generate the application key.

```bash
php artisan key:generate
```

Create the SQLite database.

```bash
touch database/database.sqlite
```

Configure the database connection in `.env`.

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Run database migrations.

```bash
php artisan migrate
```

Start the Laravel server.

```bash
php artisan serve
```

The backend will be available at:

```
http://127.0.0.1:8000
```

---

# Frontend Setup

Navigate to the frontend folder.

```bash
cd frontend
```

Install JavaScript dependencies.

```bash
npm install
```

Start the development server.

```bash
npm run dev
```

The frontend will be available at:

```
http://localhost:5173
```

---

## API Endpoints

### Check Existing Voucher

```
POST /api/check
```

Checks whether voucher assignments already exist for the given flight number and flight date.

---

### Generate Voucher

```
POST /api/generate
```

Generates three unique seats, stores the voucher assignment, and returns the generated seat numbers.

---

## Running Tests

Run Laravel feature tests with:

```bash
php artisan test
```

---

## Design Decisions

- Business logic is separated into Service classes.
- Request validation is handled using Laravel Form Requests.
- API responses are standardized using Laravel API Resources.
- Database access uses Eloquent ORM.
- SQLite is used to simplify project setup.
- Frontend communicates with the backend through REST APIs using Axios.
