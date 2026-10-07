# IT0049 TFA3 — POS Account Management

CodeIgniter 4 application for creating and editing customer and user accounts. It includes server-side form validation and secure profile-picture upload with thumbnail preparation.

## Features

- Customer listing, create form, validation, edit, and update
- User listing, create form, unique-username validation, edit, and update
- Validation errors displayed while preserving submitted values
- JPG/PNG avatar validation with a 2 MB size limit
- Uploaded avatars cropped to display-ready 300 × 300 thumbnails
- Only the generated avatar filename is stored in the database
- Placeholder image when no avatar is available
- CSRF-protected forms and escaped output

## Requirements

- PHP 8.2 or later
- Composer
- MySQL/MariaDB
- PHP extensions required by CodeIgniter, including `intl`, `mbstring`, `mysqli`, and `gd`

## Setup

1. Run `composer install` in the project directory.
2. Copy `env` to `.env`.
3. Open `.env`, set `CI_ENVIRONMENT = development`, and configure the database:

   ```ini
   database.default.hostname = localhost
   database.default.database = pos_accounts
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

4. Create the database in either of two ways:
   - Import `database/pos_accounts.sql` in phpMyAdmin; or
   - Run `php spark migrate`, then `php spark db:seed PosSeeder`.
5. Ensure PHP can write to `public/uploads`.
6. Start the local server with `php spark serve`.
7. Open `http://localhost:8080`.

## Main routes

| Page | URL |
| --- | --- |
| Customers | `/customers` |
| New customer | `/customers/new` |
| Users | `/users` |
| New user | `/users/new` |

The Edit link beside a record opens its pre-filled edit form. Avatar upload is intentionally located on the user edit form, as required by TFA3.

## Submission notes

- The raw CodeIgniter project and database export are included.
- Do not commit real passwords or production credentials in `.env`.
- Point the hosted web server's document root to the `public` directory.
- Verify that `public/uploads` is writable on the hosting service.
