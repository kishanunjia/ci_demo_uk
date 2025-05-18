<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Factory_model (Factory Model)
 * Factory model class to get to handle factory related data 
 * @author : OpenXcode
 * @version : 1.1
 * @since : 15 November 2016
 */
class Factory_model extends CI_Model
{
    /**
     * This function is used to get the factory listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function factoryListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('factory_master as BaseTbl');
        // $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the factory listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function factoryListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.*, u.name as username');
        $this->db->from('factory_master as BaseTbl');
        $this->db->join('tbl_users as u', 'u.userId = BaseTbl.userId','left');
        $this->db->order_by('BaseTbl.fc_id', 'DESC');
        //$this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * This function is used to get the factory roles information
     * @return array $result : This is result of the query
     */
    function getFactoryUsers()
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    /**
     * This function is used to add new factory to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewFactory($factoryInfo)
    {
        $this->db->trans_start();
        $this->db->insert('factory_master', $factoryInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    /**
     * This function used to get factory information by id
     * @param number $fc_id : This is factory id
     * @return array $result : This is factory information
     */
    function getFactoryInfo($fc_id)
    {
        $this->db->select('*');
        $this->db->from('factory_master');
        //$this->db->where('isDeleted', 0);
        $this->db->where('fc_id', $fc_id);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    
    /**
     * This function is used to update the factory information
     * @param array $factoryInfo : This is factorys updated information
     * @param number $fc_id : This is factory id
     */
    function editFactory($factoryInfo, $fc_id)
    {
        $this->db->where('fc_id', $fc_id);
        $this->db->update('factory_master', $factoryInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the factory information
     * @param number $fc_id : This is factory id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteFactory($fc_id, $factoryInfo)
    {
        $this->db->where('fc_id', $fc_id);
        $this->db->delete('factory_master');
        
        return 1;
    }


    /**
     * This function is used to match factorys password for change password
     * @param number $fc_id : This is factory id
     */
    function matchOldPassword($fc_id, $oldPassword)
    {
        $this->db->select('fc_id, password');
        $this->db->where('fc_id', $fc_id);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('factory_master');
        
        $factory = $query->result();

        if(!empty($factory)){
            if(verifyHashedPassword($oldPassword, $factory[0]->password)){
                return $factory;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
    /**
     * This function is used to change factorys password
     * @param number $fc_id : This is factory id
     * @param array $factoryInfo : This is factory updation info
     */
    function changePassword($fc_id, $factoryInfo)
    {
        $this->db->where('fc_id', $fc_id);
        $this->db->where('isDeleted', 0);
        $this->db->update('factory_master', $factoryInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get factory login history
     * @param number $fc_id : This is factory id
     */
    function loginHistoryCount($fc_id, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.fc_id, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.factoryAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($fc_id >= 1){
            $this->db->where('BaseTbl.fc_id', $fc_id);
        }
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get factory login history
     * @param number $fc_id : This is factory id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($fc_id, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.fc_id, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.factoryAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.sessionData  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        if($fc_id >= 1){
            $this->db->where('BaseTbl.fc_id', $fc_id);
        }
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get factory information by id
     * @param number $fc_id : This is factory id
     * @return array $result : This is factory information
     */
    function getFactoryInfoById($fc_id)
    {
        $this->db->select('*');
        $this->db->from('factory_master');
        //$this->db->where('isDeleted', 0);
        $this->db->where('fc_id', $fc_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    /**
     * This function used to get factory information by id with role
     * @param number $fc_id : This is factory id
     * @return aray $result : This is factory information
     */
    function getFactoryInfoWithRole($fc_id)
    {
        $this->db->select('BaseTbl.fc_id, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, BaseTbl.isAdmin, BaseTbl.roleId, Roles.role');
        $this->db->from('factory_master as BaseTbl');
        $this->db->join('tbl_roles as Roles','Roles.roleId = BaseTbl.roleId');
        $this->db->where('BaseTbl.fc_id', $fc_id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }

}

  