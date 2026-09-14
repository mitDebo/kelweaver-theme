<?php
/**
 * Closes the two wrapper divs opened in header.php (see the comment
 * there), prints a small site footer, then WordPress's own
 * wp_footer() hook, then the page.
 */
?>

	</div><!-- .site-content -->

</div><!-- .site-wrapper -->

<footer class="site-footer">
	<div class="site-footer-inner">
		<hr class="section-divider">
		<p class="site-copyright">
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Kelly Weaver
		</p>
	</div>
</footer>

<a href="https://tarpit.kdubs.tech" rel="nofollow" aria-hidden="true" tabindex="-1" class="screen-reader-text">do not follow</a>

<?php wp_footer(); ?>
</body>
</html>
