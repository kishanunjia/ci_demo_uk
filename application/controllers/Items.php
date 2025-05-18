<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Factory (FactoryController)
 * Factory Class to control all factory related operations.
 * @author : OpenXcode
 * @version : 1.1
 * @since : 15 November 2016
 */
class Items extends BaseController{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('items_model');
        $this->isLoggedIn();

        //Upload 
        $this->load->library('upload');
        $this->load->library('image_lib');
        $this->load->helper('file');
        $this->max_size = '2048';
        //Permission
        $this->module = 'Items';
        
    }
    
    /**
     * This function is used to load the factory list
     */
    function index()
    {
        if(!$this->hasListAccess()){
            $this->loadThis();
        }else{        
            $searchText = '';
            $data['records'] = $this->items_model->itemListing($searchText, 0, 0); 

            //Users
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('isDeleted', 0);
            $query = $this->db->get();
            $data['userlist'] = $query->result();

            //Factory
            $this->db->select('*');
            $this->db->from('factory_master');
            $query = $this->db->get();
            $data['factorylist'] = $query->result();

            $data['edit_per']   = $this->hasUpdateAccess();
            $data['delete_per'] = $this->hasDeleteAccess();
            
            $this->global['pageTitle'] = 'item Listing';            
            $this->loadViews("item/item", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if(!$this->hasCreateAccess())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('items_model');
            $data['roles'] = $this->items_model->getDestinationRoles();
            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where('isDeleted', 0);
            $query = $this->db->get();
            $data['userlist'] = $query->result();

            //Factory
            $this->db->select('*');
            $this->db->from('factory_master');
            $query = $this->db->get();
            $data['factorylist'] = $query->result();

            $this->global['pageTitle'] = 'Add New item';
            $this->loadViews("item/addNew", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new factory to the system
     */
    function addNewItem(){
        if(!$this->hasCreateAccess()){
            $this->loadThis();
        }else{
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('item_code','Item Code','trim|required|max_length[255]');
            if($this->form_validation->run() == FALSE){
                $this->addNew();
            }else{
                $item_code  = $this->input->post('item_code');
                $fc_id      = $this->input->post('fc_id');
                $item_desc1 = $this->input->post('item_desc1');
                $item_desc2 = $this->input->post('item_desc2');
                $item_desc3 = $this->input->post('item_desc3');

                $OPStk1     = $this->input->post('OPStk1');
                $OPStk2     = $this->input->post('OPStk2');
                $OPStk3     = $this->input->post('OPStk3');
                $OPStk4     = $this->input->post('OPStk4');


                $userId = $this->input->post('userId');
                $isAdmin = $this->input->post('isAdmin');
                $itemInfo = array('item_code'=>$item_code,'fc_id'=>$fc_id, 'item_desc1'=>$item_desc1, 'item_desc2'=>$item_desc2,
                        'item_desc3'=> $item_desc3,'OPStk1'=>$OPStk1,'OPStk2'=>$OPStk2,'OPStk3'=>$OPStk3,'OPStk4'=>$OPStk4);
                $this->load->model('items_model');
                $result = $this->items_model->addNewItem($itemInfo);
                if($result > 0){

                    
                    $logs       = array();
                    $ip_address = $this->input->ip_address();
                    $logs[] = array('date' => date('Y-m-d H:i:s'),'ip' => $ip_address, 'userId' => $this->session->userdata('userId'));
                    $destInfo['item_log'] = json_encode($logs);

                    $result = $this->items_model->editItem($destInfo, $result);                    

                    $this->session->set_flashdata('success', 'New item created successfully');
                } else {
                    $this->session->set_flashdata('error', 'item creation failed');
                }
                
                redirect('items');
            }
        }
    }

    
    /**
     * This function is used load factory edit information
     * @param number $dest_id : Optional : This is factory id
     */
    function editOld($id = NULL)
    {
        if(!$this->hasUpdateAccess())
        {
            $this->loadThis();
        }
        else
        {
            
            if($id == null){
                redirect('items');
            }
            $data['roles'] = $this->items_model->getItemRoles();

            //Factory
            $this->db->select('*');
            $this->db->from('factory_master');
            $query = $this->db->get();
            $data['factorylist'] = $query->result();

            $data['dataInfo'] = $this->items_model->getItemsInfo($id);
            $this->global['pageTitle'] = 'Edit item';
            $this->loadViews("item/addNew", $this->global, $data, NULL);

        }
    }

    function log($id = NULL){
        if(!$this->hasListAccess()){
            $this->loadThis();
        }else{ 
            $id = ($id == NULL ? 0 : $id);
            $data["itemsInfo"] = $this->items_model->getItemsInfo($id);
            $this->global['pageTitle'] = 'item Log History';
            $this->loadViews("item/loginHistory", $this->global, $data, NULL);
        }

    }

    
    
    /**
     * This function is used to edit the factory information
     */
    function editItem(){
        if(!$this->hasUpdateAccess()){
            $this->loadThis();
        }else{
            $this->load->library('form_validation');
            
            $item_id = $this->input->post('item_id');
            $this->form_validation->set_rules('item_code','Item Code','trim|required|max_length[255]');
            if($this->form_validation->run() == FALSE){
                $this->editOld($item_id);
            }else{

                $sInfo = $this->items_model->getItemsInfo($item_id);
                $fa_id = $sInfo->fa_id;
                //Image Upload Code Start Here
                $config = array(
                    'upload_path'   => "./uploads/items/",
                    'allowed_types' => "jpg|png|jpeg",
                    'overwrite'     => TRUE,
                    'encrypt_name'  => TRUE,
                );  
                $config['max_size'] = $this->max_size;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);                     
                $image ="";
                $fa_id = 0;                
                if($this->upload->do_upload('item_image')){

                    $image = array('upload_data' => $this->upload->data());
                    $image = 'uploads/items/'.$image['upload_data']['file_name'];
                    
                    $fa_id = add_file_in_master_table($image,$item_id,'item_master',$this->session->userdata('userId'),'fa_id');

                }else{

                    $fsize = $this->upload->data('file_size');
                    if($fsize > $config['max_size']){
                        $this->session->set_flashdata('error', 'Maximum file size is 2MB.');                                  
                    }else{
                      $error = $this->upload->display_errors(); 
                      $this->session->set_flashdata('error',$error);  
                    }

                }



                //Image Upload Code Over Here
                $item_code  = $this->input->post('item_code');
                $fc_id      = $this->input->post('fc_id');
                $item_desc1 = $this->input->post('item_desc1');
                $item_desc2 = $this->input->post('item_desc2');
                $item_desc3 = $this->input->post('item_desc3');

                $OPStk1     = $this->input->post('OPStk1');
                $OPStk2     = $this->input->post('OPStk2');
                $OPStk3     = $this->input->post('OPStk3');
                $OPStk4     = $this->input->post('OPStk4');


                $userId = $this->input->post('userId');
                $isAdmin = $this->input->post('isAdmin');
                $itemInfo = array('item_code'=>$item_code,'fc_id'=>$fc_id,'fa_id'=>$fa_id, 'item_desc1'=>$item_desc1, 'item_desc2'=>$item_desc2,
                        'item_desc3'=> $item_desc3,'OPStk1'=>$OPStk1,'OPStk2'=>$OPStk2,'OPStk3'=>$OPStk3,'OPStk4'=>$OPStk4);

                $this->load->model('items_model');


                
                $logs = ($sInfo->item_log)?json_decode($sInfo->item_log):array();
                $ip_address = $this->input->ip_address();
                $logs[] = array('date' => date('Y-m-d H:i:s'),'ip' => $ip_address, 'userId' => $this->session->userdata('userId'));
                $itemInfo['item_log'] = json_encode($logs);

                $result = $this->items_model->editItem($itemInfo, $item_id);
                if($result == true){
                    $this->session->set_flashdata('success', 'Item updated successfully');
                }else{
                    $this->session->set_flashdata('error', 'Item updation failed');
                }
                redirect('items');

            }
        }
    }


    /**
     * This function is used to delete the factory using dest_id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteItem()
    {
        if(!$this->hasDeleteAccess())
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $item_id = $this->input->post('item_id');
            //$factoryInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->items_model->deleteItem($item_id);
            
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
     * @param number $dest_id : This is factory id
     */
    function loginHistoy($dest_id = NULL)
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $dest_id = ($dest_id == NULL ? 0 : $dest_id);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["factoryInfo"] = $this->items_model->getFactoryInfoById($dest_id);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->items_model->loginHistoryCount($dest_id, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$dest_id."/", $count, 10, 3);

            $data['records'] = $this->items_model->loginHistory($dest_id, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Factory Login History';
            
            $this->loadViews("factorys/loginHistory", $this->global, $data, NULL);
        }        
    }

    function update(){
        if(!$this->hasUpdateAccess()){
            $this->loadThis();
        }else{
            $id = $this->input->post('id');
            $field = $this->security->xss_clean($this->input->post('field'));
            $value = $this->security->xss_clean($this->input->post('val'));

            $getItemsInfo = $this->items_model->getItemsInfo($id);
            $logs   = ($getItemsInfo->item_log)?json_decode($getItemsInfo->item_log):array();
            $logs[] = array('date' => date('Y-m-d H:i:s'), 'userId' => $this->session->userdata('userId'));

            $this->db->where('item_id', $id);
            $this->db->update('item_master', array($field=>$value, 'item_log'=>json_encode($logs) ));
        }
    }
}

?>