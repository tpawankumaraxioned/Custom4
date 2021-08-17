<?php


get_header();
?>
<?php
  $args = array(
    'post_type' => 'resources',
    'posts_per_page'=> -1,
    
  );

  $query = new WP_Query($args);

?>
<?php if ($query->have_posts()) {
    ?>
    <div class="resource-post">
    	<?php while ($query->have_posts()) { 
			$query->the_post(); ?>
			<article class="post">
				<h2><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
				<span><?php the_time('j F Y'); ?></span>
				<figure class="post-fig">
					<img src="<?php echo get_field('image')['url']; ?>" />
				</figure>
				<p><?php echo get_the_excerpt(); ?></p>
				
			</article>
		<?php } ?>
    </div>
<?php } 
wp_reset_query(); ?>

<?php get_footer(); ?>
