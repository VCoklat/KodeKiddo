<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    /**
     * This function is used to get the schedule listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function scheduleListingCount($searchText = '',$branch_data1='')
    {
        $this->db->select('BaseTbl.scheduleId, BaseTbl.schedule, Branch.name_branch');
        $this->db->from('tbl_schedules as BaseTbl');
		$this->db->join('tbl_branchs as Branch', 'Branch.branchId = BaseTbl.branchId and Branch.isDeleted =0','left');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('Branch.isDeleted', 0);
		$this->db->order_by("BaseTbl.scheduleId", "desc");
		if ($branch_data1!=1){
             $this->db->where('BaseTbl.branchId', $branch_data1);
         }
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the schedule listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function scheduleListing($searchText = '', $branch_data1, $page, $segment)
    {
		$this->db->select('BaseTbl.scheduleId, BaseTbl.schedule, BaseTbl.day, Branch.name_branch');
        $this->db->from('tbl_schedules as BaseTbl');
		$this->db->join('tbl_branchs as Branch', 'Branch.branchId = BaseTbl.branchId and Branch.isDeleted =0','left');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('Branch.isDeleted', 0);
		$this->db->order_by("BaseTbl.scheduleId", "desc");
		if ($branch_data1!=1){
             $this->db->where('BaseTbl.branchId', $branch_data1);
         }
        $query = $this->db->get();
               
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the schedule roles information
     * @return array $result : This is result of the query
     */
	
	function getScheduleBranch()
    {
        $this->db->select('branchId, name_branch');
        $this->db->from('tbl_branchs');
		$this->db->where('isDeleted !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * This function is used to add new schedule to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewSchedule($scheduleInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_schedules', $scheduleInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get schedule information by id
     * @param number $scheduleId : This is schedule id
     * @return array $result : This is schedule information
     */
    function getScheduleInfo($scheduleId)
    {
        $this->db->select('scheduleId, day, schedule,branchId');
        $this->db->from('tbl_schedules');
        $this->db->where('isDeleted', 0);
        $this->db->where('scheduleId', $scheduleId);
        $query = $this->db->get();
        
        return $query->result();
    }
      
    /**
     * This function is used to update the schedule information
     * @param array $scheduleInfo : This is schedules updated information
     * @param number $scheduleId : This is schedule id
     */
    function editSchedule($scheduleInfo, $scheduleId)
    {
        $this->db->where('scheduleId', $scheduleId);
        $this->db->update('tbl_schedules', $scheduleInfo);
        
        return TRUE;
    }

    
    /**
     * This function is used to delete the schedule information
     * @param number $scheduleId : This is schedule id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteSchedule($scheduleId, $scheduleInfo)
    {
        $this->db->where('scheduleId', $scheduleId);
        $this->db->update('tbl_schedules', $scheduleInfo);
        
        return $this->db->affected_rows();
    }

}

  