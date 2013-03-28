<br>
<div class="row-fluid">
	<div class="span8 offset2">
		<div class="alert alert-danger">
			<h3>A PHP Error was encountered</h3>
			<br>
			<table class="table">
				<tr>
					<td><b>Severity:</b></td>
					<td><?php echo $severity; ?></td>
				</tr>
				<tr>
					<td><b>Error Message:</b></td>
					<td><?php echo $message; ?></td>
				</tr>
				<tr>
					<td><b>Filename:</b></td>
					<td><?php echo $filepath; ?></td>
				</tr>
				<tr>
					<td><b>Line Number:</b></td>
					<td><?php echo $line; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>