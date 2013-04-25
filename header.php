<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<?php echotheme_meta_tags(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>
		<?php echotheme_title(); ?>
	</title>
	<?php

	// function that outputs the title element
	

	// include common css and javascript
	?>
	<link rel="shortcut icon" href="<?php echo ABSURL; ?>/favicon.ico" />
	<?php
	// stuff we wanna call before wp_head
	echotheme_pre_wp_head();
	// call the wp_head stuff
	wp_head();
	// stuff we wana call after wp_head
	echotheme_post_wp_head();
	?>
	<!--[if lt IE 9]>
	     <script src="<?php echo get_template_directory_uri() ?>/js/html5.js"></script>
	<![endif]-->
	
<!-- Website by http://www.echowebdynamics.com -->
</head>
<body <?php body_class(); ?>>
	<h1 class="no-display"><?php echotheme_title(); ?></h1>
	<div id="wrapper">
		
		<div id="header">
			<div class="container">
				<div id="branding" class="six columns">
					<h2>
						<a href="<?php echo bloginfo('url'); ?>">
							<?php echo bloginfo('name'); ?>
						</a>
						<span class="no-display">
							<?php echo bloginfo('description', 'display') ?>
						</span>
					</h2>
				</div> <!-- #branding -->
				
				<?php
				/**
				 * Output the main menu if set
				 */
				$args = array(
					'theme_location' 	=> 'header-menu',
					'container'       	=> false,
					// 'container_class' 	=> 'nav',
					'menu_id'        	=> 'header-nav',
					'menu_class' 		=> 'hori-nav',
					'echo'				=> false,
					'fallback_cb' 		=> false
				);
				$menu = wp_nav_menu($args);
				if ($menu) :
				?>
				<div id="header-nav-wrapper" class="ten columns">
					<?php
						echo $menu;
					?>
				</div> <!-- end #header-nav -->
				<?php
				endif;
				?>
				
			</div> <!-- .container -->
		</div> <!-- end #header -->
		
		<?php
		/**
		 * Output the main menu if set
		 */
		$args = array(
			'theme_location' 	=> 'top-menu',
			'container'       	=> false,
			// 'container_class' 	=> 'container',
			'menu_id'        	=> 'nav-bar',
			'menu_class'		=> 'hori-nav container',
			'echo'				=> false,
			'fallback_cb' 		=> false
		);
		$menu = wp_nav_menu($args);
		if ($menu) :
		?>
		<div id="primary-nav">
			<?php
				echo $menu;
			?>
		</div> <!-- end #primary-nav -->
		<?php
		endif;
		?>
		<div id="content">
			
			<?php 
			// Breadcrumbs
			if (class_exists('simple_breadcrumb') && !is_home() && !is_front_page() && !defined('DISABLE_BREADCRUMBS')) :
			?>
			<div id="breadcrumbs">
				<div class="container">
					<?php $breadcrumbs_go = new simple_breadcrumb;  ?>
				</div>
			</div> <!-- end #breadcrumbs -->
			<?php
			endif;
			
			// display the home page slideshow
			if (is_front_page() && of_get_option('slideshow-display')): 
			get_template_part('part', 'flexslider-home');
			endif;
			?>
			<div class="space-20"></div>
			<div class="container">