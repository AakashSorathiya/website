<?php
	echo validation_errors();

	echo form_open('', 'class="form-horizontal"');
	echo form_fieldset( 'Department Information' );
?>
<script src="https://www.google.com/recaptcha/api.js"></script>
	<div class="control-group">
		<label class="control-label" for="department">Department</label>
		<div class="controls">
			<?php echo form_dropdown( 'department', $departments, set_value( 'department' ), 'class="input-block-level"' ); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="departmentCode">Department Code</label>
		<div class="controls">
			<input required type="text" id="departmentCode" name="departmentCode" class="input-block-level" value="<?php echo set_value( 'departmentCode' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="location">Location</label>
		<div class="controls">
			<input required type="text" id="location" name="location" class="input-block-level" value="<?php echo set_value( 'location' ); ?>" />
		</div>
	</div>
<?php
	echo form_fieldset_close();
	echo form_fieldset( 'Contact Information' );
?>
	<div class="control-group">
		<label class="control-label" for="contactName">Contact Name</label>
		<div class="controls">
			<input required type="text" id="contactName" name="contactName" class="input-block-level" value="<?php echo set_value( 'contactName' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="contactDCE">Contact DCE</label>
		<div class="controls">
			<input required type="text" id="contactDCE" name="contactDCE" class="input-block-level" value="<?php echo set_value( 'contactDCE' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="contactPhone">Contact Phone</label>
		<div class="controls">
			<input required type="text" id="contactPhone" name="contactPhone" class="input-block-level" value="<?php echo set_value( 'contactPhone' ); ?>" />
			<br><br>

			<div class="control-group">
				<label class="control-label" for="displayPhone">Display Contact Phone</label>
				<div class="controls">
					<div class="switch" data-on-label="Yes" data-off-label="No">
						<input id="displayPhone" name="displayPhone" type="checkbox" checked />
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="contactEmail">Contact Email</label>
		<div class="controls">
			<input required type="email" id="contactEmail" name="contactEmail" class="input-block-level" value="<?php echo set_value( 'contactEmail' ); ?>" />
			<br><br>

			<div class="control-group">
				<label class="control-label" for="displayEmail">Display Contact Email</label>
				<div class="controls">
					<div class="switch" data-on-label="Yes" data-off-label="No">
						<input id="displayEmail" name="displayEmail" type="checkbox" checked />
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	echo form_fieldset_close();
	echo form_fieldset( 'Job Description' );
?>
	<div class="control-group">
		<label class="control-label" for="title">Job Title</label>
		<div class="controls">
			<input required type="text" id="title" name="title" class="input-block-level" value="<?php echo set_value( 'title' ); ?>" />
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="summary">Position Summary</label>
		<div class="controls">
			<textarea required rows="4" id="summary" name="summary" class="input-block-level"><?php echo set_value( 'summary' ); ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="essentialTasks">Essential Tasks</label>
		<div class="controls">
			<textarea required rows="4" id="essentialTasks" name="essentialTasks" class="input-block-level"><?php echo set_value( 'essentialTasks' ); ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="nonessentialTasks">Non-Essential Tasks</label>
		<div class="controls">
			<textarea required rows="4" id="nonessentialTasks" name="nonessentialTasks" class="input-block-level"><?php echo set_value( 'nonessentialTasks' ); ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="requiredSkills"><b>Required</b> Skills / Qualifications</label>
		<div class="controls">
			<textarea required rows="4" id="requiredSkills" name="requiredSkills" class="input-block-level"><?php echo set_value( 'requiredSkills' ); ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="preferredSkills"><b>Preferred</b> Skills / Qualifications</label>
		<div class="controls">
			<textarea required rows="4" id="preferredSkills" name="preferredSkills" class="input-block-level"><?php echo set_value( 'preferredSkills' ); ?></textarea>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="jobType">Job Type</label>
		<div class="controls">
			<?php echo form_dropdown( 'jobType', $types, set_value( 'jobType' ), 'class="input-block-level"' ); ?>
		</div>
	</div>
<?php
	echo form_fieldset_close();
?>
	<div class="form-actions">
		<div class="g-recaptcha" data-sitekey="6LfwbgETAAAAAKVzaIVwdfrN3xYlFnoSqPuav9ri"></div><br/>
		<button class="btn btn-primary">Submit Job Description</button>
	</div>
</form>
