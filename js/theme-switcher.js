document.addEventListener( 'DOMContentLoaded', function () {
	var themeSelect = document.getElementById( 'theme-select' );
	var accentSelect = document.getElementById( 'accent-test-select' );

	function applyAccent( value ) {
		document.documentElement.style.setProperty( '--color-accent', 'var(--color-accent-' + value + ')' );
	}

	function clearAccent() {
		document.documentElement.style.removeProperty( '--color-accent' );
	}

	if ( themeSelect ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		var initialTheme = storedTheme || 'paperback';
		themeSelect.value = initialTheme;

		if ( 'night' === initialTheme && accentSelect ) {
			applyAccent( accentSelect.value );
		}

		themeSelect.addEventListener( 'change', function () {
			var value = themeSelect.value;
			if ( 'paperback' === value ) {
				document.documentElement.removeAttribute( 'data-theme' );
				clearAccent();
			} else {
				document.documentElement.setAttribute( 'data-theme', value );
				if ( accentSelect ) {
					applyAccent( accentSelect.value );
				}
			}
			try {
				localStorage.setItem( 'kelweaver_theme', value );
			} catch ( e ) {}
		} );
	}

	if ( accentSelect ) {
		accentSelect.addEventListener( 'change', function () {
			if ( themeSelect && 'night' === themeSelect.value ) {
				applyAccent( accentSelect.value );
			}
		} );
	}
} );
