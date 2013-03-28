<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Students extends SEO_Controller {
	/**
	 *	Main Page
	 */
	public function index()
	{
		$this->data['body'] = $this->load->view('students/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function info()
	{
		$this->data['body'] = $this->load->view('students/new/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function oncampus( $category = NULL, $job_number = NULL )
	{
		// Load the index page by default
		$this->data['body'] = $this->load->view('students/oncampus/index', '', TRUE );

		// Check for the category
		if( $category != NULL ) {
			// Try to get the category
			try {
				// Load the jobs
				$data = array(
					"html" => file_get_contents( getcwd() . "/jobs/vtx$category.seoinc" ),
					"job_number" => $job_number
				);

				$this->data['body'] = $this->load->view('students/oncampus/view', $data, TRUE);
			} catch(Exception $e) {}
		}

		// Load the template
		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function offcampus( $category = NULL, $job_number = NULL )
	{
		// Load the index page by default
		$this->data['body'] = $this->load->view('students/offcampus/index', '', TRUE );

		// Check for the category
		if( $category != NULL ) {
			// Try to get the category
			try {
				// Load the jobs
				$data = array(
					"html" => file_get_contents( getcwd() . "/jobs/vto$category.seoinc" ),
					"job_number" => $job_number
				);

				$this->data['body'] = $this->load->view('students/oncampus/view', $data, TRUE);
			} catch(Exception $e) {}
		}

		// Load the template
		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function resources()
	{
		$this->data['body'] = $this->load->view('students/resources/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function handbook()
	{
		$this->data['body'] = $this->load->view('students/handbook/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Main Page
	 */
	public function faq()
	{
		$this->data['body'] = $this->load->view('students/faq/index', '', TRUE );

		$this->load->view('template', $this->data);
	}
}