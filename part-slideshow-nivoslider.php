<?php

?>
<div class="slider-wrapper theme-default">
	<div class="ribbon"></div>
    <div id="slider" class="nivoSlider">
<?php
	while ($slides->have_posts()) :
		$slides->the_post();
		$image = remove_thumbnail_height(get_the_post_thumbnail(get_the_ID(), 'slideshow'));
		echo $image;
	endwhile;
?>
	</div>
</div>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});
</script>