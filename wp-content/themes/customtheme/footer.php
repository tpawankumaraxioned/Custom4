<footer class="site-footer">
    <?php
 
      if ( is_active_sidebar( 'footer-1' ) ) { ?>
        <div id="header-widget-area" class="chw-widget-area widget-area" role="complementary">
          <?php dynamic_sidebar( 'footer-1' ); ?>
        </div>   
      <?php } ?>
        
      
      <nav class="site-nav">
        <?php $args = array('theme_location' => 'footer primary') ?>

        <?php wp_nav_menu($args); ?>
      </nav>
      <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
    </footer>

  </div>
  <!-- container ends here -->
  <?php wp_footer(); ?>
</body>
</html>