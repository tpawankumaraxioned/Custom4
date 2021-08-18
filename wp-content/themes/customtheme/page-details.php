<?php
get_header();

$featured_posts = get_field('resource_cat');
if( $featured_posts ) { ?>
  <ul class="random_list">
    <?php foreach( $featured_posts as $post ) {

      setup_postdata($post); ?>
      <li>
        <article class="random_post">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <span class="pub_date"><?php the_time('j F Y'); ?></span>
          <figure class="random-post-fig">
            <img src="<?php echo get_field('image')['url']; ?>" />
          </figure>
          <?php the_field( 'text_description' ); ?>
        </article>
      </li>
    <?php } ?>
  </ul>
  <?php 
  wp_reset_postdata(); 
} else { 
    
  $args = array(
  'post_type' => 'resources',
  'post_status' => 'publish',
  'posts_per_page'=> 3,
  'orderby' => 'rand',
  );

	$query = new WP_Query($args);
  if ($query->have_posts()) { ?>
    <ul class="random_list"> <?php
    while ($query->have_posts()) { 
      $query->the_post();?>
      <li>
        <article class="random_post">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <span class="pub_date"><?php the_time('j F Y'); ?></span>
          <figure class="random-post-fig">
            <img src="<?php echo get_field('image')['url']; ?>" />
          </figure>
          <?php the_field( 'text_description' ); ?>
        </article>
      </li> <?php
    } ?>
    </ul> 
    <?php 
  }
  wp_reset_query(); 
} 
get_footer(); ?>