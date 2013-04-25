<?php
// Get the slideshow stuff and show it!
$args = array(
	'post_type' => 'echotheme_slideshow',
	'posts_per_page' => -1,
	'orderby' => 'menu_order'
);

$query = new WP_Query($args);
if ($query->have_posts()) :

if (of_get_option('home-slideshow-width') == 'framed'): ?>
<div class="container">
<?php endif ?>

<div id="home-slideshow" class="controls-container">
<div class="flexslider sixteen columns">
	<ul class="slides">

<?php
while ($query->have_posts()):
$query->the_post();

$attr = array(
	'title' => ''
);

$image = get_the_post_thumbnail(get_the_ID(), 'slideshow', $attr);

// remove the height for the flexslider
$image = remove_thumbnail_height($image);

// should we display the title and content?
$display_text = get_meta_box_value('_echotheme_slide_display_value');
if ($display_text == 'true') :
	$title = get_the_title();
	$content = get_the_content();
	$link = get_meta_box_value('_echotheme_slide_url_value');
endif; // end $display
?>
		<li>
			<?php 
			echo $image; 
			if ($display_text): 
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

	</ul>
	<?php 
	// if doing a fading slideshow, place controls wrapper
	if ('sliding' != of_get_option('slideshow-effect')): 
	?>
	<div class="controls-inner"></div>
	<?php 
	endif; 
	?>
	
</div> <!-- end .flexslider -->
</div> <!-- end #home-slideshow -->
<?php
if (of_get_option('home-slideshow-width') == 'centered'): ?>
</div>
<?php 
endif;
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
	    $('#home-slideshow').flexslider(
			{	
				<?php
				// seperate certain options based on type of slideshow transition
				if ($effect == 'sliding') : // we are doing a sliding transition
				?>
				animation : 'slide',
				direction : '<?php echo $direction; ?>',
				reverse : <?php echo $reverse ?>,
				<?php
				else: // we are doing a fading transition
				?>
				controlsContainer: "#home-slideshow.controls-container .controls-inner",
				directionNav: <?php echo $navigation ?>,
				<?php
				endif; // end if sliding/fading
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
<?php
endif;
?>