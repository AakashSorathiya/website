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

		// Set global error dilimiters
		$this->form_validation->set_error_delimiters( '<div class="alert alert-error">', '</div>' );

		// Initialize a data set to be sent to the page
		$this->data = array(
			'body' => $this->load->view( 'errors/404', '', TRUE ),
			'isMobileBrowser' => $this->agent->is_mobile()
		);
	}
}