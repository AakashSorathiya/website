<?php echo doctype('html5'); ?>
<html>
	<head >
		<title>Student Employment Office</title>

		<meta charset="iso-8859-1" />
	<?php
		echo meta( 'viewport', 'width=device-width, initial-scale=1.0' );
		echo meta( 'keywords', 'rit, rochester institute of technology, employment card, rit emploment, rit jobs, rit seo, rit student employment, rit student jobs' );
		echo meta( 'description', 'RIT Student Employment Office' );
		echo meta( 'author', 'Jeremy Pitzeruse' );
		echo meta( 'robots', 'index, nofollow' );

		echo link_tag( 'assets/css/bootstrap.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/bootstrap-responsive.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/font-awesome-ie7.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/font-awesome.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/seo.css', 'stylesheet', 'text/css' );
		echo link_tag( 'http://fonts.googleapis.com/css?family=Gentium+Basic', 'stylesheet', 'text/css' );

		echo script_tag( 'assets/js/jquery.min.js' );
		echo script_tag( 'assets/js/bootstrap.min.js' );
	?>
	
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-39434922-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</head>

	<body>
		<div class="banner">
			<div class="max-width container clearfix">
				<div class="seo-mast pull-left"></div>
				<div class="social pull-right clearfix">
					<div class="pull-left">
						<a href="https://twitter.com/RITSEO"><i class="icon-twitter icon-large"></i></a>
						<a href="https://www.facebook.com/RITSEO"><i class="icon-facebook icon-large"></i></a>
					</div>
					<div class="pull-right">
						<form class="form-search" action="http://www.rit.edu/search/">
							<div class="input-append">
								<input type="text" name="q" placeholder="Search RIT" class="span2 search-query">
								<button type="submit" class="btn"><i class="icon-search"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="max-width container">
			<div class="page">
				<div class="container-fluid">
					<div class="row-fluid">
						<div class="span4">
							<?php require( 'navigation.php' ) ?>
						</div>

						<div class="span8">
							<?php echo $body; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="max-width container clearfix footer">
			<div class="pull-left pagination-left">
				<p>Last Updated: March 14, 2013</p>
				<p>
					<a href="http://www.rit.edu/disclaimer.html">Disclaimer</a> |
					<a href="http://www.rit.edu/copyright.html">Copyright Infringement</a> |
					<a href="mailto:<?php echo 'jxpseo@rit.edu'; ?>">Technical Difficulties</a>
				</p>
			</div>

			<div class="pull-right pagination-right">
				<p>Student Employment Office, 49 Lomb Memorial Drive, Rochester, NY 14623</p>
				<p>Copyright &copy; <a href="http://www.rit.edu/">Rochester Institute of Technology</a>, All Rights Reserved.</p>
			</div>
		</div>
	</body>
</html>