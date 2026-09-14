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
 * Load the theme's CSS, plus its Google Fonts: Merriweather for body
 * text, and Fraunces (a display serif, used only for the big site
 * title in the masthead) -- one request loads both families.
 *
 * wp_enqueue_style() is WordPress's proper way to load a stylesheet --
 * rather than hand-writing a <link> tag in header.php, we register it
 * here so WordPress can manage load order, avoid duplicates if a
 * plugin needs the same file, etc.
 */
function kelweaver_scripts() {
	wp_enqueue_style(
		'kelweaver-google-fonts',
		'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400&family=Fraunces:opsz,wght@9..144,600;9..144,700&display=swap',
		array(),
		null
	);
	wp_enqueue_style(
		'kelweaver-style',
		get_stylesheet_uri(),
		array( 'kelweaver-google-fonts' ),
		filemtime( get_stylesheet_directory() . '/style.css' )
	);

	// Shows/hides the primary nav behind the header's arrow button on
	// narrow screens -- see js/nav-toggle.js. `true` at the end loads
	// it in the footer, after the nav it looks for already exists in
	// the page, rather than in <head> before that markup is there.
	wp_enqueue_script(
		'kelweaver-nav-toggle',
		get_stylesheet_directory_uri() . '/js/nav-toggle.js',
		array(),
		filemtime( get_stylesheet_directory() . '/js/nav-toggle.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'kelweaver_scripts' );

/**
 * Customizes the browser-tab <title> WordPress builds automatically
 * (theme support for 'title-tag' above is what turns this on -- it's
 * what actually prints the <title> tag into <head>, we're just
 * changing what text goes inside it).
 *
 * Everywhere except the homepage: "<page title> | kelweaver.com".
 * $title['title'] arrives already set to whatever WordPress decided
 * the page's own title is -- a post's title, "Search Results for
 * ...", "Page not found", a category name, and so on -- so this just
 * adds the site name after it and drops the tagline WordPress
 * sometimes adds alongside it.
 *
 * On the homepage: just "kelweaver.com" by itself, since
 * "kelweaver.com | kelweaver.com" would be redundant.
 */
function kelweaver_document_title_parts( $title ) {
	if ( is_front_page() ) {
		return array( 'title' => get_bloginfo( 'name', 'display' ) );
	}

	return array(
		'title' => isset( $title['title'] ) ? $title['title'] : '',
		'site'  => get_bloginfo( 'name', 'display' ),
	);
}
add_filter( 'document_title_parts', 'kelweaver_document_title_parts' );

/**
 * WordPress joins the pieces above with " - " by default; use "|"
 * instead to match "<page title> | kelweaver.com".
 */
function kelweaver_document_title_separator() {
	return '|';
}
add_filter( 'document_title_separator', 'kelweaver_document_title_separator' );

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

/**
 * Inline SVG icon data for the sidebar's social/profile links --
 * one small vector path per network, drawn instead of the network's
 * name as text. Sourced from the Simple Icons project (MIT license)
 * for brand marks, Font Awesome Free (CC BY 4.0) for LinkedIn (Simple
 * Icons dropped it at LinkedIn's request), and a generic Material
 * Symbols envelope glyph (Apache 2.0) for Email, which isn't a brand.
 * Each path is drawn with `fill: currentColor` in CSS, so it always
 * matches the surrounding link color (and any future color scheme)
 * automatically -- no separate icon colors to maintain by hand.
 */
function kelweaver_social_icons() {
	return array(
		'instagram' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M7.0301.084c-1.2768.0602-2.1487.264-2.911.5634-.7888.3075-1.4575.72-2.1228 1.3877-.6652.6677-1.075 1.3368-1.3802 2.127-.2954.7638-.4956 1.6365-.552 2.914-.0564 1.2775-.0689 1.6882-.0626 4.947.0062 3.2586.0206 3.6671.0825 4.9473.061 1.2765.264 2.1482.5635 2.9107.308.7889.72 1.4573 1.388 2.1228.6679.6655 1.3365 1.0743 2.1285 1.38.7632.295 1.6361.4961 2.9134.552 1.2773.056 1.6884.069 4.9462.0627 3.2578-.0062 3.668-.0207 4.9478-.0814 1.28-.0607 2.147-.2652 2.9098-.5633.7889-.3086 1.4578-.72 2.1228-1.3881.665-.6682 1.0745-1.3378 1.3795-2.1284.2957-.7632.4966-1.636.552-2.9124.056-1.2809.0692-1.6898.063-4.948-.0063-3.2583-.021-3.6668-.0817-4.9465-.0607-1.2797-.264-2.1487-.5633-2.9117-.3084-.7889-.72-1.4568-1.3876-2.1228C21.2982 1.33 20.628.9208 19.8378.6165 19.074.321 18.2017.1197 16.9244.0645 15.6471.0093 15.236-.005 11.977.0014 8.718.0076 8.31.0215 7.0301.0839m.1402 21.6932c-1.17-.0509-1.8053-.2453-2.2287-.408-.5606-.216-.96-.4771-1.3819-.895-.422-.4178-.6811-.8186-.9-1.378-.1644-.4234-.3624-1.058-.4171-2.228-.0595-1.2645-.072-1.6442-.079-4.848-.007-3.2037.0053-3.583.0607-4.848.05-1.169.2456-1.805.408-2.2282.216-.5613.4762-.96.895-1.3816.4188-.4217.8184-.6814 1.3783-.9003.423-.1651 1.0575-.3614 2.227-.4171 1.2655-.06 1.6447-.072 4.848-.079 3.2033-.007 3.5835.005 4.8495.0608 1.169.0508 1.8053.2445 2.228.408.5608.216.96.4754 1.3816.895.4217.4194.6816.8176.9005 1.3787.1653.4217.3617 1.056.4169 2.2263.0602 1.2655.0739 1.645.0796 4.848.0058 3.203-.0055 3.5834-.061 4.848-.051 1.17-.245 1.8055-.408 2.2294-.216.5604-.4763.96-.8954 1.3814-.419.4215-.8181.6811-1.3783.9-.4224.1649-1.0577.3617-2.2262.4174-1.2656.0595-1.6448.072-4.8493.079-3.2045.007-3.5825-.006-4.848-.0608M16.953 5.5864A1.44 1.44 0 1 0 18.39 4.144a1.44 1.44 0 0 0-1.437 1.4424M5.8385 12.012c.0067 3.4032 2.7706 6.1557 6.173 6.1493 3.4026-.0065 6.157-2.7701 6.1506-6.1733-.0065-3.4032-2.771-6.1565-6.174-6.1498-3.403.0067-6.156 2.771-6.1496 6.1738M8 12.0077a4 4 0 1 1 4.008 3.9921A3.9996 3.9996 0 0 1 8 12.0077',
		),
		'twitter' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M14.234 10.162 22.977 0h-2.072l-7.591 8.824L7.251 0H.258l9.168 13.343L.258 24H2.33l8.016-9.318L16.749 24h6.993zm-2.837 3.299-.929-1.329L3.076 1.56h3.182l5.965 8.532.929 1.329 7.754 11.09h-3.182z',
		),
		'facebook' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.238 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647Z',
		),
		'mastodon' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z',
		),
		'bluesky' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M5.202 2.857C7.954 4.922 10.913 9.11 12 11.358c1.087-2.247 4.046-6.436 6.798-8.501C20.783 1.366 24 .213 24 3.883c0 .732-.42 6.156-.667 7.037-.856 3.061-3.978 3.842-6.755 3.37 4.854.826 6.089 3.562 3.422 6.299-5.065 5.196-7.28-1.304-7.847-2.97-.104-.305-.152-.448-.153-.327 0-.121-.05.022-.153.327-.568 1.666-2.782 8.166-7.847 2.97-2.667-2.737-1.432-5.473 3.422-6.3-2.777.473-5.899-.308-6.755-3.369C.42 10.04 0 4.615 0 3.883c0-3.67 3.217-2.517 5.202-1.026',
		),
		'threads' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M18.263 11.097c-.03-3.486-1.92-5.586-5.111-5.586-2.13 0-3.922.963-4.863 2.499l2.062 1.438c.535-.843 1.272-1.543 2.628-1.543 1.528 0 2.318.85 2.544 2.431a15 15 0 0 0-2.236-.173c-4.125 0-6.068 1.867-6.068 4.336s1.943 3.99 4.804 3.99c3.139 0 5.013-2.115 5.781-4.735.798.361 1.348 1.204 1.348 2.47 0 3.387-3.907 5.232-7.22 5.232-4.885 0-8.077-3.207-8.077-8.424 0-6.392 4.223-10.487 9.9-10.487 3.808 0 5.69 1.671 6.97 3.914l2.108-1.475C21.44 2.078 18.331 0 13.663 0 6.227 0 1.168 5.277 1.168 12.934c0 7 4.953 11.066 10.856 11.066 4.878 0 9.809-2.846 9.809-7.716 0-2.545-1.46-4.231-3.569-5.187m-6.33 4.855c-1.077 0-2.026-.512-2.026-1.453 0-1.483 1.822-1.934 3.606-1.934.678 0 1.34.045 1.927.173-.422 1.927-1.671 3.215-3.508 3.214Z',
		),
		'linkedin' => array(
			'viewBox' => '0 0 448 512',
			'd'       => 'M100.3 448l-92.9 0 0-299.1 92.9 0 0 299.1zM53.8 108.1C24.1 108.1 0 83.5 0 53.8 0 39.5 5.7 25.9 15.8 15.8s23.8-15.8 38-15.8 27.9 5.7 38 15.8 15.8 23.8 15.8 38c0 29.7-24.1 54.3-53.8 54.3zM447.9 448l-92.7 0 0-145.6c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7l0 148.1-92.8 0 0-299.1 89.1 0 0 40.8 1.3 0c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3l0 164.3-.1 0z',
		),
		'youtube' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z',
		),
		'github' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12',
		),
		'goodreads' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M17.346.026c.422-.083.859.037 1.179.325.346.284.55.705.557 1.153-.023.457-.247.88-.612 1.156l-2.182 1.748a.601.601 0 0 0-.255.43.52.52 0 0 0 .11.424 5.886 5.886 0 0 1 .832 6.58c-1.394 2.79-4.503 3.99-7.501 2.927a.792.792 0 0 0-.499-.01c-.224.07-.303.18-.453.383l-.014.02-.941 1.254s-.792.985.457.935c3.027-.119 3.817-.119 5.439-.01 2.641.18 3.806 1.903 3.806 3.275 0 1.623-1.036 3.383-3.809 3.383a117.46 117.46 0 0 0-5.517-.03c-.31.005-.597.013-.835.02-.228.006-.41.011-.52.011-.712 0-1.648-.186-1.66-1.068-.008-.729.624-1.12 1.11-1.172.43-.045.815.007 1.24.064.252.034.518.07.815.088.185.011.366.025.552.038.53.038 1.102.08 1.926.087.427.005.759.01 1.025.015.695.012.941.016 1.28-.015 1.248-.112 1.832-.61 1.832-1.376 0-.805-.584-1.264-1.698-1.414-1.564-.213-2.33-.163-3.72-.074a87.66 87.66 0 0 1-1.669.095c-.608.029-2.449.026-2.682-1.492-.053-.416-.073-1.116.807-2.325l.75-1.003c.36-.49.582-.898.053-1.559 0 0-.39-.468-.52-.638-1.215-1.587-1.512-4.08-.448-6.114 1.577-3.011 5.4-4.26 8.37-2.581.253.143.438.203.655.163.201-.032.27-.167.363-.344.02-.04.042-.082.067-.126.004-.01.241-.465.535-1.028l.734-1.41a1.493 1.493 0 0 1 1.041-.785ZM9.193 13.243c1.854.903 3.912.208 5.254-2.47 1.352-2.699.827-5.11-1.041-6.023C10.918 3.537 8.81 5.831 8.017 7.41c-1.355 2.698-.717 4.886 1.147 5.818Z',
		),
		'letterboxd' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M8.224 14.352a4.447 4.447 0 0 1-3.775 2.092C1.992 16.444 0 14.454 0 12s1.992-4.444 4.45-4.444c1.592 0 2.988.836 3.774 2.092-.427.682-.673 1.488-.673 2.352s.246 1.67.673 2.352zM15.101 12c0-.864.247-1.67.674-2.352-.786-1.256-2.183-2.092-3.775-2.092s-2.989.836-3.775 2.092c.427.682.674 1.488.674 2.352s-.247 1.67-.674 2.352c.786 1.256 2.183 2.092 3.775 2.092s2.989-.836 3.775-2.092A4.42 4.42 0 0 1 15.1 12zm4.45-4.444a4.447 4.447 0 0 0-3.775 2.092c.427.682.673 1.488.673 2.352s-.246 1.67-.673 2.352a4.447 4.447 0 0 0 3.775 2.092C22.008 16.444 24 14.454 24 12s-1.992-4.444-4.45-4.444z',
		),
		'pinterest' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z',
		),
		'tiktok' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z',
		),
		'email' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z',
		),
		// Not one of the Customizer-driven networks above (RSS is always
		// on, not a URL Kelly fills in) -- kept here anyway so the RSS
		// link in the sidebar can use the same icon treatment as the rest.
		'rss' => array(
			'viewBox' => '0 0 24 24',
			'd'       => 'M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z',
		),
	);
}
