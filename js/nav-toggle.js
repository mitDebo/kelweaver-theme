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
