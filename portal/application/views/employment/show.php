<button class="btn" onClick="javascript: history.go( -1 );">Back</button>

<div class='page-header'>
	<h1>
		<small><?php echo( $title ); ?></small>
	</h1>
</div>


<div class="row-fluid">
	<table class="table">
		<thead>
			<tr>
				<th>Last Name</th>
				<th>First Name</th>
				<th>Display Name</th>
				<th>Department</th>
			</tr>
		</thead>

		<?php
			// Count the users
			if( count( $list ) == 0 ) {
				// Notify the user no results were returned
				echo( '<tr>' );
				echo( '<td colspan="4">' );
				echo( '<div class="alert alert-danger">No Results Returned</div>');
				echo( '</td>');
				echo( '</tr>' );

			} else {
				// Loop through the list of users
				foreach( $list as $item ) {
					echo( '<tr>' );
					echo( '<td>' . $item['user']->first_name . '</td>' );
					echo( '<td>' . $item['user']->last_name . '</td>' );
					echo( '<td>' . $item['user']->display_name . '</td>' );
					echo( '<td>' . $item['dept']->name . '</td>' );
					echo( '</tr>' );
				}
			}
		?>
	</table>
</div>