<?php
// display flex gallery only on pages and posts
if (!is_single() && !is_page()) {
	return null;
}

$args = array(
/* 	'order' 		=> 'ASC', */
	'orderby'        => 'rand',
    'post_type'      => 'attachment',
    'post_parent'    => $post->ID,
    'post_mime_type' => 'image',
    'post_status'    => null,
    'numberposts'    => -1,
);
$attachments = get_children( $args );

// add featured image to the array
$post_thumbnail_id = get_post_thumbnail_id($post->ID);
if ($post_thumbnail_id) {
	$attachments[$post_thumbnail_id] = get_the_post_thumbnail($post->ID, 'gallery');
}


// only continue if we have at least one of something
if ($imageCount = count($attachments) > 0) :
$id = 'flexgallery-' . $post->ID;
?>
<div id="<?php echo $id ?>" class="gallery-slideshow controls-container">
	<div class="flexslider">
		<ul class="slides">
			<?php
			
			foreach ( $attachments as $attachment_id => $attachment ) {
			?>
			<li>
				<?php echo wp_get_attachment_image( $attachment_id, 'gallery' ); ?>
			</li>
			<?php
			}
			?>
		</ul>
		<div class="controls-inner"></div>
	</div>
</div>
<script type="text/javascript">
	$(window).load(function() {
	    $('#<?php echo $id; ?>.gallery-slideshow').flexslider(
			{
				<?php if (count($attachments) > 1): ?>
				controlsContainer: "#<?php echo $id; ?>.gallery-slideshow.controls-container .controls-inner",
				pauseOnHover: true,
				<?php endif; ?>
			}
		);
	  });
</script>
<?php
endif;
wp_reset_query();
?>