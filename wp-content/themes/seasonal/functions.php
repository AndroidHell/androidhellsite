<?php
/**
 * Functions and definitions
 *
 * @package Seasonal
 */


// Seasonal only works in WordPress 4.1 or later.
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs before the init hook. 
 * The init hook is too late for some features, such as indicating support for post thumbnails.
 */
if ( ! function_exists( 'seasonal_setup' ) ) :
	function seasonal_setup() {
		
/**
 * Set the content width based on the theme's design and stylesheet.
 * This theme gives you up to 1140 pixels of content width.
 */
 
    global $content_width;
    //Set up the content width value based on the theme's design.
    if ( ! isset( $content_width ) ) {
      $content_width = 1140;
    }
  
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Seasonal, use a find and replace to change 'seasonal' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'seasonal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Add callback for custom TinyMCE editor stylesheets. (editor-style.css)
	 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
	 */
	add_editor_style( );
		
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'seasonal' ),
		'footer'  => esc_html__( 'Footer Menu', 'seasonal' ),
		'social'  => esc_html__( 'Social Menu', 'seasonal' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio',
	) );
	
	/*
	 * Enable support for a custom header.
	 * See https://codex.wordpress.org/Custom_Headers
	 */  
    add_theme_support( 'custom-header', array( 
		'width'       => 300,
		'height'      => 300,
      	'flex-height' => true,
      	'flex-width'  => true
    ) );
    
	/*
	 * Set up the WordPress core custom background feature.
	 * See https://codex.wordpress.org/Custom_Backgrounds
	 */     
    add_theme_support( 'custom-background', array( 
      'default-color'    => '59626d',
      'default-image'    => get_template_directory_uri() .'/images/background.jpg',
	  'wp-head-callback' => 'seasonal_custom_background',
    ) );
	
}
endif; // seasonal_setup
add_action( 'after_setup_theme', 'seasonal_setup' );


/**
 * Register Google fonts.
 * @return string Google fonts URL for the theme.
 */

if ( ! function_exists( 'seasonal_fonts_url' ) ) :
function seasonal_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
		if( esc_attr(get_theme_mod( 'load_cyrillic_subset', 0 ) ) ) : 
			$subsets   = 'cyrillic, cyrillic-ext';
		else: 
			$subsets   = 'latin,latin-ext';
		endif;

	/*
	 * Translators: If there are characters in your language that are not supported by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'seasonal' ) ) {
		$fonts[] = 'Open Sans:300,400,600';
	}

	/*
	 * Translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== esc_html_x( 'on', 'Playfair Display font: on or off', 'seasonal' ) ) {
		$fonts[] = 'Playfair Display:400,400italic';
	}	

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 *
 */
function seasonal_scripts() {
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'seasonal-fonts', seasonal_fonts_url(), array(), null );
	
	// Add Font Awesome Icons. Unminified version included.
	if( esc_attr(get_theme_mod( 'load_fontawesome', 1 ) ) ) :
		wp_enqueue_style('fontAwesome', get_template_directory_uri() . '/css/fontawesome.min.css', array(), '4.3.0' );
	endif;
	
	// Load our responsive stylesheet based on Bootstrap
	if( esc_attr(get_theme_mod( 'load_bootstrap', 1 ) ) ) :
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array( ), '3.3.4' );
	endif;
	
	// Load our main stylesheet.
	wp_enqueue_style( 'seasonal-style', get_stylesheet_uri() );

	// Load our scripts
	wp_enqueue_script( 'seasonal-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	// Enqueue ie html5 shiv.

	global $wp_scripts;
	wp_enqueue_script( 'seasonal-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3', false );
	$wp_scripts->add_data( 'seasonal-html5', 'conditional', 'lt IE 9' );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'seasonal-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'seasonal-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'seasonal' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'seasonal' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'seasonal_scripts' );




/**
 * Add template tags.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Add the customizer theme options.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add Jetpack support.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add custom background support for select pages.
 */
require get_template_directory() . '/inc/custom-backgrounds.php';

/**
 * Add customized comments layout.
 */
require get_template_directory() . '/inc/comment-layout.php';

/**
 * Add inline styles from the customizer.
 */
require get_template_directory() . '/inc/inline-styles.php';

/**
 * Add sidebars.
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Theme information
 */
require get_template_directory() . '/inc/theme-info.php';