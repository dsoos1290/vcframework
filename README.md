# VC Framework

Lightweight PHP framework with a minimal application skeleton for building simple web applications and CLI scripts.

VC Framework uses a simple **V**iew-**C**ontroller architecture without a Model layer. Database access is handled directly through MySQLi.

It is designed to remain small, easy to understand and ready to use without Composer or external PHP framework dependencies. Composer packages can optionally be used when a `vendor/autoload.php` file is present. It is compatible with PHP 5.3 and newer.

## Features

- Minimal ready-to-use application skeleton
- Lightweight Controller-View architecture without a Model layer
- No Composer required
- Optional Composer package support
- No external PHP framework dependencies
- Simple routing
- Controllers and application base controller
- Views and reusable view elements
- Layout support
- Flash messages
- Optional application session support
- Optional absolute application URL support
- MySQLi database connection
- Application and database configuration
- Development and production environments
- CLI script support
- Optional CLI logging
- Unique run IDs for CLI executions
- Central PHP error logging
- Apache URL rewriting
- Subdirectory installation support
- Basic CSS and JavaScript application files
- PHP 5.3+ compatibility

## Usage

1. Download the latest version: https://github.com/dsoos1290/vcframework/releases/latest
2. Rename `private_html/app/config/db-sample.php` to `db.php`.
3. Open `db.php` and configure your database connection.
