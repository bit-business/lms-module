# Contribute to Skijasi

Skijasi is an open-source project administered by [nadzorservera](https://soft.uatech.co.id). We appreciate your interest and efforts to contribute to Skijasi.

All efforts to contribute are highly appreciated, we recommend you to talk to a maintainer prior to spending a lot of time making a pull request that may not align with the project roadmap.


## Open Development & Community Driven

Skijasi is an open-source project. See the [license](https://github.com/nadzorservera-croatia/skijasi/blob/master/license) file for licensing information. All the work done is available on GitHub.

The core team and the contributors send pull requests which go through the same validation process.


## Feature Requests

Feature Requests by the community are highly encouraged. Please feel free to submit your ides on [github discussion](https://github.com/nadzorservera-croatia/skijasi/discussions/categories/ideas)


## Code of Conduct

This project and everyone participating in it are governed by the [Skijasi Code of Conduct](https://github.com/nadzorservera-croatia/skijasi/blob/main/code_of_conduct.md). By participating, you are expected to uphold this code. Please read the [full text](https://github.com/nadzorservera-croatia/skijasi/blob/main/code_of_conduct.md) so that you can read which actions may or may not be tolerated.


## Bugs

We are using [GitHub Issues](https://github.com/nadzorservera-croatia/skijasi-lms-module/issues) to manage our public bugs. We keep a close eye on this so before filing a new issue, try to make sure the problem does not already exist.

---

## Before Submitting a Pull Request

The core team will review your pull request and will either merge it, request changes to it, or close it.

<!-- **Before submitting your pull request** make sure the following requirements are fulfilled:

To do : complete this section -->


## Contribution Prerequisites

- You are familiar with Git.


## Development Workflow

Before developing Skijasi, please get SKIJASI_LICENSE_KEY by register on <a href="https://skijasi.uatech.co.id/" target="_blank">Skijasi</a> or contact skijasi core team. This key must be included in the laravel project's .env.
Steps for registering and getting a license on Skijasi Dashboard can be found on <a href="https://skijasi-docs.uatech.co.id/docs/en/getting-started/installation/" target="_blank">Skijasi Docs</a>.


### Installation step

After getting the license, you can proceed to Skijasi installation.

1. Clone skijasi into Laravel project. Sample:
   ```bash
   Root Laravel Project
   ├─packages  # new folder
   │ ├─skijasi  # new folder
   │ │ ├─lms-module  # clone here
   │ │ ├─ilma-theme  # clone here
   . . .
   ```

2. cd into each directory, then clone the corresponding repository
  ```bash
  # in lms-module folder
  git clone https://github.com/nadzorservera-croatia/skijasi-lms-module.git

  # in ilma-theme folder
  git clone https://github.com/nadzorservera-croatia/skijasi-ilma-module.git

  ```

3. Add the following Skijasi provider and JWT provider to ```/config/app.php```.
   ```php
   "providers" => [
     ...,
     "NadzorServera\\Skijasi\\Theme\\LMSTheme\\Providers\\LMSThemeProvider",
     "NadzorServera\\Skijasi\\Module\\LMSModule\\Providers\\LMSModuleProvider",
   ]
   ```

3. Add the following to `composer.json`.
   ```json
   "autoload": {
      "psr-4": {
         ...,
         "NadzorServera\\Skijasi\\Theme\\LMSTheme\\": "package/skijasi/ilma-theme/src/",
         "NadzorServera\\Skijasi\\Module\\LMSModule\\": "package/skijasi/lms-module/src/",
         "NadzorServera\\Skijasi\\Module\\LMSModule\\Factories\\": "package/skijasi/lms-module/src/Factories/",
         ...
      }
   },
   ```

5. Copy required library from `packages/skijasi/lms-module/composer.json` and `packages/skijasi/ilma-module/composer.json` to `/composer.json` then run `composer install`

6. Run the following commands to update dependencies in package.json and webpack.
   ```bash
   php artisan skijasi-lms-module:setup
   php artisan skijasi-lms-theme:setup
   ```

7. Run the following commands in sequence.
   ```bash
   composer dump-autoload
   php artisan migrate
   ```

8. Create an admin account by typing the following command.
```
php artisan skijasi:admin your@email.com --create
```

9. Run the command `npm install` to install all of dependencies

10. Run the backend application (the module) with `php artisan serve` or run in inside a docker container

11. Run the frontend application (the theme) with `npx mix watch --hot`


### Reporting an issue

Before submitting an issue you need to make sure:

- You are experiencing a concrete technical issue with Skijasi.
- You have already searched for related [issues](https://github.com/nadzorservera-croatia/skijasi-lms-module/issues), and found none open (if you found a related _closed_ issue, please link to it from your post).
- You are not asking a question about how to use Skijasi or about whether or not Skijasi has a certain feature. For general help using Skijasi, you may:
  - Refer to [the official Skijasi documentation](https://skijasi-docs.uatech.co.id).
  - Ask a question on [github discussion](https://github.com/nadzorservera-croatia/skijasi-lms-module/discussions).
- Your issue title is concise, on-topic, and polite.
- You provide steps to reproduce your issue.
- You have tried all the following (if relevant) and your issue remains:
  - Make sure you have the right application started.
  - Make sure the [issue template](https://github.com/nadzorservera-croatia/skijasi/tree/main/.github/ISSUE_TEMPLATE) is respected.
  - Make sure your issue body is readable and [well formatted](https://guides.github.com/features/mastering-markdown).
  - Make sure the application you are using to reproduce the issue has a clean `node_modules` or `vendor` directory, meaning:
    - that you haven't made any inline changes to files in the `node_modules` or `vendor` folder
    - that you don't have any weird global dependency loops.
