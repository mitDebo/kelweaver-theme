<?php
/**
 * Kelweaver theme functions.
 *
 * This file is where a WordPress theme registers its capabilities
 * (menus, featured images, etc.) and loads its own CSS/JS. It runs on
 * every page load, before the templates render.
 */

/**
 * Theme setup: a navigation menu slot, WordPress-managed <title> tag,
 * and support for featured images (a single representative image you
 * can optionally attach to a post -- nothing shows if you don't set one).
 */
function kelweaver_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'kelweaver' ),
		)
	);
}
add_action( 'after_setup_theme', 'kelweaver_setup' );

/**
 * Load the theme's CSS, plus the Merriweather web font from Google Fonts.
 *
 * wp_enqueue_style() is WordPress's proper way to load a stylesheet --
 * rather than hand-writing a <link> tag in header.php, we register it
 * here so WordPress can manage load order, avoid duplicates if a
 * plugin needs the same file, etc.
 */
function kelweaver_scripts() {
	wp_enqueue_style(
		'kelweaver-google-fonts',
		'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'kelweaver-style',
		get_stylesheet_uri(),
		array( 'kelweaver-google-fonts' ),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);
}
add_action( 'wp_enqueue_scripts', 'kelweaver_scripts' );

/**
 * Social links: Instagram URL, editable from wp-admin.
 *
 * Rather than hardcoding a URL in PHP, this registers one setting in
 * the Customizer (Appearance > Customize > Social Links in wp-admin)
 * -- a plain text field Kelly can fill in himself. header.php reads
 * it back with get_theme_mod( 'kelweaver_instagram_url' ), and shows
 * nothing if it's empty rather than linking to a dead placeholder.
 * More fields (say, a second network) would each be one more
 * add_setting()/add_control() pair here.
 */
function kelweaver_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'kelweaver_social_links',
		array(
			'title'    => __( 'Social Links', 'kelweaver' ),
			'priority' => 120,
		)
	);

	$wp_customize->add_setting(
		'kelweaver_instagram_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'kelweaver_instagram_url',
		array(
			'label'   => __( 'Instagram URL', 'kelweaver' ),
			'section' => 'kelweaver_social_links',
			'type'    => 'url',
		)
	);
}
add_action( 'customize_register', 'kelweaver_customize_register' );
