<?php echo doctype('html5'); ?>
<html>
	<head >
		<title>Student Employment Office</title>

		<meta charset="iso-8859-1" />
	<?php
		echo meta( 'viewport', 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no' );
		echo meta( 'apple-mobile-web-app-capable', 'yes' );
		echo meta( 'apple-mobile-web-app-title', 'RITSEO' );

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
		HELLO MOBILE!
	</body>
</html>