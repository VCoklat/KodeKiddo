<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//require APPPATH . '/libraries/BaseController.php';
class Payment_model extends CI_Model
{
    /**
     * This function is used to get the payment listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function paymentListingCount($searchText = '', $branch_data1='')
    {
		$this->db->select('BaseTbl.paymentId, BaseTbl.note,BaseTbl.method, BaseTbl.nominal');
		$this->db->from('tbl_payment_history as BaseTbl');
		$this->db->join('tbl_students as Student', 'Student.studentId = BaseTbl.studentId and Student.isDeleted =0','left');
        $this->db->join('tbl_branchs as Branch', 'Student.branchId = Branch.branchId','left');
		$this->db->order_by("BaseTbl.paymentId", "desc");
		if ($branch_data1!=1){
             $this->db->where('Branch.branchId', $branch_data1);
         }
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the payment listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function paymentListing($searchText = '', $branch_data1='', $page, $segment)
    {
		$this->db->select('BaseTbl.paymentId,BaseTbl.studentId, BaseTbl.note,BaseTbl.method, BaseTbl.nominal');
		$this->db->from('tbl_payment_history as BaseTbl');
		$this->db->join('tbl_students as Student', 'Student.name = BaseTbl.studentId and Student.isDeleted =0','left');
        $this->db->join('tbl_branchs as Branch', 'Student.branchId = Branch.branchId','left');
		$this->db->order_by("BaseTbl.paymentId", "desc");
		
		if ($branch_data1!=1){
             $this->db->where('Branch.branchId', $branch_data1);
         }
        $query = $this->db->get();
               
        $result = $query->result();        
        return $result;
    }
	
	function getPaymentBranch()
    {
        $this->db->select('branchId, name_branch');
        $this->db->from('tbl_branchs');
		$this->db->where('isDeleted !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
  
	
    /**
     * This function is used to add new payment to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewPayment($paymentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_payment_history', $paymentInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get payment information by id
     * @param number $paymentId : This is payment id
     * @return array $result : This is payment information
     */
    function getPaymentInfo($paymentId)
    {
        $this->db->select('paymentId, name, status, parent_email, parent_name, age, kelas, scheduleId,school, source, mobile, branchId, address');
        $this->db->from('tbl_payments');
        $this->db->where('isDeleted', 0);
        $this->db->where('paymentId', $paymentId);
        $query = $this->db->get();
        
        return $query->result();
    }
      
    /**
     * This function is used to update the payment information
     * @param array $paymentInfo : This is payments updated information
     * @param number $paymentId : This is payment id
     */
    function editPayment($paymentInfo, $paymentId)
    {
        $this->db->where('paymentId', $paymentId);
        $this->db->update('tbl_payments', $paymentInfo);
        
        return TRUE;
    }  
    
    /**
     * This function is used to delete the payment information
     * @param number $paymentId : This is payment id
     * @return boolean $result : TRUE / FALSE
     */
    function deletePayment($paymentId, $paymentInfo)
    {
        $this->db->where('paymentId', $paymentId);
        $this->db->update('tbl_payments', $paymentInfo);
        
        return $this->db->affected_rows();
    }

}

  