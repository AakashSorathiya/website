<div class='page-header'>
	<h1>
		<small><?php echo( $title ); ?></small>
	</h1>
</div>

<div class='row-fluid'>
	<div class='span4'>
		<?php
			// Loop through each of the filters
			foreach( $filters as $filter => $values ) {
				// Initialize an html tag
				$html = "<li class='nav-header'>$filter</li>";

				// Loop through each filter option
				foreach( $values as $key => $val ) {
					$html .= "<li><a href='?/page/jobs/$key'>$val</a></li>";
				}

				// Echo out the well
				echo "<div class='well sidebar-nav'><ul class='nav nav-list'>$html</ul></div>";
			}
		?>
	</div>
	<div class='span8'>
		<div class="jobs">
		<?php
			if( count( $jobs ) == 0 ) {
				// Temporary output if no positions are available
				echo( '<div class="alert alert-error pagination-centered">' );
				echo( '<p>We apologize but there are currently no jobs available based on the provided criteria.</p>' );
				echo( '</div>' );

			} else {
				// Loop through each of the jobs
				foreach( $jobs as $job ) {
					// Initialize any necessary information
					$html = "";

					// Localize the values
					$title = $job['title'];
					$summary = $job['summary'];
					$number = $job['number'];
					$type = $job['type'];
					$wage = '$' . format_currency( floatval( $job['wage'] ) );
					$hours = $job['hours'];
					$start_date = date( 'm/d/Y', $job['start_date'] );
					$post_date = date( 'm/d/Y', $job['post_date'] );

					// Append all of the content
					$html .= "<div class='span8'>";
					$html .= "<p class='title'><a href='?/posting/show/$number'>$title</a></p>";	// TITLE
					$html .= "<p class='summary'>$summary</p>";	// SUMMARY
					$html .= "</div>";

					$html .= "<div class='span4'>";

					$html .= "<table>";
					$html .= "<tr>";
						$html .= "<td><p class='label'>Type:</p></td>";
						$html .= "<td><p class='type'>$type</p></td>";
					$html .= "</tr><tr>";
						$html .= "<td><p class='label'>Wage:</p></td>";
						$html .= "<td><p class='wage'>$wage</p></td>";
					$html .= "</tr><tr>";
						$html .= "<td><p class='label'>Hours:</p></td>";
						$html .= "<td><p class='hours'>$hours</p></td>";
					$html .= "</tr><tr>";
						$html .= "<td><p class='label'>Start Date:</p></td>";
						$html .= "<td><p class='start_date'>$start_date</p></td>";
					$html .= "</tr><tr>";
						$html .= "<td><p class='label'>Post Date:</p></td>";
						$html .= "<td><p class='post_date'>$post_date</p></td>";
					$html .= "</tr>";
					$html .= "</table>";

					$html .= "</div>";
					$html .= "</div>";

					// Echo out the html
					echo "<div class='row-fluid job'>$html</job>";
				}
			}
		?>
		</div>
	</div>
</div>

<?php
	/**
	 * Format the number into currency
	 */
	function format_currency( $number, $fractional = true ) { 
		// Check for a fraction and make whole
		if ($fractional) $number = sprintf('%.2f', $number);

		// Loop until format is complete
		while (true) {
			// Create a replacement
			$replaced = preg_replace( '/(-?\d+)(\d\d\d)/', '$1,$2', $number );

			// Check for a new number
			if( $replaced != $number ) $number = $replaced;
			else break;
		}

		// Return the new number
		return $number; 
	}
?>