<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
//require APPPATH . '/libraries/BaseController.php';
class Outstanding_model extends CI_Model
{
    /**
     * This function is used to get the student listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function outstandingListingCount($searchText = '', $branch_data1='')
    {
		$this->db->select('BaseTbl.studentId, Status.status,BaseTbl.parent_name,BaseTbl.parent_email, BaseTbl.name,BaseTbl.age,BaseTbl.kelas,BaseTbl.school, BaseTbl.mobile, Schedule.schedule, BaseTbl.address, Source.source, Branch.name_branch');
		$this->db->from('tbl_students as BaseTbl');
		$this->db->join('tbl_branchs as Branch', 'Branch.branchId = BaseTbl.branchId and Branch.isDeleted =0','left');
		$this->db->join('tbl_status as Status', 'Status.statusId = BaseTbl.status','left');
		$this->db->join('tbl_source as Source', 'Source.sourceId = BaseTbl.source','left');
		$this->db->join('tbl_schedules as Schedule', 'Schedule.scheduleId = BaseTbl.scheduleId and Schedule.isDeleted =0 ','left');
        $this->db->where('BaseTbl.isDeleted', 0);
		//$this->db->where('Schedule.isDeleted', 0);
		//$this->db->where('Branch.isDeleted', 0);
		if ($branch_data1!=1){
             $this->db->where('BaseTbl.branchId', $branch_data1);
         }
        $query = $this->db->get();
        
        return count($query->result());
    }
    
    /**
     * This function is used to get the student listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function outstandingListing($searchText = '', $branch_data1='', $page, $segment)
    {
		$this->db->select('BaseTbl.studentId, Status.status, BaseTbl.parent_name,BaseTbl.parent_email, BaseTbl.name,BaseTbl.age,BaseTbl.kelas,BaseTbl.school, BaseTbl.total_attedance, BaseTbl.total_paid, BaseTbl.mobile, Schedule.schedule,Schedule.day, BaseTbl.address, Source.source, Branch.name_branch');
		$this->db->from('tbl_students as BaseTbl');
		$this->db->join('tbl_branchs as Branch', 'Branch.branchId = BaseTbl.branchId and Branch.isDeleted =0','left');
		$this->db->join('tbl_status as Status', 'Status.statusId = BaseTbl.status','left');
		$this->db->join('tbl_source as Source', 'Source.sourceId = BaseTbl.source','left');
		$this->db->join('tbl_schedules as Schedule', 'Schedule.scheduleId = BaseTbl.scheduleId and Schedule.isDeleted =0 ','left');
        $this->db->where('BaseTbl.isDeleted', 0);
		//$this->db->where('BaseTbl.total_paid !=', 0);
		$this->db->where('BaseTbl.total_paid >=', 'BaseTbl.total_attedance');
		$this->db->where('BaseTbl.total_paid !=', 0);

		//$this->db->where('Schedule.isDeleted', 0);
		//$this->db->where('Branch.isDeleted', 0);
		if ($branch_data1!=1){
             $this->db->where('BaseTbl.branchId', $branch_data1);
         }
        $query = $this->db->get();
               
        $result = $query->result();        
        return $result;
    }
	
	function getStudentBranch()
    {
        $this->db->select('branchId, name_branch');
        $this->db->from('tbl_branchs');
		$this->db->where('isDeleted !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
    
	function getStudentStatus()
    {
        $this->db->select('statusId, status');
        $this->db->from('tbl_status');
        $query = $this->db->get();
        
        return $query->result();
    }
	
	function getStudentSource()
    {
        $this->db->select('sourceId, source');
        $this->db->from('tbl_source');
        $query = $this->db->get();
        
        return $query->result();
    }
	
	function getStudentSchedules()
    {
        $this->db->select('scheduleId, schedule, day');
        $this->db->from('tbl_schedules');
		$this->db->where('isDeleted !=', 1);
        $query = $this->db->get();
        
        return $query->result();
    }
	
    /**
     * This function is used to add new student to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewStudent($studentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_students', $studentInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
    function expenseStudent($studentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_point_expense', $studentInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	function statusReport($absentId)
     {
       $this->db->select('BaseTbl.createdBy, Students.name, BaseTbl.new_status, BaseTbl.createdDate');
       $this->db->from('tbl_status_log as BaseTbl');
       $this->db->join('tbl_students as Students', 'Students.studentId = BaseTbl.studentId');
	  // $this->db->join('tbl_status as Status', 'Students.status = BaseTbl.new_status','RIGHT');
       $this->db->order_by("createdDate", "DSC");
       $this->db->where('Students.studentId', $absentId);
	   
             //    $likeCriteria1 = "(BaseTbl.branch  LIKE '%".$branch_data2."%')";
             //    $this->db->where($likeCriteria1);

            /* if ($branch_data1!=1){
               $this->db->where('Students.branch', $branch_data1);
             }*/

