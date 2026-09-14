/**
 * A checkbox in the sidebar that flips the whole site between the
 * theme's default body font (Merriweather) and Georgia, live, so you
 * can compare them side by side while deciding. The choice is saved
 * in localStorage (the browser's own small per-site storage) so it
 * survives a page reload/navigation.
 *
 * This is a small preview of the exact pattern the real Paperback /
 * Dusk / Night scheme switcher will use later: a control toggles a
 * class on <body>, CSS variables respond to that class, and
 * localStorage remembers the choice between visits.
 */
(function () {
	var STORAGE_KEY = 'kelweaver-compare-georgia';
	var checkbox = document.getElementById( 'font-compare-toggle' );

	if ( ! checkbox ) {
		return;
	}

	function apply( on ) {
		document.body.classList.toggle( 'compare-georgia', on );
	}

	var saved = localStorage.getItem( STORAGE_KEY ) === '1';
	checkbox.checked = saved;
	apply( saved );

	checkbox.addEventListener( 'change', function () {
		localStorage.setItem( STORAGE_KEY, checkbox.checked ? '1' : '0' );
		apply( checkbox.checked );
	} );
})();
