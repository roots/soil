# Soil
[![Build Status](https://travis-ci.org/roots/soil.svg)](https://travis-ci.org/roots/soil)

A WordPress plugin which contains a collection of modules to apply theme-agnostic front-end modifications.

## Requirements

<table>
  <thead>
    <tr>
      <th>Prerequisite</th>
      <th>How to check</th>
      <th>How to install</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>PHP &gt;= 5.4.x</td>
      <td><code>php -v</code></td>
      <td>
        <a href="http://php.net/manual/en/install.php">php.net</a>
      </td>
    </tr>
  </tbody>
</table>

## Installation

You can install this plugin via the command-line or the WordPress admin panel.

### via Command-line

If you're [using Composer to manage WordPress](https://roots.io/using-composer-with-wordpress/), add Soil to your project's dependencies.

```sh
composer require roots/soil 3.5.0
```

Then activate the plugin via [wp-cli](http://wp-cli.org/commands/plugin/activate/).

```sh
wp plugin activate soil
```

### via WordPress Admin Panel

1. Download the [latest zip](https://github.com/roots/soil/archive/master.zip) of this repo.
2. In your WordPress admin panel, navigate to Plugins->Add New
3. Click Upload Plugin
4. Upload the zip file that you downloaded.

## Modules

* **Load jQuery from the Google CDN**<br>
  `add_theme_support('soil-jquery-cdn');`

* **Cleaner WordPress markup**<br>
  `add_theme_support('soil-clean-up');`

* **Cleaner walker for navigation menus**<br>
  `add_theme_support('soil-nav-walker');`

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
