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
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'kelweaver_scripts' );

/**
 * Social links for the sidebar.
 *
 * Kept as a plain PHP array (not a wp-admin menu) so it's simple to
 * read and edit directly -- add, remove, or relabel a row here and
 * it shows up in the sidebar. We can move this into the Customizer
 * later if you'd rather manage it from wp-admin instead of code.
 */
function kelweaver_social_links() {
	return array(
		array(
			'label' => 'Twitter',
			'url'   => 'https://twitter.com/',
		),
		array(
			'label' => 'Facebook',
			'url'   => 'https://facebook.com/',
		),
		array(
			'label' => 'Instagram',
			'url'   => 'https://instagram.com/',
		),
	);
}
