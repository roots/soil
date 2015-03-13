# Soil
[![Build Status](https://travis-ci.org/roots/soil.svg)](https://travis-ci.org/roots/soil)

Clean up WordPress markup, use relative URLs, nicer search URLs, and disable trackbacks

## Installation

If you're using Composer to manage WordPress, add Soil to your project's dependencies. Run:

```sh
composer require roots/soil 3.0.3
```

Or manually add it to your `composer.json`:

```json
"require": {
  "php": ">=5.3.0",
  "wordpress": "3.9.2",
  "roots/soil": "3.0.3"
}
```

## Features

### Clean-up

Enable Soil's clean-up with:

```php
add_theme_support('soil-clean-up');
```

* `wp_head()` clean up
* Remove WP version from RSS feeds
* Clean up `<html>` attributes
* Clean up `<link>` and `<script>` tags
* Clean up `body_class()`
* Wrap embedded media as suggested by Readability
* Remove unnecessary dashboard widgets
* Remove unnecessary self-closing tags

### Relative URLs

Enable Soil's root relative URLs with:

```php
add_theme_support('soil-relative-urls');
```

### Nice search

Enable Soil's nice search (`/search/query/`) with:

```php
add_theme_support('soil-nice-search');
```

### Google Analytics

Enable HTML5 Boilerplate's Google Analytics snippet

```php
add_theme_support('soil-google-analytics');
define('GOOGLE_ANALYTICS_ID', 'UA-XXXXXX');
```

By default, the GA snippet will only be shown for non-administrators. Administrators will get a dummy `ga()` function that writes its arguments to the console log for testing and development purposes. If you define `WP_ENV`, then non-production environments will always get dummy `ga()` function. You can override this via the `soil/displayGA` filter.

```php
add_filter('soil/displayGA', '__return_true'); // Appends H5BP's GA snippet
add_filter('soil/displayGA', '__return_false'); // Appends a dummy `ga()` function that writes arguments to console log
```

### JS to Footer

Move all scripts to `wp_footer` action hook with:

```php
add_theme_support('soil-js-to-footer');
```

### Disable trackbacks/pingbacks

Remove trackback/pingback functionality with:

```php
add_theme_support('soil-disable-trackbacks');
```

### Disable asset versioning

Disable `ver` query string from all styles and scripts with:

```php
add_theme_support('soil-disable-asset-versioning');
```

## Support

Use the [Roots Discourse](http://discourse.roots.io/) to ask questions and get support.
