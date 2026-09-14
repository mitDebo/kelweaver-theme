<?php
/**
 * Single post template -- shows one full post: featured image, title,
 * date + category, the full content, tags, then simple "older/newer
 * post" links at the bottom. No comments -- that's a deliberate
 * decision, not something left unfinished.
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<a class="back-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		&larr; <?php esc_html_e( 'All posts', 'kelweaver' ); ?>
	</a>

	<article <?php post_class( 'single-post' ); ?> id="post-<?php the_ID(); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<h1 class="post-title"><?php the_title(); ?></h1>

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

		<div class="post-content">
			<?php the_content(); ?>
		</div>

		<?php $tags = get_the_tags(); ?>
		<?php if ( $tags ) : ?>
			<ul class="post-tags">
				<?php foreach ( $tags as $tag ) : ?>
					<li>
						<a href="<?php echo esc_url( get_tag_link( $tag ) ); ?>">
							#<?php echo esc_html( $tag->name ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

	</article>

	<nav class="post-nav" aria-label="<?php esc_attr_e( 'More posts', 'kelweaver' ); ?>">
		<div class="post-nav-prev">
			<?php previous_post_link( '%link', '&larr; %title' ); ?>
		</div>
		<div class="post-nav-next">
			<?php next_post_link( '%link', '%title &rarr;' ); ?>
		</div>
	</nav>

<?php endwhile; ?>

<?php get_footer(); ?>
