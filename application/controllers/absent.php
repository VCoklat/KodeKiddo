<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Absent (AbsentController)
 * Absent Class to control all absent related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Absent extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('absent_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the absent
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';

        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    /**
     * This function is used to load the absent list
     */
	function absentReport()
	{
		$data['absentRecords'] = '';

        $this->global['pageTitle'] = 'Absent Listing';

        $this->loadViews("report", $this->global, $data, NULL);
	}
	
    function absentListing()
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
        $this->load->model('absent_model');

        $searchText = $this->input->post('searchText');
        $date = $this->input->post('datepicker');
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
		$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
        $count = $this->absent_model->absentListingCount($searchText,$branch);

        $returns = $this->paginationCompress ( "absentListing/", $count, 5 );
		
        $data['absentRecords'] = $this->absent_model->absentListing($date,$branch, $returns["page"], $returns["segment"]);

        $this->global['pageTitle'] = 'Absent Listing';

        $this->loadViews("absent", $this->global, $data, NULL);
      }
    }

    /**
     * This function is used to load the add new form
     */
    function addAbsent()
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->model('absent_model');
            $this->global['pageTitle'] = 'Add New Absent';
			$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
			$data['databranch']= $branch;
            $data['branches'] = $this->absent_model->getAbsentBranches();
            $data['teacher'] = $this->absent_model->getAbsentTeacher();
            $data['class'] = $this->absent_model->getAbsentClass();
            $this->loadViews("addAbsent", $this->global, $data,NULL);
          }
    }

    /**
     * This function is used to add new absent to the system
     */
    function addNewAbsent()
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('student_name','Absent Name','trim|required|xss_clean');

            //$this->form_validation->set_rules('class_schedule','Schedule','trim|required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->addAbsent();
            }
            else
            {
                $student_name = $this->input->post('student_name');
                $absent = $this->input->post('chkPassport');
                $date = $this->input->post('datepicker');
                $class = $this->input->post('class_schedule');
                $teacher = $this->input->post('teacher');
                $point = $this->input->post('point');
                $group_project = $this->input->post('group_project');
                $unplugged = $this->input->post('unplugged');
                $online = $this->input->post('online');
                $teacher_note = $this->input->post('teacher_note');
                $milestone = $this->input->post('milestone');

                $absentInfo = array(
                'Student_name'=>$student_name,'date'=>$date, 'class'=>$class,'absent'=>$absent,'teacher'=> $teacher,'point'=>$point,
                'group_project'=>$group_project,'unplugged'=> $unplugged,'online'=> $online,'teacher_note'=> $teacher_note,'milestone'=> $milestone,'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:sa'));

                $this->load->model('absent_model');
                $result = $this->absent_model->addNewAbsent($absentInfo);
				$result1 = $this->absent_model->payment;
                
				if($result > 0)
                {
					if($result1=1)
					{
						$this->session->set_flashdata('error', 'Outstanding Payment');
					} else {
                    $this->session->set_flashdata('success', 'New Absent created successfully');
					}
                }
                else
                {
                    $this->session->set_flashdata('error', 'Absent creation failed');
                }

                redirect('addAbsent');
}
        }
    }


    /**
     * This function is used load absent edit information
     * @param number $absentId : Optional : This is absent id
     */
    function editOldAbsent($absentId = NULL)
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
            if($absentId == null)
            {
                redirect('absentListing');
            }

            $data['absentInfo'] = $this->absent_model->getAbsentInfo($absentId);
            $data['branches'] = $this->absent_model->getAbsentBranches();
            $data['teacher'] = $this->absent_model->getAbsentTeacher();
            $data['class'] = $this->absent_model->getAbsentClass();
            $this->global['pageTitle'] = 'Edit Absent';

            $this->loadViews("editOldAbsent", $this->global, $data, NULL);
}
    }
	
	function viewOldAbsent($absentId = NULL)
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
        $this->load->model('absent_model');

        $searchText = $this->input->post('searchText');
        
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
		$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
        $count = $this->absent_model->absentListingCount($searchText,$branch);

        $returns = $this->paginationCompress ( "absentReport/", $count, 5 );
		
        $data['absentRecords'] = $this->absent_model->absentReport($absentId);

        $this->global['pageTitle'] = 'Absent Listing';

        $this->loadViews("detailabsent", $this->global, $data, NULL);
      }
    }
	
    /**
     * This function is used to edit the absent information
     */
    function editAbsent()
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
            $this->load->library('form_validation');

            $absentId = $this->input->post('absentId');
            $this->form_validation->set_rules('student_name','Student Name','trim|required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldAbsent($absentId);
            }
            else
            {
              $student_name = $this->input->post('student_name');
              $absent = $this->input->post('chkPassport');
              $date = $this->input->post('datepicker');
              $class = $this->input->post('class_schedule');
              $teacher = $this->input->post('teacher');
              $point = $this->input->post('point');
              $group_project = $this->input->post('group_project');
              $unplugged = $this->input->post('unplugged');
              $online = $this->input->post('online');
              $teacher_note = $this->input->post('teacher_note');
              $milestone = $this->input->post('milestone');

              $absentInfo = array();
              $absentInfo = array(
              'Student_name'=>$student_name,'date'=>$date, 'class'=>$class,'absent'=>$absent,'teacher'=> $teacher,'point'=>$point,
              'group_project'=>$group_project,'unplugged'=> $unplugged,'online'=> $online,'teacher_note'=> $teacher_note,'milestone'=> $milestone,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));

                $result = $this->absent_model->editAbsent($absentInfo, $absentId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Absent updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Absent updation failed');
                }

                redirect('absentListing');
            }
          }
    }


    /**
     * This function is used to delete the absent using absentId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteAbsent()
    {
      if($this->isAll() == TRUE)
      {
            echo(json_encode(array('status'=>'access')));
      }
      else {


            $absentId = $this->input->post('absentId');
            $absentInfo = array('isDeleted'=>1);

            $result = $this->absent_model->deleteAbsent($absentId, $absentInfo);

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
