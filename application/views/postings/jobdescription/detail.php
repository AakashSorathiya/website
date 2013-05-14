<table class="table">
	<tr>
		<td>Department Id</td>
		<td><?php echo $department; ?></td>
	</tr>
	<tr>
		<td>Department Code</td>
		<td><?php echo $departmentCode; ?></td>
	</tr>
	<tr>
		<td>Location</td>
		<td><?php echo $location; ?></td>
	</tr>
	<tr>
		<td>Contact Name</td>
		<td><?php echo $contactName; ?></td>
	</tr>
	<tr>
		<td>Contact DCE</td>
		<td><?php echo $contactDCE; ?></td>
	</tr>
	<tr>
		<td>Contact Phone</td>
		<td><?php echo $contactPhone; ?></td>
	</tr>
	<tr>
		<td>Display Phone</td>
		<td><?php echo ($displayPhone == 1 ? "Yes" : "No"); ?></td>
	</tr>
	<tr>
		<td>Contact Email</td>
		<td><?php echo $contactEmail; ?></td>
	</tr>
	<tr>
		<td>Display Email</td>
		<td><?php echo ($displayEmail == 1 ? "Yes" : "No"); ?></td>
	</tr>
	<tr>
		<td>Job Title</td>
		<td><?php echo $title; ?></td>
	</tr>
	<tr>
		<td>Position Summary</td>
		<td><?php echo $summary; ?></td>
	</tr>
	<tr>
		<td>Essential Tasks</td>
		<td><?php echo $essentialTasks; ?></td>
	</tr>
	<tr>
		<td>Non-Essential Tasks</td>
		<td><?php echo $nonessentialTasks; ?></td>
	</tr>
	<tr>
		<td>Required Skills</td>
		<td><?php echo $requiredSkills; ?></td>
	</tr>
	<tr>
		<td>Preferred Skills</td>
		<td><?php echo $preferredSkills; ?></td>
	</tr>
	<tr>
		<td>Job Type</td>
		<td><?php echo $jobType; ?></td>
	</tr>
</table>