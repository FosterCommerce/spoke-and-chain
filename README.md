<h1 align="center">Spoke & Chain Craft Commerce Demo</h1>

![Spoke & Chain homepage](https://raw.githubusercontent.com/craftcms/spoke-and-chain/main/web/assets/guide/homepage.png)

## Overview

Spoke & Chain is a fictitious bicycle shop custom-built to demonstrate [Craft CMS](https://craftcms.com) and [Craft Commerce](https://craftcms.com/commerce). This repository houses the source code for our demo, which you can spin up for yourself by visiting [craftcms.com/demo](https://craftcms.com/demo?kind=spokeandchain).

We’ve also included instructions below for setting up the demo in a local development environment with [Craft Nitro](https://getnitro.sh).

Spoke & Chain shows core Craft CMS features and a fully-configured Craft Commerce store:

- Articles and pages with custom layouts and flexible content.
- Front-end global search for products and articles.
- Categorized products with variants, categories, filtering, and sorting.
- Customer membership area with subscription-based services, order tracking and returns, and account management.
- Full, customized checkout process with coupon codes.
- Configured for healthy SEO and built targeting WCAG AA compliance.

### Development Technologies

- [Craft CMS 3](https://craftcms.com/docs/3.x/)
- [Craft Commerce 3](https://craftcms.com/docs/commerce/3.x/)
- PostgreSQL (11.5+) / MySQL (5.7+)
- PHP (7.2.5+), built on the [Yii 2 framework](https://www.yiiframework.com/)
- Native Twig templates with reactive [Sprig](https://plugins.craftcms.com/sprig) components

### Front End Dependencies

- [webpack](https://webpack.js.org)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Cypress](https://www.cypress.io)

## Local Development

### Environment

If you’d like to get Spoke & Chain running in a local environment, we recommend using [Craft Nitro](https://getnitro.sh):

1. Follow Nitro’s [installation instructions](https://craftcms.com/docs/nitro/2.x/installation.html) for your OS.
2. Make sure you’ve used `nitro db new` to create a MySQL 8 or MariaDB 10 database engine.
3. Run `nitro create` with the URL to this repository:
    ```zsh
    nitro create craftcms/spoke-and-chain spokeandchain
    ```
    - hostname: `spokeandchain.nitro`
    - web root: `web`
    - PHP version: `8.0`
    - database? `Y`
    - database engine: `mysql-8.0-*.database.nitro` (or `mariadb-latest-*.database.nitro`)
    - database name: `spokeandchain`
    - update env file? `Y`
4. Restore the initial database
   ```zsh
   nitro craft db/restore seed.sql
   ```
5. Optionally seed demo data:
   ```zsh
   nitro craft demos/seed
   ```
   > ⚠️ The Craft site is offline by default, and the seeder turns it on when it’s finished. If you skip this step, you’ll need to manually bring the site online by navigating to **Settings** → **General Settings** and switching **System Status** to “Online”.
6. Move to the project directory and add a Craft account for yourself by following the prompts:
    ```zsh
    cd spokeandchain
    nitro craft users/create --admin
    ```

> 💡 If you’re using a different local environment, see Craft’s [Server Requirements](https://craftcms.com/docs/3.x/requirements.html) and [Installation Instructions](https://craftcms.com/docs/3.x/installation.html).

### Front End

Run `npm install` with node 12. (If you’ve installed [nvm](https://github.com/nvm-sh/nvm) run `nvm use`, then `npm install`.)

If you’ve chosen a different environment setup, make sure your `.env` is configured for it. These environment variables are specifically used by `webpack-dev-server`:

- `DEVSERVER_PUBLIC`
- `DEVSERVER_PORT`
- `DEVSERVER_HOST`
- `TWIGPACK_MANIFEST_PATH`
- `TWIGPACK_PUBLIC_PATH`

You can then run any of the development scripts found in `package.json`:

- `npm run serve` to build and automatically run webpack with hot module reloading for local development
- `npm run build` to build front end assets for production

> 💡 When using `npm run serve`, switch your site’s URL from `https://` to `http://`.

#### PurgeCSS

This project uses PurgeCSS to automatically remove redundant or unused styles generated by Tailwind CSS.

PurgeCSS is disabled by default for the `serve` script, meaning your site will be loaded with every available CSS class. It also means you’ll need to check the site after running `build` to be sure important classes aren’t inadvertently stripped away.

Classes actively being used should be detected automatically, but you can encourage them to be recognized by making sure full class names appear in your template, stylesheet, and JavaScript files.

❌ For example, don’t dynamically combine `text-red-` with a variable for this loop:

```twig
{% set classes = ['100', '500', '900'] %}
{% for class in classes %}
  <div class="text-red-{{ class }}"></div>	
{% endfor %}
```

✅ Loop through complete class names like so they each appear in full:
```twig
{% set classes = ['text-red-100', 'text-red-500', 'text-red-900'] %}
{% for class in classes %}
  <div class="{{ class }}"></div>	
{% endfor %}
```

If you can’t avoid programmatic concatenation, use Tailwind’s [safelist](https://tailwindcss.com/docs/optimizing-for-production#safelisting-specific-classes) option in `tailwind.config.js`.

### Testing

Cypress tests cover multiple parts of the website:

- **control panel** – make sure the content structure is properly defined.
- **front end** – check that the website’s different sections work as expected.
- **accessibility** – evaluate the website for WCAG 2.0 compliance.

Set the environment variables Cypress needs to run by copying `cypress.example.json` to `cypress.json` and adjusting it:

```
cp cypress.example.json cypress.json
```

Open the Cypress Test Runner from the project root:

```
npx cypress open
```

Open accessibility tests only:

```
npx cypress open --config testFiles=./front/a11y/*.spec.js
```

## License

The source code of this project is licensed under the [BSD Zero Clause License](LICENSE.md) unless stated otherwise.

The imagery used by this project is the property of Marin Bikes, and used with permission. You are not free to use it for your own projects.
