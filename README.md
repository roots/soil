# Soil
[![Packagist](https://img.shields.io/packagist/v/roots/soil.svg?style=flat-square)](https://packagist.org/packages/roots/soil)
[![Packagist Downloads](https://img.shields.io/packagist/dt/roots/soil.svg?style=flat-square)](https://packagist.org/packages/roots/soil)
[![Build Status](https://img.shields.io/travis/roots/soil.svg?style=flat-square)](https://travis-ci.org/roots/soil)

A WordPress plugin which contains a collection of modules to apply theme-agnostic front-end modifications.

Soil is a commercial plugin available from [https://roots.io/plugins/soil/](https://roots.io/plugins/soil/). It's hosted on a public GitHub repository to allow for contributions from the community. It's also published on Packagist to allow easier installation with Composer.

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
composer require roots/soil 3.7.1
```

Then activate the plugin via [wp-cli](http://wp-cli.org/commands/plugin/activate/).

```sh
wp plugin activate soil
```

### via WordPress Admin Panel

1. Download the [latest zip](https://github.com/roots/soil/releases/latest) of this repo.
2. In your WordPress admin panel, navigate to Plugins->Add New
3. Click Upload Plugin
4. Upload the zip file that you downloaded.

## Modules

* **Cleaner WordPress markup**<br>
  `add_theme_support('soil-clean-up');`

* **Disable asset versioning**<br>
  `add_theme_support('soil-disable-asset-versioning');`

* **Disable trackbacks**<br>
  `add_theme_support('soil-disable-trackbacks');`

* **Google Analytics** ([more info](https://github.com/roots/soil/wiki/Google-Analytics))<br>
  `add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');`

* **Load jQuery from the jQuery CDN**<br>
  `add_theme_support('soil-jquery-cdn');`

* **Move all JS to the footer**<br>
  `add_theme_support('soil-js-to-footer');`

* **Cleaner walker for navigation menus**<br>
  `add_theme_support('soil-nav-walker');`

* **Convert search results from `/?s=query` to `/search/query/`**<br>
  `add_theme_support('soil-nice-search');`

* **Root relative URLs**<br>
  `add_theme_support('soil-relative-urls');`

## Support

Use the [Roots Discourse](https://discourse.roots.io/) to ask questions and get support. License is required.

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
* Listen to the [Roots Radio podcast](https://roots.io/podcast/)
