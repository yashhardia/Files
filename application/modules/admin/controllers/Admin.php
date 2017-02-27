 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller
{
   /*
	| -----------------------------------------------------
	| PRODUCT NAME: 	RESTAURENT APP
	| -----------------------------------------------------
	| AUTHOR:			CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| -----------------------------------------------------
	| EMAIL:			samson@conquerorstech.net
	| -----------------------------------------------------
	| COPYRIGHTS:		CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| ----------------------------------------------------------
	| WEBSITE:			http://conquerorstech.net
	|                   http://conquerorstech.co.za
	| -----------------------------------------------------
	|
	| MODULE: 			ADMIN
	| -----------------------------------------------------
	| This is Admin module controller file.
	| -----------------------------------------------------
	*/
    function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'ion_auth',
            'form_validation'
        ));
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('base_model');
        $this->load->model('crunchy_model');
		$this->load->helper('inflector');
		$this->load->helper('security');
        $this->load->library('upload');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
        $this->lang->load('auth');
        $this->load->helper('language');
		check_access(ADMIN);
    }
    public function index()
    {
        $query  = "SELECT customer_name,order_id,date_created AS posted_date FROM " . DBPREFIX.TBL_ORDERS . " WHERE status='new' ORDER BY order_id DESC LIMIT 4 ";
        $orders = $this->db->query($query)->result();
        if (count($orders) > 0)
            $this->data['orders'] = $orders;
        else
            $this->data['orders'] = array();
		
        $query  = "SELECT offer_name,offer_id,date_of_offer_created AS posted_date FROM " . DBPREFIX.TBL_OFFERS . " WHERE status='Active' ORDER BY offer_id DESC LIMIT 4 ";
        $offers = $this->db->query($query)->result();
        if (count($offers) > 0)
            $this->data['offers'] = $offers;
        else
            $this->data['offers'] = array();
		
        $this->data['active_class'] = ACTIVE_DASHBOARD;
        $this->data['title']        = (isset($this->phrases['dashboard'])) ? $this->phrases['dashboard'] : "";
        $this->data['content']      = 'dashboard';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** Function for Registered Users ***/
    function users()
    {
       
        $users = $this->base_model->fetch_records_from(TBL_USERS, array(
            'id !=' => '1'),'','id','desc');
        if (!empty($users))
            $this->data['users'] = $users;
        else
            $this->data['users'] = array();
		
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['active_class'] = ACTIVE_USERS;
        $this->data['title']        = (isset($this->phrases['users'])) ? $this->phrases['users'] : "Users";
        $this->data['content']      = PAGE_USERS;
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
	
    /*** Function for View Users ***/
    function user_details($user_id)
    {
        $usersDetails = $this->base_model->fetch_records_from(TBL_USERS, array('id' => $user_id));
        if (count($usersDetails) > 0)
            $this->data['usersDetails'] = $usersDetails[0];
        else{
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
            $this->prepare_flashmessage($msg, 2);
            redirect(URL_ADMIN_USERS);
		}
            
        $this->data['active_class'] = ACTIVE_USERS;
        $this->data['title']        = (isset($this->phrases['users'])) ? $this->phrases['users'] : "Users";
        $this->data['content']      = PAGE_USER_DETAILS;
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** Function for End of View Users ***/
    	
	/*** Change Profile ****/
	 function profile()
	{
		
		if($this->input->post()){
			$this->check_isdemo(URL_PROFILE);
			$this->form_validation->set_rules('first_name', $this->phrases['first name'], 'required');	
			$this->form_validation->set_rules('last_name', $this->phrases['last name'], 'required');	
			$this->form_validation->set_rules('phone', $this->phrases['phone'], 'required|numeric');
			
			if($this->form_validation->run()==true)
			{
				$update_data['first_name'] 	= $this->input->post('first_name'); 
				$update_data['last_name'] 	= $this->input->post('last_name'); 
				$update_data['username']   = $this->input->post('first_name').' '.$this->input->post('last_name');
				$update_data['phone'] 		= $this->input->post('phone'); 
				$where['id']                = $this->ion_auth->get_user_id();
				if($this->base_model->update_operation($update_data,TBL_USERS,$where)){
					 $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_PROFILE, REFRESH);
				}else{
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_PROFILE, REFRESH);
				}
			}else{
				$this->prepare_flashmessage(validation_errors(),1);
			}				
		}
		$user_id = $this->ion_auth->get_user_id();
		 $user	=	$this->base_model->fetch_records_from(TBL_USERS,array('id'=>$user_id));
		 if(count($user)>0){
			 $this->data['user'] = $user[0];
		 }
		  $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		 $this->data['title']	= (isset($this->phrases['profile'])) ? $this->phrases['profile'] : "Profile";
		 
		$this->data['content'] = 'profile';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
		  
	} 
	
    /*** Function for Change Password ***/
    function change_password()
    {        
		
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new_password', $this->lang->line('change_password_validation_new_password_label'), 'required|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $user = $this->ion_auth->user()->row();
        if ($this->form_validation->run() == false) {
			$this->check_isdemo(URL_PROFILE);
            // display the form
            // set the flash data error message if there is one
            $this->data['message'] = $this->session->flashdata('message');
            
            $this->data['title']   = (isset($this->phrases['change password'])) ? $this->phrases['change password'] : "Change Password";
            $this->data['content'] = 'change_password';
            $this->_render_page(TEMPLATE_ADMIN, $this->data);
        } else {
            $identity = $this->session->userdata('identity');
            $change   = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new_password'));
            if ($change) {
                // if the password was successfully changed
                $this->prepare_flashmessage($this->ion_auth->messages(), 0);
                redirect(URL_LOGIN,REFRESH);
            } else {
                $this->prepare_flashmessage($this->ion_auth->errors(), 1);
                redirect(URL_ADMIN_CHANGE_PASSWORD, REFRESH);
            }
        }
    }
    
    //Get Items on Ajax call
    function get_items()
    {
        $menu_id    = $this->input->post('menu_id');
        
        $res      = $this->base_model->fetch_records_from(TBL_ITEMS, array(
            'menu_id' => $menu_id,
            'status' => 'Active'
        ));
        $options  = "";
        foreach ($res as $l) {
            $options = $options . "<option value='" . $l->item_id . "'>" . $l->item_name . "</option>";
        }
        if ($options != "")
            echo "<option value=''>" . $this->phrases['select item'] . "</option>" . $options;
        else
            echo "<option value=''>" . $this->phrases['no items available'] . "</option>";
    }
		
	
} 
