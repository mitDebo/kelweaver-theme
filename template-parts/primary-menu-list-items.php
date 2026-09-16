<?php
$kelweaver_nav_locations = get_nav_menu_locations();

if ( isset( $kelweaver_nav_locations['primary'] ) ) {
	$kelweaver_menu_items = wp_get_nav_menu_items( $kelweaver_nav_locations['primary'] );

	if ( $kelweaver_menu_items ) {
		$kelweaver_children = array();

		foreach ( $kelweaver_menu_items as $kelweaver_item ) {
			if ( $kelweaver_item->menu_item_parent ) {
				$kelweaver_children[ $kelweaver_item->menu_item_parent ][] = $kelweaver_item;
			}
		}

		foreach ( $kelweaver_menu_items as $kelweaver_item ) {

			if ( $kelweaver_item->menu_item_parent ) {
				continue;
			}

			$kelweaver_item_children = isset( $kelweaver_children[ $kelweaver_item->ID ] ) ? $kelweaver_children[ $kelweaver_item->ID ] : array();

			if ( $kelweaver_item_children ) :
				?>
				<li class="site-nav-list-item">
					<details class="site-nav-dropdown">
						<summary><?php echo esc_html( $kelweaver_item->title ); ?></summary>
						<ul>
							<?php foreach ( $kelweaver_item_children as $kelweaver_child ) : ?>
								<li>
									<a href="<?php echo esc_url( $kelweaver_child->url ); ?>">
										<?php echo esc_html( $kelweaver_child->title ); ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</details>
				</li>
				<?php
			else :
				?>
				<li class="site-nav-list-item">
					<a class="site-nav-link" href="<?php echo esc_url( $kelweaver_item->url ); ?>">
						<?php echo esc_html( $kelweaver_item->title ); ?>
					</a>
				</li>
				<?php
			endif;
		}
	}
}
