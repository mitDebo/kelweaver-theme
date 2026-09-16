	</div>

</div>

<footer class="site-footer">
	<div class="site-footer-inner">
		<hr class="section-divider">
		<?php get_template_part( 'template-parts/social-icons', null, array( 'class' => 'site-social--footer' ) ); ?>
		<p class="site-copyright">
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Kelly Weaver
		</p>
	</div>
</footer>

<a href="https://tarpit.kdubs.tech" rel="nofollow" aria-hidden="true" tabindex="-1" class="screen-reader-text">do not follow</a>

<?php wp_footer(); ?>
</body>
</html>
