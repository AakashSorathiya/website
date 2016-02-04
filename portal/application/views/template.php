<!DOCTYPE html>
<html>
	<head>
		<title>SEO Employment Portal</title>

		<meta charset="utf-8" />
		<?php
			echo meta( 'viewport', 'width=device-width, initial-scale=1.0' );
			echo meta( 'keywords', 'rit, rochester institute of technology, employment card, rit emploment, rit jobs, rit seo, rit student employment, rit student jobs' );
			echo meta( 'description', 'RIT Student Employment Office' );
			echo meta( 'author', 'Jeremy Pitzeruse' );
			echo meta( 'robots', 'noindex, nofollow' );
		?>

		<link rel="Stylesheet" type="text/css" href="/seo/assets/css/bootstrap.min.css" />
		<link rel="Stylesheet" type="text/css" href="/seo/assets/css/bootstrap-responsive.min.css" />
		<link rel="Stylesheet" type="text/css" href="/seo/assets/css/font-awesome.min.css" />
		<link rel="Stylesheet" type="text/css" href="/seo/assets/css/font-awesome-ie7.min.css" />

		<link rel="Stylesheet" type="text/css" href="/seo/assets/css/seo.css" />
		<link rel="Stylesheet" type="text/css" href="/seo/portal/assets/css/portal.css" />

		<script src="/seo/assets/js/jquery.min.js"></script>
		<script src="/seo/assets/js/bootstrap.min.js"></script>
	</head>

	<body>
		<?php
			require "banner.php";
			require "navigation.php";
		?>

		<div class="container-fluid page">
			<?php echo $body; ?>
		</div>

		<div class="footer clearfix">
			<div class="pull-left">
				<p>Last Updated: August 13, 2012</p>
				<p>
					<a href="http://www.rit.edu/disclaimer.html">Disclaimer</a> |
					<a href="http://www.rit.edu/copyright.html">Copyright Infringement</a>
				</p>
				<p>
					<a href="http://www.rit.edu/ask/">Questions and Concerns</a> |
					<a href="mailto:ajfseo@rit.edu">Technical Difficulties</a>
				</p>
			</div>

			<div class="pull-right pagination-right">
				<p>Student Employment Office, 49 Lomb Memorial Drive, Rochester, NY 14623</p>
				<p>Copyright &copy; <a href="http://www.rit.edu/">Rochester Institute of Technology</a>, All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>
