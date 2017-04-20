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
        $this->db->select('BaseTbl.branchId, BaseTbl.address, BaseTbl.branch, BaseTbl.mobile, BaseTbl.information');
        $this->db->from('branches as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                            OR  BaseTbl.branch  LIKE '%".$searchText."%'
                            OR  BaseTbl.information  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
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
      $this->db->select('BaseTbl.branchId, BaseTbl.address, BaseTbl.branch, BaseTbl.mobile, BaseTbl.information');
      $this->db->from('branches as BaseTbl');
      if(!empty($searchText)) {
          $likeCriteria = "(BaseTbl.address  LIKE '%".$searchText."%'
                          OR  BaseTbl.branch  LIKE '%".$searchText."%'
                          OR  BaseTbl.information  LIKE '%".$searchText."%')";
          $this->db->where($likeCriteria);
      }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the branch roles information
     * @return array $result : This is result of the query
     */
  /*  function getBranchRoles()
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
    function addNewBranch($branchInfo)
    {
        $this->db->trans_start();
        $this->db->insert('branches', $branchInfo);

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
        $this->db->select('branchId, branch, address, mobile, Information');
        $this->db->from('branches');
        $this->db->where('isDeleted', 0);
        $this->db->where('branchId', $branchId);
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to update the branch information
     * @param array $branchInfo : This is branch updated information
     * @param number $branchId : This is branch id
     */
    function editBranch($branchInfo, $branchId)
    {
        $this->db->where('branchId', $branchId);
        $this->db->update('branches', $branchInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the branch information
     * @param number $branchId : This is branch id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteBranch($branchId, $branchInfo)
    {
    $this->db->where('branchId', $branchId);
        $this->db->update('branches', $branchInfo);
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
