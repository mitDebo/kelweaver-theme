document.addEventListener( 'DOMContentLoaded', function () {
	var themeSelect = document.getElementById( 'theme-select' );

	if ( themeSelect ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		var initialTheme = storedTheme || 'paperback';
		themeSelect.value = initialTheme;

		themeSelect.addEventListener( 'change', function () {
			var value = themeSelect.value;
			if ( 'paperback' === value ) {
				document.documentElement.removeAttribute( 'data-theme' );
			} else {
				document.documentElement.setAttribute( 'data-theme', value );
			}
			try {
				localStorage.setItem( 'kelweaver_theme', value );
			} catch ( e ) {}
		} );
	}
} );
