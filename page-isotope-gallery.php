<?php
/**
 * Template Name: Isotope Gallery
 * Description: A 3 Column Shadowbox portfolio
 *
 */
define('SHADOWBOX', true);
echotheme_load_isotope();
get_header();
?>
<!-- page-portfolio-3.php -->
<div id="page-portfolio-3" class="sixteen columns">
	<?php
	the_post();
	get_template_part('content', 'page');
	?>
</div> <!-- end #portfolio -->

<?php

// get category, and find out ID
$categoryName = get_custom_value('category-slug');
if ($categoryName) {
	$term = get_term_by('name', $categoryName, 'category');
	$categoryId =  $term->term_id;

	// find the requested cat sub-cats
	$subCategories = get_categories('parent='.$categoryId);

	// build the filters controls
	$filters = '<div id="isotope-filters" class="sixteen columns"><a class="button-link selected" href="#" data-filter="*">All</a> ';
	foreach($subCategories as $subCat) {
		$filters .= '<a class="button-link" href="#" data-filter=".'. $subCat->slug . '">' . $subCat->name . '</a> ';
	}
	$filters .= '</div><div class="clear"></div>';

	// get the posts under the category
	$args = array(
		'post_type' => 'post',
		'category_name' => $categoryName,
		'posts_per_page' => -1
	);

	$items = new WP_Query($args);

	if ($items->have_posts()) :
	echo $filters;
	?>

	<div id="isotope-portfolio">
	<?php
	while ($items->have_posts()) :

	$items->the_post();

	// get each posts gategories, their slugs and join
	$categories = wp_get_post_categories($post->ID);
	$cats = array();
	foreach ($categories as $category) {
		$cat = get_category($category);
		$cats[] = $cat->slug;
	}
	$cats = implode(' ', $cats);

	$title = get_the_title();
	$image = get_the_post_thumbnail(get_the_ID(), 'fours');
	if ($image) :
		// alter image html for the display
		$image = set_isotope_image_width($image);
		
		// get the link to the original image
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	?>
	<div class="item image-frame <?php echo $cats; ?>">
		<a href="<?php echo $large_image_url[0]; ?>" class="shadowbox">
			<?php echo $image; ?>
		</a>
	</div>
	<?php
	endif;
	endwhile;
	?> 
	</div>
	<script type="text/javascript">
	$(window).load(function() {
		// Shadowbox
		Shadowbox.init(
			{
				skipSetup : true
			}
		);

		Shadowbox.setup(
			"a.shadowbox", 
			{
				'gallery' : 'Images',
				'continuous' : true
			}
		);

		// Isotope
		var $container = $('#isotope-portfolio');
		$container.isotope();

		$('#isotope-filters a').click(function(){
		 	var selector = $(this).attr('data-filter');
		 	$container.isotope({ filter: selector });

			// add class "selected" to filter button
			if (!$(this).hasClass('selected')) {
				$('#isotope-filters a').removeClass('selected');
				$(this).addClass('selected');
			};

			var gallery = selector + ' a.shadowbox';

			Shadowbox.setup(
				gallery,
				{
					'gallery' : selector,
					'continuous' : true
				}
			);
		 	return false;
		});
	});

	</script>
<?php
endif;
}
get_footer();
?>