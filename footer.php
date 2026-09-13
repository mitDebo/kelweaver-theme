<?php
/**
 * Closes the two wrapper divs opened in header.php (see the comment
 * there), then WordPress's own wp_footer() hook, then the page.
 * Real footer content (copyright line, widgets, etc.) comes in the
 * "footer.php and loose ends" step -- this just closes things off
 * correctly for now so the layout is structurally valid.
 */
?>

	</div><!-- .site-content -->

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
