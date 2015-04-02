# Soil
[![Build Status](https://travis-ci.org/roots/soil.svg)](https://travis-ci.org/roots/soil)

Clean up WordPress markup, use relative URLs, nicer search URLs, and disable trackbacks

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
add_theme_support('soil-google-analytics', 'UA-XXXXX-Y');
```

By default, the script will be loaded from the `wp_footer` hook, but you can specify any other action hook as the third parameter.

```php
add_theme_support('soil-google-analytics', 'UA-XXXXX-Y', 'wp_head'); // script will load during wp_head
```

#### Dummy `ga()` Function

This module will load a dummy `ga()` function for non-administrators as well as in non-`production` environments (when `WP_ENV` is defined). The function takes all arguments passed to it and logs them to the JavaScript console.

You can override whether the dummy function is displayed via the `soil/dummyGA` filter.

```php
add_filter('soil/dummyGA', '__return_true');  // Appends a dummy `ga()` function
add_filter('soil/dummyGA', '__return_false'); // Appends H5BP's GA snippet
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

Use the [Roots Discourse](https://discourse.roots.io/) to ask questions and get support.
