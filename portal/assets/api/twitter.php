<?php
	//	Require the twitter OAuth script
	require_once( 'twitteroauth.php' );

	/**
	 * Define the Twitter Class that will be used to connect to Twitter
	 */
	class Twitter {
		// Privatize the tokens needed for computation
		private $tokens = array(
			"oauth_access_token" => "851546234-tSZXLkORbRjGdH4sCIKeuZUrDEdlzupy8BpeyRmg",
			"oauth_access_token_secret" => "PyvXWrj7yRRGqvR4sY8spjXr8DZuJyJSGyYqFyAdM",
			"consumer_key" => "6H9LEcUdIKgLR45GZSq7Q",
			"consumer_secret" => "BO27M7vlMT93Esu9jiRtrwYtGk0ShJU4FqWeC9EAI"
		);

		/**
		 * Get the tweets for the current user
		 */
		function get_tweets() {
			// Create a connection to Twitter
			$connection = new TwitterOAuth(
				$this->tokens['consumer_key'],
				$this->tokens['consumer_secret'],
				$this->tokens['oauth_access_token'],
				$this->tokens['oauth_access_token_secret']
			);

			// Verify the credentials
			$connection->get( 'account/verify_credentials' );

			// Post a new status
			return $connection->get( 'statuses/user_timeline' );
		}

		/**
		 * Send a tweet for the current user
		 */
		function send_tweet( $message ) {
			// Create a connection to Twitter
			$connection = new TwitterOAuth(
				$this->tokens['consumer_key'],
				$this->tokens['consumer_secret'],
				$this->tokens['oauth_access_token'],
				$this->tokens['oauth_access_token_secret']
			);

			// Verify the credentials
			$connection->get( 'account/verify_credentials' );

			// Post a new status
			$connection->post( 'statuses/update', array( 'status' => $message ) );
		}
	}
?>