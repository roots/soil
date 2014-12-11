<?php
/**
 * Add DNS prefetching for any external assets that are enqueued via 
 * wp_enqueue_script and wp_enqueue_style
 * 
 * You can enable/disable this feature in functions.php (or lib/config.php if you're using Roots):
 * add_theme_support('soil-dns-prefetch-external-assets');
 */

function soil_add_dns_prefetch() {
  global $wp_scripts, $wp_styles;
  
  // scripts
  foreach ( $wp_scripts -> registered as $registered )
    $script_urls[ $registered -> handle ] = $registered -> src;
  // styles
  foreach ( $wp_styles -> registered as $registered )
    $style_urls[ $registered -> handle ] = $registered -> src;
  
  $handles = array_merge( $wp_scripts -> queue, $wp_styles -> queue );
  array_values( $handles );

  // output of values
  $output = '';
  $host = parse_url(site_url(), PHP_URL_HOST);
  foreach ( $handles as $handle ) {
    if ( ! empty( $script_urls[ $handle ] ) ) {
      if (parse_url($script_urls[ $handle ], PHP_URL_HOST) != $host)
        $output .= '<link rel="dns-prefetch" href="//' . parse_url($script_urls[ $handle ], PHP_URL_HOST) . '">';
    }
      
    if ( ! empty( $style_urls[ $handle ] ) ) {
      if (parse_url($style_urls[ $handle ], PHP_URL_HOST) != $host)
        $output .= '<link rel="dns-prefetch" href="//' . parse_url($style_urls[ $handle ], PHP_URL_HOST) . '">';
    }
  }
  
  echo $output;
}
add_action('wp_head', 'soil_add_dns_prefetch', 1, 1);
