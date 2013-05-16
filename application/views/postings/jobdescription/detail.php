<h2>Student Employment Office Job Description</h2>
<p>Your job description form has been submitted successfully.  A copy of this form has been sent to the email that you have provided below.  Please check and verify that you have received a copy of this form before closing the window.  You should keep a copy of this form for your records.</p>
<br>

<table class="table">
	<tr>
		<td><b>Job Title:</b></td>
		<td colspan="3"><?php echo $title; ?></td>
	</tr>

	<tr>
		<td><b>Department:</b></td>
		<td>
			<?php
				$dept = $departments[$department];
				echo $dept;
			?>
		</td>
		<td><b>Department Code:</b></td>
		<td><?php echo $departmentCode; ?></td>
	</tr>
	<tr>
		<td><b>Department Contact:</b></td>
		<td colspan="3"><?php echo $contactName; ?></td>
	</tr>
	<tr>
		<td><b>Contact Phone:</b></td>
		<td><?php echo $contactPhone; ?></td>
		<td><b>Display Phone:</b></td>
		<td><?php echo ($displayPhone == 1 ? "Yes" : "No"); ?></td>
	</tr>
	<tr>
		<td><b>Contact Email:</b></td>
		<td><?php echo $contactEmail; ?></td>
		<td><b>Display Email:</b></td>
		<td><?php echo ($displayEmail == 1 ? "Yes" : "No"); ?></td>
	</tr>
	<tr>
		<td><b>Location:</b></td>
		<td colspan="3"><?php echo $location; ?></td>
	</tr>
	<tr>
		<td><b>Job Type:</b></td>
		<td colspan="3">
			<?php
				$type = $types[$jobType];
				echo $type;
			?>
		</td>
	</tr>
</table>

<p><b>Position Summary:</b></p>
<p><?php echo $summary; ?></p>

<p><b>Essential Tasks:</b></p>
<p><?php echo $essentialTasks; ?></p>

<p><b>Non-Essential Tasks:</b></p>
<p><?php echo $nonessentialTasks; ?></p>

<p><b>Required Skills / Qualifications:</b></p>
<p><?php echo $requiredSkills; ?></p>

<p><b>Preferred Skills / Qualifications:</b></p>
<p><?php echo $preferredSkills; ?></p>