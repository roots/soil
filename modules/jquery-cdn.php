<?php

namespace Roots\Soil\JqueryCDN;

class Fallback {
  /**
   * @var bool
   */
  static $add_jquery_fallback = false;
  /**
   * @var string
   */
  static $jquery_url;

  /**
   * Load jQuery from Google's CDN with a local fallback
   *
   * You can enable/disable this feature in functions.php (or lib/config.php if you're using Sage):
   * add_theme_support('soil-jquery-cdn');
   */
  public static function registerJquery() {
    if (!is_admin()) {
      $jquery_version = $GLOBALS['wp_scripts']->registered['jquery']->ver;

      wp_deregister_script('jquery');

      wp_register_script(
        'jquery',
        'https://ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js',
        [],
        null,
        true
      );

      add_filter('script_loader_src', [__NAMESPACE__ . '\\Fallback', 'filterScripts'], 10, 2);
    }
  }

  /**
   * Filter enqueued scripts
   *
   * @param $src     string    URL of script
   * @param $handle  string    Name of script
   * @return mixed
   */
  public static function filterScripts($src, $handle)
  {
    if (static::$jquery_url) {
      static::echoFallback(static::$jquery_url);
    }
    if ($handle === 'jquery') {
      apply_filters('script_loader_src', includes_url('/js/jquery/jquery.js'), 'jquery-fallback');
    }
    if ($handle === 'jquery-fallback') {
      static::setFallbackUrl($src);
    }

    return $src;
  }

  /**
   * @param $src  string  URL of the fallback
   */
  public static function setFallbackUrl($src)
  {
    static::$add_jquery_fallback = true;
    static::$jquery_url = $src;
  }

  /**
   * * Output the local fallback immediately after jQuery's <script>
   *
   * @link  http://wordpress.stackexchange.com/a/12450
   * @param $url  string  URl of the fallback
   */
  public static function echoFallback($url)
  {
    echo '<script>window.jQuery || document.write(\'<script src="' . $url .'"><\/script>\')</script>' . "\n";
  }
}
add_action('wp_enqueue_scripts', [__NAMESPACE__ . '\\Fallback', 'registerJquery'], 100);
