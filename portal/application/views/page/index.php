<div class="row-fluid">
	<div class="span4">
		<!-- Snapshot of User Profile -->
		<div class="well profile-card">
			<div class="pagination-centered">
				<h3><?php echo $user->display_name; ?></h3>
				<img src="/seo/portal/assets/img/225x225.gif" class="img-polaroid" />
			</div>

			<br>

			<!-- Contact List -->
			<ul class="contact nav nav-list">
				<li class="nav-header">Contact Information:</li>
				<li><p class='label type'>Email:</p><p class='contact-info'><?php echo $user->dce; ?>@rit.edu</p></li>
			</ul>
		</div>

		<!-- Hot Links Container -->
		<div class="well sidebar-nav">
			<ul class="nav nav-list">
				<li class="nav-header">Hot Links</li>
				<li><a href="http://www.rit.edu/" target="_blank">RIT Home</a></li>
				<li><a href="http://www.rit.edu/oce" target="_blank">OCE Home</a></li>
				<li><a href="http://www.rit.edu/seo" target="_blank">SEO Home</a></li>
				<li><a href="https://finweb.rit.edu/kronos/apps/timecardreview/" target="_blank">Check your Hours</a></li>
				<li><a href="http://www.attacheinc.com/" target="_blank">Need a Resum&eacute;?</a></li>
			</ul>
		</div>

		<!-- Networking Container -->
		<div class="well sidebar-nav">
			<ul class="nav nav-list">
				<li class="nav-header">Networking</li>
				<li><a href="http://www.facebook.com/RITSEO" target="_blank">Like us on Facebook</a></li>
				<li><a href="http://www.twitter.com/RITSEO" target="_blank">Follow us on Twitter</a></li>
			</ul>
		</div>
	</div>

	<!-- EMPLOYMENT FEED -->
	<div class="span8">
		<div class='page-header'>
			<h1>
				<small>SEO Employment Feed</small>
			</h1>
		</div>

		<div class="feeder">
			<?php
				// Loop through each tweet
				foreach( $tweets as $tweet ) {
					// Create a date-time result
					$date = strtotime( $tweet->created_at );

					// Create a tweet
					$htm = "<div class='alert alert-twitter feed'>";
					$htm .= "<div class='info clearfix'>";
					$htm .= "<div class='pull-left'>";
					$htm .= "<h2 class='user'><i class='icon-twitter'></i> @RITSEO</h2>";
					$htm .= "</div>";
					$htm .= "<div class='pull-right'>";
					$htm .= "<p class='date'>" . date( "Y-m-d", $date ) . "</p>";
					$htm .= "<p class='time'>" . date( "g:ia", $date ) . "</p>";
					$htm .= "</div>";
					$htm .= "</div>";
					$htm .= "<p>" . $tweet->text . "</p>";
					$htm .= "</div>";

					// Output the html
					echo( $htm );
				}
			?>
		</div>
	</div>
</div>