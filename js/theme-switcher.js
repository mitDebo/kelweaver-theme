document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.getElementById( 'theme-swatch-toggle' );
	var list = document.getElementById( 'theme-swatch-list' );
	var switcher = document.getElementById( 'theme-switcher' );
	var options = list ? list.querySelectorAll( '[data-theme-value]' ) : [];

	function setTheme( value ) {
		if ( 'paperback' === value ) {
			document.documentElement.removeAttribute( 'data-theme' );
		} else {
			document.documentElement.setAttribute( 'data-theme', value );
		}
		try {
			localStorage.setItem( 'kelweaver_theme', value );
		} catch ( e ) {}
	}

	if ( toggle && list && switcher ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		var initialTheme = storedTheme || 'paperback';
		setTheme( initialTheme );

		options.forEach( function ( option ) {
			option.addEventListener( 'click', function () {
				setTheme( option.getAttribute( 'data-theme-value' ) );
				toggle.setAttribute( 'aria-expanded', 'false' );

				// Force the list closed right away, even though the mouse may
				// still be hovering it or focus may still be inside it.
				switcher.classList.add( 'is-suppressed' );
				if ( document.activeElement && switcher.contains( document.activeElement ) ) {
					document.activeElement.blur();
				}
			} );
		} );

		switcher.addEventListener( 'mouseenter', function () {
			toggle.setAttribute( 'aria-expanded', 'true' );
		} );

		switcher.addEventListener( 'mouseleave', function () {
			toggle.setAttribute( 'aria-expanded', 'false' );
			// Once the mouse actually leaves, the next hover should open it again.
			switcher.classList.remove( 'is-suppressed' );
		} );

		switcher.addEventListener( 'focusin', function () {
			toggle.setAttribute( 'aria-expanded', 'true' );
		} );

		switcher.addEventListener( 'focusout', function () {
			window.setTimeout( function () {
				if ( ! switcher.contains( document.activeElement ) ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
					switcher.classList.remove( 'is-suppressed' );
				}
			}, 0 );
		} );
	}
} );
