<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Absent_model extends CI_Model
{
    /**
     * This function is used to get the branch listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */

     function absentListing($date = '',$branch_data1, $page, $segment)
     {
       $this->db->select('BaseTbl.id, BaseTbl.Student_name, BaseTbl.online, BaseTbl.unplugged,BaseTbl.group_project,BaseTbl.point,BaseTbl.milestone,BaseTbl.teacher_note ,schedule.schedule,schedule.day, BaseTbl.absent, BaseTbl.date');
       $this->db->from('tbl_progress as BaseTbl');
       $this->db->join('tbl_students as Students', 'Students.name = BaseTbl.Student_name','left');
       $this->db->join('tbl_schedules as schedule', 'schedule.scheduleId = Students.scheduleId','left');
	   $this->db->where('BaseTbl.date', $date);
       $this->db->order_by("date", "DSC");
	   
	   //$this->db->where('schedule.day', date("D"););
       $this->db->where('BaseTbl.isDeleted', 0);
		if ($branch_data1!=1){
             $this->db->where('Students.branchId', $branch_data1);
         }
             //    $likeCriteria1 = "(BaseTbl.branch  LIKE '%".$branch_data2."%')";
             //    $this->db->where($likeCriteria1);

            /* if ($branch_data1!=1){
               $this->db->where('Students.branch', $branch_data1);
             }*/

         $this->db->limit($page, $segment);
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
	 
    function absentListingCount($searchText = '', $branch_data1)
    {
      $this->db->select('BaseTbl.id, BaseTbl.Student_name, schedule.schedule,schedule.day, BaseTbl.absent, BaseTbl.date');
       $this->db->from('tbl_progress as BaseTbl');
       $this->db->join('tbl_students as Students', 'Students.name = BaseTbl.Student_name','left');
       $this->db->join('tbl_schedules as schedule', 'schedule.scheduleId = Students.scheduleId','left');
       $this->db->order_by("date", "DSC");
       $this->db->where('BaseTbl.isDeleted', 0);
		if ($branch_data1!=1){
             $this->db->where('Students.branchId', $branch_data1);
         }
        $query = $this->db->get();

        return count($query->result());
    }

    function getAbsentBranch()
    {
      $this->db->select('BaseTbl.absentId, BaseTbl.branch, BaseTbl.address, BaseTbl.absent, BaseTbl.mobile');
      $this->db->from('tbl_progress as BaseTbl');

        $this->db->select('branchId, branch');
        $this->db->from('tbl_branchs');
        $this->db->where('branch == BaseTbl.branch' );
        $this->db->where('isDeleted', 0 );
        $query = $this->db->get();

        return $query->result();
    }

    function getStudentBranch($branch_data1='')
    {
      $this->db->select('BaseTbl.studentId, BaseTbl.student');
      $this->db->from('tbl_students as BaseTbl');
      $this->db->join('tbl_branchs as branches', 'branches.branchId = BaseTbl.branch','left');
       /* if ($branch_data1!=1){
          $this->db->where('BaseTbl.branch', $branch_data1);
        }*/
      $this->db->where('BaseTbl.isDeleted', 0);

          //    $likeCriteria1 = "(BaseTbl.branch  LIKE '%".$branch_data2."%')";
          //    $this->db->where($likeCriteria1);

      $query = $this->db->get();
      $result = $query->result();
      return $result;
    }

    function getAbsentTeacher()
    {
      $this->db->select('BaseTbl.userId, BaseTbl.name');
      $this->db->from('tbl_users as BaseTbl');
      $this->db->where('BaseTbl.roleId', 3);
      $this->db->where('isDeleted', 0 );
      $query = $this->db->get();

      return $query->result();
    }

    function getAbsentClass()
    {
      $this->db->select('BaseTbl.scheduleId, BaseTbl.schedule');
      $this->db->from('tbl_schedules as BaseTbl');
      $this->db->where('isDeleted', 0 );
      $query = $this->db->get();

      return $query->result();
    }

    /**
     * This function is used to get the branch listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */

    function getAbsentBranches()
      {
          $this->db->select('branchId, name_branch');
          $this->db->from('tbl_branchs');
          $this->db->where('isDeleted !=', 1);
            $this->db->where('branchId !=', 1);
          $query = $this->db->get();

          return $query->result();
      }
      /*
     * This function is used to add new branch to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewAbsent($absentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_progress', $absentInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get branch information by id
     * @param number $branchId : This is branch id
     * @return array $result : This is branch information
     */
    function getAbsentInfo($absentId)
    {
        $this->db->select('id, absent, class, milestone, teacher_note,Student_name, online, unplugged, group_project, date, class,teacher, point, teacher, milestone');
        $this->db->from('tbl_progress');
        $this->db->where('isDeleted', 0);
        $this->db->where('id', $absentId);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function is used to update the branch information
     * @param array $branchInfo : This is branch updated information
     * @param number $branchId : This is branch id
     */
    function editAbsent($absentInfo, $absentId)
    {
        $this->db->where('id', $absentId);
        $this->db->update('tbl_progress', $absentInfo);
        return TRUE;
    }

    /**
     * This function is used to delete the branch information
     * @param number $branchId : This is branch id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteAbsent($absentId, $absentInfo)
    {
    $this->db->where('id', $absentId);
        $this->db->update('tbl_progress', $absentInfo);
        return $this->db->affected_rows();
    }

}
