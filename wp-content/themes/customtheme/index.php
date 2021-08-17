<?php
  global $wp_query;
  $max = $wp_query->max_num_pages;
  echo $max;
  get_header();

  if (have_posts()) {
    ?> <div class="all-posts"> <?php
    while (have_posts()) { 
      the_post(); ?>
      <article class="post">
        <h2><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>

        <p class="post-info">
          <?php the_time('F j, Y'); ?> | 
          by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php the_author(); ?></a> | 
          Post in 
          <?php
          $categories = get_the_category();
          $separator = ", ";
          $output = "";

          if ($categories) {
            foreach($categories as $category) {
              $output .= '<a href="'. get_category_link($category->term_id) .'">'. $category->cat_name . '</a>' . $separator;
            }
            echo trim($output, $separator);
          }
        ?>
        </p>

        <?php if ($post->post_excerpt) { ?>
          <p>
          <?php echo get_the_excerpt(); ?>
          <a href="<?php the_permalink(); ?>">Read more &raquo;</a>
        </p>
        <?php } else {
          the_content();
        } ?>

        
      </article>
      <?php  
    }
    ?> </div> <?php
  } else {
    echo '<p>No content found</p>';
  }
  // echo $max; 
  if ($max > 1) {
    ?> 
    <button id="load_more1">Load More</button> 
    <?php
  }
  get_footer();
?>