# ReelWave — Movie Ticket Booking System

A PHP + MySQL web app for browsing movies, managing theaters and showtimes, and handling user accounts across three roles (Admin, Employee, Customer).

**Context:** Built as a second-year school project to practice connecting a PHP backend to a frontend — form handling, sessions, MySQL queries, role-based access, and email verification (OTP via PHPMailer).

## Features

- **Customer** — browse Now Showing / Coming Soon, view movie details, sign up with email OTP verification
- **Employee** — manage movies, showtimes, and theaters
- **Admin** — everything Employee can do, plus user management and activity logs (`tbl_logs`)
- Role-based login/session handling
- Email verification via Gmail SMTP (PHPMailer)

## Tech Stack

- PHP (procedural, `mysqli`)
- MySQL
- Bootstrap 5
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) (via Composer)

## Setup

1. Clone the repo
2. Run `composer install` to pull in dependencies (vendor/ is gitignored)
3. Import the database schema (see `/database` — *add this if you export one*) into MySQL as `movie_booking`
4. Update `database_Connection.php` with your local DB credentials
5. Create `config.local.php` (not committed — see `.gitignore`) with your own SMTP credentials:
```php
   <?php
   define('SMTP_USER', 'your-email@gmail.com');
   define('SMTP_PASS', 'your-gmail-app-password');
```
6. Serve with XAMPP/local PHP server and open `index.php`

## Status / Known Limitations

This was a learning project, so a few things are still rough edges:
- Seat booking / checkout (`bookseatsForm.php`, `receipt.php`) is not yet implemented
- Actively working through security hardening (parameterized queries, password hashing) as a follow-up learning exercise
