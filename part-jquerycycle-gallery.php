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

if ($imageCount = $attachments > 0) : 
$id = 'gallery-' . $post->ID;
?>
<div id="<?php echo $id; ?>" class="cycle-gallery">
	<?php
	foreach ( $attachments as $attachment_id => $attachment ) {
		echo wp_get_attachment_image( $attachment_id, 'gallery' );
	}
	?>
</div> <!-- end .cycle-gallery -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#<?php echo $id ?>').cycle();
	});
</script>
<?php
endif;
wp_reset_query();
?>