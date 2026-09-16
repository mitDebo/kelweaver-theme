<?php
$social_class = isset( $args['class'] ) ? ' ' . $args['class'] : '';
?>
<ul class="site-social<?php echo esc_attr( $social_class ); ?>">
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
