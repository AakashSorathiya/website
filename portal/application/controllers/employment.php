<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employment extends SEO_Controller {
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
		$this->form_validation->set_rules( 'user_dce', 'user dce', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'department_id', 'department', 'required' );
		$this->form_validation->set_rules( 'role_id', 'role', 'required' );
	}
	
	/**
	 *	Show Employments
	 */
	public function show( $role = NULL )
	{
		// Create an employment object
		$emp = array();

		// Initialize a local dataset
		$data = array(
			'list' => array()
		);

		// Check for a super user
		if( $this->role < RoleEnum::SUPERUSER ) {
			// Localize the search to the department
			$emp['department_id'] = $this->department->ID;
		}

		// Check the role
		switch( strtoupper( $role ) )
		{
			case "EMPLOYER":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::EMPLOYER;

				// Set the title
				$data['title'] = "Employer Employment List";

				break;

			case "DEPARTMENT":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::DEPARTMENT;

				// Set the title
				$data['title'] = "Department Employment List";
				
				break;

			case "ADMINISTRATOR":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::ADMINISTRATOR;

				// Set the title
				$data['title'] = "Administrator Employment List";
				
				break;

			default:
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::STUDENT;

				// Set the title
				$data['title'] = "Student Employment List";

				break;
		}

		// Ensure that the person viewing the roles has at least the same level
		if( !( assert( $this->role >= $emp['role_id'] ) ) ) {
			$this->load->view( 'errors/412' );
			return;
		}


		// Get all employments in the department
		$emps = $this->EmploymentModel->get( $emp );

		// Loop through each item
		foreach( $emps as $emp ) {
			// Get some information for the page
			$user = $this->UserModel->getOne( array( 'ID' => $emp->user_id ) );
			$role = $this->RoleModel->getOne( array( 'ID' => $emp->role_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $emp->department_id ) );

			// Create an item
			$item = array(
				'emp' => $emp,
				'user' => $user,
				'dept' => $dept,
				'role' => $role
			);

			// Push the employment onto the list
			array_push( $data['list'], $item );
		}

		// Load the detail view
		$this->data['body'] = $this->load->view( 'employment/show', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Create an Employment
	 */
	public function create( $role = NULL )
	{
		// Initialize a local data array
		$data = array();

		// Check the role
		switch( strtoupper( $role ) )
		{
			case "EMPLOYER":
				// Set the role id to the employer
				$role_id = RoleEnum::EMPLOYER;

				// Set the title
				$data['title'] = "Create Employer User";

				break;

			case "DEPARTMENT":
				// Set the role id to the employer
				$role_id = RoleEnum::DEPARTMENT;

				// Set the title
				$data['title'] = "Create Department User";
				
				break;

			case "ADMINISTRATOR":
				// Set the role id to the employer
				$role_id = RoleEnum::ADMINISTRATOR;

				// Set the title
				$data['title'] = "Create Administrative User";
				
				break;

			default:
				// Set the role id to the employer
				$role_id = RoleEnum::STUDENT;

				// Set the title
				$data['title'] = "Create Student User";

				break;
		}

		// Get data for the view
		$data['users'] = to_options_array( $this->UserModel->get(), 'ID', 'dce' );
		$data['departments'] = ( $this->role >= RoleEnum::ADMINISTRATOR ? to_options_array( $this->DepartmentModel->get(), 'ID', 'name' ) : NULL );
		$data['department'] = $this->department;

		// Load the body with the create view
		$this->data['body'] = $this->load->view( 'employment/create', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}

	/**
	 *	Remove an Employment
	 */
	public function remove( $role = NULL )
	{
		// Create an employment object
		$emp = array();

		// Initialize a local data array
		$data = array(
			'list' => array()
		);

		// Check for a super user
		if( $this->role < RoleEnum::SUPERUSER ) {
			// Localize the search to the department
			$emp['department_id'] = $this->department->ID;
		}

		// Check the role
		switch( strtoupper( $role ) )
		{
			case "EMPLOYER":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::EMPLOYER;

				// Set the title
				$data['title'] = "Remove Employer User";

				break;

			case "DEPARTMENT":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::DEPARTMENT;

				// Set the title
				$data['title'] = "Remove Department User";
				
				break;

			case "ADMINISTRATOR":
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::ADMINISTRATOR;

				// Set the title
				$data['title'] = "Remove Administrative User";
				
				break;

			default:
				// Set the role id to the employer
				$emp['role_id'] = RoleEnum::STUDENT;

				// Set the title
				$data['title'] = "Remove Student User";

				break;
		}

		// Ensure that the person viewing the roles has at least the same level
		if( !( assert( $this->role >= $emp['role_id'] ) ) ) {
			$this->load->view( 'errors/412' );
			return;
		}


		// Get all employments in the department
		$emps = $this->EmploymentModel->get( $emp );

		// Loop through each item
		foreach( $emps as $emp ) {
			// Get some information for the page
			$user = $this->UserModel->getOne( array( 'ID' => $emp->user_id ) );
			$role = $this->RoleModel->getOne( array( 'ID' => $emp->role_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $emp->department_id ) );

			// Create an item
			$item = array(
				'emp' => $emp,
				'user' => $user,
				'dept' => $dept,
				'role' => $role
			);

			// Push the employment onto the list
			array_push( $data['list'], $item );
		}

		// Load the body with the create view
		$this->data['body'] = $this->load->view( 'employment/remove', $data, TRUE );

		// Load the template view
		$this->load->view( 'template', $this->data );
	}
}

/* End of file */