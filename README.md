# Laravel API Demo

This repository contains a demonstration REST API built with Laravel. It simulates a job-search platform, but its true purpose is to showcase my approach to modern, maintainable, and production-ready backend development.

## Skills Demonstrated
Here is a breakdown of the specific technologies and practices applied in this project:

Category | Technologies / Practices |	Purpose
--- | --- | ---
Framework |	Laravel | Primary tools to build the web applications.
API Development | RESTful design, Token-based Authentication, API Resources | Secure and consistent APIs.
API documentation | dedoc/scramble | easy to use API document generator
Security & Authorization | Laravel Policies, Form Request Validation | Centralized actions and input validation.
Testing | PestPHP, Feature Tests, Unit Tests, Coverage test	| Ensure the application follows its requirement
Code Quality | Larastan (PHPStan), PestPHP, Laravel Pint Architectural Tests | Ensure clean, error-free, and maintainable code.
Development Tools | Laravel Telescope, Laravel Pulse | App health check & monitoring

## Project Structure & Key Highlights
The code is organized to reflect a typical Laravel application with a focus on separation of concerns:

- **app/Models & app/Policies**: Eloquent models with corresponding policies for authorization logic.

- **app/Http/Requests**: Dedicated form request classes for input validation, keeping controllers clean.

- **app/Http/Resources**: API Resources to transform models into consistent JSON structures.

- **app/Console/Commands**: A scheduled command for automatically archiving old job posts.

- **tests/**: Comprehensive test suite, split into Unit and Feature tests. Includes tests for policies, resources, and endpoints.

- **.github/workflows**: CI pipeline configuration ensuring tests and static analysis run on every push.

## Code Quality Metrics

- **Static Analysis**: The codebase include **PHPStan/Larastan**, ensuring type safety and eliminating common bugs.

- **Test Coverage**: Key features are covered by automated tests. the test suite can be performed with `php artisan test`.

- **Architectural Consistency**: Project structure are enforced with PestPHP arch testing.

## Quick Start
If you'd like to run the project locally to inspect the code or test the API:

### Prerequisites
PHP 8.2+, Composer, SQLite (or another database), Xdebug (To run tests with coverage).

### Installation

```bash
# 1. Clone the repository
git clone https://github.com/ryoadi/laravel-api-demo.git
cd laravel-api-demo

# 2. Install dependencies
composer install

# 3. Set up environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations
php artisan migrate

# 5. (Optional) Seed the database
php artisan db:seed

# 6. Start the server
php artisan serve
```

The API will be available at http://localhost:8000/api. You can explore the interactive API documentation at http://localhost:8000/docs/api.

## License
This project is open-sourced under the MIT license.