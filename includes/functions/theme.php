<?php
/**
 * Set up the theme and include other functions files
 */
function echotheme_include_files()
{
	// Load main options panel file  
	if ( !function_exists( 'optionsframework_init' ) ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/includes/options/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/includes/options/');
		require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
	}
	
	// include the breadcrumbs
	if (file_exists(INCLUDEPATH . 'scripts/breadcrumbs/breadcrumbs.php')) {
		require_once(INCLUDEPATH . 'scripts/breadcrumbs/breadcrumbs.php');
	}
	
	// include multiple featured images
	if (file_exists(INCLUDEPATH . 'scripts/MultiPostThumbnails/MultiPostThumbnails.php')) {
		require_once(INCLUDEPATH . 'scripts/MultiPostThumbnails/MultiPostThumbnails.php');
	}
}
echotheme_include_files();

/**
 * Set up featured image support on pages
 */
function echotheme_setup()
{
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// define the image theme sizes
	add_image_size( 'fours', 200, 150, true );
	add_image_size( 'one-third', 300, 225, true );
	add_image_size( 'two-thirds', 620, 465, true );
	add_image_size( 'slideshow' , 1400, 400, true);
	add_image_size( 'gallery', 720, 405, true);
	
	// define the theme menu areas
	register_nav_menus(array( 
		'header-menu' 	=> 'Header Area Menu',
		'top-menu' 		=> 'Horizontal Nav Bar',
	));
	
	// Register all theme related assests
	wp_register_style(
		'base', 
		get_bloginfo('template_url') . '/css/base.css', 
		false, 
		THEME_VERSION, 
		'screen'
	);
	
	// determine skeleton sheet based on whether we have theme options enabled
	if (function_exists('of_get_option')) {
		// load the appropriate skeleton sheet based on theme option
		$skeleton = 960 == of_get_option('site-width') ? 'skeleton-960.css' : 'skeleton-1120.css';
	} else {
		// set the desired style sheet here
		$skeleton = 'skeleton-960.css';
	}
	
	// register the skeleton sheet
	wp_register_style(
		'skeleton', 
		get_bloginfo('template_url') . '/css/' . $skeleton, 
		array('base'), 
		THEME_VERSION, 
		'screen'
	);
	
	// theme global style sheet
	wp_register_style(
		'theme', 
		get_bloginfo('template_url') . '/css/theme.css', 
		array('skeleton'), 
		THEME_VERSION, 
		'screen'
	);
	
	// get color scheme sheet, and dynamics stylesheet based on whether we are using theme options
	if (function_exists('of_get_option')) {
		
		$color_scheme = of_get_option('color-scheme') ? of_get_option('color-scheme') . '.css' : 'default.css';
		// selected option theme
		wp_register_style(
			'color-theme', 
			get_bloginfo('template_url') . '/css/themes/' . $color_scheme, 
			array('theme'), 
			THEME_VERSION, 
			'screen'
		);
		
		// dynamics style sheet for options panel options
		wp_register_style(
			'options', 
			get_bloginfo('template_url') . '/css/custom_style.php', 
			array('style'), 
			THEME_VERSION, 
			'screen'
		);
		
	} else {
		
		wp_register_style(
			'color-theme', 
			get_bloginfo('template_url') . '/css/themes/default.css', 
			array('theme'), 
			THEME_VERSION, 
			'screen'
		);
		
	}
	
	// Finally register the default wordpress style sheet
	wp_register_style(
		'style', 
		get_bloginfo('template_url') . '/style.css', 
		array('color-theme'), 
		THEME_VERSION, 
		'screen'
	);

	// Superfish Functionality, styles and scripts
	wp_register_style(
		'superfish', 
		get_bloginfo('template_url') . '/includes/scripts/superfish/css/superfish.css'
	);
	
	wp_register_script(
		'hoverintent', 
		get_bloginfo('template_url') . '/includes/scripts/superfish/js/hoverIntent.js', 
		array('jquery')
	);
	
	wp_register_script(
		'superfish', 
		get_bloginfo('template_url') . '/includes/scripts/superfish/js/superfish.js', 
		array('hoverintent')
	);
}

add_action('after_setup_theme', 'echotheme_setup');


//////////////////////////////////////////////////////////////
// Feature Images (Post Thumbnails)
/////////////////////////////////////////////////////////////

// new MultiPostThumbnails(array(
// 	'label' => 'Background Image',
// 	'id' => 'background_image',
// 	'post_type' => 'project'
// 	)
// );


// add_image_size('echotheme_slideshow_image_full', 960, 350, true);
// add_image_size('echotheme_background_image_full', 3000, 30000);

// Hide MultiPostThumbnails Links in regular media upload page

function multi_post_thumbnail_links() {
   echo '<style type="text/css">
           .media-php .post-slidewhow_image-thumbnail{display: none;}
           .media-php .page-slidewhow_image-thumbnail{display: none;}
           .media-php .project-slidewhow_image-thumbnail{display: none;}
         </style>';
}

add_action('admin_head', 'multi_post_thumbnail_links');