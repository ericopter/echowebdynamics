<div class="controls-container flexslider">
	<ul class="slides">
	    <?php
	    while ($slides->have_posts()):
		$slides->the_post();
		
		// get the image and strip the height attribute
		$image = remove_thumbnail_height(get_the_post_thumbnail(get_the_ID(), 'slideshow'));
		
		// should we display the title and content?
		$display_text = get_meta_box_value('_echotheme_slide_display_value');
		if ($display_text == 'true') :
			$title = get_the_title();
			$content = get_the_content();
			$link = get_meta_box_value('_echotheme_slide_url_value');
		endif; // end $display_text
	    ?>
		<li>
			<?php 
			echo $image; 
			if ($display_text == 'true') :
			?>
			<div class="slide-content-container container">
				<article>
					<?php if ($link): ?>
					<a href="<?php echo $link; ?>">
					<?php endif ?>
					<header>
						<?php if ($title): ?>
						<h1>
							<?php echo $title; ?>
						</h1>	
						<?php endif ?>

						<?php if ($content): ?>
						<div>
							<?php echo $content; ?>
						</div>
						<?php endif ?>

					</header>
					<?php if ($link): ?>
					</a>
					<?php endif ?>
				</article>
			</div>
			<?php
			endif; // end $display_text
			?>
		</li>
		<?php
		endwhile;
		?>
	</ul> <!-- end .slides -->
	
	<div class="controls-inner">
		
	</div> <!-- end  -->
</div> <!-- end .flexslider.controls-container -->












<?php
// get the theme options pertaining to the slideshow
$delay = of_get_option('slideshow-delay') ? of_get_option('slideshow-delay') * 1000 : 6000;
$speed = of_get_option('slideshow-speed') ? of_get_option('slideshow-speed') * 100 : 600;
$effect = of_get_option('slideshow-effect');
$direction = of_get_option('slideshow-direction');
$navigation = of_get_option('slideshow-navigation') ? 'true' : 'false';
$pagination = of_get_option('slideshow-pagination') ? 'true' : 'false';
$keyboard = of_get_option('slideshow-keyboard') ? 'true' : 'false';
$reverse = of_get_option('slideshow-direction-reverse') ? 'true' : 'false';
?>
<script type="text/javascript">
	$(window).load(function() {
	    $('.controls-container.flexslider').flexslider(
			{	
				<?php
				// seperate certain options based on type of slideshow transition
				if ($effect == 'sliding') : // we are doing a sliding transition
				?>
				animation : 'slide',
				direction : '<?php echo $direction; ?>',
				reverse : <?php echo $reverse ?>,
				<?php
			endif;
				// else: // we are doing a fading transition
				?>
				controlsContainer: ".controls-container .controls-inner",
				directionNav: <?php echo $navigation ?>,
				<?php
				// endif; // end if sliding/fading
				// now display options common to both
				?>
				controlNav: <?php echo $pagination ?>,
				slideshowSpeed: <?php echo $delay ?>,
				animationSpeed: <?php echo $speed ?>,
				keyboard: <?php echo $keyboard ?>,
				multipleKeyboard: true,
				pauseOnHover: true
			}
		);
	  });
</script>