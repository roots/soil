# Soil
[![Build Status](https://travis-ci.org/roots/soil.svg)](https://travis-ci.org/roots/soil)

A collection of modules to apply theme-agnostic front-end modifications to WordPress.

## Installation

If you're using Composer to manage WordPress, add Soil to your project's dependencies. Run:

```sh
composer require roots/soil 3.1.0
```

Or manually add it to your `composer.json`:

```json
"require": {
  "php": ">=5.3.0",
  "wordpress": "4.1.1",
  "roots/soil": "3.1.0"
}
```

Once this is complete, activate Soil in your WordPress admin or via [wp-cli](http://wp-cli.org/commands/plugin/activate/):

```bash
wp plugin activate soil
```

## Modules

* **Load jQuery from the Google CDN**<br>
  `add_theme_support('soil-jquery-cdn');`

* **Cleaner WordPress markup**<br>
  `add_theme_support('soil-clean-up');`

* **Root relative URLs**<br>
  `add_theme_support('soil-relative-urls');`

* **Google Analytics** ([more info](https://github.com/roots/soil/wiki/Google-Analytics))<br>
  `add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');`

* **Move all JS to the footer**<br>
  `add_theme_support('soil-js-to-footer');`

* **Disable trackbacks**<br>
  `add_theme_support('soil-disable-trackbacks');`

* **Disable asset versioning**<br>
  `add_theme_support('soil-disable-asset-versioning');`

## Support

Use the [Roots Discourse](https://discourse.roots.io/) to ask questions and get support.
