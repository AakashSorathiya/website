<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends SEO_Controller {
	/**
	 *	
	 */
	function __construct()
	{
		// Call the parent constructor
		parent::__construct();

		//
		//	DEFINE FORM VALIDATION RULES
		//
		$this->form_validation->set_rules( 'ID', '', 'xss_clean' );
		$this->form_validation->set_rules( 'number', 'job number', 'trim|xss_clean' );
		$this->form_validation->set_rules( 'current_state', 'current state', 'xss_clean' );
	}

	/**
	 *	Approve a job in the database
	 */
	public function show( $id = NULL )
	{
		// Get the information from the post
		$number = $this->input->post( 'number', TRUE );
		$current_state = $this->input->post( 'current_state', TRUE );

		// Ensure that an admin is accessing the page
		if( !( assert( $this->role >= RoleEnum::ADMINISTRATOR ) ) ) {
			// Load the permissions view
			$this->load->view( 'errors/412' );

			// Prevent the remaining code from running
			return;
		}

		// Check the passed in ID
		if( $id != NULL ) {
			// Get the job
			$job = $this->JobModel->getOne( array( 'ID' => $id ) );

			// Check the current state
			if( $current_state == 'denied' ) {
				// Store the new information
				$job->current_state = StateEnum::DENIED;

				// Update the instance in the database
				$this->JobModel->update( $job );

				// Redirect to admin page
				redirect( '/page/admin', 'refresh' );

			} else if( $current_state == 'approved' ) {
				// Store the new information
				$job->number = $number;
				$job->current_state = StateEnum::APPROVED;

				// Update the instance in the database
				$this->JobModel->update( $job );

				// Redirect to the admin page
				redirect( '/page/admin', 'refresh' );

			}

			// Get the necessary information
			$info = $this->InformationModel->getOne( array( 'ID' => $job->information_id ) );
			$poc = $this->PointOfContactModel->getOne( array( 'job_id' => $job->ID, 'primary' => TRUE ) );
			$contact = $this->UserModel->getOne( array( 'ID' => $poc->user_id ) );
			$dept = $this->DepartmentModel->getOne( array( 'ID' => $job->department_id ) );
			$codes = $this->CodeModel->get( array( 'department_id' => $job->department_id ) );
			$type = $this->TypeModel->getOne( array( 'ID' => $info->type_id ) );

			// Get all positions similar to the
			$infos = $this->InformationModel->get( array( 'dept_code' => $info->dept_code ) );
			$similar = '';

			// Loop through each similar position
			foreach( $infos as $sim ) {
				// Get the position
				$pos = $this->JobModel->getOne( array( 'information_id' => $sim->ID ) );

				// Check the state
				if( $pos->current_state == StateEnum::APPROVED
					|| $pos->current_state == StateEnum::POSTED
					|| $pos->current_state == StateEnum::UNPOSTED
				) {
					// Append the spacer
					if( $similar != '' ) $similar .= ', ';

					// Append the position job number
					$similar .= $pos->number;
				}
			}

			// Local data for the page
			$data = array(
				'job' => $job,
				'info' => $info,
				'poc' => $poc,
				'contact' => $contact,
				'dept' => $dept,
				'codes' => $codes,
				'type' => $type,
				'similar' => $similar
			);

			// Load the approve view
			$this->data['body'] = $this->load->view( 'admin/index', $data, TRUE );
		}

		// Load the template view
		$this->load->view( 'template', $this->data );
	}
}