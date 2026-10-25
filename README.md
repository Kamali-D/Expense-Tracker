# EXPENSE TRACKER
Professional, colourful PHP + MySQL expense tracking starter project.

## Setup (XAMPP)
1. Extract this folder to `C:\xampp\htdocs\expense_tracker`.
2. Start Apache and MySQL in XAMPP.
3. Open `http://localhost/phpmyadmin` and import `database.sql`.
4. Check `config.php` (default XAMPP: user `root`, blank password).
5. Open `http://localhost/expense_tracker/register.php` to create an account.
6. Log in at `http://localhost/expense_tracker/login.php`.

## Features
Login/Register/Logout, Forgot Password page, dashboard, add/edit/delete/search/filter transactions, monthly budgets and alerts, Chart.js reports, CSV export, light/dark theme, profile/currency settings, change password, About Application.

## Important
The forgot-password page is a UI/workflow placeholder: it does not send email until SMTP and a secure reset-token workflow are configured. This is a learning/demo starter; harden security before public deployment.


## Password hint setup (important)

New installs: import the updated `database.sql`. The registration form now saves a reminder hint, and `forgot-password.php` displays that hint after the user enters their email. It does **not** display the actual password: passwords are stored as secure hashes and cannot be recovered as readable text. This hint feature is a simple college-project demo, not a replacement for production-grade recovery by email and a single-use reset token.

If you already imported an older database, open phpMyAdmin → select `expense_tracker` → SQL, then run:

```sql
ALTER TABLE users ADD COLUMN password_hint VARCHAR(120) NOT NULL DEFAULT '';
```

Do not run that `ALTER TABLE` command more than once. Existing accounts will have an empty hint; create a new test account or update the hint for an existing account in phpMyAdmin.
