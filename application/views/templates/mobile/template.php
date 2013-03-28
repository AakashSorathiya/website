<div class="banner">
	<div class="max-width container clearfix">
		<div class="seo-mast"></div>
	</div>
</div>

<?php require_once 'navigation.php'; ?>

<div class="content container">
	<?php echo $body ?>
</div>

<script>
	$( function()
		{
			// Fix the tables on the view
			fixTables();
		}
	);

	// Used to fix the tables on the page
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