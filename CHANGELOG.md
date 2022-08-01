### 4.1.1: August 1st, 2022
* Fix version number

### 4.1.0: August 1st, 2022
* Fix: XSS vulnerability on `language_attributes`
* Fix: Clean up - re-add disabling extra RSS feeds
* Fix: Nav walker - CPT items active classes
* Fix: PHP 8.1 notices
* Add: WPCS security and compatibility checks

### 4.0.5: July 27th, 2021
* Fix fallback autoloader compatibility with similarly named class names in other namespaces
* Google Analytics module: support checking production environment type via `wp_get_environment_type()`

### 4.0.4: September 10th, 2020
* Fix Google Analytics options: correctly support non-array default option

### 4.0.3: September 8th, 2020
* Relative URLs module: Ensure `srcset` value is array

### 4.0.2: September 8th, 2020
* Cleanup module: Fix notice for self-closing tags on site icon meta

### 4.0.1: August 31st, 2020
* Add fallback autoloader when Composer isn't present

### 4.0.0: August 29th, 2020
* BREAKING CHANGE - Refactor entire code base
* Add options support for modules
* Remove oEmbed wrapper due to incompatibility with Gutenberg

### 3.9.0: December 7th, 2019
* Enable beacon tracking for Google Analytics ([#243](https://github.com/roots/soil/pull/243))
* Add support for GitHub Updater plugin ([#241](https://github.com/roots/soil/pull/241))
* Add AJAX support for relative URLs module ([#215](https://github.com/roots/soil/pull/236))
* Fix script cleanup error with single quotes (this was causing JS errors in the WP customizer) ([#224](https://github.com/roots/soil/pull/224))
* Check if is a search page before adding active class to menu item ([#223](https://github.com/roots/soil/pull/223))
* Move addition/removal of nav filters to walk function ([#236](https://github.com/roots/soil/pull/2236))
* Add Google Optimize support for Google Analytics module ([#215](https://github.com/roots/soil/pull/215))

### 3.8.1: May 23rd, 2019
* Update version in plugin headers correctly ([#231](https://github.com/roots/soil/pull/231))

### 3.8.0: May 22nd, 2019
* Remove jQuery CDN feature ([#228](https://github.com/roots/soil/pull/228))
* Add module for disabling the REST API ([#209](https://github.com/roots/soil/pull/209))

### 3.7.3: August 13th, 2017
* Update method for removing recent commets widget styles ([#195](https://github.com/roots/soil/pull/195))
* Remove dashboard widgets removal ([#192](https://github.com/roots/soil/pull/192))
* Add `parent_theme_file_uri` to relative URLs ([#191](https://github.com/roots/soil/pull/191))
* Fix SEO Framework social images ([#190](https://github.com/roots/soil/pull/190))

### 3.7.2: June 11th, 2017
* Don't apply relative URLs to SEO Framework's social image ([#184](https://github.com/roots/soil/pull/184))
* Don't do `active` fix for CPT if no archive page ([#180](https://github.com/roots/soil/pull/180))
* Prefetch code.jquery.com ([#177](https://github.com/roots/soil/pull/177))
* Add `theme_file_uri` to relative URLs ([#176](https://github.com/roots/soil/pull/176))
* Fix PHP warnings being thrown in development ([#172](https://github.com/roots/soil/pull/172))
* Remove rel_canonical from clean-up module ([#169](https://github.com/roots/soil/pull/169))

### 3.7.1: August 30th, 2016
* Enable jQuery noConflict ([#160](https://github.com/roots/soil/issues/160))
* Disable DNS Prefetch for WordPress Emoji (WP 4.6) ([#159](https://github.com/roots/soil/issues/159))

### 3.7.0: March 7th, 2016
* Use `home_url` in `root_relative_url` ([#147](https://github.com/roots/soil/issues/147))
* Add relative URLs to responsive images output ([#146](https://github.com/roots/soil/issues/146))
* Disable relative URLs in feeds ([#145](https://github.com/roots/soil/issues/145))
* Switch from Google CDN to jQuery CDN ([#144](https://github.com/roots/soil/issues/144))

### 3.6.2: December 24th, 2015
* Add missing oEmbed cleanup ([#134](https://github.com/roots/soil/issues/134))

### 3.6.1: December 24th, 2015
* Remove `wp-embed.js` and `wp-json` from head ([#129](https://github.com/roots/soil/issues/129))

### 3.6.0: November 18th, 2015
* Add priority for loading modules (compatibility with Sage 8.3.0+)
* Add core `menu-item-has-children` class on parent nav elements ([#127](https://github.com/roots/soil/issues/127))
* Update sitemap conditional ([#126](https://github.com/roots/soil/issues/126))

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
