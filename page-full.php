<?php
/**
 * Template Name: Full Width
 */
get_header();
?>
<!-- page.php -->
<div id="page" class="sixteen columns clearfix">
	<?php
	while(have_posts()):
	the_post();
	get_template_part('content', 'page');
	endwhile;
	?>
</div> <!-- end .sixteen.columns -->
<?php
get_footer();
?>