<?php
/**
 * Main template file -- the homepage post stream. Shows an excerpt of
 * each post (title, date, category, a snippet of text, "read more"),
 * newest first, paginated per Settings > Reading in wp-admin.
 */
get_header();
?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>" class="post-thumbnail">
					<?php the_post_thumbnail( 'medium' ); ?>
				</a>
			<?php endif; ?>

			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<div class="post-meta">
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
				</time>
				<?php $categories = get_the_category(); ?>
				<?php if ( ! empty( $categories ) ) : ?>
					<span class="post-category">
						<?php echo esc_html( $categories[0]->name ); ?>
					</span>
				<?php endif; ?>
			</div>

			<div class="post-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<a class="read-more" href="<?php the_permalink(); ?>">
				<?php esc_html_e( 'Read more', 'kelweaver' ); ?> &rarr;
			</a>

		</article>

	<?php endwhile; ?>

	<div class="pagination">
		<?php the_posts_pagination(); ?>
	</div>

<?php else : ?>

	<p><?php esc_html_e( 'No posts yet.', 'kelweaver' ); ?></p>

<?php endif; ?>

<?php get_footer(); ?>
