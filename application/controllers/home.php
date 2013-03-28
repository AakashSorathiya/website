<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends SEO_Controller {
	/**
	 *	Main Page
	 */
	public function index()
	{
		$this->data['body'] = $this->load->view('home/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Our Mission Page
	 */
	public function mission()
	{
		$this->data['body'] = $this->load->view('home/mission/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Getting a Job Page
	 */
	public function job()
	{
		$this->data['body'] = $this->load->view('home/job/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Announcements Page
	 */
	public function news()
	{
		$this->data['body'] = $this->load->view('home/news/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Calendar Page
	 */
	public function calendar()
	{
		$this->data['body'] = $this->load->view('home/calendar/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

	/**
	 *	Contact Us Page
	 */
	public function contact()
	{
		$this->data['body'] = $this->load->view('home/contact/index', '', TRUE );

		$this->load->view('template', $this->data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */