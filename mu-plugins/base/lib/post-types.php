<?php
/**
 * Custom post types & taxonomies
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

/**
 * Rotator custom post type
 */
function base_register_rotator_post_type() {
  $labels = array(
    'name'               => 'Rotator Items',
    'singular_name'      => 'Rotator Item',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Rotator Item',
    'edit_item'          => 'Edit Rotator Item',
    'new_item'           => 'New Rotator Item',
    'view_item'          => 'View Rotator Item',
    'search_items'       => 'Search Rotator Items',
    'not_found'          => 'No rotator items found',
    'not_found_in_trash' => 'No rotator items found in trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Rotator'
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => 'rotator'),
    'capability_type'     => 'post',
    'has_archive'         => false,
    'hierarchical'        => false,
    'menu_position'       => null,
    'supports'            => array('title', 'thumbnail', 'excerpt')
  );

  register_post_type('base_rotator', $args);
}
add_action('init', 'base_register_rotator_post_type');

/**
 * Rotator Location taxonomy
 */
function base_register_location_taxonomy() {
  $labels = array(
    'name'              => 'Locations',
    'singular_name'     => 'Location',
    'search_items'      => 'Search Locations',
    'all_items'         => 'All Locations',
    'parent_item'       => 'Parent Location',
    'parent_item_colon' => 'Parent Location:',
    'edit_item'         => 'Edit Location',
    'update_item'       => 'Update Location',
    'add_new_item'      => 'Add New Location',
    'new_item_name'     => 'New Location Name',
    'menu_name'         => 'Location'
  );

  $args = array(
    'hierarchical' => true,
    'labels'       => $labels,
    'show_ui'      => true,
    'query_var'    => true,
    'rewrite'      => array('slug' => 'rotator-location'),
  );
  register_taxonomy('base_rotator_location', 'base_rotator', $args);
}
add_action('init', 'base_register_location_taxonomy');
