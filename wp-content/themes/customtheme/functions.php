<?php
function custom1_resources() {
  wp_enqueue_style('style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'custom1_resources');

// custom post types
function custom_post_type_resource() {
    $args = array(
      'labels' => array(
        'name' => 'Resources',
        'singular_name' => 'Resource',
        'all_items' => 'All Resources', 
      ),
      'hierarchical' => false,
      'menu_icon'   => 'dashicons-admin-post',
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail','comments', 'excerpt', 'page-attributes'),      
    );
    
    register_post_type('resources', $args);
}

add_action('init', 'custom_post_type_resource');

// custom taxonomy
function custom_taxonomy_resource() {
  $args = array(
    'labels' => array(
      'name' => 'Categorys',
      'singular_name' => 'Category',
    ),
    'hierarchical' => true,
    'public' => true,
    'has_archive' => true,
  );

  register_taxonomy('cats', array('resources'), $args);

}

add_action('init', 'custom_taxonomy_resource');

// excerpt word count length
function custom_excerpth_length( ) {
  return 50;
}

add_filter('excerpt_length', 'custom_excerpth_length', 999);

// Adding Menu
function custom1_setup() {

  // Navigation Menu
  register_nav_menus(array(
    'header primary' =>__('Header Primary Menu'),
    'footer primary' =>__('Footer Primary Menu'),
  ));

  // featured image support
  add_theme_support('post-thumbnails');
  add_image_size('small-thumbnail', 200, 180, true);
  add_image_size('banner-thumbnail', 600, 400, true);

}

add_action('after_setup_theme', 'custom1_setup');

// Register and enqueue scripts for slider
function my_custom_scripts() {
    
  global $wp_query;
  wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), false, true);


  wp_localize_script('custom-script', 'load_filter_params', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'current_page' => get_query_var('paged')?get_query_var('paged'): 1,
    'max_page' => $wp_query->max_num_pages,
  ));
}

add_action( 'wp_enqueue_scripts', 'my_custom_scripts' );

//Filter button (Explore) button
function load_filter() {
	if($_POST['cat_type'] != '') {
    $args = array(
      'post_type' => 'resources',
      'posts_per_page'=> 6,
      'paged' => $paged,
      'tax_query' => array(
      'relation' => 'AND', 
        array(
          'taxonomy' => 'cats',
          'field' => 'slug',
          'terms' => $_POST['cat_type']
        ),
      )
    );
  } else {
    $args = array(
      'post_type' => 'resources',
      'posts_per_page'=> 6
    );
	}

	$query = new WP_Query($args);
	if ($query->have_posts()) {
		?>
		<div class="resource-post">
			<?php while ($query->have_posts()) { 
				$query->the_post(); ?>
				<article class="post">
					<h2><?php the_title(); ?></h2>
					<span><?php the_time('j F Y'); ?></span>
					<figure class="post-fig">
						<img src="<?php echo get_field('image')['url']; ?>" />
					</figure>
					<p><?php echo get_the_excerpt(); ?></p>
					<a class="post-link" href="<?php the_permalink(); ?>">Read More</a>
				</article>
			<?php } ?>
		</div>
	<?php } else {
	echo 'No posts found';
	}
	wp_reset_query(); 
  wp_die();
}

add_action( 'wp_ajax_load_filter', 'load_filter' );
add_action( 'wp_ajax_nopriv_load_filter', 'load_filter' );

// Show More (Load More) button
function load_more_filter() {
  $paged1 = $_POST['page'] + 1;
  if (!empty($paged1)) {
    if($_POST['cat_type']) {
      $args = array(
        'post_type' => 'resources',
        'posts_per_page'=> 6,
        'paged' => $paged1,
        'tax_query' => array(
        'relation' => 'AND', 
          array(
            'taxonomy' => 'cats',
            'field' => 'slug',
            'terms' => $_POST['cat_type']
          ),
        )
      );
    } else {
      $args = array(
        'post_type' => 'resources',
        'posts_per_page'=> 6
      );
    }
    $query = new WP_Query( $args );

    // if ($query->have_posts()) {
      ?>
      <div class="resource-post">
        <?php while ($query->have_posts()) { 
          $query->the_post(); ?>
          <article class="post">
            <h2><?php the_title(); ?></h2>
            <span><?php the_time('j F Y'); ?></span>
            <figure class="post-fig">
              <img src="<?php echo get_field('image')['url']; ?>" />
            </figure>
            <p><?php echo get_the_excerpt(); ?></p>
            <a class="post-link" href="<?php the_permalink(); ?>">Read More</a>
          </article>
        <?php } ?>
      </div>
    <?php 
    // } else {
    // echo 'No posts found';
    // }
    // wp_reset_query();
  }
  wp_die();
}

add_action( 'wp_ajax_load_more_filter', 'load_more_filter' );
add_action( 'wp_ajax_nopriv_load_more_filter', 'load_more_filter' );
