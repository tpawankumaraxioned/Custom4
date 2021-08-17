<?php

  get_header();

  if (have_posts()) {
    while (have_posts()) { 
      the_post(); ?>
      <article class="post page">
        
        <h2><?php the_title(); ?></h2>
        
        <?php the_post_thumbnail('small-thumbnail'); ?>
        <?php the_content(); ?>
      </article>
    <?php }
  } else {
    echo '<p>No content found</p>';
  }
    
  get_footer();