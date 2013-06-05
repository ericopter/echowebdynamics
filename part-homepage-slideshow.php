<?php
/**
 * part-homepage-gallery.php
 * 
 * file will include the proper slideshow type selected from the options panel
 */

// First get our slideshow posts
$args = array(
	'post_type' => 'echotheme_slideshow',
	'posts_per_page' => -1,
	'orderby' => 'menu_order'
);

$slides = new WP_Query($args);

if (!$slides->have_posts()) {
	return;
}

// get slideshow preferences from option panel

if (of_get_option('home-slideshow-layout') == 'framed') {
	$wrapperClass = 'framed container';
} else {
	$wrapperClass = 'fullwidth';
}
$slideshowType = of_get_option('home-slideshow-type');

// Create the outer markup
?>
<div id="homepage-slideshow" class="<?php echo $wrapperClass; ?>">
	<?php include "part-slideshow-" . $slideshowType . ".php"; ?>
</div> <!-- end #homepage-gallery -->