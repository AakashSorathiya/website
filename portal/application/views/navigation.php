<div class="navbar">
	<div class="navbar-inner">
		<div class="max-width container">
			<div class="nav-collapse collapse">
				<ul class="nav">
					<?php
						// Create a navigation array
						$navs = array(
							// Home Page
							array(
								"label"		=>	"Home",
								"role_id"	=>	1,
								"link"		=>	""
							),

							// Jobs Page
							array(
								"label"		=>	"Jobs",
								"role_id"	=>	1,
								"link"		=>	"page/jobs"
							),

							// Calendar Page
							array(
								"label"		=>	"Calendar",
								"role_id"	=>	1,
								"link"		=>	"page/calendar"
							),

							// Employers Page
							array(
								"label"		=>	"Employers",
								"role_id"	=>	2,
								"link"		=>	"page/employer"
							),

							// Department Page
							array(
								"label"		=>	"Department",
								"role_id"	=>	3,
								"link"		=>	"page/department"	
							),

							// Administrators Page
							array(
								"label"		=>	"Administrators",
								"role_id"	=>	4,
								"link"		=>	"page/admin"
							)
						);

						// Loop through each of the navigation elements
						foreach( $navs as $nav ) {
							// Compare the roles
							if( $role >= $nav["role_id"] ) {
								// Localize the values
								$link = $nav["link"];
								$label = $nav["label"];

								// Echo out the link
								echo( "<li><a href='?/$link'>$label</a></li>" );
							}
						}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div><!--/ .container -->
	</div><!--/ .navbar-inner -->
</div>