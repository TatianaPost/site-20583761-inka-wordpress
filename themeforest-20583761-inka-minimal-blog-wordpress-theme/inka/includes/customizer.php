<?php
/**
 * Theme Customizer
 *
 * @package Inka
 */


function deo_customize_register( $wp_customize ) {

	// Customize Background Settings
	$wp_customize->get_section('background_image')->title = esc_html__('Background Styles', 'inka');
	$wp_customize->get_control('background_color')->section = 'background_image';


	// Footer Copyright
	$wp_customize->add_setting( 'deo_footer_bottom_text', array(
		'capability' => 'edit_theme_options',
		'default' => sprintf(esc_html__( 'Inka, made by %1$sDeoThemes%2$s' , 'inka' ),
		'<a href="https://deothemes.com">',
		'</a>'),
		'sanitize_callback' => 'deo_sanitize_html',
	 ) );

	$wp_customize->add_control( 'deo_footer_bottom_text', array(
		'type'        => 'text',
		'section'     => 'deo_footer',
		'label'       => esc_html__( 'Footer bottom text', 'inka' ),
		'description' => esc_html__( 'Allowed HTML: a, span, i, em, strong', 'inka' ),
		'priority'    => 30,
	) );
}
add_action( 'customize_register', 'deo_customize_register' );


