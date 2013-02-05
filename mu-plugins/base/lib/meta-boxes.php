<?php
/**
 * Custom meta boxes with the CMB plugin
 *
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Basic-Usage
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Field-Types
 * @link https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress/wiki/Display-Options
 */

function base_meta_boxes($meta_boxes) {
  /**
   * Page Options meta box
   */
  $meta_boxes[] = array(
    'id'         => 'page_options',
    'title'      => 'Page Options',
    'pages'      => array('page'),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'fields'     => array(
      array(
        'name' => 'Subtitle',
        'desc' => '',
        'id'   => '_base_page_subtitle',
        'type' => 'text'
      ),
    ),
  );

  return $meta_boxes;
}
add_filter('cmb_meta_boxes', 'base_meta_boxes');
