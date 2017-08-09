<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Branch_model extends CI_Model
{
    /**
     * This function is used to get the branch listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function branchListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.branchId, BaseTbl.name_branch, BaseTbl.address, BaseTbl.phone, BaseTbl.info');
        $this->db->from('tbl_branchs as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->order_by("BaseTbl.branchId", "desc");
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the branch listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function branchListing($searchText = '', $page, $segment)
    {
       $this->db->select('BaseTbl.branchId, BaseTbl.name_branch, BaseTbl.address, BaseTbl.phone, BaseTbl.info');
       $this->db->from('tbl_branchs as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->order_by("BaseTbl.branchId", "desc");
        $query = $this->db->get();
               
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to add new branch to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewBranch($branchInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_branchs', $branchInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get branch information by id
     * @param number $branchId : This is branch id
     * @return array $result : This is branch information
     */
    function getBranchInfo($branchId)
    {
        $this->db->select('branchId, name_branch, phone, info, address');
        $this->db->from('tbl_branchs');
        $this->db->where('isDeleted', 0);
        $this->db->where('branchId', $branchId);
        $query = $this->db->get();
        
        return $query->result();
    }
      
    /**
     * This function is used to update the branch information
     * @param array $branchInfo : This is branchs updated information
     * @param number $branchId : This is branch id
     */
    function editOldBranch($branchInfo, $branchId)
    {
        $this->db->where('branchId', $branchId);
        $this->db->update('tbl_branchs', $branchInfo);
        
        return TRUE;
    }
    
    /**
     * This function is used to delete the branch information
     * @param number $branchId : This is branch id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBranch($branchId, $branchInfo, $personInfo, $scheduleInfo)
    {
        $this->db->where('branchId', $branchId);
        $this->db->update('tbl_branchs', $branchInfo);
         $this->db->where('branchId', $branchId);
        $this->db->update('tbl_users', $personInfo);
		 $this->db->where('branchId', $branchId);
        $this->db->update('tbl_students', $personInfo);
		$this->db->where('branchId', $branchId);
        $this->db->update('tbl_schedules', $scheduleInfo);
        return $this->db->affected_rows();
    }

    function listCurrentBranches()
    {
        $query = $this->db->query("SELECT branchId FROM tbl_branchs where isDeleted=0");
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }
}

  