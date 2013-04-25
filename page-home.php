<?php
/**
 * Template Name: Home Page
 */

get_header();
?>
<!-- page-home.php -->
<?php
if (have_posts()) :
	the_post();
?>
<div id="page-home" class="sixteen columns clearfix">
	<?php
	get_template_part('content', 'page');
	?>
</div>

<?php 
endif;
$sticky = get_option('sticky_posts');
$args = array(
	'post__in' => $sticky,
	'posts_per_page' => -1,
	'post_type' => 'post',
);

$query = new WP_Query($args);

if ($query->have_posts() && $sticky[0]) :
?>
<div id="featured-posts" class="sixteen columns">
<?php
	while ($query->have_posts()) :
		$query->the_post();
		get_template_part('content', 'featured');
	endwhile;
?>
</div>
<?php
endif;

get_footer();
?>