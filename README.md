# ⏰ Laravel Cron Job Demo

A simple Laravel project demonstrating how to create and schedule **Cron Jobs (Task Scheduling)** using Laravel's built-in Task Scheduler.

This project shows how to automate tasks such as updating database records, sending emails, generating reports, cleaning logs, and executing scheduled commands.

---

## 📌 Features

- Laravel Task Scheduling
- Custom Artisan Commands
- Automatic Job Execution
- Logging Cron Job Activity
- Database Record Updates
- Easy Cron Setup
- Clean and Beginner-Friendly Code

---

## 🛠️ Tech Stack

- Laravel
- PHP 8.x
- MySQL
- Composer
- Laravel Scheduler

---

## 📋 Requirements

Before installing, make sure you have the following installed:

- PHP >= 8.2
- Composer
- MySQL
- Node.js (Optional)
- Git

---

# 🚀 Installation

## 1. Clone the Repository

```bash
git clone https://github.com/ronak4549/crone_Job_demo.git
```

```bash
cd crone_Job_demo
```

---

## 2. Install PHP Dependencies

```bash
composer install
```

---

## 3. Create Environment File

Linux / Mac

```bash
cp .env.example .env
```

Windows

```bash
copy .env.example .env
```

---

## 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 5. Configure Database

Update your `.env` file.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cron_job_demo
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Run Migrations

```bash
php artisan migrate
```

---

## 7. Start Laravel Server

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

# ⚙️ Cron Job Setup

Laravel uses its own scheduler to execute scheduled tasks.

## Create a Custom Command

```bash
php artisan make:command UpdateAppointmentStatus
```

Example Command Signature

```php
protected $signature = 'app:update-appointment-status';
```

---

## Register the Command

Open

```
routes/console.php
```

or

```
app/Console/Kernel.php
```

Example

```php
Schedule::command('app:update-appointment-status')
    ->everyMinute();
```

or

```php
Schedule::command('app:update-appointment-status')
    ->dailyAt('00:00');
```

---

# Running the Scheduler

Run Laravel Scheduler

```bash
php artisan schedule:run
```

For continuous execution

```bash
php artisan schedule:work
```

---

# Linux Server Cron Configuration

Open Crontab

```bash
crontab -e
```

Add the following line

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

This executes Laravel Scheduler every minute.

---

# Example Use Cases

This demo can be used for:

- Updating appointment status
- Sending scheduled emails
- Daily reports
- Monthly reports
- Cleaning temporary files
- Database backup
- Expired subscription check
- Auto notifications
- Queue processing

---

# Project Structure

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

---

# Useful Artisan Commands

Generate Command

```bash
php artisan make:command CommandName
```

Run Command

```bash
php artisan app:update-appointment-status
```

Run Scheduler Once

```bash
php artisan schedule:run
```

Run Scheduler Continuously

```bash
php artisan schedule:work
```

Clear Cache

```bash
php artisan optimize:clear
```

List All Commands

```bash
php artisan list
```

---

# Example Log Output

```
Cron Job Started...
Appointment statuses updated successfully.
Cron Job Completed.
```

---

# Future Improvements

- Email Notifications
- Queue Jobs
- Report Generation
- Backup Automation
- SMS Notifications
- Queue Monitoring
- Dashboard for Scheduled Jobs

---

# Contributing

Contributions are welcome!

1. Fork the repository
2. Create a new branch

```bash
git checkout -b feature-name
```

3. Commit changes

```bash
git commit -m "Added new feature"
```

4. Push to GitHub

```bash
git push origin feature-name
```

5. Create a Pull Request

---

# Author

**Ronak Prajapati**

GitHub: https://github.com/ronak4549

---

# License

This project is licensed under the MIT License.
