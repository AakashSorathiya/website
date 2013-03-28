<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Create a twitter controller
class Twitter extends CI_Controller {
	public function update()
	{
		// Require the necessary scripts
		require_once( getcwd() . "/assets/api/simple_html_dom.php" );
		require_once( getcwd() . "/assets/api/twitter.php" );

		// Define a path to the jobs
		$path = getcwd() . "/jobs/";

		// Use the helper method
		$postedJobs = $this->getCurrentlyPostedJobs( $path );

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
				"twitter_code" => TwitterEnumerations::ADDED
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
		// Get all the twitter queue items
		$allTweets = $this->TwitterQueue->get();

		// Loop through all the tweeted jobs changing them to the remove code
		foreach( $allTweets as $tweet )
		{
			// Set the remove code
			$tweet->twitter_code = TwitterEnumerations::REMOVE;

			// Update the database instance
			$this->TwitterQueue->update( $tweet );
		}

		// Output a status
		echo( 'FLAGGED ALL JOBS FOR REMOVAL<BR><BR>' );

		// Loop through each of the jobs
		foreach( $jobs as $job )
		{
			// Try to get one instance
			$result = $this->TwitterQueue->get( array('job_number' => $job['job_number']) );

			// Check the number of results returned
			if( count( $result ) == 0 ) {				// TWEET MUST BE SENT OUT
				// Output a status
				echo( 'INSERTING: ' . $job['job_number'] ."<BR>" );

				// Insert the instance into the database
				$this->TwitterQueue->insert( $job );

				// Send a tweet for the current position
				$this->sendTweet( $job );

			} else {									// TWEET HAS BEEN SENT OUT
				// Output a status
				echo( 'NOT INSERTING: ' . $job['job_number'] ."<BR><BR>" );

				// Try to get one instance
				$result = $this->TwitterQueue->getOne( array('job_number' => $job['job_number']) );

				// Change the twitter code
				$result->twitter_code = TwitterEnumerations::EXISTING;

				// Update the result
				$this->TwitterQueue->update( $result );
			}
		}

		// Output a status
		echo( "<BR>" );
		echo( 'FINISHED THE INSERTION PROCESS<BR><BR>' );

		// Get all the twitter queue items for deletion
		$deleteTweets = $this->TwitterQueue->get( array('twitter_code' => TwitterEnumerations::REMOVE) );

		// Loop through each tweet that needs to be deleted
		foreach( $deleteTweets as $tweet )
		{
			// Output the status
			echo( 'DELETING JOB NUMBER ' . $tweet->job_number . ' TWEET FROM THE QUEUE<BR>' );

			// Delete the tweet
			$this->TwitterQueue->delete( $tweet );
		}

		// Echo the break point
		echo( 'FINISHED DELETING UNNEEDED TWEET ENTRIES<BR><BR>' );
	}

	/**
	 *	Send a Tweet about a Particular Job
	 */
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
		echo( "TWEETING: " . $message . "<BR><BR>" );

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
}