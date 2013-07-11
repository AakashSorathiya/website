<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends SEO_Controller {
	/**
	 *	Add additional functionality to the constructor
	 */
	function __construct()
	{
		// Call the parent constructor
		parent::__construct();
 
		//
		//	DEFINE FORM VALIDATION RULES
		//
		$this->form_validation->set_rules( 'title', 'title', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'dept_code', 'department code', 'required' );
		$this->form_validation->set_rules( 'summary', 'summary', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'functions', 'functions', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'qualifications', 'qualifications', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'skills', 'skills', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'type_id', 'job type', 'required' );
	}

	/**
	 *	Show a job in the database
	 */
	public function show( $id = NULL )
	{
		// Check the number
		if( $id !== NULL ) {
			// Get the job from the database
			$job = $this->JobModel->getOne( array( 'id' => $id ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $job->department_id ) );
			$type = $this->TypeModel->getOne( array( 'ID' => $info->type_id ) );
			$state = $this->StateModel->getOne( array( 'ID' => $job->current_state ) );
			$poc = $this->PointOfContactModel->getOne(
				array(
					'job_id' => $job->ID,
					'primary' => TRUE
				)
			);
			$contact = $this->UserModel->getOne( array( 'ID' => $poc->user_id ) );

			// Create a data object to send to the view
			$data = array(
				'job' => $job,
				'info' => $info,
				'dept' => $dept,
				'type' => $type,
				'state' => $state,
				'contact' => $contact
			);

			// Load the body
			$this->data['body'] = $this->load->view( 'job/show', $data, TRUE );

			// Load the template view
			$this->load->view( 'template', $this->data );
		}
	}

	/**
	 *	Create a job and insert it into the database
	 */
	public function create()
	{
		// Ensure that an employer is logged in
		if( !( assert( $this->role >= RoleEnum::EMPLOYER ) ) ) {
			$this->load->view( 'errors/412' );
			return;
		}

		// Run the form validation
		if( $this->form_validation->run() == FALSE ) {
			// Get necessary data
			$types = $this->TypeModel->get();
			$emps = $this->EmploymentModel->get( array( 'user_id' => $this->user->ID ) );
			$depts = array();
			$users = array();

			// Loop through each employments
			foreach( $emps as $emp ) {
				// Push the department onto the array
				array_push( $depts, $this->DepartmentModel->getOne( array( 'ID' => $emp->department_id ) ) );

				// Get the department users
				$dept_users = $this->EmploymentModel->get( array( 'department_id' => $emp->department_id ) );

				// Loop through each of the department users
				foreach( $dept_users as $user ) {
					// Check for the employer
					if( intval( $user->role_id ) > 1 ) {
						// Push on the new model
						array_push( $users, $this->UserModel->getOne( array( 'ID' => $user->user_id ) ) );
					}
				}
			}

			// Create a data array for the page
			$data = array(
				'types' => to_options_array( $types, 'ID', 'label' ),
				'departments' => to_options_array( $depts, 'ID', 'name' ),
				'users' => to_options_array( $users, 'ID', 'display_name' )
			);

			// Load the body for the page
			$this->data['body'] = $this->load->view( 'job/create', $data, TRUE );
		} else {
			// Create the information
			$info = array(
				'title' => $this->input->post( 'title', TRUE ),
				'dept_code' => $this->input->post( 'dept_code', TRUE ),
				'summary' => $this->input->post( 'summary', TRUE ),
				'functions' => $this->input->post( 'functions', TRUE ),
				'qualifications' => $this->input->post( 'qualifications', TRUE ),
				'skills' => $this->input->post( 'skills', TRUE ),
				'type_id' => $this->input->post( 'type_id', TRUE )
			);

			// Insert the information into the database
			$info['ID'] = $this->InformationModel->insert( $info );

			// Create the Job
			$job = array(
				'information_id' => $info['ID'],
				'department_id' => $this->input->post( 'department_id', TRUE ),
				'timestamp' => time(),
				'number' => 0,
				'current_state' => StateEnum::PENDING
			);

			// Insert the job into the database
			$job['ID'] = $this->JobModel->insert( $job );

			// Create the primary point of contact
			$ppoc = array(
				'job_id' => $job['ID'],
				'primary' => TRUE,
				'user_id' => $this->input->post( 'user_id', TRUE )
			);

			// Insert the primary point of contact into the database
			$ppoc['ID'] = $this->PointOfContactModel->insert( $ppoc );

			// Check the primary point of contact
			if( $this->user->ID != $ppoc['user_id'] ) {
				// Create a secondary point of contact
				$spoc = array(
					'job_id' => $job['ID'],
					'primary' => FALSE,
					'user_id' => $this->user->ID
				);

				// Insert the secondary point of contact into the database
				$spoc['ID'] = $this->PointOfContactModel->insert( $spoc );
			}

			// Load the body for the page
			$this->data['body'] = $this->load->view( 'page/success', '', TRUE );
		}

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Edit a job in the database
	 */
	public function edit( $id = NULL )
	{
		//
		//	ASSERT POINT OF CONTACT | >= ADMIN
		//	EDIT A JOB
		//	BE SURE TO REMOVE THE POSTING IF IT EXISTS
		//	NEEDS RE-APPROVAL FROM THE DEPARTMENT
		//

		// Ensure that an employer is logged in
		if( !( assert( $this->role >= RoleEnum::EMPLOYER ) ) ) {
			$this->load->view( 'errors/412' );
			return;
		}

		// Check the id being passed in
		if( $id != NULL ) {
			// Get the necessary information to remove
			$job = $this->JobModel->getOne( array( 'ID' => $id ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$poc = $this->PointOfContactModel->getOne( array( 'job_id' => $job->ID, 'primary' => TRUE ) );

			// Run the form validation
			if( $this->form_validation->run() == FALSE ) {
				// Get necessary data
				$types = $this->TypeModel->get();
				$emps = $this->EmploymentModel->get( array( 'user_id' => $this->user->ID ) );
				$depts = array();
				$users = array();

				// Loop through each employments
				foreach( $emps as $emp ) {
					// Push the department onto the array
					array_push( $depts, $this->DepartmentModel->getOne( array( 'ID' => $emp->department_id ) ) );

					// Get the department users
					$dept_users = $this->EmploymentModel->get( array( 'department_id' => $emp->department_id ) );

					// Loop through each of the department users
					foreach( $dept_users as $user ) {
						// Check for the employer
						if( intval( $user->role_id ) > 1 ) {
							// Push on the new model
							array_push( $users, $this->UserModel->getOne( array( 'ID' => $user->user_id ) ) );
						}
					}
				}

				// Create a data var to pass to the view
				$data = array(
					'job' => $job,
					'info' => $info,
					'poc' => $poc,
					'types' => to_options_array( $types, 'ID', 'label' ),
					'departments' => to_options_array( $depts, 'ID', 'name' ),
					'users' => to_options_array( $users, 'ID', 'display_name' )
				);

				// Load the body for the page
				$this->data['body'] = $this->load->view( 'job/edit', $data, TRUE );
			} else {
				// Get the updated information
				$info->title = $this->input->post( 'title', TRUE );
				$info->dept_code = $this->input->post( 'dept_code', TRUE );
				$info->summary = $this->input->post( 'summary', TRUE );
				$info->functions = $this->input->post( 'functions', TRUE );
				$info->qualifications = $this->input->post( 'qualifications', TRUE );
				$info->skills = $this->input->post( 'skills', TRUE );
				$info->type_id = $this->input->post( 'type_id', TRUE );

				// Update the information model
				$this->InformationModel->update( $info );

				// Get the updated job
				$job->department_id = $this->input->post( 'department_id', TRUE );
				$job->current_state = StateEnum::PENDING;

				// Update the job model
				$this->JobModel->update( $job );

				// Get the new user ID from the page
				$poc->user_id = $this->input->post( 'user_id', TRUE );

				// Update the point of contact
				$this->PointOfContactModel->update( $poc );

				// Get the posts in the database
				$posts = $this->PostingModel->get( array( 'job_id' => $job->ID ) );

				// Delete any posting that exists
				foreach( $posts as $post ) $this->PostingModel->delete( $post );

				// Redirect to the employer page
				redirect( '/page/employer', 'refresh' );
			}
		}

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Remove a job from the database
	 */
	public function remove( $id = NULL )
	{
		// Create a point of contact instance
		$poc = array( 'user_id' => $this->user->ID, 'job_id' => $id );

		// Check for the appropriate permissions
		if( !( assert(
				count( $this->PointOfContactModel->get( $poc )	) > 0
					|| $this->role >= RoleEnum::ADMINISTRATOR )
			)
		) {
			// Load the permissions view
			$this->load->view( 'errors/412' );

			// Prevent the remaining code from running
			return;
		}


		// Check the passed in ID
		if( $id != NULL ) {
			// Get the necessary information to remove
			$job = $this->JobModel->getOne( array( 'ID' => $id ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$pocs = $this->PointOfContactModel->get( array( 'job_id' => $job->ID ) );
			$posts = $this->PostingModel->get( array( 'job_id' => $job->ID ) );

			// Delete the job
			$this->JobModel->delete( $job );

			// Delete the information
			$this->InformationModel->delete( $info );

			// Delete each point of contact
			foreach( $pocs as $poc ) $this->PointOfContactModel->delete( $poc );

			// Delete each post
			foreach( $posts as $post ) $this->PostingModel->delete( $post );
		}

		// Redirect to the employer page
		redirect( '/page/employer', 'refresh' );
	}
}

/* End of file */