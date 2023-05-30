---
sidebar_position: 1
---

# Installation

## Module

1. [Install skijasi](https://skijasi-docs.nadzorserveraweb.hr/getting-started/installation) first.
2. Make sure you already run the migration and skijasi seeder, even if you're using docker.
3. Run the following command to install skijasi LMS module
   ```bash
   # as of now, because all of our works are still in the staging branch, you have to add the `:dev-staging`
   composer require skijasi/lms-module:dev-staging
   ```
4. Run the following commands to finish the skijasi LMS module setup
   ```bash
   php artisan migrate
   php artisan skijasi-lms-module:setup
   composer dump-autoload
   ```
5. Make sure that all of the routes declared by skijasi LMS module are already accessible. You can see the defined routes by running the following command
   ```bash
   php artisan route:list
   ```
    If you see something similar to this line `POST skijasi-api/module/lms/v1/auth/login`, that means you have successfully set up your skijasi application.

<!-- For skijasi v2.x (Laravel 8)
```
php artisan db:seed --class="Database\Seeders\Skijasi\LMS\SkijasiLMSModuleSeeder"
```

For skijasi v1.x (Laravel 5, 6, 7)
```
php artisan db:seed --class=SkijasiLMSModuleSeeder
``` -->

That's all, and you should be good to go!

## Theme

Skijasi LMS also comes with a free-to-use open-source theme, called skijasi-ilma-theme. You are free to use this theme, or you can also build your own theme to your liking. To use skijasi-ilma-theme, do follow the following steps.

1. Make sure you alerady have [skijasi](https://github.com/nadzorservera-croatia/skijasi) and [skijasi-lms-module](https://github.com/nadzorservera-croatia/skijasi-lms-module) installed.
2. Install skijasi-ilma-theme using the following command.
   ```bash
   composer require skijasi/ilma-theme
   ```
3. Update the dependency by running
   ```bash
   npm install
   ```
3. Run the following command to setup the `skijasi-content`.
   ```bash
   php artisan skijasi-content:setup
   ```
4. Run the following command to migrate `skijasi-content` table.
   ```bash
   php artisan migrate
   ```

5. Run the following command.
   ```bash
   php artisan skijasi-lms-theme:setup
   ```
