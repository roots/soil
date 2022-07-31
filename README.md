# Soil
[![Packagist](https://img.shields.io/packagist/v/roots/soil.svg?style=flat-square)](https://packagist.org/packages/roots/soil)
[![Packagist Downloads](https://img.shields.io/packagist/dt/roots/soil.svg?style=flat-square)](https://packagist.org/packages/roots/soil)
![Build Status](https://github.com/roots/soil/workflows/Compatibility%20Checks/badge.svg)

A WordPress plugin which contains a collection of modules to apply theme-agnostic front-end modifications.

Soil is a commercial plugin available from [https://roots.io/plugins/soil/](https://roots.io/plugins/soil/). It's hosted on a public GitHub repository to allow for contributions from the community. It's also published on Packagist to allow easier installation with Composer.

## Support

Use [Roots Discourse](https://discourse.roots.io/) to ask questions, get support, or report issues. **[Soil must be purchased](https://roots.io/plugins/soil/) in order to get support.**

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
      <td>PHP &gt;= 5.6.x</td>
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
composer require roots/soil
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
  `add_theme_support('soil', 'clean-up');`

* **Disable REST API**<br>
  `add_theme_support('soil', 'disable-rest-api');`

* **Disable asset versioning**<br>
  `add_theme_support('soil', 'disable-asset-versioning');`

* **Disable trackbacks**<br>
  `add_theme_support('soil', 'disable-trackbacks');`

* **Google Analytics**<br>
  `add_theme_support('soil', ['google-analytics' => 'UA-XXXXX-Y']);`

* **Move all JS to the footer**<br>
  `add_theme_support('soil', 'js-to-footer');`

* **Cleaner walker for navigation menus**<br>
  `add_theme_support('soil', 'nav-walker');`

* **Convert search results from `/?s=query` to `/search/query/`**<br>
  `add_theme_support('soil', 'nice-search');`

* **Root relative URLs**<br>
  `add_theme_support('soil', 'relative-urls');`

And in a format you can copy & paste into your theme:
```php
/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil', [
    'clean-up',
    'disable-rest-api',
    'disable-asset-versioning',
    'disable-trackbacks',
    'google-analytics' => 'UA-XXXXX-Y',
    'js-to-footer',
    'nav-walker',
    'nice-search',
    'relative-urls'
]);
```

### Module options

Soil 4 introduced support for options on some modules.

<details>
<summary>Full annotated list of features and options</summary>

```php

/**
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support('soil', [
    /**
     * Clean up WordPress
     */
    'clean-up' => [
        /**
         * Obscure and suppress WordPress information.
         */
        'wp_obscurity',

        /**
         * Disable WordPress emojis.
         */
        'disable_emojis',

        /**
         * Disable Gutenberg block library CSS.
         */
        'disable_gutenberg_block_css',

        /**
         * Disable extra RSS feeds.
         */
        'disable_extra_rss',

        /**
         * Disable recent comments CSS.
         */
        'disable_recent_comments_css',

        /**
         * Disable gallery CSS.
         */
        'disable_gallery_css',

        /**
         * Clean HTML5 markup.
         */
        'clean_html5_markup',
    ],

    /**
     * Disable WordPress REST API
     */
    'disable-rest-api',

    /**
     * Remove version query string from all styles and scripts
     */
    'disable-asset-versioning',

    /**
     * Disables trackbacks/pingbacks
     */
    'disable-trackbacks',

    /**
     * Google Analytics
     */
    'google-analytics' => [
        /**
         * This is to go live with GA.
         *
         * This should probably be false in non-production.
         */
        'should_load' => false,

        /**
         * Google Analytics ID
         *
         * This is also known as your "property ID" or "measurement ID"
         *
         * Format: UA-XXXXX-Y
         */
        'google_analytics_id' => null,

        /**
         * Optimize container ID
         *
         * Format: OPT-A1B2CD (previously: GTM-A1B2CD)
         *
         * @link https://support.google.com/optimize/answer/6262084
         */
        'optimize_id' => null,

        /**
         * Anonymize user IP addresses.
         *
         * This might be required depending on region.
         *
         * @link https://github.com/roots/soil/pull/206
         */
        'anonymize_ip',
    ],

    /**
     * Moves all scripts to wp_footer action
     */
    'js-to-footer',

    /**
     * Cleaner walker for wp_nav_menu()
     */
    'nav-walker',

    /**
     * Redirects search results from /?s=query to /search/query/, converts %20 to +
     *
     * @link http://txfx.net/wordpress-plugins/nice-search/
     */
    'nice-search',

    /**
     * Convert absolute URLs to relative URLs
     *
     * Inspired by {@link https://web.archive.org/web/20180529232418/http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/}
     */
    'relative-urls',
]);
```
</details>

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
* Listen to the [Roots Radio podcast](https://roots.io/podcast/)
