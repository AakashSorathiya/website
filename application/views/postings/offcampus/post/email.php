<div>
	<table>
		<tr>
			<td><b>Company Name:</b></td>
			<td><?php echo( $company_name ); ?></td>
		</tr>

		<tr>
			<td><b>Address / Location:</b></td>
			<td><?php echo( $address ); ?></td>
		</tr>

		<?php if( $city != "" ) { ?>
		<tr>
			<td><b>City:</b></td>
			<td><?php echo( $city ); ?></td>
		</tr>
		<?php } ?>

		<?php if( $state != "" ) { ?>
		<tr>
			<td><b>State:</b></td>
			<td><?php echo( $state ); ?></td>
		</tr>
		<?php } ?>

		<?php if( $zip != "" ) { ?>
		<tr>
			<td><b>Zip:</b></td>
			<td><?php echo( $zip ); ?></td>
		</tr>
		<?php } ?>

		<tr>
			<td><b>Contact Name:</b></td>
			<td><?php echo( $contact_name ); ?></td>
		</tr>

		<tr>
			<td><b>Email:</b></td>
			<td><?php echo( $email ); ?></td>
		</tr>

		<?php if( $phone != "" ) { ?>
		<tr>
			<td><b>Phone:</b></td>
			<td><?php echo( $phone ); ?></td>
		</tr>
		<?php } ?>

		<?php if( $fax != "" ) { ?>
		<tr>
			<td><b>Fax:</b></td>
			<td><?php echo( $fax ); ?></td>
		</tr>
		<?php } ?>

		<tr>
			<td><b>Job Title:</b></td>
			<td><?php echo( $title ); ?></td>
		</tr>

		<tr>
			<td><b>Start Date:</b></td>
			<td><?php echo( $start_date ); ?></td>
		</tr>

		<tr>
			<td><b>Hours per Week:</b></td>
			<td><?php echo( $shift_hours ); ?></td>
		</tr>

		<?php if( $work_hours != "" ) { ?>
		<tr>
			<td><b>Work Hours:</b></td>
			<td><?php echo( $work_hours ); ?></td>
		</tr>
		<?php } ?>

		<tr>
			<td><b>Wage:</b></td>
			<td><?php echo( $wage ); ?></td>
		</tr>

		<?php if( $shift_days != "" ) { ?>
		<tr>
			<td><b>Shift Days:</b></td>
			<td><?php echo( $shift_days ); ?></td>
		</tr>
		<?php } ?>

		<tr>
			<td><b>Job Category:</b></td>
			<td><?php echo( $category ); ?></td>
		</tr>

		<tr>
			<td><b>Position Summary:</b></td>
			<td><?php echo( $summary ); ?></td>
		</tr>

		<tr>
			<td><b>Position Requirements:</b></td>
			<td><?php echo( $requirements ); ?></td>
		</tr>
	</table>
</div>