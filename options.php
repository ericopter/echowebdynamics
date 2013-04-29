<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/options/';
	
	$defaultDev = array(
		'global' => array(
			'color-scheme' => array(
				
			),
			'site-width' => array(
				
			),
			'site-layout' => array(
				
			),
			'sidebar-position' => array(
				
			),
			
		),
		'global-type' => array(
			'general' => array(
				
			),
			'links' => array(
				
			),
			'headings' => array(
				
			)
		),
		'header' => array(
			
		),
		'navigation' => array(
			
		),
		'content' => array(
			
		),
		'footer' => array(
			
		),
		'slideshow' => array(
			
		),
		'contact' => array(
			
		),
		'meta-data' => array(
			
		)
	);
	
	$defaults = array(
		'color-scheme' => array(
			'default' => 'Blue/Grey (Default)',
			'black-red' => 'Black/Red',
			'dev' => 'Under Development'
		),
		'site-width' => array(
			'960' => '960px',
			'1120' => '1120px'
		),
		'site-layout' => array(
			'full' => $imagepath . 'option-layout-full.png',
			'framed' => $imagepath . 'option-layout-framed.png'
		),
		'sidebar-position' => array(
			'right' => $imagepath . '2cr.png',
			'left' => $imagepath . '2cl.png'
		),
		'footer-copy' => '<a href="http://www.echowebdynamics.com">Theme By EchoWebDynamics.com</a>',
		'body-background' => array(
			// 'color' => '',
			// 'image' => $imagepath . 'content-bg.png',
			// 'repeat' => 'repeat',
			// 'position' => 'top center',
			// 'attachment'=>'scroll'
		),
		'typo-general' => array(
			'size' => '16px',
			'face' => 'helvetica',
			'style' => 'normal',
			'color' => '#333333' 
		),
		'typo-general-links' => array(
			'color' => '#2A63A6'
		),
		'slideshow' => array(
			'display' => 1,
			'home-width' => array(
				'full' => 'Full Width',
				'framed' => 'Framed'
			),
			'delay' => 6,
			'speed' => 6,
			'effect' => 'fading',
			'direction' => 'horizontal',
			'direction-reverse' => 0,
			'navigation' => 1,
			'pagination' => 1,
			'keyboard' => 1
		),
		'recaptcha' => array(
			'theme' => 'clean'
		)
	);
	
	$options = array();
	
