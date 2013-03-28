<h2 class="section-title"><b>Student Employment Office Calendar of Events</b></h2>
<center>
	<?php
		// Define variables for api
		$protocol = "https";
		$host = "www.google.com";
		$app = "calendar";

		// Define the parameter list for the application
		$params = array(
			"showTitle" => "0",
			"showPrint" => "0",
			"showTabs" => "0",
			"showCalendars" => "0",
			"showTz" => "0",
			"mode" => "MONTH",
			"height" => "600",
			"wkst" => "1",
			"src" => array(
				"employment.rit@gmail.com"
			),
			"ctz" => "America/New_York"
		);

		// Initialize a query
		$query = "";

		// Loop through each parameter
		foreach( $params as $param => $value ) {
			// Check the query
			if( $query != "" ) $query .= "&";

			// Check the type of the value
			if( gettype( $value ) != "string" ) {
				// Query string
				$query2 = "";

				// Loop through each of the values
				foreach( $value as $element ) {
					// Check the second query
					if( $query2 != "" ) $query2 .= "&";
					
					// Joing the new string
					$query2 .= k_v_join( "=", $param, $element );
				}

				// Append the second string to the initial query
				$query .= $query2;
			} else {
				// Get the param string
				$query .= k_v_join( "=", $param, $value );
			}
		}

		// Create an src
		// $src = "$protocol://$host/$app/b/0/embed?$query";
		$src = "/seo/assets/api/calendar.google.php?$query";

		/**
		 * Joing a kv pair
		 */
		function k_v_join( $del, $key, $val ) {
			// Return the joinged values
			return $key . $del . $val;
		}
	?>
	<iframe src="<?php echo( $src ); ?>" style="border: 0" width="624px" height="600px" frameborder="0" scrolling="no"></iframe>
</center>