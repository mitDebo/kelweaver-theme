<?php
/**
 * Template Name: Archive
 *
 * A single page listing every post ever published, grouped by year,
 * as just a date + title (no excerpts) -- for quickly scanning
 * everything at once or jumping to something you remember writing a
 * while back, rather than clicking "next page" through the homepage.
 *
 * To use this: in wp-admin, create a Page titled "Archive" (slug
 * "archive" -- that's what the sidebar's "Browse all" link looks
 * for), and in the Page Attributes panel pick "Archive" as the
 * template, then publish. Nothing else to configure; the list below
 * is generated automatically from your posts.
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<?php if ( get_the_content() ) : ?>
		<div class="page-content"><?php the_content(); ?></div>
	<?php endif; ?>
<?php endwhile; ?>

<?php
$all_posts = new WP_Query(
	array(
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'no_found_rows'  => true,
		'post_status'    => 'publish',
	)
);

$current_year = null;

if ( $all_posts->have_posts() ) :
	while ( $all_posts->have_posts() ) :
		$all_posts->the_post();
		$year = get_the_date( 'Y' );

		if ( $year !== $current_year ) :
			if ( null !== $current_year ) :
				echo '</ul>';
			endif;
			?>
			<h2 class="archive-year"><?php echo esc_html( $year ); ?></h2>
			<ul class="archive-list">
			<?php
			$current_year = $year;
		endif;
		?>
		<li>
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
				<?php echo esc_html( get_the_date( 'M j' ) ); ?>
			</time>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
	<?php
	endwhile;
	echo '</ul>';
	wp_reset_postdata();
else :
	?>
	<p><?php esc_html_e( 'No posts yet.', 'kelweaver' ); ?></p>
	<?php
endif;
?>

<?php get_footer(); ?>
