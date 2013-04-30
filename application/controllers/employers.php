<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employers extends SEO_Controller {
	/**
	 *	Main Page
	 */
	public function index()
	{
		$this->data['body'] = $this->load->view('employers/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Employer Information Page
	 */
	public function info()
	{
		$this->data['body'] = $this->load->view('employers/new/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Search for the department
	 */
	public function department( $q = "" )
	{
		// Initialize an array for the departments
		$depts = array();

		// Echo out the department search
		$results = $this->DepartmentModel->search(array( "name" => urldecode( $q ) ));

		// Loop through the result list
		foreach( $results as $result )
			array_push( $depts, $result->name );

		// Output the departments
		echo json_encode($depts);
	}

	/**
	 *	Post On Campus Page
	 */
	public function postOnCampus()
	{
		// Set up sime basic information
		$this->email->to('967dept@rit.edu');
		$this->email->from('967dept@rit.edu', 'Website: Post On Campus');
		$this->email->subject( 'Post On Campus Position' );

		// Set up form validation rules
		$this->form_validation->set_rules( 'job_number', 'job number', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'job_title', 'job title', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'start_date', 'start date', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'shift_hours', ' hours per week', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'work_hours', 'work hours', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'wage', 'wage', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'shift_days[]', 'shift days', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'contact_name', 'contact name', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'department', 'department', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'phone', 'phone', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'post_phone', 'post phone', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'email', 'email', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'post_email', 'post email', 'required|trim|xss_clean' );

		// Run the validation
		if( $this->form_validation->run() == FALSE ) {
			// Initialize a data array
			$data = array(
				"browser_error" => ""
			);

			// Check the browser
			if( $this->agent->is_browser( 'MSIE' ) ||
				$this->agent->is_browser( 'Internet Explorer' ) )
			{
				// Set the browser error message
				$data['browser_error'] = "You are currently using Internet Explorer which has had issues when submitting jobs to our website. Please use Mozilla Firefox or Google Chrome to avoid any issues.";
			}

			// Load the form by default
			$this->data['body'] = $this->load->view('postings/oncampus/post/form', $data, TRUE );
		} else {
			// Get the data
			$data = array(
				"job_number" => $this->input->post( 'job_number', TRUE ),
				"job_title" => $this->input->post( 'job_title', TRUE ),
				"start_date" => $this->input->post( 'start_date', TRUE ),
				"shift_hours" => $this->input->post( 'shift_hours', TRUE ),
				"work_hours" => $this->input->post( 'work_hours', TRUE ),
				"wage" => $this->input->post( 'wage', TRUE ),
				"shift_days" => implode( $this->input->post( 'shift_days', TRUE ) ),
				"contact_name" => $this->input->post( 'contact_name', TRUE ),
				"department" => $this->input->post( 'department', TRUE ),
				"phone" => $this->input->post( 'phone', TRUE ),
				"post_phone" => $this->input->post( 'post_phone', TRUE ),
				"email" => $this->input->post( 'email', TRUE ),
				"post_email" => $this->input->post( 'post_email', TRUE )
			);

			// Send the email
			$body = $this->load->view( 'postings/oncampus/post/email', $data, TRUE );

			// Get the message body
			$this->email->message( $body );
			$this->email->send();

			// Echo any errors
			$data = array(
				'errors' => $this->email->print_debugger(),
				'email' => $body
			);

			// Load the body of the page
			$this->data['body'] = $this->load->view( 'postings/oncampus/post/success', $data, TRUE );
		}

		$this->load->view('template', $this->data);
	}

	/**
	 *	Remove On Campus Page
	 */
	public function removeOnCampus()
	{
		// Set up sime basic information
		$this->email->to('967dept@rit.edu');
		$this->email->from('967dept@rit.edu', 'Website: Remove On Campus');
		$this->email->subject( 'Remove On Campus Position' );

		// Set up form validation rules
		$this->form_validation->set_rules( 'job_number', 'job number', 'required|trim|xss_clean' );

		// Run the validation
		if( $this->form_validation->run() == FALSE ) {
			// Initialize a data array
			$data = array(
				"browser_error" => ""
			);

			// Check the browser
			if( $this->agent->is_browser( 'MSIE' ) ||
				$this->agent->is_browser( 'Internet Explorer' ) )
			{
				// Set the browser error message
				$data['browser_error'] = "You are currently using Internet Explorer which has had issues when submitting jobs to our website. Please use Mozilla Firefox or Google Chrome to avoid any issues.";
			}

			// Load the form
			$this->data['body'] = $this->load->view('postings/oncampus/remove/form', $data, TRUE );
		} else {
			// Get the data
			$data = array(
				"job_number" => $this->input->post( 'job_number', TRUE )
			);

			// Send the email
			$body = $this->load->view( 'postings/oncampus/remove/email', $data, TRUE );

			// Get the message body
			$this->email->message( $body );
			$this->email->send();

			// Echo any errors
			$data = array(
				'errors' => $this->email->print_debugger(),
				'email' => $body
			);

			// Load the view
			$this->data['body'] = $this->load->view( 'postings/oncampus/remove/success', $data, TRUE );
		}

		// Load the template with the data
		$this->load->view('template', $this->data);
	}

	/**
	 *	Post Off Campus Page
	 */
	public function postOffCampus()
	{
		// Set the form validation rules
		// Company Information
		$this->form_validation->set_rules( 'company_name', 'company name', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'address', 'address / location', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'city', 'city', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'state', 'state', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'zip', 'zip', 'trim|xss_clean' );

		// Contact Information
		$this->form_validation->set_rules( 'contact_name', 'contact name' ,'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'email', 'email' ,'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'phone', 'phone' ,'trim|xss_clean' );
		$this->form_validation->set_rules( 'fax', 'fax' ,'trim|xss_clean' );
		
		// Job Information
		$this->form_validation->set_rules( 'title', 'job title', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'start_date', 'start date', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'shift_hours', 'hours per week', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'work_hours', 'work hours', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'wage', 'wage', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'shift_days[]', 'shift days', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'category', 'job category', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'summary', 'position summary', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'requirements', 'position requirements', 'required|trim|xss_clean' );

		// Attempt to rum the validation
		if( $this->form_validation->run() == FALSE ) {
			// Initialize a data array
			$data = array(
				"browser_error" => ""
			);

			// Check the browser
			if( $this->agent->is_browser( 'MSIE' ) ||
				$this->agent->is_browser( 'Internet Explorer' ) )
			{
				// Set the browser error message
				$data['browser_error'] = "You are currently using Internet Explorer which has had issues when submitting jobs to our website. Please use Mozilla Firefox or Google Chrome to avoid any issues.";
			}

			// Load the form by default
			$this->data['body'] = $this->load->view('postings/offcampus/post/form', $data, TRUE );
		} else {
			// Set up sime basic information
			$this->email->to('967dept@rit.edu');
			$this->email->from('967dept@rit.edu', 'Website: Post Off Campus');
			$this->email->subject( 'New Off Campus Position' );

			// Localize the shift
			$shift_days = $this->input->post( 'shift_days', TRUE );

			// Check the shift days
			if( $shift_days == "" ) {
				// Set the array
				$shift_days = array();
			}

			// Get the data to pass to the view
			$data = array(
				"company_name" => $this->input->post( 'company_name', TRUE ),
				"address" => $this->input->post( 'address', TRUE ),
				"city" => $this->input->post( 'city', TRUE ),
				"state" => $this->input->post( 'state', TRUE ),
				"zip" => $this->input->post( 'zip', TRUE ),
				"contact_name" => $this->input->post( 'contact_name', TRUE ),
				"email" => $this->input->post( 'email', TRUE ),
				"phone" => $this->input->post( 'phone', TRUE ),
				"fax" => $this->input->post( 'fax', TRUE ),
				"title" => $this->input->post( 'title', TRUE ),
				"start_date" => $this->input->post( 'start_date', TRUE ),
				"shift_hours" => $this->input->post( 'shift_hours', TRUE ),
				"work_hours" => $this->input->post( 'work_hours', TRUE ),
				"wage" => $this->input->post( 'wage', TRUE ),
				"shift_days" => implode( $shift_days ),
				"category" => $this->input->post( 'category', TRUE ),
				"summary" => $this->input->post( 'summary', TRUE ),
				"requirements" => $this->input->post( 'requirements', TRUE )
			);

			// Send the email
			$body = $this->load->view( 'postings/offcampus/post/email', $data, TRUE );

			// Get the message body
			$this->email->message( $body );
			$this->email->send();

			// Echo any errors
			$data = array(
				'errors' => $this->email->print_debugger(),
				'email' => $body
			);

			// Load the success view
			$this->data['body'] = $this->load->view( 'postings/offcampus/post/success', $data, TRUE );
		}

		$this->load->view('template', $this->data);
	}

	/**
	 *	Employer Resources Page
	 */
	public function resources()
	{
		$this->data['body'] = $this->load->view('employers/resources/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Employer Handbook Page
	 */
	public function handbook()
	{
		$this->data['body'] = $this->load->view('employers/handbook/index', '', TRUE );

		$this->load->view('template', $this->data);
	}
}