# Lara Blog

Lara Blog is a blogging platform built using **Laravel**, **Blade**, **TailwindCSS**, and **MySQL**. It provides a simple and efficient way to manage and publish blog posts with a clean and responsive design.

## Features

-   User Authentication (Sign Up, Sign In, Forgot Password)
-   Create, Read, Update, and Delete (CRUD) Blog Posts
-   Pin favorite top 3 blogs at the top of the user's profile
-   Category Management
-   Search for blogs or other users
-   Responsive Design
-   Users can follow each other
-   Users can start blogs
-   Users can save blogs

## Requirements

-   PHP 8.1 or higher
-   Composer
-   Node.js and NPM
-   MySQL 8.0 or higher
-   A web server (e.g., Apache or Nginx)

## run the project by running these commands

```bash
cp .env.example .env # Then configure the configurations in the .env
php artisan key:generate
php artisan migrate --seed
php artisan route:cache

npm install
npm run build

php artisan queue:work # To run the queue jobs
```

## Important

> **Mail Configuration is Required.**  
> To enable features like account verification, password reset, and notifications, you must configure your mail settings in the `.env` file.  
> For development and testing, it is highly recommended to use **[Mailtrap](https://mailtrap.io/)** to safely capture outgoing emails without sending them to real users.

### Example Mailtrap Configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=no-reply@larablog.test
MAIL_FROM_NAME="Lara Blog"
```
