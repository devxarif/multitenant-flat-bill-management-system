## Multi-Tenant Flat & Bill Management System
Laravel-based multi-tenant system to manage buildings, flats, tenants, bills and payments.
Roles: `admin` (super admin) and `owner` (house owner). Column-based tenancy using `owner_id`.

## Tech stack
- Laravel 12 (or latest)
- Tailwind CSS (via Breeze/Jetstream)
- MySQL (or PostgreSQL)
- MailHog (recommended for local mail testing)

### Key Features
<li>Admin: create/manage owners, create tenants, view/assign tenants to buildings.</li>
<li>Owner: create/manage flats, categories, create bills, record payments.</li>
<li>Email notifications: on bill creation and bill payment.</li>

## Setup
```bash
# Clone the repo
git clone https://github.com/devxarif/multitenant-flat-bill-management-system.git

#Go to repo directory
cd <repo>

# Copy environment file
cp .env.example .env

# Install composer dependency
composer install

# Set the Application key
php artisan key:generate

# setup the database credentials and migrate database with seeders
php artisan migrate --seed

# Install node modules 
npm install / yarn
```

## Development Server

Start the development server on http://localhost:8000

```bash
php artisan serve
```
```bash
npm run watch / yarn watch
```
