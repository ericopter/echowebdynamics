<?php
get_header();
?>
<!-- single.php -->
<div id="single" class="sixteen columns">
	<?php 
	while ( have_posts() ) : 
		the_post(); 
		echotheme_post_nav(); 
		get_template_part( 'content', 'single' ); 
		comments_template( '', true ); 
	endwhile; // end of the loop. ?>
</div> <!-- end #single -->
<?php
get_footer();
?>