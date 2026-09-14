<?php
/**
 * Site header -- prints the big full-width title banner, then opens
 * the left-hand sidebar (nav, latest posts, search, social + RSS) and
 * the two wrapper <div>s that make the left/right layout possible:
 *
 *   header.site-masthead    <- big "kelweaver.com" title banner, full
 *                               width, scrolls away normally with the
 *                               rest of the page (not sticky)
 *   .site-wrapper            <- outer flex container (see style.css)
 *     aside.site-sidebar    <- left column, sticky (stays put once you
 *                               scroll past the masthead) -- everything
 *                               below the banner in this file
 *     div.site-content      <- right column, opened here, closed in footer.php
 *
 * Every template calls get_header() first, prints its own content,
 * then calls get_footer() to close these divs back up.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-masthead">
	<p class="site-title">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php bloginfo( 'name' ); ?>
		</a>
	</p>
	<?php $description = get_bloginfo( 'description', 'display' ); ?>
	<?php if ( $description ) : ?>
		<p class="site-description"><?php echo $description; ?></p>
	<?php endif; ?>
</header>

<div class="site-wrapper">

	<aside class="site-sidebar">

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'kelweaver' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<?php
		/**
		 * "Latest": a collapsible list of the 10 most recent posts, plus
		 * a link to the full archive. This uses the native HTML <details>
		 * element for the collapse/expand behavior -- no JavaScript
		 * needed, the browser handles opening/closing and keyboard
		 * support for free. `open` just means it starts out expanded.
		 */
		$latest_posts = new WP_Query(
			array(
				'posts_per_page' => 10,
				'no_found_rows'  => true,
				'post_status'    => 'publish',
			)
		);
		?>
		<details class="site-latest" open>
			<summary><?php esc_html_e( 'Latest', 'kelweaver' ); ?></summary>

			<ul>
				<?php if ( $latest_posts->have_posts() ) : ?>
					<?php while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>

				<?php
				// The archive page doesn't exist until you create it in
				// wp-admin (a Page titled "Archive", slug "archive", using
				// the "Archive" template) -- until then this just falls
				// back to the homepage so the link is never broken.
				$archive_page = get_page_by_path( 'archive' );
				$archive_url  = $archive_page ? get_permalink( $archive_page ) : home_url( '/' );
				?>
				<li><a href="<?php echo esc_url( $archive_url ); ?>"><?php esc_html_e( 'Browse all', 'kelweaver' ); ?> &rarr;</a></li>
			</ul>
		</details>

		<div class="site-search">
			<?php echo get_search_form( false ); ?>
		</div>

		<ul class="site-social">
			<?php
			// Each network's URL comes from Appearance > Customize >
			// Social Links, instead of being hardcoded here --
			// get_theme_mod() just reads whatever's saved there (empty
			// string if nothing's been entered, in which case that one
			// network is skipped rather than linking nowhere).
			foreach ( kelweaver_social_networks() as $key => $label ) :
				$url = get_theme_mod( 'kelweaver_' . $key . '_url' );
				if ( ! $url ) {
					continue;
				}
				?>
				<li>
					<a href="<?php echo esc_url( $url ); ?>">
						<?php echo esc_html( $label ); ?>
					</a>
				</li>
			<?php endforeach; ?>
			<li>
				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>">
					<?php esc_html_e( 'RSS', 'kelweaver' ); ?>
				</a>
			</li>
		</ul>

	</aside>

	<div class="site-content">
