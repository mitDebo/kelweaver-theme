document.addEventListener( 'DOMContentLoaded', function () {
	var themeSelect = document.getElementById( 'theme-select' );
	var mastheadFontSelect = document.getElementById( 'masthead-font-test-select' );

	function applyMastheadFont( value ) {
		document.documentElement.style.setProperty( '--font-masthead', 'var(--font-option-' + value + ')' );
	}

	function clearMastheadFont() {
		document.documentElement.style.removeProperty( '--font-masthead' );
	}

	if ( themeSelect ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		var initialTheme = storedTheme || 'paperback';
		themeSelect.value = initialTheme;

		if ( 'night' === initialTheme && mastheadFontSelect ) {
			applyMastheadFont( mastheadFontSelect.value );
		}

		themeSelect.addEventListener( 'change', function () {
			var value = themeSelect.value;
			if ( 'paperback' === value ) {
				document.documentElement.removeAttribute( 'data-theme' );
				clearMastheadFont();
			} else {
				document.documentElement.setAttribute( 'data-theme', value );
				if ( mastheadFontSelect ) {
					applyMastheadFont( mastheadFontSelect.value );
				}
			}
			try {
				localStorage.setItem( 'kelweaver_theme', value );
			} catch ( e ) {}
		} );
	}

	if ( mastheadFontSelect ) {
		mastheadFontSelect.addEventListener( 'change', function () {
			if ( themeSelect && 'night' === themeSelect.value ) {
				applyMastheadFont( mastheadFontSelect.value );
			}
		} );
	}
} );
