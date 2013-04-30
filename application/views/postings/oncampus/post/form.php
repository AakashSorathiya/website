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

	echo form_open('', 'id="employerForm" class="form-horizontal"');
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
			<input required type="text" id="department" data-provide="typeahead" autocomplete="off" name="department" class="input-block-level" value="<?php echo set_value( 'department' ); ?>" />
		</div>
	</div>

	<script>
		$( function() {
			// Bind the typeahead
			$( "#department" ).typeahead(
				{
					source: function (query, typeahead) {
						// Process the query
						var url = '?/employers/department/' + query;

						// Return the ajax request
						return $.get( url, {}, function (data) {
							// Parse the data
							var parsed = JSON.parse( data );

							// Process the returned data
							return typeahead( parsed );
						} );
					}
				}
			);
		} );
	</script>

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

<script>
	$( function() {
		// Fire a javascript event that will clean the ui components
		$( "#employerForm" ).submit( function (event) {
			// Loop through each of the long fields
			$( this ).find( 'input,textarea' ).each( function() {
				// Replace the word characters
				$( this ).val( replaceWordChars( $(this).val() ) );
			} );
		} );
	} );

	/// Replaces commonly-used Windows 1252 encoded chars that do not exist in ASCII or ISO-8859-1 with ISO-8859-1 cognates.
	var replaceWordChars = function(text) {
		// Localize the text
		var s = text;

		// smart single quotes and apostrophe
		s = s.replace(/[\u2018|\u2019|\u201A]/g, "\'");

		// smart double quotes
		s = s.replace(/[\u201C|\u201D|\u201E]/g, "\"");

		// ellipsis
		s = s.replace(/\u2026/g, "...");

		// dashes
		s = s.replace(/[\u2013|\u2014]/g, "-");

		// circumflex
		s = s.replace(/\u02C6/g, "^");

		// open angle bracket
		s = s.replace(/\u2039/g, "<");

		// close angle bracket
		s = s.replace(/\u203A/g, ">");

		// spaces
		s = s.replace(/[\u02DC|\u00A0]/g, " ");

		return s;
	}
</script>