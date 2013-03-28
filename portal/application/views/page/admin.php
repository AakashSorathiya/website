<div class='page-header'>
	<h1>
		<small>Administrators</small>
	</h1>
</div>

<div class="row-fluid">
	<div class="span4">
		<b>Students</b>
		<ul>
			<li><a href="?/employment/show/student">View All Student Users</a></li>
			<li><a href="?/employment/create/student">Assign Student User Rights</a></li>
			<li><a href="?/employment/remove/student">Revoke Student User Rights</a></li>
		</ul>
		
		<b>Employers</b>
		<ul>
			<li><a href="?/employment/show/employer">View All Employer Users</a></li>
			<li><a href="?/employment/create/employer">Assign Employer User Rights</a></li>
			<li><a href="?/employment/remove/employer">Revoke Employer User Rights</a></li>
		</ul>

		<b>Departments</b>
		<ul>
			<li><a href="?/employment/show/department">View All Department Users</a></li>
			<li><a href="?/employment/create/department">Assign Department User Rights</a></li>
			<li><a href="?/employment/remove/department">Revoke Department User Rights</a></li>
		</ul>

		<b>Administrators</b>
		<ul>
			<li><a href="?/employment/show/administrator">View All Administrative Users</a></li>
			<li><a href="?/employment/create/administrator">Assign Administrative User Rights</a></li>
			<li><a href="?/employment/remove/administrator">Revoke Administrative User Rights</a></li>
		</ul>
	</div>

	<div class="span8">
		<h1>Positions Pending Approval</h1>
		<br>
		<?php
			if( count( $list ) > 0 ) {
				foreach( $list as $pos ) {
					// Output the information
					echo( '<div class="row-fluid job">' );
						echo( '<div class="span8">' );
							echo( '<p class="title"><a href="?/admin/show/' . $pos['job']->ID . '">' . $pos['info']->title . '</a></p>' );
							echo( '<p class="summary">' . $pos['info']->summary . '</p>' );
						echo( '</div>' );
						echo( '<div class="span4">' );
							echo( '<table>' );
								echo( '<tr>' );
								echo( '<td><p class="label">Type:</p></td>' );
								echo( '<td><p class="type">' . $pos['type']->label . '</p></td>' );
								echo( '</tr>' );

								echo( '<tr>' );
								echo( '<td><p class="label">Department:</p></td>' );
								echo( '<td><p class="dept_code">' . $pos['info']->dept_code . '</p></td>' );
								echo( '</tr>' );
							echo( '</table>' );
						echo( '</div>' );
					echo( '</div>' );
				}
			} else {
				echo( "<div class='alert alert-info'>" );
				echo( "<p>No Positions Needing Approval</p>" );
				echo( "</div>" );
			}
		?>
	</div>
</div>