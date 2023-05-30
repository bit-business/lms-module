---
sidebar_position: 2
---

# Override View

To override the view, you can follow the following steps:

- You must run the theme setup first by running the `php artisan skijasi-ilma-theme:setup` command.

- A folder named `ilma-theme` will be created in the `resources/js/skijasi/theme` folder.

- Inside the `ilma-theme` folder, there will be a folder named `pages`. Create a .vue file inside the `pages` folder with the same name as the page. For example, if you want to override the `home` page, you can create a `home.vue` file in the `pages` folder.
  
- You can see the available page that can be overridden in the `vendor/skijasi/ilma-theme/src/resources/app/pages/` file.
