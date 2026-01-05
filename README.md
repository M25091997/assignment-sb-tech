# Project Setup Guide

This project is hosted on GitHub as a **public repository**.  

**GitHub Repository Link:**  
[https://github.com/your-username/your-repository](https://github.com/your-username/your-repository)

---

## 📌 Prerequisites

Ensure the following are installed:

- PHP (recommended: 8.2+)
- Composer
- MySQL / MariaDB or SQLite
- Git
- Node.js & npm (if frontend assets are used)


## 📂 Clone the Repository

  git clone https://github.com/your-username/your-repository.git

Switch to the repo folder

    cd your-repository

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate


Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000

**TL;DR command list**

    git clone https://github.com/your-username/your-repository.git
    cd your-repository
    composer install
    cp .env.example .env
    php artisan key:generate

    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate or  php artisan migrate:fresh --seed
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes users, articles, comments, tags, favorites and follows. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the SuperAdminSeeder and set the property values as per your requirement

    database/seeds/SuperAdminSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
