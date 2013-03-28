<?php
/**
 *	SEO_Controller
 *	
 *	This overwrites the functionality defined in CI_Controller to provide
 *	functionality that is specific to the Student Employment Office.
 *
 *	Jeremy Pitzeruse
 *	<jxp5688@rit.edu>
 */
class SEO_Controller extends CI_Controller {
	/**
	 *	Core Functionality
	 *
	 *	Every controller will have this functionality
	 */
	function __construct()
	{
		// Call the parent constructor
		parent::__construct();

		// Load the models
		$this->load->model( 'CodeModel', '', TRUE );
		$this->load->model( 'DepartmentModel', '', TRUE );
		$this->load->model( 'EmploymentModel', '', TRUE );
		$this->load->model( 'InformationModel', '', TRUE );
		$this->load->model( 'JobModel', '', TRUE );
		$this->load->model( 'PointOfContactModel', '', TRUE );
		$this->load->model( 'PostingModel', '', TRUE );
		$this->load->model( 'RoleModel', '', TRUE );
		$this->load->model( 'StateModel', '', TRUE );
		$this->load->model( 'TypeModel', '', TRUE );
		$this->load->model( 'UserModel', '', TRUE );

		// Load some useful libraries
		$this->load->library( 'form_validation' );

		// Set global error dilimiters
		$this->form_validation->set_error_delimiters( '<div class="alert alert-error">', '</div>' );

		// Load some useful helpers
		$this->load->helper( array( 'url', 'form', 'SEO' ) );

		// Store the Student DCE
		$dce = $_SERVER['uid'];

		// Attempt to get the user
		$users = $this->UserModel->get( array( 'dce' => $dce ) );

		// Check for the user
		if( count( $users ) == 0 ) {
			// Create a user
			$user = array(
				'first_name' => '',
				'last_name' => '',
				'display_name' => '',
				'added' => time(),
				'dce' => $dce
			);

			// Add the user to the database
			$this->UserModel->insert( $user );

			// Re-get the users
			$users = $this->UserModel->get( array( 'dce' => $dce ) );
		}

		// Store the user on the server
		$this->user = $users[0];

		// Get the employment records for the user
		$emps = $this->EmploymentModel->get( array( 'user_id' => $this->user->ID ) );

		// Check the employment records
		if( count( $emps ) == 0 ) {
			// Set the role to a student
			$this->role = 1;

			// Set the department to null if no results returned
			$this->department = NULL;

		} else if( count( $emps ) == 1 ) {
			// Get the only role that the individual has
			$this->role = intval( $emps[0]->role_id );

			// Get the department and store it
			$this->department = $this->DepartmentModel->getOne( array( 'ID' => $emps[0]->department_id ) );
		} else {
			// Set an initial role
			$max = 0;
			$dept = 0;

			// Loop through each of the employments
			foreach( $emps as $emp ) {
				// Compare to the relative max
				if( intval( $emp->role_id ) > $max ) {
					// Store the maximum employment role
					$max = intval( $emp->role_id );
					$dept = $emp->department_id;
				}
			}

			// Store the role
			$this->role = $max;

			// Get the department and store it
			$this->department = $this->DepartmentModel->getOne( array( 'ID' => $dept ) );
		}

		// Initialize a data set to be sent to the page
		$this->data = array(
			'body' => '<h1>Hello World</h1>',
			'user' => $this->user,
			'role' => $this->role
		);
	}
}