         $query = $this->db->get();

         $result = $query->result();
         return $result;
     }
	 
	function expenseReport($absentId)
     {
       $this->db->select('BaseTbl.note, Students.name, BaseTbl.nominal, BaseTbl.createdDate');
       $this->db->from('tbl_point_expense as BaseTbl');
       $this->db->join('tbl_students as Students', 'Students.studentId = BaseTbl.studentId');
       $this->db->order_by("createdDate", "DSC");
       $this->db->where('Students.studentId', $absentId);
       $query = $this->db->get();

       $result = $query->result();
       return $result;
     } 
	 
	function absentReport($absentId)
     {
       $this->db->select('BaseTbl.id, BaseTbl.Student_name, BaseTbl.online, BaseTbl.unplugged,BaseTbl.group_project,BaseTbl.point,BaseTbl.milestone,BaseTbl.teacher_note ,schedule.schedule,schedule.day, BaseTbl.absent, BaseTbl.date');
       $this->db->from('tbl_progress as BaseTbl');
       $this->db->join('tbl_students as Students', 'Students.name = BaseTbl.Student_name','left');
       $this->db->join('tbl_schedules as schedule', 'schedule.scheduleId = Students.scheduleId','left');
       $this->db->order_by("date", "DSC");
       $this->db->where('BaseTbl.isDeleted', 0);
       $this->db->where('Students.studentId', $absentId);
	   
             //    $likeCriteria1 = "(BaseTbl.branch  LIKE '%".$branch_data2."%')";
             //    $this->db->where($likeCriteria1);

            /* if ($branch_data1!=1){
               $this->db->where('Students.branch', $branch_data1);
             }*/

         $query = $this->db->get();

         $result = $query->result();
         return $result;
     }
	 
    /**
     * This function used to get student information by id
     * @param number $studentId : This is student id
     * @return array $result : This is student information
     */
    function getStudentInfo($studentId)
    {
        $this->db->select('studentId, name, status, parent_email, parent_name, age, kelas, scheduleId,school, source, mobile, branchId, address');
        $this->db->from('tbl_students');
        $this->db->where('isDeleted', 0);
        $this->db->where('studentId', $studentId);
        $query = $this->db->get();
        
        return $query->result();
    }
      
    /**
     * This function is used to update the student information
     * @param array $studentInfo : This is students updated information
     * @param number $studentId : This is student id
     */
    function editStudent($studentInfo, $studentId)
    {
        $this->db->where('studentId', $studentId);
        $this->db->update('tbl_students', $studentInfo);
        
        return TRUE;
    }  
    
    /**
     * This function is used to delete the student information
     * @param number $studentId : This is student id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStudent($studentId, $studentInfo)
    {
        $this->db->where('studentId', $studentId);
        $this->db->update('tbl_students', $studentInfo);
        
        return $this->db->affected_rows();
    }

}

  