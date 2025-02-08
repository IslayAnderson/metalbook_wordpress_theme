			<footer class="metalbook-footer">
				<div class="metalbook-width-container">
					<div class="metalbook-footer__meta">
						<div class="metalbook-footer__meta-item metalbook-footer__meta-item--grow">
							<?php get_sidebar(); ?>
							<h2 class="metalbook-visually-hidden"><!-- widget --></h2>
							<ul class="metalbook-footer__inline-list">
								<?php wp_nav_menu(array(
									'container' => '',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
									'container_class' => 'metalbook-footer__inline-list-item',         // class of container (should you choose to use it)
									'menu' => __( 'Footer Links', 'metalbook' ),   // nav name
									'menu_class' => 'metalbook-footer__link',            // adding custom nav class
									'theme_location' => 'footer-links',             // where it's located in the theme
									'before' => '',                                 // before the menu
									'after' => '',                                  // after the menu
									'link_before' => '',                            // before each link
									'link_after' => '',                             // after each link
									'depth' => 0,                                   // limit the depth of the nav
									'fallback_cb' => 'metalbook_footer_links_fallback'  // fallback function
									)); 
								?>
							</ul>
							<span class="metalbook-footer__licence-description"><!-- widget --></span>
						</div>
						<div class="metalbook-footer__meta-item">
							<a class="metalbook-footer__link metalbook-footer__copyright-logo" href="">© <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></a>
						</div>
					</div>
				</div>
			</footer>
			
		<?php wp_footer(); ?>
		<script type="module">
			import { initAll } from '<?= get_stylesheet_directory_uri() . '/assets/js/metalbook-frontend.min.js' ?>'
			initAll()
		</script>

	</body>

</html> 
