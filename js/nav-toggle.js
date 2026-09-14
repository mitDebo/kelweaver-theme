/**
 * Sidebar toggle: shows/hides the WHOLE sidebar (nav, Latest, search,
 * social/RSS -- everything in aside#site-sidebar) on narrow screens,
 * as one unit, via the hamburger button in the masthead (see the
 * .nav-toggle / #site-sidebar rules in style.css).
 *
 * The button and sidebar are connected two ways: aria-controls (on
 * the button) points at the sidebar's id for screen readers, and this
 * script keeps aria-expanded and the sidebar's .is-open class in sync
 * so the visual state and the accessibility state can never disagree.
 *
 * Only does anything on narrow screens -- above 768px the button is
 * hidden by CSS and never gets clicked.
 */
document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.querySelector( '.nav-toggle' );
	var sidebar = document.getElementById( 'site-sidebar' );

	if ( ! toggle || ! sidebar ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = sidebar.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	} );
} );
