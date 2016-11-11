<h1>On-Campus Job Removal Form</h1>

<p>
	This form may be used to remove a job currently posted on the SEO website. If you do not know what your
	job number is, please <a href="../../contact.php">contact the SEO</a>. If you would like to create or
	post a <b>NEW</b> job, you will need to submit an <a href="forms.php">SEO Job Description Form</a>.
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
<script src="https://www.google.com/recaptcha/api.js"></script>
	<div class="control-group">
		<label class="control-label" for="job_number">Job Number *</label>
		<div class="controls">
			<input required type="text" id="job_number" name="job_number" class="input-block-level" value="<?php echo set_value( 'job_number' ); ?>" />
		</div>
	</div>
<?php
	echo form_fieldset_close();
?>
	<div class="form-actions">
		<div class="g-recaptcha" data-sitekey="6LfwbgETAAAAAKVzaIVwdfrN3xYlFnoSqPuav9ri"></div><br />
		<button class="btn btn-primary">Submit</button>
	</div>
</form>
