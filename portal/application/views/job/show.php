<p><a href="#" onClick="javascript: history.go( -2 );">&lt; Back to list</a></p>
<br>

<div class="row-fluid">
<!-- OVERVIEW INFORMATION -->
	<h1><?php echo( $info->title ); ?></h1>
	<br>

	<div class="row-fluid">
		<div class="span12">
			
		</div>
	</div>

	<div class="row-fluid">
		<div class="span8">
			<table class="table">
				<tr>
					<td>
						<b>Job Number</b>
					</td><td>
						<p><?php echo( ( $job->number != 0 ? $job->number : 'Unassigned' ) ); ?></p>
					</td>
				</tr>

				<tr>
					<td>
						<b>Job Type</b>
					</td><td>
						<p><?php echo( $type->label ); ?></p>
					</td>
				</tr>

				<tr>
					<td>
						<b>Current State</b>
					</td><td>
						<p><?php echo( ucwords( strtolower( $state->state ) ) ); ?></p>
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
				<p><?php echo( rawurldecode( $dept->name ) ); ?></p>

				<b>Hours Open</b>
				<p><?php echo( $dept->opening_time . ' - ' . $dept->closing_time ); ?></p>

				<b>Days Open</b>
				<p><?php echo( parse_day_string( $dept->days_open ) ); ?></p>
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