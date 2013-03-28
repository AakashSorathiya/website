<?php
	// Create default values for the form
	$title = $info->title;
	$type_id = $info->type_id;
	$department_id = $job->department_id;
	$dept_code = $info->dept_code;
	$user_id = $poc->user_id;
	$summary = $info->summary;
	$functions = $info->functions;
	$qualifications =  $info->qualifications;
	$skills = $info->skills;
?>
<div class="page-header">
	<h1>
		<small>Edit your Job</small>
	</h1>
</div>

<div class="alert alert-danger">
	<h3>Important Notice</h3>
	<p>By changing the information about this job, the position must be re-approved by the Student Employment Office before it can be posted.</p>
</div>

<?php
	echo validation_errors();

	echo form_open();
	echo form_fieldset( 'Job Information' );
?>
<div class="row-fluid">
	<div class="span5">
		<label class="span12" for="title">Job Title</label>
		<input class="span12" type="text" name="title" value="<?php echo set_value( 'title', $title ); ?>" required />
		<br>
		
		<label class="span12" for="type_id">Job Type</label>
		<?php echo form_dropdown( 'type_id', $types, set_value( 'type_id' ), 'class="span12"' ); ?>
		<br>

		<label class="span12" for="department_id">Department</label>
		<?php echo form_dropdown( 'department_id', $departments, set_value( 'department_id', $department_id ), 'class="span12"' ); ?>
		<br>

		<label class="span12" for="dept_code">Department Code</label>
		<input type="text" class="span12" name="dept_code" placeholder="#####" value="<?php echo set_value( 'dept_code', $dept_code ); ?>" required />
		<br>

		<label class="span12" for="user_id">Primary Contact</label>
		<?php echo form_dropdown( 'user_id', $users, set_value( 'user_id', $user_id ), 'class="span12"' ); ?>
	</div>
	<div class="span7">
		<label class="span12" for="summary">Summary</label>
		<textarea class="span12" name="summary" value="" required><?php echo set_value( 'summary', $summary ); ?></textarea>

		<label class="span12" for="functions">Functions</label>
		<textarea class="span12" name="functions" value="" required><?php echo set_value( 'functions', $functions ); ?></textarea>

		<label class="span12" for="qualifications">Qualifications</label>
		<textarea class="span12" name="qualifications" value="" required><?php echo set_value( 'qualifications', $qualifications ); ?></textarea>

		<label class="span12" for="skills">Skills</label>
		<textarea class="span12" name="skills" value="" required><?php echo set_value( 'skills', $skills ); ?></textarea>
	</div>
</div>

<?php echo form_fieldset_close(); ?>
<div class="row-fluid span12">
	<button class="btn btn-primary" onClick="javascript: submit_changes();">Submit Changes</button>
	<button class="btn" type="button" onClick="javascript: history.go( -1 );">Cancel Changes</button>
</div>
<?php echo form_close(); ?>
<br>

<script>
	//
	//	Submit the changes
	function submit_changes() {
		// Confirm the submission of changes
		var conf = confirm( 'Are you sure you want to re-submit this job for approval?' );

		// Check the confirmation
		if( conf ) $( "form" ).submit();
	}
</script>