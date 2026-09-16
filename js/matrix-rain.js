document.addEventListener( 'DOMContentLoaded', function () {
	var canvas = document.getElementById( 'matrix-rain' );

	if ( ! canvas ) {
		return;
	}

	var ctx = canvas.getContext( '2d' );
	var fontSize = 18;
	var chars = 'アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン0123456789';
	var columns = 0;
	var drops = [];
	var intervalId = null;

	function resize() {
		canvas.width = window.innerWidth;
		canvas.height = window.innerHeight;
		columns = Math.floor( canvas.width / fontSize );
		drops = new Array( columns ).fill( 1 );
	}

	function draw() {
		ctx.fillStyle = 'rgba(0, 0, 0, 0.06)';
		ctx.fillRect( 0, 0, canvas.width, canvas.height );

		ctx.font = fontSize + 'px monospace';
		ctx.fillStyle = '#00ff41';

		for ( var i = 0; i < drops.length; i++ ) {
			var char = chars.charAt( Math.floor( Math.random() * chars.length ) );
			ctx.fillText( char, i * fontSize, drops[ i ] * fontSize );

			if ( drops[ i ] * fontSize > canvas.height && Math.random() > 0.975 ) {
				drops[ i ] = 0;
			}
			drops[ i ]++;
		}
	}

	function isTerminalActive() {
		return 'terminal' === document.documentElement.getAttribute( 'data-theme' );
	}

	function start() {
		if ( intervalId ) {
			return;
		}
		resize();
		ctx.fillStyle = '#000000';
		ctx.fillRect( 0, 0, canvas.width, canvas.height );
		intervalId = setInterval( draw, 50 );
	}

	function stop() {
		if ( intervalId ) {
			clearInterval( intervalId );
			intervalId = null;
		}
	}

	function sync() {
		if ( isTerminalActive() ) {
			start();
		} else {
			stop();
		}
	}

	window.addEventListener( 'resize', function () {
		if ( intervalId ) {
			resize();
		}
	} );

	new MutationObserver( sync ).observe( document.documentElement, {
		attributes: true,
		attributeFilter: [ 'data-theme' ],
	} );

	sync();
} );
