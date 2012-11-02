<ul>
<?php
  $rotator_location = array();
  if (!empty($location)) :
    $rotator_location = array(
      array(
        'taxonomy' => 'base_rotator_location',
        'field'    => 'slug',
        'terms'    => $location
      )
    );
  endif;

  $rotator_args = array(
    'posts_per_page' => -1,
    'post_type'      => 'base_rotator',
    'tax_query'      => $rotator_location
  );
  $rotator_query = new WP_Query($rotator_args);

  while ($rotator_query->have_posts()) : $rotator_query->the_post(); ?>

    <li <?php post_class(); ?>>

      <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail(); ?>
      <?php endif; ?>

      <h3><?php the_title(); ?></h3>
      <?php the_excerpt(); ?>
    </li>

  <?php endwhile; wp_reset_postdata(); ?>
</ul>