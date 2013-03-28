<?php
	// Placeholder start and end dates
	$start = date( 'm/d/Y' );
	$end = date( 'm/d/Y', time() + (7 * 24 * 60 * 60) );
?>
<div class="row-fluid">
	<div class="span6">
		<h2><?php echo $info->title; ?></h2>

		<p><b>Summary</b></p>
		<p><?php echo $info->summary; ?></p>

		<p><b>Functions</b></p>
		<p><?php echo $info->functions; ?></p>

		<p><b>Qualifications</b></p>
		<p><?php echo $info->qualifications; ?></p>

		<p><b>Skills</b></p>
		<p><?php echo $info->skills; ?></p>
	</div>
	<div class="span6">
		<h2>Posting Information</h2>

		<?php echo validation_errors(); ?>

		<form class="form-horizontal" method="post">
			<div class="control-group">
				<label class="control-label" for="start_date"><b>Start Date</b> *</label>
				<div class="controls">
					<input type="text" id="start_date" name="start_date" class="span12" placeholder="<?php echo $start; ?>" value="<?php echo set_value( 'start_date' ); ?>"  required />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="end_date"><b>End Date</b></label>
				<div class="controls">
					<input type="text" id="end_date" name="end_date" class="span12" placeholder="<?php echo $end; ?>" value="<?php echo set_value( 'end_date' ); ?>" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="shift_days[]"><b>Shift Days</b> *</label>
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

			<div class="control-group">
				<label class="control-label" for="shift_hours"><b>Shift Hours</b> *</label>
				<div class="controls">
					<input type="text" name="shift_hours" class="span12" placeholder="9:00am - 12:00pm" required value="<?php echo set_value( 'shift_hours' ); ?>" />
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="weekly_hours"><b>Weekly Hours</b> *</label>
				<div class="controls">
					<div class="input-append span12">
						<input type="text" name="weekly_hours" placeholder="10 - 12" required value="<?php echo set_value( 'weekly_hours' ); ?>" />
						<span class="add-on">hours</span>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="wage"><b>Wage</b> *</label>
				<div class="controls">
					<div class="input-prepend span12">
						<span class="add-on">$</span>
						<input type="text" name="wage" placeholder="8.00" required value="<?php echo set_value( 'wage' ); ?>" />
					</div>
				</div>
			</div>

			<div class="control-group">
				<div class="controls">
					<p class="alert alert-error">Please Note: Fields marked with a * are required in order to proceed.</p>
					<button type="submit" class="btn btn-primary">Post Position</button>
					<button onClick="history.go( -1 );" class="btn">Cancel</button>
				</div>
			</div>
		</form>
	</div>
</div>