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

            $this->loadViews("branch", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addBranch()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('branch_model');
          //  $data['roles'] = $this->branch_model->getBranchRoles();

            $this->global['pageTitle'] = 'Add New Branch';

            $this->loadViews("addBranch", $this->global, NULL);
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

            $this->form_validation->set_rules('bname','Branch Name','trim|required|xss_clean');
            $this->form_validation->set_rules('baddress','Branch Address','trim|required|xss_clean|');
            $this->form_validation->set_rules('binformation','Branch Information','trim|required|xss_clean|');
            $this->form_validation->set_rules('mobile','Branch Phone Number','required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->addBranch();
            }
            else
            {
                $branch = $this->input->post('bname');
                $address = $this->input->post('baddress');
                $information = $this->input->post('binformation');
                $mobile = $this->input->post('mobile');

                $branchInfo = array('address'=>$address,'information'=>$information, 'branch'=> $branch, 'mobile'=>$mobile);

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

                redirect('addBranch');
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

            $this->loadViews("editOldBranch", $this->global, $data, NULL);
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

            $this->form_validation->set_rules('bname','Branch Name','trim|required|xss_clean');
            $this->form_validation->set_rules('baddress','Branch Address','trim|required|xss_clean|');
            $this->form_validation->set_rules('binformation','Branch Information','trim|required|xss_clean|');
            $this->form_validation->set_rules('mobile','Branch Phone Number','required|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOldBranch($branchId);
            }
            else
            {
              $barnch = $this->input->post('bname');
              $address = $this->input->post('baddress');
              $information = $this->input->post('binformation');
              $mobile = $this->input->post('mobile');

              $branchInfo = array();
              $branchInfo = array('address'=>$address,'information'=>$information, 'branch'=> $branch, 'mobile'=>$mobile);

                $result = $this->branch_model->editBranch($branchInfo, $branchId);

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
            $branchInfo = array('isDeleted'=>1);

            $result = $this->branch_model->deleteBranch($branchId, $branchInfo);

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