// Check if Kirki is installed
if ( class_exists( 'Kirki' ) ) {

	// Selector Vars
	$selector = array(
		'main_color'      => 'a, .loader, .widget_recent_entries ul li a:hover, .recent-posts-title a:hover, .owl-next:hover i, .owl-prev:hover i, .socials--nobase a:hover, .entry__title:hover a, .entry__meta li a:hover, .instagram-feed > p a:hover, .entry-tags a:hover, .related-posts__entry-title a:hover, .comment-edit-link, .widget_categories li a:hover, .widget-popular-posts__entry-title a:hover, .nav__menu > li > a:hover, .nav__menu .active > a, .nav__dropdown-menu > li > a:hover, .nav__dropdown-submenu > .nav__dropdown-menu > li > a:hover, .entry__meta__category',
		'main_background_color' => '.entry__meta__category:before, .entry__meta__category:after, .btn:hover, .btn-color, .btn-button:hover, .btn-button:focus, .owl-page.active span, .owl-carousel.dark-dots .owl-page.active span, .socials a:hover, .pagination__link a:hover, .mc4wp-form-fields input[type=submit]:hover, .widget_tag_cloud a:hover, .nav__icon-toggle:focus .nav__icon-toggle-bar, .nav__icon-toggle:hover .nav__icon-toggle-bar, #back-to-top:hover, .pagination span:not(span):hover, .pagination a:not(span):hover, .woocommerce-pagination span:not(span):hover, .woocommerce-pagination a:not(span):hover',
		'main_border_color' => 'input:focus, textarea:focus, .entry__read-more',
		'nav_background_color' => '.nav',
		'nav_links_color' => 
			'.nav__menu > li > a,
			.nav__socials a,
			.nav__search-input,
			.nav__search-submit,
			.nav__dropdown-trigger,
			.nav__search-mobile-button,
			.nav__search-mobile-input
		',

		'subscribe_background_color' => '.sidebar .widget_mc4wp_form_widget',
		'headings'        => 'h1,h2,h3,h4,h5,h6',
		'h1'              => 'h1',
		'h2'              => 'h2',
		'h3'              => 'h3',
		'h4'              => 'h4',
		'h5'              => 'h5',
		'h6'              => 'h6',
		'text'            => 'body',
		'meta'            => '.entry__meta__date, .entry__meta__comments a',
	);

	// Kirki
	Kirki::add_config( 'deo_config', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
		'option_name'   => 'deo_config'
	) );


	/**
	* SECTIONS / PANELS
	**/

	$priority = 20;

	// Preloader
	Kirki::add_section( 'deo_preloader', array(
		'title'          => esc_html__( 'Preloader', 'inka' ),
		'description'    => esc_html__( 'Theme Preloader Options', 'inka' ),
		'priority'       => $priority,
		'capability'     => 'edit_theme_options',
	) );

	// Navigation
	Kirki::add_section( 'deo_navigation', array(
		'title'          => esc_html__( 'Navigation', 'inka' ),
		'description'    => esc_html__( 'Navigation options', 'inka' ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );

	// Featured Slider
	Kirki::add_section( 'deo_featured_slider', array(
		'title'          => esc_html__( 'Featured Slider', 'inka' ),
		'description'    => esc_html__( 'Featured Slider options', 'inka' ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );

	// Blog PANEL
	Kirki::add_panel( 'deo_blog', array(
		'title'          => esc_html__( 'Blog', 'inka' ),
		'priority'       => $priority++,
	) );

			// Post Excerpt
			Kirki::add_section( 'deo_post_excerpt', array(
				'title'          => esc_html__( 'Post Excerpt', 'inka' ),
				'panel'					 => 'deo_blog',
				'capability'     => 'edit_theme_options',
			) );

			// Post Meta
			Kirki::add_section( 'deo_post_meta', array(
				'title'          => esc_html__( 'Post Meta', 'inka' ),
				'panel'					 => 'deo_blog',
				'capability'     => 'edit_theme_options',
			) );

			// Pagination
			Kirki::add_section( 'deo_blog_pagination', array(
				'title'          => esc_html__( 'Pagination', 'inka' ),
				'panel'					 => 'deo_blog',
				'capability'     => 'edit_theme_options',
			) );

			// Single Post
			Kirki::add_section( 'deo_single_post', array(
				'title'          => esc_html__( 'Single Post', 'inka' ),
				'panel'					 => 'deo_blog',
				'capability'     => 'edit_theme_options',
			) );

			// Socials Share
			Kirki::add_section( 'deo_socials_share', array(
				'title'          => esc_html__( 'Socials Share Icons', 'inka' ),
				'panel'					 => 'deo_blog',
				'capability'     => 'edit_theme_options',
			) );

	// Layout PANEL
	Kirki::add_panel( 'deo_layout', array(
		'title'          => esc_html__( 'Layout', 'inka' ),
		'priority'       => $priority++,
	) );

			// Blog Layout
			Kirki::add_section( 'deo_blog_layout', array(
				'title'          => esc_html__( 'Blog', 'inka' ),
				'description'    => esc_html__( 'Layout options for blog pages', 'inka' ),
				'panel'					 => 'deo_layout',
				'capability'     => 'edit_theme_options',
			) );

			// Archives Layout
			Kirki::add_section( 'deo_archives_layout', array(
				'title'          => esc_html__( 'Archives', 'inka' ),
				'description'    => esc_html__( 'Layout options for archives and categories pages', 'inka' ),
				'panel'					 => 'deo_layout',
				'capability'     => 'edit_theme_options',
			) );

			// Page Layout
			Kirki::add_section( 'deo_page_layout', array(
				'title'          => esc_html__( 'Page', 'inka' ),
				'description'    => esc_html__( 'Layout options for regular pages', 'inka' ),
				'panel'					 => 'deo_layout',
				'capability'     => 'edit_theme_options',
			) );

	// Colors
	Kirki::add_section( 'deo_colors', array(
		'title'          => esc_html__( 'Colors', 'inka' ),
		'description'    => esc_html__( 'Change colors settings', 'inka'  ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );

	// Typography
	Kirki::add_section( 'deo_typography', array(
		'title'          => esc_html__( 'Typography', 'inka' ),
		'description'    => esc_html__( 'Change typography settings', 'inka'  ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );

	// Socials
	Kirki::add_section( 'deo_socials', array(
		'title'          => esc_html__( 'Socials', 'inka' ),
		'description'    => esc_html__( 'Socials options. Paste your social profile links here', 'inka'  ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );

	// Footer
	Kirki::add_section( 'deo_footer', array(
		'title'          => esc_html__( 'Footer', 'inka' ),
		'description'    => esc_html__( 'Footer options', 'inka' ),
		'priority'       => $priority++,
		'capability'     => 'edit_theme_options',
	) );



	/**
	* CONTROLS
	**/

	// Logo Image Upload
	Kirki::add_field( 'deo_config', array(
		'type'        => 'image',
		'settings'    => 'deo_logo_image_upload',
		'label'       => esc_attr__( 'Upload Logo', 'inka' ),
		'section'     => 'title_tagline',
		'default'     => get_template_directory_uri() . '/assets/img/logo.png',
	) );

	// Logo Retina Image Upload
	Kirki::add_field( 'deo_config', array(
		'type'        => 'image',
		'settings'    => 'deo_logo_retina_image_upload',
		'label'       => esc_attr__( 'Upload Retina Logo', 'inka' ),
		'description' => esc_html__( 'Logo 2x bigger size', 'inka' ),
		'section'     => 'title_tagline',
		'default'     => get_template_directory_uri() . '/assets/img/logo@2x.png',
	) );


	// Preloader control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_preloader_settings',
		'label'       => esc_html__( 'Enable/Disable Theme Preloader', 'inka' ),
		'section'     => 'deo_preloader',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );
	

	/**
	* Navigation
	*/

	// Sticky nav control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_sticky_nav_settings',
		'label'       => esc_html__( 'Sticky Navbar', 'inka' ),
		'section'     => 'deo_navigation',
		'default'     => 1,
	) );

	// Navbar height
	Kirki::add_field( 'deo_config', array(
		'type'        => 'slider',
		'settings'    => 'deo_navbar_height',
		'label'       => esc_html__( 'Navbar Height', 'inka' ),
		'description' => esc_html__( 'Applies only on a big screens', 'inka' ),
		'section'     => 'deo_navigation',
		'default'     => 54,
		'choices'     => array(
			'min'   => 54,
			'max' => 120,
			'step' => 1,
		),
		'output'   => array(
			array(
				'element'     => '.nav__menu > li > a, .nav--sticky.sticky .nav__menu > li > a',
				'property'    => 'line-height',
				'units'       => 'px',
				'media_query' => '@media (min-width: 992px)',
			),
			array(
				'element'     => '.nav, .nav--sticky, .nav.sticky, .nav--sticky.sticky',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (min-width: 992px)',
			)
		),
	));	

	// Navbar Socials
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_navbar_socials_show',
		'label'       => esc_html__( 'Show Navbar Socials', 'inka' ),
		'section'     => 'deo_navigation',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Navbar Search
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_navbar_search_show',
		'label'       => esc_html__( 'Show Navbar Search', 'inka' ),
		'section'     => 'deo_navigation',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );


	/**
	* Featured Slider
	*/

	// Featured Slider Show control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_featured_slider_show_settings',
		'label'       => esc_html__( 'Show Featured Slider', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Featured Slider Posts control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'number',
		'settings'    => 'deo_featured_slider_posts_settings',
		'label'       => esc_html__( 'How many posts to show', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => 3,
		'choices'     => array(
			'min'   => 0,
			'max' => 10,
			'step' => 1,
		),
	) );

	// Featured Slider Categories control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'select',
		'settings'    => 'deo_featured_slider_categories_settings',
		'label'       => esc_html__( 'Choose featured category', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => 0,
		'choices'     => deo_categories_dropdown(),
	) );

	// Featured Slider Posts ID controls
	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_featured_slider_posts_id_settings',
		'label'       => esc_html__( 'Choose specific posts by ID', 'inka' ),
		'description' => esc_html__( 'Paste posts ID\'s separated by commas. This will overwrite featured category settings.', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => esc_attr( '' ),
	) );


	// Featured Hero Show control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_featured_hero_show_settings',
		'label'       => esc_html__( 'Show Featured Hero', 'inka' ),
		'description' => esc_html__( 'Show single hero post. Turn off the slider switch to see the effect.', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => 0,
		'choices'     => array(
			'on'   => esc_html__( 'On', 'inka' ),
			'off' => esc_html__( 'Off', 'inka' ),
		),
	) );

	// Featured Hero Posts ID controls
	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_featured_hero_posts_id_settings',
		'label'       => esc_html__( 'Choose specific post by ID', 'inka' ),
		'description' => esc_html__( 'Paste your featured post ID here.', 'inka' ),
		'section'     => 'deo_featured_slider',
		'default'     => esc_attr( '' ),
	) );



	/**
	* Blog / Post Excerpt
	*/

	// Posts excerpt show
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_post_excerpt_show',
		'label'       => esc_attr__( 'Show posts excerpt', 'inka' ),
		'section'     => 'deo_post_excerpt',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Posts excerpt words
	Kirki::add_field( 'deo_config', array(
		'type'        => 'number',
		'settings'    => 'deo_post_excerpt_words',
		'label'       => esc_attr__( 'Number of excerpt words', 'inka' ),
		'section'     => 'deo_post_excerpt',
		'default'     => 55,
		'choices'     => array(
			'min'  => 0,
			'max'  => 9999,
			'step' => 1,
		),
	) );


	/**
	* Blog / Post Meta
	*/

	// Meta category
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_posts_category_settings',
		'label'       => esc_attr__( 'Show meta category', 'inka' ),
		'section'     => 'deo_post_meta',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Meta date
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_posts_date_settings',
		'label'       => esc_attr__( 'Show meta date', 'inka' ),
		'section'     => 'deo_post_meta',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Meta comments
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_posts_comments_settings',
		'label'       => esc_attr__( 'Show meta comments', 'inka' ),
		'section'     => 'deo_post_meta',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );


	/**
	* Blog / Pagination
	*/

	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio',
		'settings'    => 'deo_pagination_type',
		'label'       => __( 'Pagination type', 'inka' ),
		'section'     => 'deo_blog_pagination',
		'default'     => 'numbers',
		'choices'     => array(
			'buttons'   => esc_attr__( 'Buttons', 'inka' ),
			'numbers' => esc_attr__( 'Numbers', 'inka' ),
		),
	) );


	/**
	* Blog / Single Post
	*/

	// Posts Tags control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_posts_tags_settings',
		'label'       => esc_attr__( 'Show post tags', 'inka' ),
		'section'     => 'deo_single_post',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Related Posts control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_posts_related_settings',
		'label'       => esc_attr__( 'Show related posts', 'inka' ),
		'section'     => 'deo_single_post',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );


	/**
	* Blog / Socials Share Icons
	*/

	// Post share icons control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'switch',
		'settings'    => 'deo_post_share_icons_show',
		'label'       => esc_attr__( 'Show share icons', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => 1,
		'choices'     => array(
			'on'   => esc_attr__( 'On', 'inka' ),
			'off' => esc_attr__( 'Off', 'inka' ),
		),
	) );

	// Facebook Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_facebook',
		'label'       => esc_attr__( 'Facebook', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );

	// Twitter Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_twitter',
		'label'       => esc_attr__( 'Twitter', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );		

	// Google Plus Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_google_plus',
		'label'       => esc_attr__( 'Google Plus', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );

	// Linkedin Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_linkedin',
		'label'       => esc_attr__( 'Linkedin', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => false,
	) );

	// Pinterest Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_pinterest',
		'label'       => esc_attr__( 'Pinterest', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );

	// Pocket Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_pocket',
		'label'       => esc_attr__( 'Pocket', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );

	// Email Share
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_share_email',
		'label'       => esc_attr__( 'Email', 'inka' ),
		'section'     => 'deo_socials_share',
		'default'     => true,
	) );


	/**
	* Layout
	*/

	// Post Layout
	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio-image',
		'settings'    => 'deo_post_layout_type',
		'label'       => esc_html__( 'Post layout type', 'inka' ),
		'section'     => 'deo_blog_layout',
		'default'     => 'grid',
		'choices'     => array(
			'grid'   => get_template_directory_uri() . '/assets/img/customizer/grid.png',
			'list' => get_template_directory_uri() . '/assets/img/customizer/list.png',
		),
	) );

	// Blog Layout
	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio-image',
		'settings'    => 'deo_blog_layout_type',
		'label'       => esc_html__( 'Blog layout type', 'inka' ),
		'section'     => 'deo_blog_layout',
		'default'     => 'right-sidebar',
		'choices'     => array(
			'left-sidebar'   => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
			'fullwidth'  => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
		),
	) );


	// Archives Layout
	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio-image',
		'settings'    => 'deo_archives_layout_type',
		'label'       => esc_html__( 'Page layout type', 'inka' ),
		'section'     => 'deo_archives_layout',
		'default'     => 'fullwidth',
		'choices'     => array(
			'left-sidebar'   => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
			'fullwidth'  => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
		),
	) );

	// Archives Post Layout
	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio-image',
		'settings'    => 'deo_archives_post_layout_type',
		'label'       => esc_html__( 'Post layout type', 'inka' ),
		'section'     => 'deo_archives_layout',
		'default'     => 'grid',
		'choices'     => array(
			'grid'   => get_template_directory_uri() . '/assets/img/customizer/grid.png',
			'list' => get_template_directory_uri() . '/assets/img/customizer/list.png',
		),
	) );

	// Archives columns
	Kirki::add_field( 'deo_config', array(
		'type'        => 'select',
		'settings'    => 'deo_archives_columns',
		'label'       => esc_html__( 'Columns', 'inka' ),
		'description' => esc_html__( 'Will apply on grid layout type', 'inka' ),
		'section'     => 'deo_archives_layout',
		'default'     => 'col-md-4',
		'choices'     => array(
			'col-md-12' => esc_attr__( '1 Column', 'inka' ),
			'col-md-6' => esc_attr__( '2 Columns', 'inka' ),
			'col-md-4' => esc_attr__( '3 Columns', 'inka' ),
			'col-md-3' => esc_attr__( '4 Columns', 'inka' ),
		),
		'active_callback'  => array(
			array(
				'setting'  => 'deo_archives_post_layout_type',
				'value'    => 'list',
				'operator' => '!=',
			),
		),
	) );

	// Page Layout
	Kirki::add_field( 'deo_config', array(
		'type'        => 'radio-image',
		'settings'    => 'deo_page_layout_type',
		'label'       => esc_html__( 'Page layout type', 'inka' ),
		'section'     => 'deo_page_layout',
		'default'     => 'fullwidth',
		'choices'     => array(
			'left-sidebar'   => get_template_directory_uri() . '/assets/img/customizer/left-sidebar.png',
			'right-sidebar' => get_template_directory_uri() . '/assets/img/customizer/right-sidebar.png',
			'fullwidth'  => get_template_directory_uri() . '/assets/img/customizer/fullwidth.png',
		),
	) );


	/**
	* Socials
	*/

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_facebook',
		'label'       => esc_html__( 'Facebook', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '#' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_twitter',
		'label'       => esc_html__( 'Twitter', 'inka' ),
		'section'     => 'deo_socials',
		'description' => esc_html__( 'Add your twitter username without @ symbol', 'inka' ),
		'default'     => esc_url( '#' ),
		'sanitize_callback' => 'deo_sanitize_twitter_handler'
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_google_plus',
		'label'       => esc_html__( 'Google +', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_pinterest',
		'label'       => esc_html__( 'Pinterest', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '#' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_instagram',
		'label'       => esc_html__( 'Instagram', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '#' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_snapchat',
		'label'       => esc_html__( 'Snapchat', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '#' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_bloglovin',
		'label'       => esc_html__( 'Bloglovin', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_blogger',
		'label'       => esc_html__( 'Blogger', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_linkedin',
		'label'       => esc_html__( 'Linkedin', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_dribbble',
		'label'       => esc_html__( 'Dribbble', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_tumblr',
		'label'       => esc_html__( 'Tumblr', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_reddit',
		'label'       => esc_html__( 'Reddit', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_rss',
		'label'       => esc_html__( 'RSS', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_behance',
		'label'       => esc_html__( 'Behance', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_vkontakte',
		'label'       => esc_html__( 'Vkontakte', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_slack',
		'label'       => esc_html__( 'Slack', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_github',
		'label'       => esc_html__( 'Github', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_flickr',
		'label'       => esc_html__( 'Flickr', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_youtube',
		'label'       => esc_html__( 'Youtube', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_xing',
		'label'       => esc_html__( 'Xing', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );

	Kirki::add_field( 'deo_config', array(
		'type'        => 'text',
		'settings'    => 'deo_socials_settings_vimeo',
		'label'       => esc_html__( 'Vimeo', 'inka' ),
		'section'     => 'deo_socials',
		'default'     => esc_url( '' ),
	) );


	// Back to top control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'checkbox',
		'settings'    => 'deo_back_to_top_settings',
		'label'       => esc_html__( 'Back to top arrow', 'inka' ),
		'section'     => 'deo_footer',
		'default'     => 1,
		'priority'    => 20,
	) );


	// Colors control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_color_settings',
		'label'       => esc_html__( 'Main accent color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#e04f62',
		'output' => array(
			array(
				'element'  => $selector['main_color'],
				'property' => 'color',
			),
			array(
				'element' => $selector['main_background_color'],
				'property' => 'background-color',
			),
			array(
				'element' => $selector['main_border_color'],
				'property' => 'border-color',
			),
			array(
				'element' => '.edit-post-visual-editor a, .editor-rich-text__tinymce a',
				'property' => 'color',
				'context' => array( 'editor' ),
			)
		)
	));


	// Nav bg color control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_nav_background_color_settings',
		'label'       => esc_html__( 'Navbar background color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#f9eded',
		'output' => array(
			array(
				'element'  => $selector['nav_background_color'],
				'property' => 'background-color',
			)
		),
	));

	// Nav links color
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_nav_links_color_settings',
		'label'       => esc_html__( 'Navbar links color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#353535',
		'output' => array(
			array(
				'element'  => $selector['nav_links_color'],
				'property' => 'color',
			),
			array(
				'element'  => '.nav__holder input::-webkit-input-placeholder',
				'property' => 'color',
			),
			array(
				'element'  => '.nav__holder input:-moz-placeholder, .nav__holder input::-moz-placeholder',
				'property' => 'color',
			),
			array(
				'element'  => '.nav__holder input:-ms-input-placeholder',
				'property' => 'color',
			),
			array(
				'element'  => '.nav__icon-toggle-bar',
				'property' => 'background-color',				
			)
		),
	));

	// Nav dropdown bg color
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_nav_dropdown_background_color_settings',
		'label'       => esc_html__( 'Navbar dropdown background color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#ffffff',
		'output' => array(
			array(
				'element'  => '.nav__dropdown-menu, .nav__dropdown-submenu > .nav__dropdown-menu',
				'property' => 'background-color',
				'media_query' => '@media (min-width: 992px)'
			)
		),
	));

	// Nav dropdown links color
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_nav_dropdown_links_color_settings',
		'label'       => esc_html__( 'Navbar dropdown links color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#4e4e4e',
		'output' => array(
			array(
				'element'  => '.nav__dropdown-menu > li > a, .nav__dropdown-submenu > .nav__dropdown-menu > li > a',
				'property' => 'color',
			)
		),
	));

	// Nav mobile dividers color
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_nav_mobile_dividers_color_settings',
		'label'       => esc_html__( 'Navbar mobile dividers color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#e8d9db',
		'output' => array(
			array(
				'element'  => '.nav__menu li a',
				'property' => 'border-color',
				'media_query' => '@media (max-width: 991px)'
			)
		),
	));


	// Subscribe bg color control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'color',
		'settings'    => 'deo_subscribe_background_color_settings',
		'label'       => esc_html__( 'Edit subscribe widget background color', 'inka' ),
		'section'     => 'deo_colors',
		'default'     => '#f9eded',
		'output' => array(
			array(
				'element'  => $selector['subscribe_background_color'],
				'property' => 'background-color',
			)
		),
	));


	// Headings typography control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_typography',
		'label'       => esc_html__( 'Headings Typography', 'inka' ),
		'description' => esc_html__( 'Select the main typography options for your site.', 'inka' ),
		'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-family'    => 'Maven Pro',
			'variant'        => '400',
			'line-height'    => '1.3',
			'color'          => '#444',
			'letter-spacing' => '0.11em',
		),
		'output' => array(
			array(
				'element' => $selector['headings'],
			),
			array(
				'element' => '.edit-post-visual-editor .editor-post-title__block .editor-post-title__input,
				.edit-post-visual-editor .editor-block-list__block h1,
				.edit-post-visual-editor .editor-block-list__block h2,
				.edit-post-visual-editor .editor-block-list__block h3,
				.edit-post-visual-editor .editor-block-list__block h4,
				.edit-post-visual-editor .editor-block-list__block h5,
				.edit-post-visual-editor .editor-block-list__block h6',
				'context' => array( 'editor' ),
			)
		),
	));


	// H1 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h1',
		'label'       => esc_html__( 'H1 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '32px',
			'variant'        => '400'
		),
		'output' => array(
			array(
				'element' => $selector['h1'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h1',
				'context' => array( 'editor' ),
			)
		),
	));


	// H2 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h2',
		'label'       => esc_html__( 'H2 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '26px',
			'variant'        => '400',
		),
		'output' => array(
			array(
				'element' => $selector['h2'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h2',
				'context' => array( 'editor' ),
			)
		),
	));


	// H3 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h3',
		'label'       => esc_html__( 'H3 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '24px',
			'variant'        => '400'
		),
		'output' => array(
			array(
				'element' => $selector['h3'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h3',
				'context' => array( 'editor' ),
			)
		),
	));


	// H4 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h4',
		'label'       => esc_html__( 'H4 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '20px',
			'variant'        => '400'
		),
		'output' => array(
			array(
				'element' => $selector['h4'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h4',
				'context' => array( 'editor' ),
			)
		),
	));


	// H5 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h5',
		'label'       => esc_html__( 'H5 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '18px',
			'variant'        => '400'
		),
		'output' => array(
			array(
				'element' => $selector['h5'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h5',
				'context' => array( 'editor' ),
			)
		),
	));


	// H6 control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_headings_h6',
		'label'       => esc_html__( 'H6 Headings', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-size'      => '15px',
			'variant'        => '400'
		),
		'output' => array(
			array(
				'element' => $selector['h6'],
			),
			array(
				'element' => '.edit-post-visual-editor .wp-block-heading h6',
				'context' => array( 'editor' ),
			)
		),
	));



	// Meta typography control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_meta_typography',
		'label'       => esc_html__( 'Meta Typography', 'inka' ),
		'description' => esc_html__( 'Set the meta font styles.', 'inka' ),
		'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-family'    => 'Lora',
			'variant'        => 'italic',
			'font-size'      => '13px',
			'color'          => '#AEAEAE',
		),
		'output' => array(
			array(
				'element' => $selector['meta'],
			),
		),
	));


	// Body typography control
	Kirki::add_field( 'deo_config', array(
		'type'        => 'typography',
		'settings'    => 'deo_body_typography',
		'label'       => esc_html__( 'Body Typography', 'inka' ),
		'description' => esc_html__( 'Select the main typography options for your site.', 'inka' ),
		'help'        => esc_html__( 'The typography options you set here apply to all content on your site.', 'inka' ),
		'section'     => 'deo_typography',
		'default'     => array(
			'font-family'    => 'Lora',
			'variant'        => '400',
			'font-size'      => '16px',
			'line-height'    => '26px',
			'color'          => '#4e4e4e',
		),
		'output' => array(
			array(
				'element' => $selector['text'],
			),
			array(
				'element' => '.edit-post-visual-editor .editor-block-list__block,
				.edit-post-visual-editor .editor-block-list__block p:not(.wp-block-cover-text),
				.edit-post-visual-editor .editor-block-list__block-edit,
				.edit-post-visual-editor',
				'context' => array( 'editor' ),
			)
		),
	));


	// Add theme support for Custom Backgrounds
	$defaults = array(
		'default-color' => '#fff',
	);
	add_theme_support( 'custom-background', $defaults );

} // endif Kirki check


//Sanitization settings
function deo_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}


// Sanitize text
function deo_sanitize_text( $text ) {
	return sanitize_text_field( $text );
}

function deo_sanitize_html( $input ) {
	return wp_kses( $input, array(
		'a' => array(
			'href' => array(),
			'target' => array(),
		),
		'i' => array(),
		'span' => array(),
		'em' => array(),
		'strong' => array(),
) );
};



/**
 * Adds custom admin classes.
 *
 * @param string $classes Classes for the body element.
 * @return string
 */
function deo_admin_body_classes( $classes ) {

	$screen = get_current_screen();

	// Add blog layout class
	if( $screen->id === "post" ) {
		$classes = deo_layout_type( 'blog' );
	}

	// Add page layout class
	if( $screen->id === "page" ) {
		$classes = deo_layout_type( 'page' );
	}
	
	return $classes;
}
add_filter( 'admin_body_class', 'deo_admin_body_classes' );