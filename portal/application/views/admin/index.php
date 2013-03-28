<div class="row-fluid">
	<div class="span5">
		<button class="btn" onClick="javascript: history.go( -1 );">Back</button>
	</div>
	<div class="span7">
		<div>
			<form id="approval" method="POST">
				<input id="ID" name="ID" type="hidden" value="<?php echo( $job->ID ); ?>" />
				<div class="pull-left">
					<label for="number">
						<b>Job Number:</b>
						<input id="number" name="number" type="text" />
					</label>
				</div>
				<input id="current_state" name="current_state" type="hidden" />

				&nbsp;&nbsp;
				<button class="btn btn-success" onClick="approve();">Approve</button>
				<button class="btn btn-danger" onClick="deny();">Deny</button>
			</form>
		</div>
		<div>
			<b>Past Job Numbers:</b>
			<p><?php echo( $similar ); ?></p>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<!-- OVERVIEW INFORMATION -->
		<h1><?php echo( $info->title ); ?></h1>
		<br>
	</div>
</div>

<div class="row-fluid">
	<div class="row-fluid">
		<div class="span8">
			<table class="table">
				<tr>
					<td>
						<b>Job Type</b>
					</td><td>
						<p><?php echo( $type->label ); ?></p>
					</td>
				</tr>
				<tr>
					<td>
						<b>Job Number</b>
					</td>
					<td>
						<p><?php echo( $job->number != "0" ? $job->number : "Unassigned" ); ?></p>
					</td>
				</tr>
			</table>

			<!-- DETAILED INFORMATION -->
			<h5>Summary</h5>
			<p><?php echo( $info->summary ); ?></p>

			<h5>Functions</h5>
			<p><?php echo( $info->functions ); ?></p>

			<h5>Qualifications</h5>
			<p><?php echo( $info->qualifications ); ?></p>

			<h5>Skills</h5>
			<p><?php echo( $info->skills ); ?></p>
		</div>

		<div class="span4">
			<!-- DEPARTMENT INFORMATION -->
			<div class="well">
				<h5>Department</h5>
				<p><?php echo( $dept->name ); ?></p>

				<b>Hours Open</b>
				<p><?php echo( $dept->opening_time . ' - ' . $dept->closing_time ); ?></p>

				<b>Days Open</b>
				<p><?php echo( parse_day_string( $dept->days_open ) ); ?></p>

				<b>Department Codes</b>
				<p>
					<?php
						// Initialze a code string
						$code_string = '';

						// Loop through each of the codes
						foreach( $codes as $code ) {
							// Check for pre-existent content
							if( $code_string != '' ) $code_string .= ', ';

							// Append the code to the string
							$code_string .= $code->code;
						}

						// Echo out the string
						echo( $code_string );
					?>
				</p>
			</div>

			<!-- CONTACT INFORMATION -->
			<div class="well">
				<h5>Point of Contact</h5>
				<?php
					// Echo out the point of contact
					echo( '<p>' . $contact->display_name . '</p>' );

					// Create a mailing link
					echo( '<p><a target="_blank" href="mailto:' . $contact->dce . '@rit.edu">' . $contact->dce . '@rit.edu</a></p>' );
				?>
			</div>
		</div>
	</div>
</div>

<script>
	//
	//	Approve a position on campus
	function approve() {
		// Check the job number
		if( $( "#number" ).val() != "" ) {
			// Approve the position
			$( "#current_state" ).val( "approved" );
			$( "#approval" ).submit();

		} else {
			// Notify the user when information isnt included
			alert( "You must enter a job number in order to approve the position." );
		}
	}

	//
	//	Deny a position on campus
	function deny() {
		// Deny the position
		$( "#current_state" ).val( "denied" );
		$( "#approval" ).submit();
	}
</script>