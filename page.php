<?php
$push = 'left' == of_get_option('sidebar-position') ? 'push_4' : null;
get_header();
?>
<!-- page-sidebar.php -->
<div id="page-sidebar" class="twelve columns <?php echo $push; ?>">
	<?php
	the_post();
	get_template_part('content', 'page');
	?>
</div> <!-- end #page-sidebar -->

<?php
get_sidebar();
get_footer();
?>