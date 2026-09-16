<?php
$kelweaver_nav_locations = get_nav_menu_locations();

if ( isset( $kelweaver_nav_locations['primary'] ) ) {
	$kelweaver_primary_items = wp_get_nav_menu_items( $kelweaver_nav_locations['primary'] );

	if ( $kelweaver_primary_items ) {
		foreach ( $kelweaver_primary_items as $kelweaver_menu_item ) {

			if ( $kelweaver_menu_item->menu_item_parent ) {
				continue;
			}
			?>
			<li class="site-nav-bar-item">
				<a class="site-nav-bar-link" href="<?php echo esc_url( $kelweaver_menu_item->url ); ?>">
					<?php echo esc_html( $kelweaver_menu_item->title ); ?>
				</a>
			</li>
			<?php
		}
	}
}
