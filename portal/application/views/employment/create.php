<button class="btn" onClick="javascript: history.go( -1 );">Back</button>

<div class='page-header'>
	<h1>
		<small><?php echo( $title ); ?></small>
	</h1>
</div>

<div class="row-fluid">
	<form method="POST">
		<label for="user_id">
			User DCE:
			<?php echo form_dropdown( 'user_id', $users, set_value( 'user_id' ), 'class="span12"' ); ?>
		</label>

		<?php if( $departments !== NULL ) { ?>
			<label for="department_id">
				Departments:
				<?php echo form_dropdown( 'department_id', $departments, set_value( 'department_id' ), 'class="span12"' ); ?>
			</label>
		<?php } else { ?>
			<input name="department_id" type="hidden" value="<?php echo $department->ID; ?>" />
		<?php } ?>

		<br>
		<div>
			<button class="btn" type="submit">Create Role</button>
			<button class="btn" onClick="javascript: history.go( -1 );">Cancel</button>
		</div>
	</form>
</div>