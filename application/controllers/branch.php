<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Branch (BranchController)
 * Branch Class to control all branch related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Branch extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('branch_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the branch
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the branch list
     */
    function branchListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('branch_model');
        
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->branch_model->branchListingCount($searchText);

			$returns = $this->paginationCompress ( "branchListing/", $count, 5 );
            
            $data['branchRecords'] = $this->branch_model->branchListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Branch Listing';
            
            $this->loadViews("branchs", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('branch_model');
			$data['roles'] = "";
            $this->global['pageTitle'] = 'Add New Branch';

            $this->loadViews("addBranch", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to add new branch to the system
     */
    function addNewBranch()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Branch Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('info','Information','trim|xss_clean');
			$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
            $this->form_validation->set_rules('mobile','Phone Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $mobile = $this->input->post('mobile');
				$address = $this->input->post('address');
				$info = $this->input->post('info');
                
                $branchInfo = array('address'=>$address, 'name_branch'=> $name,'info'=> $info,
                                    'phone'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:sa'));
                
                $this->load->model('branch_model');
                $result = $this->branch_model->addNewBranch($branchInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Branch created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Branch creation failed');
                }
                
                redirect('addNewBranch');
            }
        }
    }
   
    /**
     * This function is used load branch edit information
     * @param number $branchId : Optional : This is branch id
     */
    function editOldBranch($branchId = NULL)
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            if($branchId == null)
            {
                redirect('branchListing');
            }
            
            $data['branchInfo'] = $this->branch_model->getBranchInfo($branchId);
            
            $this->global['pageTitle'] = 'Edit Branch';
            
            $this->loadViews("editBranch", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the branch information
     */
    function editBranch()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $branchId = $this->input->post('branchId');      
            
            $this->form_validation->set_rules('fname','Branch Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('info','Information','trim|xss_clean');
			$this->form_validation->set_rules('address','Address','trim|required|xss_clean');
            $this->form_validation->set_rules('mobile','Phone Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOldBranch($branchId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
               
                $branch = $this->input->post('branchId');
                $mobile = $this->input->post('mobile');
				$info = $this->input->post('info');
				$address = $this->input->post('address');
                
                $branchInfo = array();
                $branchInfo = array('branchId'=>$branch,'address'=>$address, 'info'=>$info, 'name_branch'=>$name,
                                    'phone'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                
                $result = $this->branch_model->editOldBranch($branchInfo, $branchId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Branch updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Branch updation failed');
                }
                
                redirect('branchListing');
            }
        }
    }

    /**
     * This function is used to delete the branch using branchId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBranch()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $branchId = $this->input->post('branchId');
            $branchInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
			$scheduleInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            $personInfo = array('status'=>2,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            $result = $this->branch_model->deleteBranch($branchId, $branchInfo, $personInfo, $scheduleInfo);
            
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