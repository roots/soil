# Soil

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
