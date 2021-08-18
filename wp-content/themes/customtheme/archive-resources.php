<?php
// global $wp_query;
// $max = $wp_query->max_num_pages;

get_header();
$cat_type = isset($_POST['cat_type'])? $_POST['cat_type'] : '';
?>
<form class="filter_taxonomy" id="filter_taxonomy" method="POST">
	<?php
    $categories_type = get_categories('taxonomy=cats');

    $select_type = "<select name='cat_type' id='cat_type' class='postform'>n";
    $select_type.= "<option value=''>Select category</option>n";
  
    foreach($categories_type as $category) {
      if($category->count > 0){
        $select_type.= "<option class='cat_type' value='".$category->slug."'>".$category->name."</option>";
      }
    }
  
    $select_type.= "</select>";
  
    echo $select_type;
	
	?>
  <input type="hidden" value="<?php echo $cat_type; ?>" class="post-cats"/>
	<button id="explore">Explore</button>
</form>

<?php
  if ($_POST) {
    $args = array(
      'post_type' => 'resources',
      'posts_per_page'=> 6,
      // 'paged' => $paged,
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
      'posts_per_page'=> 6,
    );
  }
  

  $query = new WP_Query($args);
  $total = $query->found_posts;
  $pages1 = $query->max_num_pages;

?>
<?php if ($query->have_posts()) {
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
          <p><?php 
          $excerpt = get_the_excerpt(); 
          
          $excerpt = substr( $excerpt, 0, 100 );
          $result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
          echo $result;
          // echo get_the_excerpt(10); 
          ?></p>
          <a class="post-link" href="<?php the_permalink(); ?>">Read More</a>
        </article>
      <?php } ?>
    </div>
<?php } 
wp_reset_query();

if ($pages1 > 1) { ?> 
	<button id="load_more_resources" class="load_more_resources">Show More</button> 
<?php } ?>

<?php get_footer(); ?>
