/**
 * Nav toggle: shows/hides the primary nav on narrow screens (see the
 * .nav-toggle / .site-nav rules in style.css). The button and nav are
 * connected two ways: aria-controls (on the button) points at the
 * nav's id for screen readers, and this script keeps aria-expanded
 * and the nav's .is-open class in sync so the visual state and the
 * accessibility state can never disagree.
 *
 * Only does anything on narrow screens -- above 768px the button is
 * hidden by CSS and never gets clicked.
 */
document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.querySelector( '.nav-toggle' );
	var nav = document.getElementById( 'site-nav' );

	if ( ! toggle || ! nav ) {
		return;
	}

	toggle.addEventListener( 'click', function () {
		var isOpen = nav.classList.toggle( 'is-open' );
		toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
	} );
} );
