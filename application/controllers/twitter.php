<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Create a twitter controller
class Twitter extends CI_Controller {
	/**
	 *
	 */
	public function update()
	{
		// Require the necessary scripts
		require_once( getcwd() . "/assets/api/simple_html_dom.php" );
		// require_once( getcwd() . "/assets/api/twitter.php" );

		// Define a path to the jobs
		$path = getcwd() . "/jobs/";

		// Output some feedback
		echo '<p>Retreiving the current jobs...</p>';

		// Use the helper method
		$postedJobs = $this->getCurrentlyPostedJobs( $path );

		// Output some feedback
		echo '<p>Processing the current jobs...</p>';

		// Process the posted jobs
		$this->processJobs( $postedJobs );
	}

	/**
	 * Get the currently posted jobs
	 */
	private function getCurrentlyPostedJobs( $path )
	{
		// Initialize all the types
		$filePrefixes = array(
			"vtx"
		);

		// Initialize all the categories
		$fileCategories = array(
			"ac", "at", "cl", "ct",
			"cs", "fs", "mc", "mt",
			"sv", "te"
		);

		// Initialize an array of all jobs
		$jobs = array();

		// Loop through the prefixes
		foreach( $filePrefixes as $prefix )
		{
			// Loop through each of the categories
			foreach( $fileCategories as $category )
			{
				// Create a file reference
				$file = $prefix . $category . '.seoinc';

				// Merge the arrays
				$jobs = array_merge( $jobs, $this->parseFileToModel( $path . $file, $category ) );
			}
		}

		// Return the array of jobs
		return $jobs;
	}

	/**
	 *	Parse the file out into a model that is workable
	 */
	private function parseFileToModel( $file, $category )
	{
		// Initialize a jobs array
		$jobs = array();

		// Get the html ofk the file
		$html = file_get_html( $file );

		// Loop through each of the jobs
		foreach( $html->find('div.job') as $job )
		{
			$h2 = $job->find('h2');
			$input = $job->find('input');

			// Initialize a new job model
			$jobModel = array(
				"job_title" => $h2[0]->plaintext,
				"job_number" => $input[0]->value,
				"category" => $category,
				"added" => time(),
				"twitter_code" => TwitterEnumerations::NEW_POSTING
			);

			// Append the job number to the 
			array_push( $jobs, $jobModel );
		}

		// Return the jobs
		return $jobs;
	}

	/**
	 *	Insert an instance into the database
	 */
	private function processJobs( $jobs )
	{
		///
		///
		///

		echo '<p>Processing the current postings...</p>';
		$this->processPostings();
		echo '<p>All postings flagged as previously posted</p>';

		///
		///
		///

		echo '<p>Handling the new jobs coming in...</p>';
		$this->handleIncomingJobs( $jobs );
		echo '<p>All incoming jobs have been handled</p>';

		///
		///
		///

		echo '<p>Handling all previously posted positions...</p>';
		$this->handleUnpostedPositions();
		echo '<p>All previously posted positions have been unposted</p>';
	}

	private function processPostings()
	{
		// Get all positions
		$postings = array_merge(
			$this->TwitterQueue->get(
				array(
					"twitter_code" => TwitterEnumerations::NEW_POSTING	// Grabs older enumerations
				)
			),
			$this->TwitterQueue->get(
				array(
					'twitter_code' => TwitterEnumerations::POSTED
				)
			)
		);

		// Flag all prior positions as previously posted
		foreach( $postings as $post )
		{
			// Set the twitter code
			$post->twitter_code = TwitterEnumerations::PREVIOUS_POSTING;

			// Update the entry in the table
			$this->TwitterQueue->update( $post );

			// Unpost the postion
			echo '<p>Job number ' . $post->job_number . ' has been marked as previously posted</p>';
		}
	}

	private function handleIncomingJobs( $jobs )
	{
		// Loop through each of the positions
		foreach( $jobs as $job )
		{
			// Get all the entries with the job number
				// SHOULD BE A MAX OF 1
			$entries = $this->TwitterQueue->get(
				array(
					'job_number' => $job['job_number']
				)
			);

			// Check the table entries
			if( count($entries) == 0 ) {
				// NEW ENTRY	::	TWEET
				echo '<p><b>NEW POSITION:</b> ' . $job['job_number'] . '</p>';

				// Mark the position
				$job['twitter_code'] = TwitterEnumerations::POSTED;

				// Insert the job
				$this->TwitterQueue->insert( $job );

				// Tweet the job
				$this->sendTweet( $job );

			} else if( $entries[0]->twitter_code == TwitterEnumerations::UNPOSTED ) {
				// UNPOSTED ENTRY	::	TWEET
				echo '<p><b>UNPOSTED POSITION:</b> ' . $job['job_number'] . '</p>';

				// Localize the entry
				$entry = $entries[0];

				// Set the code to be a posted position
				$entry->twitter_code = TwitterEnumerations::POSTED;

				// Update the entry
				$this->TwitterQueue->update( $entry );

				// Tweet the job
				$this->sendTweet( $job );

			} else if( $entries[0]->twitter_code == TwitterEnumerations::PREVIOUS_POSTING ) {
				// PREVIOUSLY POSTED 	::	NO TWEET
				echo '<p><b>PREVIOUSLY POSTED POSITION:</b> ' . $job['job_number'] . '</p>';

				// Localize the entry
				$entry = $entries[0];

				// Set the code to be a posted position
				$entry->twitter_code = TwitterEnumerations::POSTED;

				// Update the entry
				$this->TwitterQueue->update( $entry );
			}
		}
	}

	private function handleUnpostedPositions()
	{
		// Get the unposted positions
		$unposted = $this->TwitterQueue->get(
			array(
				'twitter_code' => TwitterEnumerations::PREVIOUS_POSTING
			)
		);

		// Loop through each of the positions
		foreach( $unposted as $unpost )
		{
			// Change the twitter code
			$unpost->twitter_code = TwitterEnumerations::UNPOSTED;

			// Update the entry in the table
			$this->TwitterQueue->update( $unpost );

			// Unpost the postion
			echo '<p><b>Job number ' . $unpost->job_number . ' has been unposted</b></p>';
		}
	}

	private function sendTweet( $job )
	{
		// Localize the job number
		$number = $job['job_number'];

		// Get the category
		$category = $this->TypeModel->getOne( array( 'code' => $job['category'] ) );	// 20 Characters Max
		$label = strtolower($category->label);

		// Create a url to the currently posted job
		$url = 'http://bit.ly/seoon' . $job['category'];	// 21 Characters Max

		// Create a message for the job
		$message = "A new $label job has become available on campus.  See job number $number for more details. $url";

		// Output the status
		echo( "<p><b>TWEETING:</b> " . $message . "</p>" );

		// Create a handle for twitter
		$twitterHandle = new TwitterHandler();

		// Send the message to twitter
		$twitterHandle->send_tweet( $message );
	}
}

/**
 *	ENUMERATION OBJECT USED INTERNAL TO THIS SCRIPT
 */
class TwitterEnumerations
{
	const REMOVE = 0;
	const ADDED = 1;
	const EXISTING = 2;

	const PREVIOUS_POSTING = 0;
	const NEW_POSTING = 1;
	const POSTED = 2;
	const UNPOSTED = 3;
}