<?php


get_header();
?>

<?php if (have_posts()) {
    ?>
    <div class="resource-single-post">
    	<?php while (have_posts()) { 
			the_post(); ?>
			<article class="single-post">
				<h2><?php the_title(); ?></h2>
				<span><?php the_time('j F Y'); ?></span>
				<figure class="post-fig">
					<img src="<?php echo get_field('image')['url']; ?>" />
				</figure>
				<p><?php the_field('text_description'); ?></p>
				
			</article>
		<?php } ?>
    </div>
<?php } else {
    echo '<p>No content found</p>';
}

get_footer(); ?>
