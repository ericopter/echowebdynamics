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
$attachments[$post_thumbnail_id] = get_the_post_thumbnail($post->id, 'gallery');

if ($imageCount = count($attachments) > 0):
?>
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
    <div id="slider" class="nivoSlider">
<?php
	foreach ($attachments as $attachment_id => $attachment):
		echo wp_get_attachment_image( $attachment_id, 'gallery' );
	endforeach;
?>
	</div>
</div>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});
</script>
<?php
endif;
?>