<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Factory (FactoryController)
 * Factory Class to control all factory related operations.
 * @author : OpenXcode
 * @version : 1.1
 * @since : 15 November 2016
 */
class Factory extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('factory_model');
        $this->isLoggedIn();
    }
    
    /**
     * This function is used to load the factory list
     */
    function index()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = '';
            $data['users'] = $this->factory_model->getFactoryUsers();
            $data['factoryRecords'] = $this->factory_model->factoryListing($searchText, 0, 0);            
            $this->global['pageTitle'] = 'Factory Listing';            
            $this->loadViews("factory/factory", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('factory_model');
            $data['users'] = $this->factory_model->getFactoryUsers();
            
            $this->global['pageTitle'] = 'Add New Factory';
            $data['factoryInfo'] = '';
            $this->loadViews("factory/addOrEdit", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new factory to the system
     */
    function addEditFactory()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fc_code','Code','trim|required');
            $this->form_validation->set_rules('fc_name','Name','trim|required');
            $this->form_validation->set_rules('fc_address','Address','required');
            $this->form_validation->set_rules('fc_landmark','Landmark','trim|required');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $factoryId = $this->input->post('factoryId');
                $fc_code = $this->security->xss_clean($this->input->post('fc_code'));
                $fc_name = ($this->security->xss_clean($this->input->post('fc_name')));
                $fc_address = ($this->security->xss_clean($this->input->post('fc_address')));
                $fc_landmark = ($this->security->xss_clean($this->input->post('fc_landmark')));
                $fc_contact1 = ($this->security->xss_clean($this->input->post('fc_contact1')));
                $fc_contact2 = ($this->security->xss_clean($this->input->post('fc_contact2')));
                $fc_contact3 = ($this->security->xss_clean($this->input->post('fc_contact3')));
                $fc_email1 = ($this->security->xss_clean($this->input->post('fc_email1')));
                $fc_email2 = ($this->security->xss_clean($this->input->post('fc_email2')));
                
                $factoryInfoData = array('fc_code'=>$fc_code, 'fc_name'=>$fc_name, 'fc_address'=>$fc_address, 'fc_landmark'=>$fc_landmark, 'fc_contact1'=>$fc_contact1, 'fc_contact2'=>$fc_contact2, 'fc_contact3'=>$fc_contact3, 'fc_email1'=>$fc_email1, 'fc_email2'=>$fc_email2 );
                
                $this->load->model('factory_model');
                if($factoryId){
                    $factoryInfo = $this->factory_model->getFactoryInfo($factoryId);
                    $logs = ($factoryInfo->fc_log)?json_decode($factoryInfo->fc_log):array();
                    $logs[] = array('date' => date('Y-m-d H:i:s'), 'userId' => $this->session->userdata('userId'));
                    $factoryInfoData['fc_log'] = json_encode($logs);
                    $result = $this->factory_model->editFactory($factoryInfoData, $factoryId);
                    if($result == true) {
                        $this->session->set_flashdata('success', 'Factory updated successfully');
                    }else{
                        $this->session->set_flashdata('error', 'Factory updation failed');
                    }
                    
                    redirect('factory');    
                }else{
                    //$logs = array(array('date' => date('Y-m-d H:i:s'), 'userId' => $this->session->userdata('userId')));
                    //$factoryInfo['fc_log'] = $logs;
                    $factoryInfoData['userId'] = $this->session->userdata('userId');
                    $result = $this->factory_model->addNewFactory($factoryInfoData);
                    if($result > 0){
                        $this->session->set_flashdata('success', 'New Factory created successfully');
                    } else {
                        $this->session->set_flashdata('error', 'Factory creation failed');
                    }
                    redirect('factory');
                }
            }
        }
    }

    
    /**
     * This function is used load factory edit information
     * @param number $fc_id : Optional : This is factory id
     */
    function editOld($fc_id = NULL)
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            if($fc_id == null)
            {
                redirect('factoryListing');
            }
            
            $data['users'] = $this->factory_model->getFactoryUsers();
            $data['factoryInfo'] = $this->factory_model->getFactoryInfo($fc_id);

            $this->global['pageTitle'] = 'Edit Factory';
            
            $this->loadViews("factory/addOrEdit", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to delete the factory using fc_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteFactory()
    {
        if(!$this->isAdmin())
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $fc_id = $this->input->post('fc_id');
            $factoryInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->factory_model->deleteFactory($fc_id, $factoryInfo);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = '404 - Page Not Found';
        
        $this->loadViews("general/404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $fc_id : This is factory id
     */
    function log($fc_id = NULL)
    {
        $fc_id = ($fc_id == NULL ? 0 : $fc_id);
        $data["factoryInfo"] = $this->factory_model->getFactoryInfoById($fc_id);

        $this->global['pageTitle'] = 'Factory Log History';
        $this->loadViews("factory/loginHistory", $this->global, $data, NULL);    
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is factory email
     */
    function emailExists($email)
    {
        $fc_id = $this->vendorId;
        $return = false;

        if(empty($fc_id)){
            $result = $this->factory_model->checkEmailExists($email);
        } else {
            $result = $this->factory_model->checkEmailExists($email, $fc_id);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }

    function update(){
        $id = $this->input->post('id');
        $field = $this->security->xss_clean($this->input->post('field'));
        $value = $this->security->xss_clean($this->input->post('val'));

        $factoryInfo = $this->factory_model->getFactoryInfo($id);
        $logs = ($factoryInfo->fc_log)?json_decode($factoryInfo->fc_log):array();
        $logs[] = array('date' => date('Y-m-d H:i:s'), 'userId' => $this->session->userdata('userId'));

        $this->db->where('fc_id', $id);
        $this->db->update('factory_master', array($field => $value, 'fc_log' => json_encode($logs)));
    }
}

?>