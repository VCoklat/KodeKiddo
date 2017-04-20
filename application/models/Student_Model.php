<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Student_model extends CI_Model
{
    /**
     * This function is used to get the branch listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function studentListingCount($searchText = '')
    {
      //$getbranch= getStudentBranch();
        $this->db->select('BaseTbl.studentId, BaseTbl.branch, BaseTbl.address, BaseTbl.student, BaseTbl.mobile, BaseTbl.information');
        $this->db->from('student as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.student  LIKE '%".$searchText."%'
                            OR  BaseTbl.information  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.branch', ".$getbranch.");
        $query = $this->db->get();

        return count($query->result());
    }

    function getStudentBranch()
    {
      $this->db->select('BaseTbl.studentId, BaseTbl.branch, BaseTbl.address, BaseTbl.student, BaseTbl.mobile, BaseTbl.information');
      $this->db->from('student as BaseTbl');

        $this->db->select('branchId, branch');
        $this->db->from('branches');
        $this->db->where('branch == BaseTbl.branch' );
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
    function studentListing($searchText = '', $page, $segment)
    {
      $this->db->select('BaseTbl.studentId, BaseTbl.address, BaseTbl.student, BaseTbl.mobile, BaseTbl.information');
      $this->db->from('student as BaseTbl');
      if(!empty($searchText)) {
          $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                          OR  BaseTbl.student  LIKE '%".$searchText."%'
                          OR  BaseTbl.information  LIKE '%".$searchText."%')";
          $this->db->where($likeCriteria);
      }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.branch', "KodeKiddo Gading Serpong");
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the branch roles information
     * @return array $result : This is result of the query
     */
  /*  function getStudentRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    /*function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to add new branch to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewStudent($studentInfo)
    {
        $this->db->trans_start();
        $this->db->insert('student', $studentInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get branch information by id
     * @param number $branchId : This is branch id
     * @return array $result : This is branch information
     */
    function getStudentInfo($studentId)
    {
        $this->db->select('studentId, student, address, mobile, Information');
        $this->db->from('student');
        $this->db->where('isDeleted', 0);
        $this->db->where('studentId', $studentId);
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to update the branch information
     * @param array $branchInfo : This is branch updated information
     * @param number $branchId : This is branch id
     */
    function editStudent($studentInfo, $studentId)
    {
        $this->db->where('studentId', $studentId);
        $this->db->update('student', $studentInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the branch information
     * @param number $branchId : This is branch id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteStudent($studentId, $studentInfo)
    {
    $this->db->where('studentId', $studentId);
        $this->db->update('student', $studentInfo);
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match branches password for change password
     * @param number $userId : This is user id
     */
  /*function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    /*function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }*/
}
