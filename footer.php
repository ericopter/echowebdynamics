			</div> <!-- .container -->
		</div> <!-- #content -->
		
		<div id="footer">
			<div class="container">
				<?php	
				if (is_front_page() && is_active_sidebar('footer_home')) {
					
					dynamic_sidebar('footer_home');
					
				} elseif ((is_archive() || is_single() || is_home()) && is_active_sidebar('footer_posts')) { 
					
					dynamic_sidebar('footer_posts');
					
				} elseif (is_page() && is_active_sidebar('footer_pages')) {
					
					dynamic_sidebar('footer_pages');
					
				} else { 
					
					if (is_active_sidebar('footer_default')) {
						dynamic_sidebar('footer_default');
					}
					
				} 
				?>
			</div> 
		</div> <!-- end #footer -->
		<?php
		$footer_copy = of_get_option('footer-copy');
		
		/**
		 * Output the main menu if set
		 */
		$args = array(
			'theme_location' 	=> 'footer-menu',
			'container'       	=> false,
			// 'container_class' 	=> 'container',
			'menu_id'        	=> 'footer-nav',
			'menu_class'		=> 'hori-nav container',
			'echo'				=> false,
			'fallback_cb' 		=> false,
			'depth'				=> 1
		);
		$menu = wp_nav_menu($args);
		
		/**
		 * If one or both output container
		 */
		if ($footer_copy || $menu) :
		?>
		<div id="sub-footer">
			<div class="container">
				<?php
				if ($menu) {
					echo $menu;
				}
				if ($footer_copy) :
				?>
				<div id="footer-copy" class="sixteen columns">
					<?php echo $footer_copy ?>
				</div>
				<?php
				endif;
				?>
			</div> 
		</div> <!-- end #primary-nav -->
		<?php
		endif;
		?>
		
	</div> <!-- #wrapper -->
	<?php 
	wp_footer(); 
	?>
</body>
</html>