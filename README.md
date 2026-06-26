# Cronjob Demo - Laravel

A Laravel application demonstrating how to implement scheduled tasks (cronjobs) for sending automated birthday wishes to users via email.

## 📋 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [How Cronjobs Work](#how-cronjobs-work)
- [Project Structure](#project-structure)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)

## ✨ Features

- **Automated Birthday Wishes**: Send automatic email notifications on users' birthdays
- **Laravel Scheduler**: Uses Laravel's task scheduling for reliable cron execution
- **Email Notifications**: Leverages Laravel Mailable for professional email templates
- **User Management**: Full user model with birthdate tracking
- **Queue Support**: Built with queue-able mails for better performance
- **Database Migrations**: Organized database schema management

## 🔧 Requirements

- **PHP**: ^8.1
- **Composer**: Latest version
- **Laravel**: ^10.0
- **Database**: MySQL, PostgreSQL, or SQLite
- **Mail Driver**: SMTP, Mailgun, or local testing

### Dependencies

```json
{
  "laravel/framework": "^10.0",
  "laravel/sanctum": "^3.2",
  "laravel/tinker": "^2.8",
  "guzzlehttp/guzzle": "^7.2"
}
```

## 📦 Installation

### 1. Clone or Download the Project

```bash
cd c:\laragon\www
# Project is already in cronjob_demo directory
```

```bash
git clone https://github.com/ronak4549/crone_Job_demo.git
```

```bash
cd crone

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Create Environment Configuration

```bash
copy .env.example .env
```

Or manually create `.env` with your configuration:

```env
APP_NAME="Cronjob Demo"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cronjob_demo
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

## ⚙️ Configuration

### Mail Configuration

Update your `.env` file with your mail provider settings:

**For Local Development (Mailhog):**
```env
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

**For SMTP (Gmail, SendGrid, etc.):**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### Database Configuration

Configure your database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cronjob_demo
DB_USERNAME=root
DB_PASSWORD=your_password
```

## 🗄️ Database Setup

### 1. Create the Database

```bash
mysql -u root -p
CREATE DATABASE cronjob_demo;
EXIT;
```

Or import the provided SQL file:

```bash
mysql -u root -p cronjob_demo < cronjob_demo.sql
```

### 2. Run Migrations

```bash
php artisan migrate
```

This will create:
- `users` table with `birthdate` column
- `password_reset_tokens` table
- `failed_jobs` table
- `personal_access_tokens` table

### 3. Seed Sample Data (Optional)

```bash
php artisan db:seed
```

## 🚀 Usage

### 1. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

### 2. Run the Scheduler

In a separate terminal, run the Laravel scheduler:

```bash
php artisan schedule:work
```

This command will continuously run and execute scheduled tasks as they're due. In production, you would set up a system cron job to run this command.

### 3. Monitor Task Execution

You can see the scheduled tasks in:

**File**: `app/Console/Kernel.php`

Current scheduled task:
```php
$schedule->command('auto:birth-day-wish')->everyMinute();
```

### 4. View Mail in Development

If using Mailhog, access it at `http://localhost:8025` to see captured emails.

## 📅 How Cronjobs Work

### The Workflow

1. **Scheduler Starts**: `php artisan schedule:work` runs continuously
2. **Command Executes**: The `auto:birth-day-wish` command runs every minute
3. **Check Birthdays**: The command queries users with birthdays today
4. **Send Emails**: BirthDayWish Mailable sends personalized birthday emails
5. **Queue Processing**: Emails are queued and processed asynchronously (if queue is configured)

### Key Files

- **Scheduler Definition**: `app/Console/Kernel.php`
- **Custom Commands**: `app/Console/Commands/`
- **Mail Class**: `app/Mail/BirthDayWish.php`
- **User Model**: `app/Models/User.php`
- **Email Template**: `resources/views/emails/birthDayWish.blade.php`

### Scheduling Frequency Options

The scheduler supports various frequencies:

```php
$schedule->command('auto:birth-day-wish')
    ->everyMinute();              // Every minute
    // ->everyFiveMinutes();       // Every 5 minutes
    // ->everyTenMinutes();        // Every 10 minutes
    // ->everyThirtyMinutes();     // Every 30 minutes
    // ->hourly();                 // Every hour
    // ->daily();                  // Every day
    // ->dailyAt('13:00');         // At specific time
    // ->weekly();                 // Every week
    // ->monthly();                // Every month
```

## 📁 Project Structure

```
cronjob_demo/
├── app/
│   ├── Console/
│   │   ├── Kernel.php              # Scheduler configuration
│   │   └── Commands/               # Custom artisan commands
│   ├── Mail/
│   │   ├── BirthDayWish.php       # Birthday email mailable
│   │   └── TestEmail.php          # Test email mailable
│   ├── Models/
│   │   └── User.php               # User model with birthdate
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Providers/
├── database/
│   ├── migrations/
│   │   └── 2025_09_11_093053_add_birthdate_column.php
│   ├── factories/
│   │   └── UserFactory.php
│   └── seeders/
├── resources/
│   ├── views/
│   │   └── emails/
│   │       └── birthDayWish.blade.php
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   ├── api.php
│   └── console.php
├── tests/
│   ├── Feature/
│   └── Unit/
├── .env                          # Environment configuration
├── composer.json                 # PHP dependencies
├── package.json                  # Node.js dependencies
└── artisan                       # Artisan CLI
```

## 🧪 Testing

### Run All Tests

```bash
php artisan test
```

### Run Specific Test File

```bash
php artisan test tests/Feature/ExampleTest.php
```

### Generate Test Coverage Report

```bash
php artisan test --coverage
```

## 🔍 Troubleshooting

### Issue: Scheduler Not Running

**Solution:**
- Ensure `php artisan schedule:work` is running in a separate terminal
- In production, add to system cron: `* * * * * /usr/bin/php /path/to/artisan schedule:run >> /dev/null 2>&1`

### Issue: Emails Not Sending

**Debugging Steps:**
1. Check `.env` mail configuration
2. If using local development, verify Mailhog is running at `http://localhost:8025`
3. Check `storage/logs/laravel.log` for errors
4. Run: `php artisan config:cache` to refresh cache

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Issue: Database Connection Error

**Solution:**
```bash
# Verify database exists
mysql -u root -p -e "SHOW DATABASES LIKE 'cronjob_demo';"

# Re-run migrations
php artisan migrate:refresh
```

### Issue: Command Not Found

**Solution:**
```bash
# Clear command cache
php artisan cache:clear

# Reload commands
php artisan optimize:clear
```

## 📝 Adding More Scheduled Tasks

To add additional scheduled tasks:

1. **Create a new command:**
   ```bash
   php artisan make:command MyScheduledCommand
   ```

2. **Edit the command** in `app/Console/Commands/MyScheduledCommand.php`

3. **Register in Kernel.php:**
   ```php
   protected function schedule(Schedule $schedule): void
   {
       $schedule->command('my:command')->daily();
   }
   ```

## 🤝 Contributing

To contribute to this project, please follow these steps:

1. Create a feature branch (`git checkout -b feature/amazing-feature`)
2. Commit your changes (`git commit -m 'Add amazing feature'`)
3. Push to the branch (`git push origin feature/amazing-feature`)
4. Open a Pull Request

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 📞 Support

For issues or questions:
- Check the Laravel documentation: https://laravel.com/docs
- Review the code comments in source files
- Check `storage/logs/laravel.log` for error messages

## 🎯 Quick Start Summary

```bash
# 1. Install dependencies
composer install && npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Database setup
php artisan migrate
php artisan db:seed

# 4. Start development (Terminal 1)
php artisan serve

# 5. Run scheduler (Terminal 2)
php artisan schedule:work

# 6. Monitor emails (Terminal 3) - if using Mailhog
# Open http://localhost:8025
```

---

**Version**: 1.0.0  
**Created**: 2025  
**Laravel Version**: 10.0+  
**PHP Version**: 8.1+

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
