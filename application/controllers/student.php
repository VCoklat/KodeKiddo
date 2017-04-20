<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Student (StudentController)
 * Student Class to control all student related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Student extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('student_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the student
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';

        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    /**
     * This function is used to load the student list
     */
    function studentListing()
    {
      if($this->isManager() == TRUE)
      {
            $this->loadThis();
      }
      else {
        $this->load->model('student_model');

        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;

        $this->load->library('pagination');

        $count = $this->student_model->studentListingCount($searchText);

  $returns = $this->paginationCompress ( "studentListing/", $count, 5 );

        $data['studentRecords'] = $this->student_model->studentListing($searchText, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'Student Listing';

        $this->loadViews("student", $this->global, $data, NULL);
      }
    }

    /**
     * This function is used to load the add new form
     */
    function addStudent()
    {
      if($this->isManager() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->model('student_model');
          //  $data['roles'] = $this->student_model->getStudentRoles();

            $this->global['pageTitle'] = 'Add New Student';

            $this->loadViews("addStudent", $this->global, NULL);
          }
    }

    /**
     * This function is used to add new student to the system
     */
    function addNewStudent()
    {
      if($this->isManager() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('bname','Student Name','trim|required|xss_clean');
            $this->form_validation->set_rules('baddress','Student Address','trim|required|xss_clean|');
            $this->form_validation->set_rules('binformation','Parent Name','trim|required|xss_clean|');
            $this->form_validation->set_rules('mobile','Student Phone Number','required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->addStudent();
            }
            else
            {
                $student = $this->input->post('bname');
                $address = $this->input->post('baddress');
                $information = $this->input->post('binformation');
                $mobile = $this->input->post('mobile');

                $studentInfo = array('address'=>$address,'information'=>$information, 'student'=> $student, 'mobile'=>$mobile);

                $this->load->model('student_model');
                $result = $this->student_model->addNewStudent($studentInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Student created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Student creation failed');
                }

                redirect('addStudent');
}
        }
    }


    /**
     * This function is used load student edit information
     * @param number $studentId : Optional : This is student id
     */
    function editOldStudent($studentId = NULL)
    {
      if($this->isManager() == TRUE)
      {
            $this->loadThis();
      }
      else {
            if($studentId == null)
            {
                redirect('studentListing');
            }

            $data['studentInfo'] = $this->student_model->getStudentInfo($studentId);

            $this->global['pageTitle'] = 'Edit Student';

            $this->loadViews("editOldStudent", $this->global, $data, NULL);
}
    }


    /**
     * This function is used to edit the student information
     */
    function editStudent()
    {
      if($this->isManager() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->library('form_validation');

            $studentId = $this->input->post('studentId');

            $this->form_validation->set_rules('bname','Student Name','trim|required|xss_clean');
            $this->form_validation->set_rules('baddress','Student Address','trim|required|xss_clean|');
            $this->form_validation->set_rules('binformation','Student Information','trim|required|xss_clean|');
            $this->form_validation->set_rules('mobile','Student Phone Number','required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldStudent($studentId);
            }
            else
            {
              $barnch = $this->input->post('bname');
              $address = $this->input->post('baddress');
              $information = $this->input->post('binformation');
              $mobile = $this->input->post('mobile');

              $studentInfo = array();
              $studentInfo = array('address'=>$address,'information'=>$information, 'student'=> $student, 'mobile'=>$mobile);

                $result = $this->student_model->editStudent($studentInfo, $studentId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Student updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Student updation failed');
                }

                redirect('studentListing');
            }
          }
    }


    /**
     * This function is used to delete the student using studentId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStudent()
    {
      if($this->isManager() == TRUE)
      {
            echo(json_encode(array('status'=>'access')));
      }
      else {


            $studentId = $this->input->post('studentId');
            $studentInfo = array('isDeleted'=>1);

            $result = $this->student_model->deleteStudent($studentId, $studentInfo);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
}
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = '404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>
