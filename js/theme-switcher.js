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

	function openList() {
		switcher.classList.add( 'is-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );
	}

	function closeList() {
		switcher.classList.remove( 'is-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
	}

	if ( toggle && list && switcher ) {
		var storedTheme = null;
		try {
			storedTheme = localStorage.getItem( 'kelweaver_theme' );
		} catch ( e ) {}
		setTheme( storedTheme || 'paperback' );

		toggle.addEventListener( 'click', function ( event ) {
			event.stopPropagation();
			if ( switcher.classList.contains( 'is-open' ) ) {
				closeList();
			} else {
				openList();
			}
		} );

		options.forEach( function ( option ) {
			option.addEventListener( 'click', function ( event ) {
				event.stopPropagation();
				setTheme( option.getAttribute( 'data-theme-value' ) );
				closeList();
			} );
		} );

		document.addEventListener( 'click', function ( event ) {
			if ( ! switcher.contains( event.target ) ) {
				closeList();
			}
		} );

		document.addEventListener( 'keydown', function ( event ) {
			if ( 'Escape' === event.key && switcher.classList.contains( 'is-open' ) ) {
				closeList();
				toggle.focus();
			}
		} );
	}
} );