/*
	boilerplate
	
	$options[] = array(
		'name' 	=> __('', 'echotheme'),
		'desc'	=> __('', 'echotheme'),
		'type' 	=> '',
		'id' 	=> '',
		'std'	=> '',
		'class'	=> '',
		'options' => array()
	);
*/
	
	/*
		Global
	*/
	$options[] = array(
		'name' => __('Global Settings', 'echotheme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Wireframe', 'echotheme'),
		'desc'	=> __('Show primary layout elements wireframe for design purposes?', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'site-wireframe',
		'std'	=> '0',
	);
	
	$options[] = array(
		'name' 	=> __('Color Scheme', 'echotheme'),
		'desc'	=> __('Pick your sites default color Scheme', 'echotheme'),
		'type' 	=> 'radio',
		'id' 	=> 'color-scheme',
		'std' 	=> 'default',
		'options' => $defaults['color-scheme']
	);
	
	$options[] = array(
		'name' 	=> __('Site Logo', 'echotheme'),
		'desc'	=> __('Upload a custom logo for your site', 'echotheme'),
		'type' 	=> 'upload',
		'id' 	=> 'site-logo'
	);
	
	$options[] = array(
		'name' 	=> __('Site Content Area Width', 'echotheme'),
		'desc'	=> __('Choose the site content width area for your site', 'echotheme'),
		'type' 	=> 'radio',
		'id' 	=> 'site-width',
		'std'	=> '960',
		'options' => $defaults['site-width']
	);
	
	$options[] = array(
		'name' 	=> __('Site Layout Display', 'echotheme'),
		'desc'	=> __('Choose between full width layout or a framed/boxed layout', 'echotheme'),
		'type' 	=> 'images',
		'id' 	=> 'site-layout',
		'std'	=> 'full',
		'options' => $defaults['site-layout']
	);
	
	$options[] = array(
		'name' 	=> __('Add Box Shadow to Framed Layout', 'echotheme'),
		'desc'	=> __('Click this box if you would like to add a CSS box shadow to the frame/box layout', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'frame-shadow',
		'std'	=> '1',
	);
	
	$options[] = array(
		'name' 	=> __('Sidebar Position', 'echotheme'),
		'desc'	=> __('Choose which side your sites sidebar will appear on', 'echotheme'),
		'type' 	=> 'images',
		'id' 	=> 'sidebar-position',
		'std'	=> 'right',
		// 'class'	=> '',
		'options' => $defaults['sidebar-position']
	);
	
	$options[] = array(
		'name' 	=> __('Body Background', 'echotheme'),
		'desc'	=> __('Site Body Background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'body-background',
	);
	
	$options[] = array(
		'name' 	=> __('Wrapper Background', 'echotheme'),
		'desc'	=> __('Outer content wrapper background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'wrapper-background',
	);
	
	
	
	/*
		Global Typography
	*/
	$options[] = array(
		'name' => __('Global Typography', 'options_framework_theme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Global Typography', 'echotheme'),
		'desc'	=> __('Set your sites global font characteristics', 'echotheme'),
		'type' 	=> 'typography',
		'id' 	=> 'global-type',
		'std'	=> $defaults['typo-general'],
		'options' => $defaults['typo-general']
	);
	
	$options[] = array(
		'name' 	=> __('Global Links', 'echotheme'),
		'desc'	=> __('Set the global link characteristics for the site', 'echotheme'),
		'type' 	=> 'typography',
		'id' 	=> 'global-type-links',
		'std'	=> $defaults['typo-general-links'],
		'options' => $defaults['typo-general-links']
	);
	
	$options[] = array(
		'name' 	=> __('Global Headings', 'echotheme'),
		'desc'	=> __('Set the global Heading characteristics for the site', 'echotheme'),
		'type' 	=> 'typography',
		'id' 	=> 'global-type-headings',
		'std'	=> $defaults['typo-general-links'],
		'options' => $defaults['typo-general-links']
	);
	
	
	
	/*
		Header
	*/
	$options[] = array(
		'name' => __('Header', 'echotheme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Header Background', 'echotheme'),
		'desc'	=> __('Site Header Background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'header-background',
	);
	
	$options[] = array(
		'name' 	=> __('Header Typography', 'echotheme'),
		'desc'	=> __('Set your sites global font characteristics', 'echotheme'),
		'type' 	=> 'typography',
		'id' 	=> 'header-type',
		'std'	=> $defaults['typo-general'],
		'options' => $defaults['typo-general']
	);
	
	$options[] = array(
		'name' 	=> __('Global Links', 'echotheme'),
		'desc'	=> __('Set the global link characteristics for the site', 'echotheme'),
		'type' 	=> 'typography',
		'id' 	=> 'header-type-links',
		'std'	=> $defaults['typo-general-links'],
		'options' => $defaults['typo-general-links']
	);
	
	
	
	/*
		Navigation
	*/
	$options[] = array(
		'name' => __('Navigation', 'echotheme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Navigation Bar Background', 'echotheme'),
		'desc'	=> __('Site Header Background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'navigation-background',
	);
	
	
	
	/*
		Content
	*/
	$options[] = array(
		'name' => __('Content', 'echotheme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Content Background', 'echotheme'),
		'desc'	=> __('Site Content Background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'content-background',
	);
	
	
	
	/*
		Footer
	*/
	$options[] = array(
		'name' => __('Footer', 'echotheme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Footer Background', 'echotheme'),
		'desc'	=> __('Site Footer Background', 'echotheme'),
		'type' 	=> 'background',
		'id' 	=> 'footer-background',
	);
	
	$options[] = array(
		'name' 	=> __('Footer Copy', 'echotheme'),
		'desc'	=> __('Add your "Footer" text here', 'echotheme'),
		'type' 	=> 'textarea',
		'id' 	=> 'footer-copy',
		'std'	=> $defaults['footer-copy'],
	);
	
	
	
	/*
		Slideshow
	*/
	$options[] = array(
		'name' => __('Slideshow', 'options_framework_theme'),
		'type' => 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Enable Homepage Slideshow', 'echotheme'),
		'desc'	=> __('Check button to enable homepage slideshow', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'slideshow-display',
		'std'	=> $defaults['slideshow']['display']
	);
	
	$options[] = array(
		'name' 	=> __('Homepage Slideshow Width', 'echotheme'),
		'desc'	=> __('Do you want the slideshow full screen width or to match the content width?', 'echotheme'),
		'type' 	=> 'radio',
		'id' 	=> 'home-slideshow-width',
		'std'	=> 'framed',
		'options' => $defaults['slideshow']['home-width']
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Transition Effect', 'echotheme'),
		'desc'	=> __('Choose between a fading or sliding transition', 'echotheme'),
		'type' 	=> 'select',
		'id' 	=> 'slideshow-effect',
		'std'	=> $defaults['slideshow']['effect'],
		'class'	=> 'mini',
		'options' => array(
			'fading' => 'Fading',
			'sliding' => 'Sliding'
		)
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Direction', 'echotheme'),
		'desc'	=> __('Direction of sliding movement (for "Sliding" type transition only)', 'echotheme'),
		'type' 	=> 'select',
		'id' 	=> 'slideshow-direction',
		'std'	=> $defaults['slideshow']['direction'],
		'class'	=> 'mini',
		'options' => array(
			'horizontal' => 'Horizontal',
			'vertical' => 'Vertical'
		)
	);
	
	$options[] = array(
		'name' 	=> __('Reverse Sliding Direction', 'echotheme'),
		'desc'	=> __('Check this box to reverse the default direction of the slide movement', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'slideshow-direction-reverse',
		'std'	=> $defaults['slideshow']['direction-reverse']
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Speed', 'echotheme'),
		'desc'	=> __('Delay in seconds to change slides', 'echotheme'),
		'type' 	=> 'select',
		'id' 	=> 'slideshow-delay',
		'std'	=> $defaults['slideshow']['delay'],
		'class'	=> 'mini',
		'options' => array(
			1 => '1 Second',
			2 => '2 Seconds',
			3 => '3 Seconds',
			4 => '4 Seconds',
			5 => '5 Seconds',
			6 => '6 Seconds',
			7 => '7 Seconds',
			8 => '8 Seconds',
			9 => '9 Seconds',
			10 => '10 Seconds',
		)
	);
	
	$options[] = array(
		'name' 	=> __('Animation Speed', 'echotheme'),
		'desc'	=> __('Time for animation transition effect to occur', 'echotheme'),
		'type' 	=> 'select',
		'id' 	=> 'slideshow-speed',
		'std'	=> $defaults['slideshow']['speed'],
		'class'	=> 'mini',
		'options' => array(
			1 => '.1 Second',
			2 => '.2 Seconds',
			3 => '.3 Seconds',
			4 => '.4 Seconds',
			5 => '.5 Seconds',
			6 => '.6 Seconds',
			7 => '7 Seconds',
			8 => '.8 Seconds',
			9 => '.9 Seconds',
			10 => '1.0 Seconds',
			11 => '1.1 Seconds',
			12 => '1.2 Seconds',
			13 => '1.3 Seconds',
			14 => '1.4 Seconds',
			15 => '1.5 Seconds',
		)
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Pagination', 'echotheme'),
		'desc'	=> __('Check to show navigation links for each slide in the show', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'slideshow-pagination',
		'std'	=> $defaults['slideshow']['pagination'],
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Navigation', 'echotheme'),
		'desc'	=> __('Check to show prev/next buttons for the slideshow', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'slideshow-navigation',
		'std'	=> $defaults['slideshow']['navigation'],
	);
	
	$options[] = array(
		'name' 	=> __('Slideshow Keyboard Navigation', 'echotheme'),
		'desc'	=> __('Check to allow navigating prev/next slides with keyboard arrow keys', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'slideshow-keyboard',
		'std'	=> $defaults['slideshow']['keyboard'],
	);
	
	
	
	/*
		Contact Page
	*/
	$options[] = array(
		'name'	=> __('Contact', 'echotheme'),
		'type'	=> 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Email Recipients', 'echotheme'),
		'desc'	=> __('Please enter recipient\'s email address, comma-separate multiple recipients', 'echotheme'),
		'type' 	=> 'textarea',
		'id' 	=> 'email-recipients',
	);
	
	$options[] = array(
		'name' 	=> __('Add reCAPTCHA', 'echotheme'),
		'desc'	=> __(' Add ReCAPTCHA to the email form for extra security. <a href="http://www.google.com/recaptcha">reCAPTCHA Site</a>', 'echotheme'),
		'type' 	=> 'checkbox',
		'id' 	=> 'use-recaptcha',
	);
	
	$options[] = array(
		'name' 	=> __('reCAPTCHA Public Key', 'echotheme'),
		'desc'	=> __('Your reCAPTCHA public key', 'echotheme'),
		'type' 	=> 'text',
		'id' 	=> 'recaptcha-public-key',
	);
	
	$options[] = array(
		'name' 	=> __('reCAPTCHA Private Key', 'echotheme'),
		'desc'	=> __('Your reCAPTCHA private key', 'echotheme'),
		'type' 	=> 'text',
		'id' 	=> 'recaptcha-private-key',
	);
	
	$options[] = array(
		'name' 	=> __('reCAPTCHA Theme', 'echotheme'),
		'desc'	=> __('Choose reCAPTCHA them', 'echotheme'),
		'type' 	=> 'select',
		'id' 	=> 'recaptcha-theme',
		'std'	=> $defaults['recaptcha']['theme'],
		'class'	=> 'mini',
		'options' => array(
			'white' => 'White', 
			'red' => 'Red',
			'blackglass' => 'Black Glass',
			'clean' => 'Clean'
		)
	);
	
	/*
		Meta Data
	*/
	$options[] = array(
		'name'	=> __('Meta Data', 'echotheme'),
		'type'	=> 'heading'
	);
	
	$options[] = array(
		'name' 	=> __('Meta Description', 'echotheme'),
		'desc'	=> __('Enter your site meta description', 'echotheme'),
		'type' 	=> 'textarea',
		'id' 	=> 'meta-description',
	);
	
	$options[] = array(
		'name' 	=> __('Meta Keywords', 'echotheme'),
		'desc'	=> __('Enter your sites meta keywords (comma separated)', 'echotheme'),
		'type' 	=> 'textarea',
		'id' 	=> 'meta-keywords',
	);
	
	$options[] = array(
		'name' 	=> __('Google Analytics', 'echotheme'),
		'desc'	=> __('Paste in your google analytics code (Script tag not required)', 'echotheme'),
		'type' 	=> 'textarea',
		'id' 	=> 'google-analytics',
	);

	return $options;
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	// contact option hiding
	if ($('#use-recaptcha:checked').val() !== undefined) {
		$('#section-recaptcha-public-key').show();
		$('#section-recaptcha-private-key').show();
		$('#section-recaptcha-theme').show();
	} else {
		$('#section-recaptcha-public-key').hide();
		$('#section-recaptcha-private-key').hide();
		$('#section-recaptcha-theme').hide();
	}
	
	$('#use-recaptcha').click(function() {
		$('#section-recaptcha-public-key').slideToggle(400);
		$('#section-recaptcha-private-key').slideToggle(400);
		$('#section-recaptcha-theme').slideToggle(400);
	});
	
	// Slideshow option hiding
	if ($('#slideshow-effect').val() == 'fading') {
		$('#section-slideshow-direction').hide();
		$('#section-slideshow-direction-reverse').hide();
	} else {
		$('#section-slideshow-navigation').hide();
		
	}
	
	$('#slideshow-effect').change(function() {
		$('#section-slideshow-direction').slideToggle();
		$('#section-slideshow-direction-reverse').slideToggle();
		$('#section-slideshow-navigation').slideToggle();
	});
	
	// framed layout box shadow option selection
	if ($('.of-radio-img-radio:checked').val() == 'framed') {
		$('#section-frame-shadow').show();
	} else {
		$('#section-frame-shadow').hide();
	}
	
	$('#site-layout_framed').nextAll('img').first().click(function() {
		$('#section-frame-shadow').slideDown(400);
	})
	
	$('#site-layout_full').nextAll('img').first().click(function() {
		$('#section-frame-shadow').slideUp(400);
	});
	
});
</script>

<?php
}