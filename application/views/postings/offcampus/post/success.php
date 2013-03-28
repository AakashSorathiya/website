<div class="alert alert-success">
	<h2>Submission Success</h2>
	<p>Your position was submitted successfully.  Please save or print the contents below for your records.</p>
</div>

<div class="controls">
	<button class="btn" onClick="printPage();">Print</button>
</div>
<br>

<div id="printArea" class="well">
	<?php echo $email; ?>
</div>

<script>
	/**
	 * Print the page
	 */
	function printPage() {
		// Remove the print frame
		$( '#printFrame' ).remove();

		// get the contents
		var source = $( "#printArea" ).html();

		// Make a print function
		var printFunction = "(function() { window.print(); })()";

		// Append a function
		// Need to break up the script
		source += "<scri" + "pt>" + printFunction + "</scri" + "pt>";

		// Create and print the document
		$( "<iframe>", {
				id : 'printFrame',
				srcdoc : source,
				css : {
					'display' : 'none'
				}
			}
		).appendTo( 'body' );
	}

	/**
	 * Save the page
	 */
	function savePage() {

	}
</script>