# Laravel API Demo

Job search API built using Laravel, just for demo purpose.

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- SQLite or another supported database

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd laravel-api-demo
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate
   ```

5. **Start the development server**
   ```bash
   php artisan serve
   ```

The API will be available at `http://localhost:8000/api`

## Features

### Authentication & Authorization

Simple Token-based API Login & Registration

### User profile Management

Profile management for authenticated user

### Job info Management

Create & manage job info for authenticated user

### Publishing Management

Publish a job for public views

### Job Search

Published job post listing & searches for public users

### Archiving Scheduler

Scheduler for archiving Job post automatically

### Documentation

Auto generation of API documentation


## API Documentation

Open `http://localhost:8000/docs/api` to view the API documentation.

## Best Practices

### API Resource

Provide a transformation layer between Eloquent models and JSON responses. 

### Model Policy

Centralize authorization logic and keep controllers clean.

### Form validation

Validation rules for user inputs.

### HTTP Test

End to end tests for each API routes.

### Unit Test

Encapsulated tests for each units: Policies, API Resource, Form validation.