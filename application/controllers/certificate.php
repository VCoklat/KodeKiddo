<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Certificate extends BaseController
{
  public function __construct()
    {
        parent::__construct();
        $this->load->model('certificate_model');
        $this->isLoggedIn();
    }

  function index()
  {
    $this->global['pageTitle'] = 'Dashboard';
    $this->loadViews("dashboard", $this->global, NULL , NULL);
  }
  
  function showCertificate()
  {
	if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
        
        $name = $this->input->post('name');
        $milestone = $this->input->post('milestone');
		for ($i=0;$i<count($name);$i++)
		{
			$data['user'] = $this->certificate_model->certificateuser($name[$i]);
			$data['milestone'] = $this->certificate_model->milestone($milestone);
			$this->loadViews("show_certificate", $this->global, $data, NULL);
		}
	  }
  }
	function show()
  {
	$this->loadViews("show_certificate");
  }
  
	function certificateListing()
    {
      if($this->isAll() == TRUE)
      {
            $this->loadThis();
      }
      else {
        $this->load->model('certificate_model');

		$vendor=$this->vendorId;
			$con = mysqli_connect('localhost', 'root', '');
			mysqli_select_db($con,"cias");
			$no = 1;
				
			$query = mysqli_query($con, "SELECT branchId FROM tbl_users WHERE userId= '$vendor' ;")or die("Error: ".mysqli_error($con));
			while($hasil=mysqli_fetch_array($query)){
				$branch = $hasil['branchId'];
			}		
		
        $data['certificateRecords'] = $this->certificate_model->certificateListing($branch);

        $this->global['pageTitle'] = 'Certificate';

        $this->loadViews("generate_certificate", $this->global, $data, NULL);
      }
    }
}
?>