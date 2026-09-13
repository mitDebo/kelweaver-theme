<?php
/**
 * Kelweaver theme functions.
 *
 * This file is where a WordPress theme registers its capabilities
 * (menus, featured images, etc.) and loads its own CSS/JS. It runs on
 * every page load, before the templates render.
 */

/**
 * Tell WordPress this theme has a navigation menu slot called "primary",
 * and that WordPress should manage the <title> tag for us.
 *
 * Registering "primary" doesn't create the menu itself -- it just makes
 * a named slot available. You (or anyone editing the site) build the
 * actual menu under Appearance > Menus in wp-admin, and assign it to
 * this "Primary Navigation" slot. That's what wp_nav_menu() in
 * header.php will render.
 */
function kelweaver_setup() {
	add_theme_support( 'title-tag' );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'kelweaver' ),
		)
	);
}
add_action( 'after_setup_theme', 'kelweaver_setup' );

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
