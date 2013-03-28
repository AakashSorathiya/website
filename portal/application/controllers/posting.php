<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posting extends SEO_Controller {
	/**
	 *	Add additional functionality to the constructor
	 */
	function __construct()
	{
		// Call the parent constructor
		parent::__construct();

		//	Define form validation rules
		$this->form_validation->set_rules( 'start_date', 'start date', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'end_date', 'end date', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'wage', 'wage', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'weekly_hours', 'weekly hours', 'required|trim|xss_clean' );
		$this->form_validation->set_rules( 'shift_days[]', 'shift days', 'required' );
		$this->form_validation->set_rules( 'shift_hours', 'shift hours', 'required|trim|xss_clean' );
	}

	/**
	 *	Show a posting in the database
	 */
	public function show( $number = NULL )
	{
		// Check the number
		if( $number !== NULL ) {
			// Get the job from the database
			$job = $this->JobModel->getOne( array( 'number' => $number ) );
			$post = $this->PostingModel->getOne( array( 'job_id' => $job->ID ) );
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $job->department_id ) );
			$type = $this->TypeModel->getOne( array( 'ID' => $info->type_id ) );
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
				'post' => $post,
				'info' => $info,
				'dept' => $dept,
				'type' => $type,
				'contact' => $contact
			);

			// Load the body
			$this->data['body'] = $this->load->view( 'posting/show', $data, TRUE );

			// Load the template view
			$this->load->view( 'template', $this->data );
		}
	}

	/**
	 *	Create a posting and insert it into the database
	 */
	public function create( $number = NULL )
	{
		// Check the job number that was passed
		if( $number !== NULL ) {
			// Get the job
			$job = $this->JobModel->getOne( array( 'number' => $number ) );
	
			//
			// TODO: Ensure job is not posted
			//

			// Get the point of contact for this job
			$poc = $this->PointOfContactModel->get(
				array(
					'job_id' => $job->ID,
					'user_id' => $this->user->ID
				)
			);

			// Assert that the user is a point of contact
			// or if they are an administrator
			if( assert( $poc > 0 ) || $this->role >= RoleEnum::ADMINISTRATOR ) {
				// Run the form validation
				if( $this->form_validation->run() == FALSE ) {
					// Finishing gathering data
					$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
					$dept = $this->DepartmentModel->getOne( array( 'ID' => $job->department_id ) );
					$contact = $this->PointOfContactModel->getOne(
						array(
							'job_id' => $job->ID,
							'primary' => TRUE
						)
					);

					// Create a data object
					$data = array(
						'job' => $job,
						'info' => $info,
						'dept' => $dept,
						'contact' => $contact
					);

					// Load the body for the page
					$this->data['body'] = $this->load->view( 'posting/create', $data, TRUE );
				} else {
					// Create a post to send to the database
					$post = array(
						'job_id' => $job->ID,
						'start_date' => strtotime( $this->input->post( 'start_date', TRUE ) ),
						'end_date' => strtotime( $this->input->post( 'end_date', TRUE ) ),
						'wage' => $this->input->post( 'wage', TRUE ),
						'weekly_hours' => $this->input->post( 'weekly_hours', TRUE ),
						'shift_days' => implode( $this->input->post( 'shift_days', TRUE ) ),
						'shift_hours' => $this->input->post( 'shift_hours', TRUE ),
						'timestamp' => time()
					);

					// Insert the post into the database
					$this->PostingModel->insert( $post );

					// Set the current state
					$job->current_state = StateEnum::POSTED;

					// Update the job in the database
					$this->JobModel->update( $job );

					//
					//	TODO: Hook into TWITTER
					//

					// Redirect to the employer page
					redirect( '/page/employer', 'refresh' );
				}
			} else {
				// Load an error page
				$this->data['body'] = $this->load->view( 'errors/412', '', TRUE );
			}

			// Load the template
			$this->load->view( 'template', $this->data );
		}
	}

	/**
	 *	Remove a posting from the database	
	 */
	public function remove( $number = NULL )
	{
		// Check the job number that was passed
		if( $number !== NULL ) {
			// Get the job
			$job = $this->JobModel->getOne( array( 'number' => $number ) );
	
			//
			// TODO: Ensure job is posted
			//

			// Get the point of contact for this job
			$poc = $this->PointOfContactModel->get(
				array(
					'job_id' => $job->ID,
					'user_id' => $this->user->ID
				)
			);

			// Assert that the user is a point of contact
			// or if they are an administrator
			if( assert( $poc > 0 ) || $this->role >= RoleEnum::ADMINISTRATOR ) {
				// Get the posting
				$post = $this->PostingModel->getOne( array( 'job_id' => $job->ID ) );

				// Remove the post from the database
				$this->PostingModel->delete( $post );

				// Change the jobs state
				$job->current_state = StateEnum::UNPOSTED;

				// Save the job in the database
				$this->JobModel->update( $job );

				// Redirect to the employer page
				redirect( '/page/employer', 'refresh' );
			} else {
				// Load an error page
				$this->data['body'] = $this->load->view( 'errors/412', '', TRUE );
			}

			// Load the template
			$this->load->view( 'template', $this->data );
		}
	}

}
/* End of file */