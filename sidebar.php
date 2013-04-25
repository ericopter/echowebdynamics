<!-- sidebar.php -->
<?php
$pull = 'left' == of_get_option('sidebar-position') ? 'pull_12' : null;
?>
<div id="sidebar" class="four columns <?php echo $pull; ?>">
	<?php 
	 // Reach for the appropriate Sidebar
	if ((is_archive() || is_home() || is_single() || is_search()) && is_active_sidebar('sidebar_posts')) {
		
		dynamic_sidebar('sidebar_posts');
		
	} elseif (is_page() && is_active_sidebar('sidebar_pages')) {
		
		dynamic_sidebar('sidebar_pages');
		
	} elseif (is_front_page() && is_active_sidebar('sidebar_home')) {
		
		dynamic_sidebar('sidebar_home');
		
	} else {
	
		if (is_active_sidebar('sidebar')) {
			dynamic_sidebar('sidebar');
		}
	
	} 
	?>
</div> <!-- end #sidebar -->