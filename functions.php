<?php

function metalbook_head_cleanup() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );

} 

// http://www.deluxeblogtips.com/2012/03/better-title-meta-tag.html
function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;
  if ( is_feed() ) return $title;
  if ( 'right' == $seplocation ) {
	$title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

} 

// remove WP version from RSS
function metalbook_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function metalbook_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function metalbook_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

function add_type_attribute($tag, $handle, $src) {
    // if not your script, do nothing and return original $tag
    if ( stripos($handle, 'module') < 1 ) {
        return $tag;
    }
    // change the script tag by adding type="module" and return it.
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}
add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);

function metalbook_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {
		// register main stylesheet
		wp_register_style( 'stylesheet', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), '', 'all' );
		// register main javascript
		wp_register_script( 'functions', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '', 'all' );

		// enqueue styles and scripts
		wp_enqueue_style( 'stylesheet' );
		wp_enqueue_script( 'functions' );
		
	}
}



function metalbook_theme_support() {
	// rss
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat',               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// register menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'metalbook' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'metalbook' ) // secondary nav in footer
		)
	);

} 

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function metalbook_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// modify read more 
function metalbook_excerpt_more($more) {
	global $post;
	return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'metalbook' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'metalbook' ) .'</a>';
}

function metalbook_wp_settings_scss_compile($args = null){
	$compiler = new ScssPhp\ScssPhp\Compiler();
	$compressor = new tubalmartin\CssMin\Minifier();
	
	$source_scss = get_template_directory() . '/assets/sass/main.scss';
	$scssContents = file_get_contents($source_scss);
	$import_path = get_template_directory() . '/assets/sass';
	$compiler->addImportPath($import_path);
	$target_css = get_template_directory() . '/assets/css/main.css';
	$stylesheetRel = explode($_SERVER['SERVER_NAME'],get_template_directory_uri())[1] . '/assets/';
	
	$variables = [
		'$metalbook-assets-path' => $stylesheetRel
	];

	if(!is_null($args)){
		$variables = array_merge($variables, $args);
		$target_css = get_template_directory() . '/assets/css/test.css';
	}

	$compiler->setVariables($variables);
	
	$css = $compiler->compile($scssContents);
	if (!empty($css) && is_string($css)) {
		file_put_contents($target_css, $css);
	}

	$minified_css = $compressor->run(file_get_contents($target_css)); 
	if (!empty($minified_css) && is_string($minified_css)) {
		file_put_contents($target_css, $minified_css);
	}
}

function metalbook_launch() {

	// include composer 
	add_action('init', function(){
		include(get_template_directory(). '/vendor/autoload.php');
	});

	// launching operation cleanup
	add_action( 'init', 'metalbook_head_cleanup' );
	// A better title
	add_filter( 'wp_title', 'rw_title', 10, 3 );
	// remove WP version from RSS
	add_filter( 'the_generator', 'metalbook_rss_version' );
	// remove injected css from comments widget
	add_filter( 'wp_head', 'metalbook_remove_wp_widget_recent_comments_style', 1 );
	add_action( 'wp_head', 'metalbook_remove_recent_comments_style', 1 );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'metalbook_scripts_and_styles', 999 );

	// launching this stuff after theme setup
	metalbook_theme_support();

	// add sidebars
	add_action( 'widgets_init', 'metalbook_register_sidebars' );

	// remove p tags
	add_filter( 'the_content', 'metalbook_filter_ptags_on_images' );
	// modfy excerpt
	add_filter( 'excerpt_more', 'metalbook_excerpt_more' );

	// add wordpress constants to scss
	add_action('after_setup_theme', 'metalbook_wp_settings_scss_compile');

	// build customiser scss
	add_action('customize_save_after', 'metalbook_wp_settings_scss_customiser');

} 

// run actions on init
add_action( 'after_setup_theme', 'metalbook_launch' );



// Sidebars & Widgets
function metalbook_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'metalbook' ),
		'description' => __( 'The first (primary) sidebar.', 'metalbook' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	
} 





?>
