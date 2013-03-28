<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *	Page Controller Definition
 */
class Page extends SEO_Controller {
	/**
	 *	Index Page
	 */
	public function index()
	{
		// Localize the root
		$root = getcwd();

		// Require the twitter script
		require_once( "$root/assets/api/twitter.php" );

		// Initialize a Twitter Object
		$twitter = new Twitter();

		// Local data for this page
		$data = array(
			'user' => $this->data['user'],
			'tweets' => $twitter->get_tweets()
		);

		// Load the body of the page
		$this->data['body'] = $this->load->view( 'page/index', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Job Listing Page
	 */
	public function jobs( $type = NULL, $offset = 0 )
	{
		// Localize the types
		$types = $this->TypeModel->get();

		// Create some essential lookups
		$lookup = to_options_array( $types, 'code', 'ID' );
		$labels = to_options_array( $types, 'ID', 'label' );

		// Local data for this page
		$data = array(
			// Get the data from the query string, if provided
			'filter' => $type,
			'offset' => $offset,

			// Create an array of filters
			'filters' => array(
				'type' => to_options_array( $types, 'code', 'label' )
			)
		);

		// Get the filter ID
		$filter_id = ( $data['filter'] !== NULL ? $lookup[$data['filter']] : NULL );

		// Set the title
		$data['title'] = ( $filter_id !== NULL ? $labels[$filter_id] : 'All' ) . " Jobs";

		// Get all the postings
		$posts = $this->PostingModel->get();

		// Initialize an array of jobs
		$data['jobs'] = array();

		// Loop through the postings
		foreach( $posts as $post ) {
			// Get the job and its information
			$job = $this->JobModel->getOne( array( 'ID' => $post->job_id ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );

			// Check the filter
			if( $data['filter'] !== NULL ) if( $info->type_id !== $filter_id ) continue;

			// Create a new job
			$pos = array(
				'title' => $info->title,
				'summary' => $info->summary,
				'number' => $job->number,
				'type' => $labels[$info->type_id],
				'wage' => $post->wage,
				'hours'	=> $post->weekly_hours,
				'start_date' => $post->start_date,
				'post_date' => $post->timestamp
			);

			// Push on the new job
			array_push( $data['jobs'], $pos );
		}

		// Load the body of the page
		$this->data['body'] = $this->load->view( 'page/jobs', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Calendar Page
	 */
	public function calendar()
	{
		// Local data for this page
		$data = array();

		// Load the body of the page
		$this->data['body'] = $this->load->view( 'page/calendar', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Employer Page
	 */
	public function employer()
	{
		// Ensure that an employer is logged in
		if( !( assert( $this->role >= RoleEnum::EMPLOYER ) ) ) {
			// Load the permissions view
			$this->load->view( 'errors/412' );

			// Prevent the remaining code from running
			return;
		}

		// Local data for this page
		$data = array(
			'department' => ( $this->input->get( 'department' ) ? $this->input->get( 'department' ) : NULL )
		);

		// Get all jobs where this user is a point of contact
		$pocs = $this->PointOfContactModel->get( array( 'user_id' => $this->user->ID ) );

		// Initialize a jobs and departments array
		$data['jobs'] = array();
		$data['departments'] = array();

		// Loop through each of the points of contacts
		foreach( $pocs as $poc ) {
			// Get all the needed information
			$job = $this->JobModel->getOne( array( 'ID' => $poc->job_id ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $job->department_id ) );
			$state = $this->StateModel->getOne( array( 'ID' => $job->current_state ) );

			// Check for the department on the array
			if( !( isset( $data['departments'][$dept->ID] ) ) ) {
				// Push the department onto the array
				$data['departments'][$dept->ID] = rawurldecode( $dept->name );
			}

			// Check for the appropriate department
			if( $data['department'] !== NULL ) if( $dept->ID !== $data['department'] ) continue;

			// Create a job instance
			$job = array(
				'id' => $job->ID,
				'number' => $job->number,
				'title' => $info->title,
				'state' => ucwords( strtolower( $state->state ) ),
				'summary' => $info->summary,
				'department' => rawurldecode( $dept->name )
			);

			// Push the job onto the final array
			array_push( $data['jobs'], $job );
		}

		// Load the body of the page
		$this->data['body'] = $this->load->view( 'page/employer', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Department Page
	 */
	public function department()
	{
		// Ensure that a department is logged in
		if( !( assert( $this->role >= RoleEnum::DEPARTMENT ) ) ) {
			// Load the permissions view
			$this->load->view( 'errors/412' );

			// Prevent the remaining code from running
			return;
		}

		// Local data for this page
		$data = array();

		//
		//
		//

		// Load the body of the page
		$this->data['body'] = $this->load->view( 'page/department', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Administrator Page
	 */
	public function admin()
	{
		// Ensure that an admin is logged in
		if( !( assert( $this->role >= RoleEnum::ADMINISTRATOR ) ) ) {
			// Load the permissions view
			$this->load->view( 'errors/412' );

			// Prevent the remaining code from running
			return;
		}

		// Local data for this page
		$data = array(
			'list' => array()
		);

		// Get all needing approval
		$jobs = $this->JobModel->get( array( 'current_state' => StateEnum::PENDING ) );

		// Loop through each of the jobs that need approval
		foreach( $jobs as $job ) {
			// Localize the data
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$type = $this->TypeModel->getOne( array( 'ID' => $info->type_id ) );

			// Get the item
			$item = array(
				'job' => $job,
				'info' => $info,
				'type' => $type
			);

			// Push the item onto the array
			array_push( $data['list'], $item );
		}

		// Set the body for the page
		$this->data['body'] = $this->load->view( 'page/admin', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 * Any update that needs to be executed
	 */
	public function update()
	{
		die( 'No Update to Run' );
	/*
		// Get all departments
		$depts = $this->DepartmentModel->get();
		$whitelist = array();
		$blacklist = array();

		// Loop through each department
		foreach( $depts as $dept ) {
			// Create a readable name
			$dept->name = rawurldecode( $dept->name );

			// Update the department model in the database
			$this->DepartmentModel->update( $dept );

			// Check for the added department
			if( !( isset( $whitelist[$dept->name] ) ) ) {
				// Create an added key for the name
				$whitelist[$dept->name] = $dept->ID;
			} else {
				// Push the ID onto the blacklist for deletion
				array_push( $blacklist, $dept );
			}

			// Add an instance to the code table
			$code = array(
				'department_id' => $whitelist[$dept->name],
				'code' => $dept->code
			);

			// Check for a table instance
			if( count( $this->CodeModel->get( $code ) ) == 0 ) {
				// Insert the code into the database
				$this->CodeModel->insert( $code );
			}

		}

		// Loop through the blacklist
		foreach( $blacklist as $marked ) {
			// Delete the marked instance
			$this->DepartmentModel->delete( $marked );
		}
	*/
	}
}