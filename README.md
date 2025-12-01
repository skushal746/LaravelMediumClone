# Laravel Medium Clone

Minimalistic version of medium built with Laravel

## Features

- User authentication (Registration & Login)
- Email verification
- Post creation, editing, and deletion
- Categories for posts
- User profiles
- Follow/Unfollow users
- Like/Unlike posts
- Filter posts by category
- Show posts from following users
- Image upload and resizing
- Pagination

## Installation

1. Clone the repository
2. Install dependencies:
   ```bash
   composer install
   npm install
   ```
3. Copy `.env.example` to `.env` and configure your database
4. Generate application key:
   ```bash
   php artisan key:generate
   ```
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Seed the database:
   ```bash
   php artisan db:seed
   ```
7. Build assets:
   ```bash
   npm run build
   ```
8. Start the development server:
   ```bash
   php artisan serve
   ```

## Tutorial

This project is based on a comprehensive YouTube tutorial by [TheCodeholic](https://www.youtube.com/@TheCodeholic).

