<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
$data   = array();
						$this->load->model('student_model');

						$data['userRecords'] = $this->student_model->by_id(1);

						$this->load->view("student", $data);

		/*$this->load->model('student_model');
		/*$student = $this->student_model->by_id(1);
		if (empty($student))
		{
			$this->student_model->save(array(
				'address' => 'Test',
				//'birth_date' => time()
			));
		}*/
/*
		$students = $this->student_model->by_id(1);
		//var_dump($students);
		$this->load->view('welcome_message');*/
	}

	function userListing()
	{
					$this->load->model('student_model');

					$data['userRecords'] = $this->student_model->by_id(1);

					$this->load->view("student", $data, NULL);

	}
}
