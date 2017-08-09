<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Student (StudentController)
 * Student Class to control all student related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Outstanding extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('outstanding_model');
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
    function outstandingListing()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('outstanding_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}	
            $this->load->library('pagination');
            
            $count = $this->outstanding_model->outstandingListingCount($searchText, $branch);

			$returns = $this->paginationCompress ( "outstandingListing/", $count, 5 );
            
            $data['studentRecords'] = $this->outstanding_model->outstandingListing($searchText, $branch, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Student Listing';
            
            $this->loadViews("outstandings", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('student_model');
			$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
			$data['databranch']= $branch;
            $data['schedule'] = $this->student_model->getStudentSchedules();
			$data['status'] = $this->student_model->getStudentStatus();
			$data['source'] = $this->student_model->getStudentSource();
            $data['branch'] = $this->student_model->getStudentBranch();
            $this->global['pageTitle'] = 'Add New Student';

            $this->loadViews("addStudent", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new student to the system
     */
    function addNewStudent()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('branch','Branch','trim|required|numeric');
			$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
			$this->form_validation->set_rules('class','Class','trim|required|xss_clean');
			$this->form_validation->set_rules('school','School','trim|required|xss_clean');
            $this->form_validation->set_rules('email','Parent Email','trim|required|valid_email|xss_clean|max_length[128]');
			$this->form_validation->set_rules('source','Source','trim|required|numeric');
			$this->form_validation->set_rules('age','Age','trim|required|numeric');
			$this->form_validation->set_rules('status','Status','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Parent Phone Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
				$age = $this->input->post('age');
				$parent_name = $this->input->post('parent_name');
				$class = $this->input->post('class');
				$status= $this->input->post('status');
				$school = $this->input->post('school');
				$schedule = $this->input->post('schedule');
				$source = $this->input->post('source');
                $mobile = $this->input->post('mobile');
				$branch = $this->input->post('branch');
				$address = $this->input->post('address');
                
                $studentInfo = array('studentId'=>"" ,'parent_email'=>$email,'scheduleId'=>$schedule,'branchId'=>$branch,'address'=>$address, 'name'=> $name,'age'=> $age,'status'=> $status,'school'=> $school,'kelas'=> $class,'source'=> $source,'parent_name'=> $parent_name,'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:sa'));
                
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
                
                redirect('addNewStudent');
            }
        }
    }
    
    /**
     * This function is used load student edit information
     * @param number $studentId : Optional : This is student id
     */
    function editOldStudent($studentId = NULL)
    {
        if($this->isAll() == TRUE || $studentId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($studentId == null)
            {
                redirect('studentListing');
            }
            $data['jadwal1'] = $this->student_model->getStudentSchedules();
            $data['sources'] = $this->student_model->getStudentSource();
			$data['branches'] = $this->student_model->getStudentBranch();
			$data['status_data'] = $this->student_model->getStudentStatus();
            $data['studentInfo'] = $this->student_model->getStudentInfo($studentId);
            $data['absentRecords'] = $this->student_model->absentReport($studentId);
			$data['statusRecords'] = $this->student_model->statusReport($studentId);
			$data['expenseRecords'] = $this->student_model->expenseReport($studentId);
            $this->global['pageTitle'] = 'Edit Student';
            
            $this->loadViews("editStudent", $this->global, $data, NULL);
        }
    }   
	
	
    function expenseStudent()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $studentId = $this->input->post('studentId');
            
           
			$this->form_validation->set_rules('nominal','Nominal','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldStudent($studentId);
            }
            else
            {
				$note = $this->input->post('note');
				$nominal = $this->input->post('nominal');
                
                $studentInfo = array('note'=>$note,'nominal'=>$nominal,'studentId'=>$studentId,'createdBy'=>$this->vendorId, 'createdDate'=>date('Y-m-d H:i:sa'));
                
                
                $result = $this->student_model->expenseStudent($studentInfo);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Insert Student Expense Success');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Insert Student Expense failed');
                }
                
                redirect('editOldStudent/'.$studentId);
            }
		}
	}
    /**
     * This function is used to edit the student information
     */
    function editStudent()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $studentId = $this->input->post('studentId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('branch','Branch','trim|required|numeric');
			$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
			$this->form_validation->set_rules('class','Class','trim|required|xss_clean');
			$this->form_validation->set_rules('school','School','trim|required|xss_clean');
            $this->form_validation->set_rules('email','Parent Email','trim|required|valid_email|xss_clean|max_length[128]');
			$this->form_validation->set_rules('source','Source','trim|required|numeric');
			$this->form_validation->set_rules('age','Age','trim|required|numeric');
			$this->form_validation->set_rules('status','Status','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Parent Phone Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldStudent($studentId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
				$age = $this->input->post('age');
				$parent_name = $this->input->post('parent_name');
				$class = $this->input->post('class');
				$status= $this->input->post('status');
				$school = $this->input->post('school');
				$schedule = $this->input->post('schedule');
				$source = $this->input->post('source');
                $mobile = $this->input->post('mobile');
				$branch = $this->input->post('branch');
				$address = $this->input->post('address');
                
                $studentInfo = array('parent_email'=>$email,'scheduleId'=>$schedule,'branchId'=>$branch,'address'=>$address, 'name'=> $name,'age'=> $age,'status'=> $status,'school'=> $school,'kelas'=> $class,'source'=> $source,'parent_name'=> $parent_name,'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                
                
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
        if($this->isAll() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $studentId = $this->input->post('studentId');
            $studentInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            
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