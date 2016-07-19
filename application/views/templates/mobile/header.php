<?php
	echo meta( 'viewport', 'width=device-width, initial-scale=1.0, user-scalable=no' );

	echo meta( 'apple-mobile-web-app-capable', 'yes' );
	echo meta( 'apple-mobile-web-app-title', 'RITSEO' );
	echo meta( 'apple-mobile-web-app-status-bar-style', 'black-translucent' );

	echo link_tag( array( 'href' => 'assets/img/ios/Icon-72.png', 'rel' => 'apple-touch-icon', 'sizes' => '72x72' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon-72@2x.png', 'rel' => 'apple-touch-icon', 'sizes' => '144x144' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon-Small-50.png', 'rel' => 'apple-touch-icon', 'sizes' => '50x50' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon-Small-50@2x.png', 'rel' => 'apple-touch-icon', 'sizes' => '100x100' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon-Small.png', 'rel' => 'apple-touch-icon', 'sizes' => '29x29' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon-Small@2x.png', 'rel' => 'apple-touch-icon', 'sizes' => '58x58' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon.png', 'rel' => 'apple-touch-icon', 'sizes' => '57x57' ) );
	echo link_tag( array( 'href' => 'assets/img/ios/Icon@2x.png', 'rel' => 'apple-touch-icon', 'sizes' => '114x114' ) );

	echo link_tag( 'assets/css/bootstrap-responsive.min.css', 'stylesheet', 'text/css' );
	echo link_tag( 'assets/css/add2home.css', 'stylesheet', 'text/css' );
?>

<style>
	body {
		padding-left: 0;
		padding-right: 0;
		padding-bottom: 10px;
	}

	body img {
		width: 98%;
	}

	.banner .seo-mast {
		background-position: center center;
		background-size: 100% auto;
		width: 100%;
	}

	.navbar-inner {z
		border-radius: 0;
		border-right: 0;
		border-left: 0;
	}

	.content.container {
		margin-left: 5px;
		margin-right: 5px;
		position: relative;
	}
</style>

<script>
	// Add to home screen configuration
	var addToHomeConfig = {
		animationIn		: 'bubble',
		animationOut	: 'fade',
		lifespan		: 10000,
		expire			: 2,
		touchIcon		: true
	};

	/**
	 *	Lazy Initialization
	 */
	$( function()
		{
			// Fix the tables on the view
			fixTables();
		}
	);

	/**
	 *	Fix the tables on some pages
	 */
	function fixTables()
	{
		// Loop through each of the rows
		$( 'tr' ).each( function() {
				// Get the columns
				var columns = $( this ).find('td');

				// Check the length
				if( columns.length > 2 ) {
					// Push the columns
					var rows = [],
						row = $( '<tr>' );

					// Loop through the columns jquery object
					columns.each(
						function(x) {
							// Append the column
							row.append( this );

							// Check the index
							if( x % 2 == 1 )
							{
								// Push the row
								rows.push( row );

								// Initialize a new row
								row = $( '<tr>' );
							}
						}
					);

					console.log( rows );

					// Loop through the rows
					for( y in rows )
						// Append the row before
						$( this ).before( rows[y] );

					// Remove this row
					$( this ).remove();
				} else {
					// Remove the colspan attribute
					columns.removeAttr('colspan');
				}
			}
		);
	}
</script>

<?php echo script_tag( 'assets/js/add2home.js' ); ?>
