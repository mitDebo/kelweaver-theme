<?php
$kelweaver_latest_posts = new WP_Query(
	array(
		'posts_per_page' => 10,
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);
?>
<?php if ( $kelweaver_latest_posts->have_posts() ) : ?>
	<?php while ( $kelweaver_latest_posts->have_posts() ) : $kelweaver_latest_posts->the_post(); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php
$kelweaver_archive_page = get_page_by_path( 'archive' );
$kelweaver_archive_url  = $kelweaver_archive_page ? get_permalink( $kelweaver_archive_page ) : home_url( '/' );
?>
<li><a href="<?php echo esc_url( $kelweaver_archive_url ); ?>"><?php esc_html_e( 'Browse all', 'kelweaver' ); ?> &rarr;</a></li>
