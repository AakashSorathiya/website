<table style="width:100%;">
	<tbody>
		<tr>
			<td style="width:50%;"></td>
			<td style="text-align:right;width:50%;">
				<b>Job Number:</b>
				__________________
			</td>
		</tr>
	</tbody>
</table>

<h2 style="text-align:center;">Student Employment Office Job Description Form</h2>
<div style="font-size:11pt;">
	<table style="border-spacing:10px;width:100%;">
		<tr>
			<td><b>Job Title:</b></td>
			<td style="border-bottom:1px solid #000;" colspan="3"><?php echo $title; ?></td>
		</tr>

		<tr>
			<td><b>Department:</b></td>
			<td style="border-bottom:1px solid #000;">
				<?php
				$dept = $departments[$department];
				echo $dept;
				?>
			</td>
			<td><b>Department Code:</b></td>
			<td style="border-bottom:1px solid #000;"><?php echo $departmentCode; ?></td>
		</tr>
		<tr>
			<td><b>Department Contact:</b></td>
			<td style="border-bottom:1px solid #000;" colspan="3"><?php echo $contactName; ?></td>
		</tr>
		<tr>
			<td><b>Contact Phone:</b></td>
			<td style="border-bottom:1px solid #000;"><?php echo $contactPhone; ?></td>
			<td><b>Display Phone:</b></td>
			<td style="border-bottom:1px solid #000;"><?php echo ($displayPhone == 1 ? "Yes" : "No"); ?></td>
		</tr>
		<tr>
			<td><b>Contact Email:</b></td>
			<td style="border-bottom:1px solid #000;"><?php echo $contactEmail; ?></td>
			<td><b>Display Email:</b></td>
			<td style="border-bottom:1px solid #000;"><?php echo ($displayEmail == 1 ? "Yes" : "No"); ?></td>
		</tr>
		<tr>
			<td><b>Location:</b></td>
			<td style="border-bottom:1px solid #000;" colspan="3"><?php echo $location; ?></td>
		</tr>
		<tr>
			<td><b>Job Type:</b></td>
			<td style="border-bottom:1px solid #000;" colspan="3">
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
</div>