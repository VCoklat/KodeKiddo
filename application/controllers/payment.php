<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Payment (PaymentController)
 * Payment Class to control all payment related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Payment extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the payment
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the payment list
     */
    function paymentListing()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('payment_model');
        
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
            
            $count = $this->payment_model->paymentListingCount($searchText, $branch);

			$returns = $this->paginationCompress ( "paymentListing/", $count, 5 );
            
            $data['paymentRecords'] = $this->payment_model->paymentListing($searchText, $branch, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Payment Listing';
            
            $this->loadViews("payments", $this->global, $data, NULL);
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
            $this->load->model('payment_model');
			$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
			$data['databranch']= $branch;
            $this->global['pageTitle'] = 'Add New Payment';

            $this->loadViews("addPayment", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new payment to the system
     */
    function addNewPayment()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('student_name','Full Name','trim|required|max_length[128]|xss_clean');
			$this->form_validation->set_rules('allocation','Allocation','trim|required|numeric');
			$this->form_validation->set_rules('method','Method','trim|required|xss_clean');
			$this->form_validation->set_rules('note','Note','trim|required|xss_clean');
			$this->form_validation->set_rules('nominal','Nominal','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('student_name')));
                $note = $this->input->post('note');
				$allocation = $this->input->post('allocation');
				$method = $this->input->post('method');
				$nominal = $this->input->post('nominal');
				                
                $paymentInfo = array('studentId'=>$name,'note'=>$note,'allocation'=>$allocation, 'method'=>$method, 'nominal'=> $nominal, 'createdBy'=>$this->vendorId, 'createdDate'=>date('m/d/Y'));
                
                $this->load->model('payment_model');
                $result = $this->payment_model->addNewPayment($paymentInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Payment created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Payment creation failed');
                }
                
                redirect('addNewPayment');
            }
        }
    }
    
    /**
     * This function is used load payment edit information
     * @param number $paymentId : Optional : This is payment id
     */
    function editOldPayment($paymentId = NULL)
    {
        if($this->isAll() == TRUE || $paymentId == 1)
        {
            $this->loadThis();
        }
        else
        {
            if($paymentId == null)
            {
                redirect('paymentListing');
            }
            $data['jadwal1'] = $this->payment_model->getPaymentSchedules();
            $data['sources'] = $this->payment_model->getPaymentSource();
			$data['branches'] = $this->payment_model->getPaymentBranch();
			$data['status_data'] = $this->payment_model->getPaymentStatus();
            $data['paymentInfo'] = $this->payment_model->getPaymentInfo($paymentId);
            
            $this->global['pageTitle'] = 'Edit Payment';
            
            $this->loadViews("editPayment", $this->global, $data, NULL);
        }
    }   
    
    /**
     * This function is used to edit the payment information
     */
    function editPayment()
    {
        if($this->isAll() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $paymentId = $this->input->post('paymentId');
            
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
                $this->editOldPayment($paymentId);
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
                
                $paymentInfo = array('parent_email'=>$email,'scheduleId'=>$schedule,'branchId'=>$branch,'address'=>$address, 'name'=> $name,'age'=> $age,'status'=> $status,'school'=> $school,'kelas'=> $class,'source'=> $source,'parent_name'=> $parent_name,'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
                
                
                $result = $this->payment_model->editPayment($paymentInfo, $paymentId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Payment updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Payment updation failed');
                }
                
                redirect('paymentListing');
            }
        }
    }

    /**
     * This function is used to delete the payment using paymentId
     * @return boolean $result : TRUE / FALSE
     */
    function deletePayment()
    {
        if($this->isAll() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $paymentId = $this->input->post('paymentId');
            $paymentInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:sa'));
            
            $result = $this->payment_model->deletePayment($paymentId, $paymentInfo);
            
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