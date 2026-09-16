<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script>(function(){try{var t=localStorage.getItem('kelweaver_theme');if(t)document.documentElement.setAttribute('data-theme',t);}catch(e){}})();</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-masthead">
	<div class="site-masthead-inner">
		<div class="site-masthead-row">
			<p class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php bloginfo( 'name' ); ?>
				</a>
			</p>

			<div class="masthead-controls">
				<div class="theme-switcher" id="theme-switcher">
					<button type="button" class="theme-swatch theme-swatch-current" id="theme-swatch-toggle" aria-haspopup="true" aria-expanded="false" aria-controls="theme-swatch-list">
						<span class="screen-reader-text"><?php esc_html_e( 'Color scheme', 'kelweaver' ); ?></span>
					</button>
					<ul class="theme-swatch-list" id="theme-swatch-list">
						<li>
							<button type="button" class="theme-swatch theme-swatch-paperback" data-theme-value="paperback">
								<span class="screen-reader-text"><?php esc_html_e( 'Paperback', 'kelweaver' ); ?></span>
							</button>
						</li>
						<li>
							<button type="button" class="theme-swatch theme-swatch-night" data-theme-value="night">
								<span class="screen-reader-text"><?php esc_html_e( 'Night', 'kelweaver' ); ?></span>
							</button>
						</li>
					</ul>
				</div>

				<button type="button" class="nav-toggle" aria-expanded="false" aria-controls="site-sidebar">
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'kelweaver' ); ?></span>
					<svg class="nav-toggle-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M4 6h16M4 12h16M4 18h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</button>
			</div>
		</div>

		<?php $description = get_bloginfo( 'description', 'display' ); ?>
		<?php if ( $description ) : ?>
			<p class="site-description"><?php echo $description; ?></p>
		<?php endif; ?>
		<hr class="section-divider">
	</div>
</header>

<div class="site-wrapper">

	<aside class="site-sidebar" id="site-sidebar">

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'kelweaver' ); ?>">
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
				$archive_page = get_page_by_path( 'archive' );
				$archive_url  = $archive_page ? get_permalink( $archive_page ) : home_url( '/' );
				?>
				<li><a href="<?php echo esc_url( $archive_url ); ?>"><?php esc_html_e( 'Browse all', 'kelweaver' ); ?> &rarr;</a></li>
			</ul>
		</details>

		<hr class="section-divider">

		<div class="site-search">
			<?php echo get_search_form( false ); ?>
		</div>

		<ul class="site-social">
			<?php
			foreach ( kelweaver_social_networks() as $key => $network ) :
				$value = get_theme_mod( 'kelweaver_' . $key . '_url' );
				if ( ! $value ) {
					continue;
				}
				$href = ( 'email' === $network['type'] ) ? 'mailto:' . $value : $value;
				$icon = kelweaver_social_icons()[ $key ] ?? null;
				?>
				<li>
					<a href="<?php echo esc_url( $href ); ?>">
						<?php if ( $icon ) : ?>
							<svg class="social-icon" viewBox="<?php echo esc_attr( $icon['viewBox'] ); ?>" aria-hidden="true" focusable="false"><path d="<?php echo esc_attr( $icon['d'] ); ?>"></path></svg>
						<?php endif; ?>
						<span class="screen-reader-text"><?php echo esc_html( $network['label'] ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
			<?php $rss_icon = kelweaver_social_icons()['rss']; ?>
			<li>
				<a href="<?php echo esc_url( get_bloginfo( 'rss2_url' ) ); ?>">
					<svg class="social-icon" viewBox="<?php echo esc_attr( $rss_icon['viewBox'] ); ?>" aria-hidden="true" focusable="false"><path d="<?php echo esc_attr( $rss_icon['d'] ); ?>"></path></svg>
					<span class="screen-reader-text"><?php esc_html_e( 'RSS', 'kelweaver' ); ?></span>
				</a>
			</li>
		</ul>

	</aside>

	<div class="site-content">
