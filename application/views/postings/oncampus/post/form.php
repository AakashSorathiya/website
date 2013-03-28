<h1>On-Campus Job Posting Form</h1>

<p>
	The On-Campus Job Posting Form can only be used to post existing jobs that you have on-file with the SEO.
	If this is a <b>NEW</b> position, you will need to submit an <a href="?/employers/resources/">SEO Job Description Form</a>.
</p>

<p>* denotes a required field.</p>
<?php
	if( $browser_error != "" ) {
?>
<div class="alert alert-danger">
	<h2>WARNING!</h2>
	<p><?php echo $browser_error; ?></p>
</div>
<?php
	}
?>

<?php
	echo validation_errors();

	echo form_open('', 'class="form-horizontal"');
	echo form_fieldset( 'Job Information' );
?>
	<div class="control-group">
		<label class="control-label" for="job_number">Job Number *</label>
		<div class="controls">
			<input required type="text" id="job_number" name="job_number" class="input-block-level" value="<?php echo set_value( 'job_number' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="job_title">Job Title *</label>
		<div class="controls">
			<input required type="text" id="job_title" name="job_title" class="input-block-level" value="<?php echo set_value( 'job_title' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="start_date">Start Date *</label>
		<div class="controls">
			<input required type="text" id="start_date" name="start_date" class="input-block-level" value="<?php echo set_value( 'start_date' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="shift_hours">Hours per Week *</label>
		<div class="controls">
			<input required type="text" id="shift_hours" name="shift_hours" class="input-block-level" value="<?php echo set_value( 'shift_hours' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="work_hours">Work Hours *</label>
		<div class="controls">
			<input required type="text" id="work_hours" name="work_hours" class="input-block-level" value="<?php echo set_value( 'work_hours' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="wage">Wage *</label>
		<div class="controls">
			<input required type="text" id="wage" name="wage" class="input-block-level" value="<?php echo set_value( 'wage' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="shift_days[]">Shift Days *</label>
		<div class="controls">
			<div class="row-fluid">
				<div class="span6">
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Mon" />Monday
					</label><br>
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Tue" />Tuesday
					</label><br>
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Wed" />Wednesday
					</label><br>
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Thu" />Thursday
					</label><br>
				</div>
				<div class="span6">
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Fri" />Friday
					</label><br>
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Sat" />Saturday
					</label><br>
					<label class="inline checkbox">
						<input type="checkbox" name="shift_days[]" value="Sun" />Sunday
					</label><br>
				</div>
			</div>
		</div>
	</div>
<?php
	echo form_fieldset_close();
	echo form_fieldset( 'Contact Information' );
?>
	<div class="control-group">
		<label class="control-label" for="contact_name">Name *</label>
		<div class="controls">
			<input required type="text" id="contact_name" name="contact_name" class="input-block-level" value="<?php echo set_value( 'contact_name' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="department">Department *</label>
		<div class="controls">
			<input required type="text" id="department" name="department" class="input-block-level" value="<?php echo set_value( 'department' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="phone">Phone *</label>
		<div class="controls">
			<input required type="text" id="phone" name="phone" class="input-block-level" value="<?php echo set_value( 'phone' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="post_phone">Post Phone *</label>
		<div class="controls">
			<label class="radio">
				<input type="radio" name="post_phone" value="yes" checked />
				Yes
			</label>
			<label class="radio">
				<input type="radio" name="post_phone" value="no" />
				No
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email">Email *</label>
		<div class="controls">
			<input required type="email" id="email" name="email" class="input-block-level" value="<?php echo set_value( 'email' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="post_email">Post Email *</label>
		<div class="controls">
			<label class="radio">
				<input type="radio" name="post_email" value="yes" checked />
				Yes
			</label>
			<label class="radio">
				<input type="radio" name="post_email" value="no" />
				No
			</label>
		</div>
	</div>
<?php
	echo form_fieldset_close();
?>
	<div class="form-actions">
		<button class="btn btn-primary">Submit</button>
	</div>
</form>