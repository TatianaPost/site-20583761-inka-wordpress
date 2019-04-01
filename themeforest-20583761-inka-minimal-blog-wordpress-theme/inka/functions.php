<?php
/**
 * Theme functions and definitions
 *
 * @package Inka
 */

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

// Constants
define('DEOTHEMEDIR', get_template_directory() );
define('DEOTHEMEURI', get_template_directory_uri() );
define('DEOPRODUCTION', true );


if ( ! function_exists( 'deo_theme_setup' ) ) :
// Sets up theme defaults and registers support for various WordPress features.
function deo_theme_setup() {

	load_theme_textdomain( 'inka', get_template_directory() . '/languages' );

	// Enable theme support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( "title-tag" );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'gallery', 'quote', 'link', ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background', apply_filters( 'deo_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	// Gutenberg
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style();

	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => esc_html__( 'red', 'inka' ),
			'slug' => 'red',
			'color' => '#E04F62',
		),
		array(
			'name' => esc_html__( 'green', 'inka' ),
			'slug' => 'green',
			'color' => '#c8dcd2',
		),

		array(
			'name' => esc_html__( 'blue', 'inka' ),
			'slug' => 'blue',
			'color' => '#b3c6d2',
		),
		array(
			'name' => esc_html__( 'lavender', 'inka' ),
			'slug' => 'lavender',
			'color' => '#c5b1da',
		),
		array(
			'name' => esc_html__( 'light-pink', 'inka' ),
			'slug' => 'light-pink',
			'color' => '#f9eded',
		),
		array(
			'name' => esc_html__( 'dark-grey', 'inka' ),
			'slug' => 'dark-grey',
			'color' => '#333333',
		),
	) );


	// Set size of thumbnails
	update_option( 'thumbnail_size_w', 92 );
	update_option( 'thumbnail_size_h', 65 );
	update_option( 'thumbnail_crop', 1 );

	update_option( 'large_size_w', 814 );
	update_option( 'large_size_h', 571 );
	update_option( 'large_crop', 1 );

	update_option( 'medium_size_w', 387 );
	update_option( 'medium_size_h', 272 );
	update_option( 'medium_crop', 1 );


	// Nav menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'inka' ),
	) );

}
endif; // theme_setup
add_action( 'after_setup_theme', 'deo_theme_setup' );


// Register widget areas
function deo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'inka' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Instagram', 'inka' ),
		'id'            => 'deo-footer-instagram',
		'before_widget' => '<div id="%1$s" class="instagram-feed instagram-feed--wide text-center %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="instagram-feed__title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'deo_widgets_init' );


// TGMPA plugins activation
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'deo_tgmpa_register_required_plugins' );

function deo_tgmpa_register_required_plugins() {

	$plugins = array(		

		array(
			'name'             => 'Deo Core',
			'slug'             => 'deo-core',
			'source'           => DEOTHEMEDIR . '/includes/plugins/deo-core.zip',
			'required'         => true,
			'version'          => '1.0.1',
			'force_activation' => false,
		),

		array(
			'name'             => 'Envato Market',
			'slug'             => 'envato-market',
			'source'           => DEOTHEMEDIR . '/includes/plugins/envato-market.zip',
			'required'         => false,
			'version'          => '2.0.1',
			'force_activation' => false,
		),

		array(
			'name'      => 'Kirki',
			'slug'      => 'kirki',
			'required'  => true,
		),

		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		array(
			'name'      => 'WP Instagram Widget',
			'slug'      => 'wp-instagram-widget',
			'required'  => false,
		),

		array(
			'name'      => 'MailChimp for WordPress',
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'      => 'One Click Demo Import',
			'slug'      => 'one-click-demo-import',
			'required'  => false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => true,
		'message'      => '',

		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'inka' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'inka' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'inka' ),
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'inka' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'inka' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'inka' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'inka' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'inka' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'inka' ),
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'inka' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'inka' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'inka' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'inka' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'inka' ),
			'nag_type'                        => 'updated',
		),

	);

	tgmpa( $plugins, $config );
}


// Demo Import
function deo_ocdi_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Import 1',
			'categories'                   => array( 'Category 1', 'Category 2' ),
			'local_import_file'            => trailingslashit( DEOTHEMEDIR ) . 'includes/demo-import/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( DEOTHEMEDIR ) . 'includes/demo-import/widgets.wie',
			'local_import_customizer_file' => trailingslashit( DEOTHEMEDIR ) . 'includes/demo-import/customizer.dat'
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'deo_ocdi_import_files' );



// Includes
require 'includes/theme-functions.php';
require 'includes/class-nav-walker.php';
require 'includes/class-comments-walker.php';
require 'includes/customizer.php';


/**
 * Theme styles
 */
function deo_theme_styles() {
	wp_enqueue_style( 'bootstrap', DEOTHEMEURI . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'deo-font-icons', DEOTHEMEURI . '/assets/css/font-icons.css' );
	wp_enqueue_style( 'deo-styles', get_stylesheet_uri(), array( 'bootstrap', 'deo-font-icons' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'deo_theme_styles' );


// Add backend styles for Gutenberg.
add_action( 'enqueue_block_editor_assets', 'deo_gutenberg_assets' );

// Load Gutenberg stylesheet.
function deo_gutenberg_assets() {
	wp_enqueue_style( 'deo-gutenberg-editor-styles', get_theme_file_uri( '/assets/css/gutenberg-editor-style.css' ), false );
}


/**
 * Theme scripts
 */
function deo_theme_js() {
	wp_enqueue_script( 'bootstrap', DEOTHEMEURI . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'easing', DEOTHEMEURI . '/assets/js/easing.js', array( 'jquery' ), '1.3', true );
	wp_enqueue_script( 'owl-carousel', DEOTHEMEURI . '/assets/js/owl-carousel.js', array( 'jquery' ), '2.2.1', true );
	wp_enqueue_script( 'modernizr', DEOTHEMEURI . '/assets/js/modernizr.js', array( 'jquery' ), '3.4.0', true );
	wp_enqueue_script( 'deo-scripts', DEOTHEMEURI . '/assets/js/scripts.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'deo_theme_js' );


/**
 * WP Customizer styles and scripts
 */
function deo_customizer_enqueue_scripts() {
	wp_enqueue_style( 'deo-customizer-styles', DEOTHEMEURI . '/assets/css/customizer/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'deo_customizer_enqueue_scripts' );