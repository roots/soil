# Soil

## Features

### Clean-up

Enable Soil's clean-up with:

```php
add_theme_support('soil-clean-up');
```

* `wp_head()` clean up
* Remove WP version from RSS feeds
* Clean up `<html>` attributes
* Clean up `<link>` tags
* Clean up `body_class()`
* Wrap embedded media as suggested by Readability
* Use `<figure>` and `<figcaption>` for WP captions
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

### Disable Trackbacks / Pingbacks

Remove trackback / pingback functionality entirely with:

```php
add_theme_support('soil-disable-trackbacks');
```