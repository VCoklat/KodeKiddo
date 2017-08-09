<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Certificate_model extends CI_Model
{
	function certificateListing($branch_data1)
     {
       $this->db->select('BaseTbl.name, BaseTbl.studentId');
       $this->db->from('tbl_students as BaseTbl');
	   $this->db->where('BaseTbl.isDeleted', 0);
	   //$this->db->where('schedule.day', date("D"););

		if ($branch_data1!=1){
             $this->db->where('BaseTbl.branchId', $branch_data1);
         }

         $query = $this->db->get();

         $result = $query->result();
         return $result;
     }
	 
	function milestone($id)
     {
       $this->db->select('BaseTbl.description, BaseTbl.milestoneId');
       $this->db->from('tbl_milestone as BaseTbl');
	   $this->db->where('BaseTbl.isDeleted', 0);
	   $this->db->where('BaseTbl.milestoneId', $id);

         $query = $this->db->get();

         $result = $query->result();
         return $result;
     }

	function certificateuser($studentID)
     {
       $this->db->select('BaseTbl.name, BaseTbl.studentId');
       $this->db->from('tbl_students as BaseTbl');
	   $this->db->where('BaseTbl.isDeleted', 0);
	   $this->db->where('BaseTbl.studentID', $studentID);     

         $query = $this->db->get();

         $result = $query->result();
         return $result;
     }
}
?>