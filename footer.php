	</div>

</div>

<footer class="site-footer">
	<div class="site-footer-inner">
		<hr class="section-divider">
		<div class="site-footer-row">
			<?php get_template_part( 'template-parts/social-icons', null, array( 'class' => 'site-social--footer' ) ); ?>
			<p class="site-copyright">
				&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> Kelly Weaver
			</p>
			<div class="theme-switcher" id="theme-switcher">
				<button type="button" class="theme-swatch theme-swatch-current" id="theme-swatch-toggle" aria-haspopup="true" aria-expanded="false" aria-controls="theme-swatch-list">
					<span class="screen-reader-text"><?php esc_html_e( 'Color scheme', 'kelweaver' ); ?></span>
				</button>
				<ul class="theme-swatch-list" id="theme-swatch-list">
					<li>
						<button type="button" class="theme-swatch-option" data-theme-value="paperback">
							<span class="theme-swatch-option-label"><?php esc_html_e( 'Paperback', 'kelweaver' ); ?></span>
							<span class="theme-swatch theme-swatch-paperback" aria-hidden="true"></span>
						</button>
					</li>
					<li>
						<button type="button" class="theme-swatch-option" data-theme-value="night">
							<span class="theme-swatch-option-label"><?php esc_html_e( 'Night', 'kelweaver' ); ?></span>
							<span class="theme-swatch theme-swatch-night" aria-hidden="true"></span>
						</button>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>

<a href="https://tarpit.kdubs.tech" rel="nofollow" aria-hidden="true" tabindex="-1" class="screen-reader-text">do not follow</a>

<?php wp_footer(); ?>
</body>
</html>
