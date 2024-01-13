# Laravel Application Setup Guide

This guide provides step-by-step instructions for setting up a Laravel application. Laravel is a popular PHP framework that offers a clean and elegant syntax, making it easy to build web applications quickly.

## Prerequisites

Before you begin, make sure you have the following installed on your system:

- PHP (7.4 or higher)
- Composer
- MySQL 
- Web server (e.g., Apache)

## Step 1: Clone the Repository
1. Open your `terminal` or command prompt.
2. Navigate to the directory where you want to store your Laravel application.
3. Run the following command to clone the repository:

```bash
git clone https://github.com/prianti29/gitFormed.git
```

## Step 2: Install Dependencies

1. Navigate into the project's root directory:

```bash
cd gitFormed
```

2. Run the following command to install the project dependencies using Composer:

```bash
composer install
```

3. Run the following command to install the JavaScript dependencies:

```bash
npm install
```

## Step 3: Environment Configuration

1. Create a copy of the `.env.example` file and name it `.env`:

```bash
cp .env.example .env
```

2. Generate a new application key by running the following command:

```bash
php artisan key:generate
```

3. Open the `.env` file and configure the database connection details, such as `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`, according to your local environment.

## Step 4: Database Setup

1. Create a new `database` in your MySQL or preferred database system.

2. Update the `.env` file with the newly created database credentials.

3. Run the following command to migrate the database tables:

```bash
php artisan migrate
```

4. If your application uses seeders, run the following command to `seed` the database:

```bash
php artisan db:seed
```

## Step 5: Serve the Application
1.  Use the following command to start the Laravel development `server`:

```bash
php artisan serve
```
if you using laragon or laravel valet? then you don't have to start development `server`. just goto the respected url which is provided by laragon or laravel valet.

2. Run the following command to build your assets:

```bash
npm run dev
```

3. Open your web browser and visit http://localhost:8000 to see your Laravel application running.

Conclusion
You have successfully set up your Laravel application! Happy coding!