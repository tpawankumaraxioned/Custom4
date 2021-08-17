<footer class="site-footer">
    <?php
 
      if ( is_active_sidebar( 'footer-1' ) ) : ?>
        <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
          <?php dynamic_sidebar( 'footer-1' ); ?>
        </div>   
      <?php endif; ?>
        
      
      <nav class="site-nav">
      <?php $args = array('theme_location' => 'footer') ?>

      <?php wp_nav_menu($args); ?>
      </nav>
      <p>
        <a href="<?php $page_id = get_option('custom_first_dropdown_setting'); echo get_the_permalink($page_id);?>">
        <?php echo get_option('custom_first_txtbox_setting'); ?></a>
        - &copy; <?php echo date('Y'); ?>
      </p>
      <?php 
        $id = get_theme_mod('custom_first_audio_setting');

        if ($id != 0) {
          $attr = array( 'src' => wp_get_attachment_url($id) ); ?>
          <span><?php echo wp_audio_shortcode($attr); ?></span>
        <?php }
      ?>
      <!-- <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p> -->
    </footer>

  </div>
  <!-- container ends here -->
  <?php wp_footer(); ?>
  <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>		 -->
</body>
</html>