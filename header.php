<!doctype html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php wp_title(''); ?></title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<?php /*
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-touch-icon.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png"> 
		<meta name="theme-color" content="#121212">

		*/?>

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body class="" itemscope itemtype="http://schema.org/WebPage">
	<script>document.body.className += ' js-enabled' + ('noModule' in HTMLScriptElement.prototype ? ' metalbook-frontend-supported' : '');</script>
		
	<header class="metalbook-header" data-module="metalbook-header">
		<div class="metalbook-header__container metalbook-width-container">
			<div class="metalbook-header__logo">
				<a href="#" class="metalbook-header__link metalbook-header__link--homepage"> </a>
			</div>
			<div class="metalbook-header__content">
				<a href="<?php echo home_url(); ?>" class="metalbook-header__link metalbook-header__service-name"><?php bloginfo('name'); ?></a>
				<nav aria-label="Menu" class="metalbook-header__navigation">
					<button type="button" class="metalbook-header__menu-button metalbook-js-header-toggle" aria-controls="navigation" hidden>
					Menu
					</button>
						<?php 
						function metalbook_menu_classes($classes, $item, $args) {
							if($args->theme_location == 'main-nav') {
								$classes[] = 'metalbook-header__navigation-item';
							}
							return $classes;
						}
						add_filter('nav_menu_css_class','metalbook_menu_classes',1,3);

						function metalbook_add_link_atts($atts) {
							$atts['class'] = "metalbook-header__link";
							return $atts;
						}
						add_filter( 'nav_menu_link_attributes', 'metalbook_add_link_atts');

						function metalbook_special_nav_class($classes, $item){
							if( in_array('current-menu-item', $classes) ){
								$classes[] = 'metalbook-header__navigation-item--active ';
							}
							return $classes;
						}
						add_filter('metalbook_special_nav_class' , 'special_nav_class' , 10 , 2);
						wp_nav_menu(
							array(
								'container' => false,                           		// remove nav container
								//'items_wrap' => '<ul id="%1$s" class="%2$s metalbook-header__navigation-list">%3$s</ul>',
								'container_class' => '',   // class of container (should you choose to use it)
								'menu' => __( 'The Main Menu', 'metalbook' ),  			// nav name
								'menu_class' => 'metalbook-header__navigation-list',               	// adding custom nav class
								'theme_location' => 'main-nav',                 		// where it's located in the theme
								'before' => '',                                 		//	 before the menu
								'after' => '',                                 			// after the menu
								'link_before' => '',                            		// before each link
								'link_after' => '',                             		// after each link
								'depth' => 0,                                   		// limit the depth of the nav
								'fallback_cb' => '',                             		// fallback function (if there is one)
							)
						);
						
						?>
					</ul>
				</nav>
			</div>
		</div>
	</header>