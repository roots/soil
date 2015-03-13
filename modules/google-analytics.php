<?php

namespace Roots\Soil\GoogleAnalytics;

/**
 * Google Analytics snippet from HTML5 Boilerplate
 *
 * Cookie domain is 'auto' configured. See: http://goo.gl/VUCHKM
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
 * add_theme_support('soil-google-analytics');
 * define('GOOGLE_ANALYTICS_ID', 'UA-XXXXXX');
 */
function google_analytics() {
  if (!defined('GOOGLE_ANALYTICS_ID') || !GOOGLE_ANALYTICS_ID) {
    return;
  }
  $displayGA = (!defined('WP_ENV') || WP_ENV === 'production') && !current_user_can('manage_options');
  ?>
  <script>
    <?php if (apply_filters('soil/displayGA', $displayGA)) : ?>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    <?php else : ?>
      function ga() {if (window.console) {console.log('Google Analytics: ' + [].slice.call(arguments));}}
    <?php endif; ?>
      ga('create','<?= GOOGLE_ANALYTICS_ID; ?>','auto');ga('send','pageview');
  </script>
  <?php
}
add_action('wp_footer', __NAMESPACE__ . '\\google_analytics', 20);
