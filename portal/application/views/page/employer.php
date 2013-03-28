<div class='page-header'>
	<h1>
		<small>Employers</small>
	</h1>
</div>

<div class='clearfix'>
	<div class='pull-left'>
		<a class='btn' href='?/job/create'>Create New Job</a>
	</div>

	<div class='pull-right'>
		<select id="department">
			<option value="NULL">All Departments</option>
			<?php
				// Loop through each department
				foreach( $departments as $id => $dept ) {
					// Check the department
					if( $department == $id ) {
						// Echo out the option
						echo( "<option selected value='$id'>$dept</option>" );
					} else {
						// Echo out the option
						echo( "<option value='$id'>$dept</option>" );
					}
				}
			?>
		</select>
	</div>
</div>
<br>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th></th>
			<th>Number</th>
			<th>Title</th>
			<th>Status</th>
			<th>Summary</th>
			<th>Department</th>
		</tr>
	</thead>

	<?php
		// Count the jobs
		if( count( $jobs ) == 0 ) {
			// Output an error
			echo( '<tr><td colspan="6">' );
			echo( '<div class="alert alert-danger pagination-centered">We currently do not have any positions for you based on your specified criteria.</div>' );
			echo( '</td></tr>' );

		} else {
			// Loop through each item
			foreach( $jobs as $item ) {
				// Output the opening item
				echo "<tr>";

				// Initialize a control string
				$controls = '';

				// get the number
				$id = $item['id'];
				$number = $item['number'];

				// Check the state before 
				if( $item['state'] == 'Approved' || $item['state'] == 'Unposted' ) {
					// Create a target for the button
					$target = "?/posting/create/$number";
					$icon = '<i class="icon-pushpin"></i>';

					// Append the post control
					$controls .= "<a href='$target' title='Post Job' class='btn btn-warning'>$icon</a>";
				} else if( $item['state'] == 'Posted' ) {
					// Create a target for the button
					$target = "?/posting/remove/$number";
					$icon = '<i class="icon-pushpin"></i>';

					// Append the unpost control
					$controls .= "<a href='$target' title='Unpost Job' class='btn btn-success'>$icon</a>";
				}

				// Edit Control
				$icon = '<i class="icon-edit"></i>';
				$controls .= "<a href='?/job/edit/$id' title='Edit Job' class='btn'>$icon</a>";

				// Delete Control
				$icon = '<i class="icon-trash"></i>';				
				$controls .= "<a href='?/job/remove/$id' title='Delete Job' class='btn btn-danger'>$icon</a>";

				// Output an action item
				echo ( '<td>' );
				echo ( '<div class="btn-toolbar">' );
				echo ( '<div class="btn-group btn-group-vertical">' );
				echo ( $controls );
				echo ( '</div>' );
				echo ( '</div>' );
				echo ( '</td>' );

				// Job Number
				echo( '<td>' . $item['number'] . '</td>' );

				// Title
				echo( '<td><a href="?/job/show/' . $item['id'] . '">' . $item['title'] . '</a></td>' );

				// Status
				echo( '<td>' . $item['state'] . '</td>' );

				// Summary
				echo( '<td>' . $item['summary'] . '</td>' );

				// Department
				echo( '<td>' . $item['department'] . '</td>' );

				// Output the closing item
				echo "</tr>";
			}
		}
	?>
</table>
<br>

<script>
	//
	//	LAZY INITIALIZATION
	$( function() {
			// Alert the department
			$( '#department' ).change( function() {
					// Store the value of this object
					var value = $( this ).val(),
						URL = "?/page/employer";

					// Check the value
					if( value != 'NULL' ) {
						// Show only this department
						URL += value;
					}

					// Navigate to the URL
					window.location.href = URL;
				}
			);
		}
	);
</script>