<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <!-- <link href="<?php echo get_bloginfo('template_directory'); ?>/style.css" rel="stylesheet"> -->
  <?php wp_head(); ?>
  <!-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> -->
  
</head>
<body <?php body_class(); ?> style="background:<?php echo get_option('custom_first_color_picker_setting') ?>">
  
  <!-- constainer starts here -->
  <div class="container">
    <header class="site-header">
      <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      <h5>
        <?php bloginfo('description'); ?> 
        <?php if (is_page('contact-us')) { ?>
         - Thank you for Viewing our work 
        <?php } ?>
      </h5>


      <nav class="site-nav">
        <?php $args = array('theme_location' => 'header primary') ?>

        <?php wp_nav_menu($args); ?>
	    </nav>
    </header>

