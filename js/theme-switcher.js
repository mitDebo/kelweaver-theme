document.addEventListener( 'DOMContentLoaded', function () {
	var themeSelect = document.getElementById( 'theme-select' );
	var accentSelect = document.getElementById( 'accent-test-select' );
	var fontSelect = document.getElementById( 'font-test-select' );

	function applyAccent( value ) {
		document.documentElement.style.setProperty( '--color-accent', 'var(--color-accent-' + value + ')' );
	}

	function clearAccent() {
		document.documentElement.style.removeProperty( '--color-accent' );
	}

	function applyFont( value ) {
		document.documentElement.style.setProperty( '--font-body', 'var(--font-option-' + value + ')' );
		document.documentElement.style.setProperty( '--font-display', 'var(--font-option-' + value + ')' );
	}

	function clearFont() {
		document.documentElement.style.removeProperty( '--font-body' );
		document.documentElement.style.removeProperty( '--font-display' );
	}

	if ( themeSelect ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		var initialTheme = storedTheme || 'paperback';
		themeSelect.value = initialTheme;

		if ( 'night' === initialTheme ) {
			if ( accentSelect ) {
				applyAccent( accentSelect.value );
			}
			if ( fontSelect ) {
				applyFont( fontSelect.value );
			}
		}

		themeSelect.addEventListener( 'change', function () {
			var value = themeSelect.value;
			if ( 'paperback' === value ) {
				document.documentElement.removeAttribute( 'data-theme' );
				clearAccent();
				clearFont();
			} else {
				document.documentElement.setAttribute( 'data-theme', value );
				if ( accentSelect ) {
					applyAccent( accentSelect.value );
				}
				if ( fontSelect ) {
					applyFont( fontSelect.value );
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

	if ( fontSelect ) {
		fontSelect.addEventListener( 'change', function () {
			if ( themeSelect && 'night' === themeSelect.value ) {
				applyFont( fontSelect.value );
			}
		} );
	}
} );
