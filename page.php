<?php
/**
 * Static page template -- for standalone pages like a reading list,
 * a CV, or a project writeup (as opposed to single.php, which is for
 * blog posts). No date, category, tags, or prev/next links here --
 * those are post concepts and pages aren't part of that chronological
 * stream. A featured image shows if one's set, same as on a post.
 */
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'large' ); ?>
			</div>
		<?php endif; ?>

		<h1 class="page-title"><?php the_title(); ?></h1>

		<div class="page-content">
			<?php the_content(); ?>
		</div>

	</article>

<?php endwhile; ?>

<?php get_footer(); ?>
