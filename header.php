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

<nav class="site-nav-bar" id="site-nav-bar" aria-label="<?php esc_attr_e( 'Moonlight navigation', 'kelweaver' ); ?>">
	<div class="site-nav-bar-inner">
		<ul class="site-nav-bar-menu">
			<li class="site-nav-bar-item">
				<button type="button" class="site-nav-bar-link" aria-haspopup="true" aria-expanded="false">
					<?php esc_html_e( 'Latest', 'kelweaver' ); ?>
				</button>
				<ul class="site-nav-bar-dropdown">
					<?php get_template_part( 'template-parts/latest-posts-items' ); ?>
				</ul>
			</li>
			<?php get_template_part( 'template-parts/primary-menu-bar-items' ); ?>
		</ul>

		<form role="search" method="get" class="site-nav-bar-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="site-nav-bar-search-input"><?php esc_html_e( 'Search for:', 'kelweaver' ); ?></label>
			<input type="search" id="site-nav-bar-search-input" class="site-nav-bar-search-input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search&hellip;', 'kelweaver' ); ?>">
			<button type="submit" class="site-nav-bar-search-button">
				<svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="2"/>
					<line x1="15.5" y1="15.5" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
				</svg>
				<span class="screen-reader-text"><?php esc_html_e( 'Search', 'kelweaver' ); ?></span>
			</button>
		</form>
	</div>
</nav>

<div class="site-wrapper">

	<aside class="site-sidebar" id="site-sidebar">

		<nav class="site-nav" id="site-nav" aria-label="<?php esc_attr_e( 'Primary menu', 'kelweaver' ); ?>">
			<ul class="site-nav-list">
				<li class="site-nav-list-item">
					<details class="site-latest" open>
						<summary><?php esc_html_e( 'Latest', 'kelweaver' ); ?></summary>

						<ul>
							<?php get_template_part( 'template-parts/latest-posts-items' ); ?>
						</ul>
					</details>
				</li>
				<?php get_template_part( 'template-parts/primary-menu-list-items' ); ?>
			</ul>
		</nav>

		<hr class="section-divider">

		<div class="site-search">
			<?php echo get_search_form( false ); ?>
		</div>

		<?php get_template_part( 'template-parts/social-icons', null, array( 'class' => 'site-social--sidebar' ) ); ?>

	</aside>

	<div class="site-content">
