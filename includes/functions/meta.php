<?php
/**
 * function remove_wp_headlinks()
 * 
 * Remove unnecessary headlinks that screw validation in wp_head hook
 */
function echotheme_remove_headlinks()
{
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_generator');
}

add_action('init', 'echotheme_remove_headlinks');

/**
 * generates the title text
 */
function echotheme_title()
{
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	
	$separator = ' - ';

	wp_title( $separator, true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo $separator . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo $separator . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );
}

/*
	Generate the custom meta description/keywords tags for our SEO smart theme
*/
function echotheme_meta_tags()
{
	global $post;
	$description = null;
	$keywords = null;
	
	// if we have theme options and the meta description/keywords value is set
	if (function_exists('of_get_option')) {
		$description = of_get_option('meta-description') ? of_get_option('meta-description') : $description;
		$keywords = of_get_option('meta-keywords') ? of_get_option('meta-keywords') : $keywords;
	}
	
	// if the particular page/post meta description/keyword value is set
	$description = get_meta_box_value('_echotheme_meta_description_value') ? get_meta_box_value('_echotheme_meta_description_value') : $description;
	$keywords = get_meta_box_value('_echotheme_meta_keywords_value') ? get_meta_box_value('_echotheme_meta_keywords_value') : $keywords;
	
	// if $description isn't null, output meta tag
	if ($description) {
		echo '<meta name="description" content="' . $description . '">' . "\n";
	}
	
	// if $keywords isn't null, output meta tag
	if ($keywords) {
		echo '<meta name="keywords" content="' . $keywords . '">' . "\n";
	}
}

/**
 * Use my jQuery instead of Wordpress's
 */
function echotheme_jquery() {
	wp_deregister_script('jquery');
	wp_register_script(
		'jquery', 
		get_template_directory_uri() . '/js/jquery-1.7.1.min.js', 
		null ,
		THEME_VERSION
	);
	wp_enqueue_script('jquery');
	
	wp_register_script(
		'jquery-easing', 
		get_template_directory_uri() . '/js/jquery.easing.js', 
		array('jquery'), 
		THEME_VERSION
	);
}
add_action('wp_enqueue_scripts', 'echotheme_jquery');

/**
 * general javascript files required by all pages
 */
function echotheme_general_javascript()
{
	wp_enqueue_script(
		'general', 
		get_template_directory_uri() . '/js/general.js', 
		array('jquery')
	);
	wp_enqueue_script('superfish');
	// wp_enqueue_script('echo-menu', ABSURL . '/js/echoDropDownMenu.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'echotheme_general_javascript');

/**
 * Function for linking to custom css files
 */
function echotheme_general_css()
{ 
	// enqueue all the necessary theme styles, enqueueing "style" or "options" triggers the rest
	if (function_exists( 'optionsframework_init' )) {
		wp_enqueue_style('options');
		
		// for development and design, should we show the wireframes?
		if (of_get_option('site-wireframe')) {
			wp_enqueue_style(
				'wireframe', 
				get_bloginfo('template_url') . '/css/wireframe.css', 
				array('options'), 
				THEME_VERSION,
				'screen'
			);
		}
	} else {
		wp_enqueue_style('style');
	}
}

add_action('wp_print_styles', 'echotheme_general_css');

/**
 * Creates action hook to be called directly before wp_head action
 */
function echotheme_pre_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_pre_wp_head');
}

/**
 * Creates action hook to be called directly before closing the head
 */
function echotheme_post_wp_head()
{ 
	// run the hook to add custom stuff at end of head
	do_action('echotheme_post_wp_head');
}

/**
 * Include scripts and styles based on different requirements
 * ??REVISE??
 */
function echotheme_specific_links()
{
	if (is_home() || is_front_page()) {
		// add_action('wp_enqueue_scripts', 'echotheme_homepage_links');
		// echotheme_load_flexslider();
	}

	if (defined('SHADOWBOX')) {
		// add_action('wp_enqueue_scripts', 'echotheme_load_shadowbox');
		echotheme_load_shadowbox();
	}

	if (defined('SLIDESHOW')) {
	    // add_action('wp_enqueue_scripts', 'echotheme_slideshow_links');
		echotheme_slideshow_links();
	}
}

add_action('echotheme_pre_wp_head', 'echotheme_specific_links');

/**
 * Function/hook for adding Shadowbox to a page
 */
function echotheme_load_shadowbox()
{
	wp_enqueue_style(
		'shadowbox', 
		get_bloginfo('template_url') . '/includes/scripts/shadowbox/shadowbox.css'
	);
	wp_enqueue_script(
		'shadowbox', 
		get_bloginfo('template_url') . '/includes/scripts/shadowbox/shadowbox.js', 
		array('jquery')
	);	
}

/**
 * Function to load isotope
 */
function echotheme_load_isotope()
{
	// isotope
	wp_enqueue_script(
		'isotope', 
		get_bloginfo('template_url') . '/includes/scripts/isotope/jquery.isotope.min.js', 
		array('jquery')
	);
	wp_enqueue_style(
		'isotope', 
		get_bloginfo('template_url') . '/includes/scripts/isotope/style.css', 
		false, 
		'', 
		'screen'
	);
}
/**
 * Function/hook for adding Slideshow to a page
 */
function echotheme_load_flexslider()
{
	wp_enqueue_script(
		'flexslider', 
		get_bloginfo('template_url') . '/includes/scripts/flexslider/jquery.flexslider-min.js', 
		array('jquery-easing')
	);
	wp_enqueue_style(
		'flexslider', 
		get_bloginfo('template_url') . '/includes/scripts/flexslider/flexslider.css'
	);
}
add_action('echotheme_pre_wp_head', 'echotheme_load_flexslider');

function echotheme_load_jqueryCycle()
{
	wp_enqueue_style(
		'jquery.cycle', 
		get_template_directory_uri() . '/includes/scripts/cycle/jquery.cycle.css'
	);
	wp_enqueue_script(
		'jqueryCycle', 
		get_bloginfo('template_url') . '/includes/scripts/cycle/jquery.cycle.all.js', 
		array('jquery')
	);
}
add_action('echotheme_pre_wp_head', 'echotheme_load_jqueryCycle');

function echotheme_load_nivoslider()
{
	wp_enqueue_style(
		'nivo.style', 
		get_template_directory_uri() . '/includes/scripts/nivo-slider/nivo-slider.css'
	);
	wp_enqueue_style(
		'nivo.style.default', 
		get_template_directory_uri() . '/includes/scripts/nivo-slider/themes/default/default.css', 
		'nivo.style'
	);
	wp_enqueue_script(
		'nivo.script', 
		get_bloginfo('template_url') . '/includes/scripts/nivo-slider/jquery.nivo.slider.pack.js', 
		array('jquery')
	);
}
add_action('echotheme_pre_wp_head', 'echotheme_load_nivoslider');

function echotheme_analytics()
{
	if (function_exists('of_get_option') && $analytics = of_get_option('google-analytics')) {
?>
<script type="text/javascript"><?php echo $analytics ?></script>
<?php
	}
}

add_action('echotheme_post_wp_head', 'echotheme_analytics');
?>