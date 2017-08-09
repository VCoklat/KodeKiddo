<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Schedule (ScheduleController)
 * Schedule Class to control all schedule related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Schedule extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('schedule_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the schedule
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the schedule list
     */
    function scheduleListing()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('schedule_model');
        
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
            
            $count = $this->schedule_model->scheduleListingCount($searchText,$branch);

			$returns = $this->paginationCompress ( "scheduleListing/", $count, 5 );
            
            $data['scheduleRecords'] = $this->schedule_model->scheduleListing($searchText, $branch, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Schedule Listing';
            
            $this->loadViews("schedules", $this->global, $data, NULL);
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
            $this->load->model('schedule_model');
			$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
			$data['databranch']= $branch;
            $data['branch'] = $this->schedule_model->getScheduleBranch();
            $this->global['pageTitle'] = 'Add New Schedule';

            $this->loadViews("addSchedule", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new schedule to the system
     */
    function addNewSchedule()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('day','Day','trim|required|xss_clean');
            $this->form_validation->set_rules('fname','Time','trim|required|xss_clean');
			$this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');
			
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $day = $this->input->post('day');
                
				$branch = $this->input->post('branch');
                
                $scheduleInfo = array();
                
                $scheduleInfo = array('branchId'=>$branch,'schedule'=>$name, 'day'=>$day, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:sa'));
                
                $this->load->model('schedule_model');
                $result = $this->schedule_model->addNewSchedule($scheduleInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Schedule created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Schedule creation failed');
                }
                
                redirect('addNewSchedule');
            }
        }
    }

    
    /**
     * This function is used load schedule edit information
     * @param number $scheduleId : Optional : This is schedule id
     */
    function editOldSchedule($scheduleId = NULL)
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($scheduleId == null)
            {
                redirect('scheduleListing');
            }
            
			$data['branch'] = $this->schedule_model->getScheduleBranch();
            $data['scheduleInfo'] = $this->schedule_model->getScheduleInfo($scheduleId);
            
            $this->global['pageTitle'] = 'Edit Schedule';
            
            $this->loadViews("editSchedule", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the schedule information
     */
    function editSchedule()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $scheduleId = $this->input->post('scheduleId');
            
            $this->form_validation->set_rules('fname','Time','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('day','Day','trim|required|xss_clean');
			$this->form_validation->set_rules('branch','Branch','trim|required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($scheduleId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $day = $this->input->post('day');
                
				$branch = $this->input->post('branch');
                
                $scheduleInfo = array();
                
                $scheduleInfo = array('branchId'=>$branch,'schedule'=>$name, 'day'=>$day, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                
                
                $result = $this->schedule_model->editSchedule($scheduleInfo, $scheduleId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Schedule updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Schedule updation failed');
                }
                
                redirect('scheduleListing');
            }
        }
    }


    /**
     * This function is used to delete the schedule using scheduleId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSchedule()
    {
        if($this->isAll() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $scheduleId = $this->input->post('scheduleId');
            $scheduleInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            
            $result = $this->schedule_model->deleteSchedule($scheduleId, $scheduleInfo);
            
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