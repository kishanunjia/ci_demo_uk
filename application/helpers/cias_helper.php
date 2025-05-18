<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/*Upload Data*/

if(!function_exists('add_file_in_master_table')){
    function add_file_in_master_table($filepath='',$id=0,$fa_type='',$userId=0,$field='fa_id'){
        $row = select_where_multi('fileadd_master',array(array('fa_type ',$fa_type),array('m_id',$id)));
        $fa_id =0;
        $ci = get_instance();
        if(empty($row)){
            $h_data = array(
                'fa_type'   => $fa_type,
                'm_id'      => $id,
                'dest_id'   => 0,
                'fileadd'   => $filepath,
                'userId'    => $userId,
            );
            $ci->db->insert('fileadd_master',$h_data);
            $fa_id = $ci->db->insert_id();
        }else{

            $fa_id = $row->$field;
            $fileadd = $row->fileadd;
            if(file_exists(FCPATH."/".$fileadd)){
                unlink(FCPATH."/".$fileadd);
            }
            $ci->db->where($field,$fa_id);
            $ci->db->update('fileadd_master', array('fileadd' => $filepath));

        }
        return $fa_id;
    }
}

if(!function_exists('update_row_file_in_master_table')){
    function update_row_file_in_master_table($m_id){
        $ci = get_instance();
        $ci->db->where('fa_id',$fa_id);
        $ci->db->update('fileadd_master', array('m_id' => $m_id));
    }
}

if(!function_exists('select_where_multi')){
    function select_where_multi($table,$field_val,$order_by='',$order=''){
        $ci = get_instance();
        $ci->db->select();
        $ci->db->from($table);
        if(!empty($field_val)){
          foreach($field_val as $fval){
            $ci->db->where($fval[0],$fval[1]);
          }
        }
        if(!empty($order_by) && !empty($order)){
          $ci->db->order_by($order_by,$order);  
        }
        $query = $ci->db->get();
        $query = $query->row();  
        return $query;
    }
}


/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
        
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

?>