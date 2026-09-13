<?php
/**
 * Site header -- this builds the left-hand sidebar (site title, nav
 * menu, social links) and opens the two wrapper <div>s that make the
 * left/right layout possible:
 *
 *   .site-wrapper           <- outer flex/grid container (styled in CSS step)
 *     aside.site-sidebar    <- left column, everything in this file
 *     div.site-content      <- right column, opened here, closed in footer.php
 *
 * Every template (index.php, single.php, page.php) calls get_header()
 * first, which runs this file, then prints its own content, then
 * calls get_footer(), which closes these divs back up. Think of
 * header.php/footer.php as the bread of a sandwich that every page is
 * the filling of.
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

<div class="site-wrapper">

	<aside class="site-sidebar">

		<div class="site-branding">
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</p>
			<?php $description = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $description ) : ?>
				<p class="site-description"><?php echo $description; ?></p>
			<?php endif; ?>
		</div>

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

		<ul class="site-social">
			<?php foreach ( kelweaver_social_links() as $link ) : ?>
				<li>
					<a href="<?php echo esc_url( $link['url'] ); ?>">
						<?php echo esc_html( $link['label'] ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>

	</aside>

	<div class="site-content">
