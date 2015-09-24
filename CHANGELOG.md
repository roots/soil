### 3.5.0: September 24th, 2015
* Disable nice search on advanced queries ([#115](https://github.com/roots/soil/issues/115))
* Add `.menu-item` class to all items in walker ([#112](https://github.com/roots/soil/issues/112))
* Support placeholder links ([#108](https://github.com/roots/soil/issues/108))
* Add filter `soil/relative-url-filters` ([#104](https://github.com/roots/soil/issues/104))
* Fix warnings when input is empty in `clean_style_tag` ([#102](https://github.com/roots/soil/issues/102))
* Fix Disable Asset Ver when loaded asset is false ([#99](https://github.com/roots/soil/issues/99))
* Remove `is_element_empty()` ([#95](https://github.com/roots/soil/issues/95))
* Refactored `root_relative_url()` ([#94](https://github.com/roots/soil/issues/94))
* Properly make URLs relative when using multisite with domain mapping ([#91](https://github.com/roots/soil/issues/91))
* Remove page template slug from body class ([#90](https://github.com/roots/soil/issues/90))
* Check for protocol relative URLs we can drop the domain from ([#89](https://github.com/roots/soil/issues/89))
* Don't use GA logger in prod env ([#87](https://github.com/roots/soil/issues/87))

### 3.4.0: April 29th, 2015
* Remove inline CSS used by posts with galleries ([#85](https://github.com/roots/soil/issues/85))
* Remove inline CSS and JS from WP emoji support ([#84](https://github.com/roots/soil/issues/84))

### 3.3.0: April 22nd, 2015
* Escape `remove_query_arg` ([#79](https://github.com/roots/soil/issues/79))
* Remove comments feed ([#78](https://github.com/roots/soil/issues/78))
* Specify HTTPS protocol ([#77](https://github.com/roots/soil/issues/77))
* Add more utils, clean up utils ([#76](https://github.com/roots/soil/issues/76))
* Add module for a cleaner navigation walker ([#73](https://github.com/roots/soil/issues/73))
* Use short array syntax ([#72](https://github.com/roots/soil/issues/72))
* Use Google's / @mathiasbynens's GA snippet ([#61](https://github.com/roots/soil/issues/61))

### 3.2.0: April 12th, 2015
* Add module for loading jQuery from Google's CDN with a local fallback ([#64](https://github.com/roots/soil/issues/64))
* Add note about activating the plugin ([#62](https://github.com/roots/soil/issues/62))

### 3.1.0: March 13th, 2015
* Add module for HTML5 Boilerplate's Google Analytics snippet ([#56](https://github.com/roots/soil/pull/56))
* Add module for moving all JS to footer ([#51](https://github.com/roots/soil/pull/51))
* Add nice search support to WordPress SEO ([#48](https://github.com/roots/soil/pull/48))
* Add check for protocol relative URLs to root relative URLs ([#49](https://github.com/roots/soil/pull/49))
* Add `wp_get_attachment_url` to root relative URLs for post thumbnails ([#50](https://github.com/roots/soil/pull/50))
* Refactor Soil to use loop ([#46](https://github.com/roots/soil/pull/46))

### 3.0.3: January 24th, 2015
* Remove fix for empty search queries redirecting to home page
* Clean up output of `<script>` tags
* Add namespace
* Disable relative URLs on sitemaps
* Use `term_link` instead of `tag_link` for relative URLs

### 3.0.2: November 14th, 2014
* Add option to remove version query string from all styles and scripts

### 3.0.1: August 13th, 2014
* Remove caption changes from clean up now that WordPress supports HTML5 captions
* Add option to remove trackback/pingback functionality

### 3.0.0: March 31st, 2014
* Rewrite, Soil is now a plugin with functionality migrated out of the Roots starter theme: clean-up, relative URLs, nice search. Take a look at [Bedrock](https://github.com/roots/bedrock) if you like the ideas from the old Soil, and use Composer to manage plugins on your WP installation.

### 2.0.0: November 1st, 2012
* Add base mu-plugin for all site specific functionality (custom post types, taxonomies, meta boxes, shortcodes)
* Update all plugins
* Remove SLD Custom Content and Taxonomies

### 1.0.0: July 30th, 2012
* Initial commit
