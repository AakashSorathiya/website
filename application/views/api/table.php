<table>
	<thead>
		<tr>
			<th>Job Number</th>
			<th>Job Title</th>
			<th>Category</th>
			<th>Added</th>
		</tr>
	</thead>

<?php
	// Loop through each of the entries
	foreach( $entries as $entry ) {
		// Get the category
		$category = $types[$entry->category];

		// Get the timestamp
		$timestamp = date( 'F j, Y',  intval( $entry->added ) );
?>
	<tr>
		<td><?php echo $entry->job_number; ?></td>
		<td><?php echo $entry->job_title; ?></td>
		<td><?php echo $category; ?></td>
		<td><?php echo $timestamp; ?></td>
	</tr>
<?php } ?>

</table>