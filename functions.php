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
 * Social/profile links the sidebar knows how to show. Each key becomes
 * a Customizer field named kelweaver_{key}_url -- add a line here to
 * offer a new network anywhere on the site; nothing else to wire up.
 * Order here is also the order they'll appear in wp-admin (and, since
 * header.php loops over this same list, in the sidebar too).
 *
 * 'type' is 'url' for a normal profile link, or 'email' for a plain
 * address -- Kelly just types his email in, and header.php turns it
 * into a mailto: link automatically (no "mailto:" typing required).
 */
function kelweaver_social_networks() {
	return array(
		'instagram'  => array(
			'label' => __( 'Instagram', 'kelweaver' ),
			'type'  => 'url',
		),
		'twitter'    => array(
			'label' => __( 'Twitter / X', 'kelweaver' ),
			'type'  => 'url',
		),
		'facebook'   => array(
			'label' => __( 'Facebook', 'kelweaver' ),
			'type'  => 'url',
		),
		'mastodon'   => array(
			'label' => __( 'Mastodon', 'kelweaver' ),
			'type'  => 'url',
		),
		'bluesky'    => array(
			'label' => __( 'Bluesky', 'kelweaver' ),
			'type'  => 'url',
		),
		'threads'    => array(
			'label' => __( 'Threads', 'kelweaver' ),
			'type'  => 'url',
		),
		'linkedin'   => array(
			'label' => __( 'LinkedIn', 'kelweaver' ),
			'type'  => 'url',
		),
		'youtube'    => array(
			'label' => __( 'YouTube', 'kelweaver' ),
			'type'  => 'url',
		),
		'github'     => array(
			'label' => __( 'GitHub', 'kelweaver' ),
			'type'  => 'url',
		),
		'goodreads'  => array(
			'label' => __( 'Goodreads', 'kelweaver' ),
			'type'  => 'url',
		),
		'letterboxd' => array(
			'label' => __( 'Letterboxd', 'kelweaver' ),
			'type'  => 'url',
		),
		'pinterest'  => array(
			'label' => __( 'Pinterest', 'kelweaver' ),
			'type'  => 'url',
		),
		'tiktok'     => array(
			'label' => __( 'TikTok', 'kelweaver' ),
			'type'  => 'url',
		),
		'email'      => array(
			'label' => __( 'Email', 'kelweaver' ),
			'type'  => 'email',
		),
	);
}

/**
 * Registers one URL setting per network above in the Customizer
 * (Appearance > Customize > Social Links in wp-admin) -- plain text
 * fields Kelly fills in himself, instead of hardcoded links in PHP.
 * header.php reads them back with get_theme_mod(), and shows nothing
 * for any network left blank, rather than linking to a placeholder.
 */
function kelweaver_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'kelweaver_social_links',
		array(
			'title'    => __( 'Social Links', 'kelweaver' ),
			'priority' => 120,
		)
	);

	foreach ( kelweaver_social_networks() as $key => $network ) {
		$setting_id = 'kelweaver_' . $key . '_url';
		$is_email   = 'email' === $network['type'];

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => '',
				'sanitize_callback' => $is_email ? 'sanitize_email' : 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				/* translators: %s: network name, e.g. "Instagram" or "Email". */
				'label'   => $is_email ? $network['label'] : sprintf( __( '%s URL', 'kelweaver' ), $network['label'] ),
				'section' => 'kelweaver_social_links',
				'type'    => $is_email ? 'email' : 'url',
			)
		);
	}
}
add_action( 'customize_register', 'kelweaver_customize_register' );
