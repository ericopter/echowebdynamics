<?php
// Theme version
define('THEME_VERSION', '0.1');

// Creates absolute url "/wp-content/themes/themename/etc" for use in templates
define('ABSURL', str_replace($_SERVER['DOCUMENT_ROOT'], '', TEMPLATEPATH));

// Define path to our includes directory
define('INCLUDEPATH', dirname(realpath(__FILE__)) . '/includes/');

// get all our other function files
$includeFiles = array(
	'theme', 
	'meta', 
	'content',
	'widgets',
	'shortcodes',
	'post-types'
);

foreach ($includeFiles as $file) {
	$file = INCLUDEPATH . 'functions/' . $file . '.php';

	if (is_file($file)) {
		require_once($file);
	}
}