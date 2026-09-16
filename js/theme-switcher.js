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
				toggle.focus();
			} );
		} );

		switcher.addEventListener( 'focusin', function () {
			toggle.setAttribute( 'aria-expanded', 'true' );
		} );

		switcher.addEventListener( 'focusout', function () {
			window.setTimeout( function () {
				if ( ! switcher.contains( document.activeElement ) ) {
					toggle.setAttribute( 'aria-expanded', 'false' );
				}
			}, 0 );
		} );

		switcher.addEventListener( 'mouseenter', function () {
			toggle.setAttribute( 'aria-expanded', 'true' );
		} );

		switcher.addEventListener( 'mouseleave', function () {
			toggle.setAttribute( 'aria-expanded', 'false' );
		} );
	}
} );
