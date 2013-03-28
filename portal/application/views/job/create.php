
<div class="page-header">
	<h1>
		<small>Create a New Job</small>
	</h1>
</div>
<?php
	echo validation_errors();

	echo form_open();
	echo form_fieldset( 'Job Information' );
?>
<div class="row-fluid">
	<div class="span5">
		<label class="span12" for="title">Job Title</label>
		<input class="span12" type="text" name="title" value="<?php echo set_value( 'title' ); ?>" required />
		<br>
		
		<label class="span12" for="type_id">Job Type</label>
		<?php echo form_dropdown( 'type_id', $types, set_value( 'type_id' ), 'class="span12"' ); ?>
		<br>

		<label class="span12" for="department_id">Department</label>
		<?php echo form_dropdown( 'department_id', $departments, set_value( 'department_id' ), 'class="span12"' ); ?>
		<br>

		<label class="span12" for="dept_code">Department Code</label>
		<input type="text" class="span12" name="dept_code" placeholder="#####" value="<?php echo set_value( 'dept_code' ); ?>" required />
		<br>

		<label class="span12" for="user_id">Primary Contact</label>
		<?php echo form_dropdown( 'user_id', $users, set_value( 'user_id' ), 'class="span12"' ); ?>
	</div>
	<div class="span7">
		<label class="span12" for="summary">Summary</label>
		<textarea class="span12" name="summary" value="" required><?php echo set_value( 'summary' ); ?></textarea>

		<label class="span12" for="functions">Functions</label>
		<textarea class="span12" name="functions" value="" required><?php echo set_value( 'functions' ); ?></textarea>

		<label class="span12" for="qualifications">Qualifications</label>
		<textarea class="span12" name="qualifications" value="" required><?php echo set_value( 'qualifications' ); ?></textarea>

		<label class="span12" for="skills">Skills</label>
		<textarea class="span12" name="skills" value="" required><?php echo set_value( 'skills' ); ?></textarea>
	</div>
</div>

<?php echo form_fieldset_close(); ?>
<div class="row-fluid span12">
	<button class="btn btn-primary" type="submit">Submit Job</button>
	<button class="btn" type="button" onClick="javascript: clear_form();">Clear Form</button>
	<button class="btn" type="button" onClick="javascript: history.go( -1 );">Cancel</button>
</div>
<?php echo form_close(); ?>
<br>

<script>
	//
	//	Clear the form
	function clear_form() {
		// Clear all values
		$( "input" ).val( "" );
		$( "textarea" ).val( "" );
		$( "select" ).val( 0 );
	}
</script>