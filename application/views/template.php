<?php echo doctype('html5');
	// Define some page contents
	$header = 'templates/desktop/header.php';
	$template = 'templates/desktop/template.php';

	// Force a mobile browser for testing
	// $isMobileBrowser = TRUE;

	// Check for a mobile browser
	if( $isMobileBrowser )
	{
		$header = 'templates/mobile/header.php';
		$template = 'templates/mobile/template.php';
	}
?>
<html manifest="./assets/cache.manifest">
	<head>
		<title>Student Employment Office</title>

		<meta charset="utf-8" />
	<?php
		echo meta( 'keywords', 'rit, rochester institute of technology, employment card, rit emploment, rit jobs, rit seo, rit student employment, rit student jobs' );
		echo meta( 'description', 'RIT Student Employment Office' );
		echo meta( 'author', 'Jeremy Pitzeruse' );
		echo meta( 'robots', 'index, nofollow' );

		echo link_tag( 'assets/css/bootstrap.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/font-awesome-ie7.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/font-awesome.min.css', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/seo.css', 'stylesheet', 'text/css' );
		echo link_tag( 'http://fonts.googleapis.com/css?family=Gentium+Basic', 'stylesheet', 'text/css' );
		echo link_tag( 'assets/css/bootswitch.css', 'stylesheet', 'text/css' );

		echo script_tag( 'assets/js/jquery.min.js' );
		echo script_tag( 'assets/js/bootstrap.min.js' );
		echo script_tag( 'assets/js/json2.min.js' );
		echo script_tag( 'assets/js/bootswitch.js' );

		require_once $header;
	?>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-87759145-1', 'auto');
			ga('send', 'pageview');

	</script>
	
	</head>

	<body>
		<?php require_once $template; ?>
	</body>
</html>
