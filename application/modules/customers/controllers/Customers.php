<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class Customers extends MY_Controller
	{
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
	        
			$this->load->helper('inflector');
			$this->load->helper('security');
	        
	        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	        // Load MongoDB library instead of native db driver if required
	        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
	        $this->lang->load('auth');
	        $this->load->helper('language');
			check_access(ADMIN);
		}
		
		function index()
		{			
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['ajaxrequest'] = array(
			'url' => URL_CUSTOMER_AJAX_GET_DATA,
			'disablesorting' => '0,4',
		);
	        
	        $this->data['active_class'] = ACTIVE_CUSTOMERS;
	        $this->data['title']        = (isset($this->phrases['customers'])) ? $this->phrases['customers'] : "Customers";
	        $this->data['content']      = 'customers';
	        $this->_render_page(TEMPLATE_ADMIN, $this->data);
		}
		
		/*** Function for View Users ***/
	    function customer_details($user_id)
	    {
	        $usersDetails = $this->base_model->fetch_records_from(TBL_USERS, array('id' => $user_id));
	        if (count($usersDetails) > 0)
	            $this->data['usersDetails'] = $usersDetails[0];
	        else{
				$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
	            $this->prepare_flashmessage($msg, 2);
	            redirect(URL_CUSTOMERS);
			}
	            
	        $this->data['active_class'] = ACTIVE_CUSTOMERS;
	        $this->data['title']        = (isset($this->phrases['users'])) ? $this->phrases['users'] : "Users";
	        $this->data['content']      = 'customer_details';
	        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	    }
	    /*** Function for End of View Users ***/
	    
	 /**
	 * Diaplays data
	 *
	 * @param	mixed	$type
	 * @return	void
	 */
	function ajax_get_data()
	{
		
		if($this->input->post())
		{
			
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('id', 'first_name', 'last_name', 'email','phone','active');
			
			$condition = array('id !=' => '1');
			
			$records = $this->base_model->get_datatables(TBL_USERS, 'auto', $condition, $columns, array('id' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				
				$row[] = '<input id="checkbox-'.$record->id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->id.'">';
                $row[] = '<span>'.$record->first_name.'</span>';        
				$row[] = '<span>'.$record->email.'</span>';
				$row[] = '<span>'.$record->phone.'</span>';$status = 'Active';
					$class = 'badge success'; 
				$row[] ='<a href="'.URL_SEND_MAIL . '/' . $record->id . '"><i class="btn btn-info">'.Send." ".Mail.'</i></a>';			
			  
				$checked = '';
				$class = 'badge danger';
				$status = 'Inactive';
				if($record->active == '1'){
					$checked = ' checked';	
					$status = 'Active';
					$class = 'badge success';	
				}
				
				$row[] = '<span class="'.$class.'">'.$status.'</span>';
				//add html for action
				$row[] = '				
				<div class="digiCrud">
					<a href="'.URL_VIEW_CUSTOMER . '/' . $record->id . '" class="btn btn-info">
						<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				  <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->id . '" id="status_' . $record->id . '" name="check_' . $record->id . '" onclick="statustoggle(this, \'' .  URL_CUSTOMER_STATUSTOGGLE .'\')"'.$checked . '/>
					<div class="slider round"></div>
                </label></div>
				</div>
				';
				$data[] = $row;
			}
			//echo "<pre>";
			//print_r($data); die();
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_USERS, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_USERS, 'auto', $condition, $columns, array('id' => 'asc')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}        
	}
	
    
    /**
	 * Changes the status of the record
	 *
	 */
		
	function statustoggle()
	{
		if(!$this->check_isdemo_ajax(URL_CUSTOMERS)){
		if($this->input->post())
		{
			$id = $this->input->post('id');
			$term_status = $this->input->post('status');
			$filedata = array();
			$message = '';
			if($term_status == 'false')
			{
				$filedata['active'] = '0';
				$message = $this->phrases['MSG DEACTIVATED'];
			}
			else
			{
				$filedata['active'] = '1';				
				$message = $this->phrases['MSG ACTIVATED'];
			}	
			$this->base_model->update_operation_in( $filedata, TBL_USERS, 'id', explode(',', $id) );
			echo json_encode(array('status' => 1, 'message' => $message, 'action' => 'success'));
		} 
		else
		{
			$message = $this->phrases['MSG WRONG OPERATION'];
			echo json_encode(array('status' => 0, 'message' => $message, 'action' => 'failed'));			
		}
		}
		else{						
				$msg = 'Access Denied on demo server';				
				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));		
			}
	}		
	
	function view_details($customer_id='')	
	{		
	
		$result = $this->base_model->fetch_records_from(TBL_USERS, array('id' => $customer_id));
        if (count($result) > 0) {            
			$this->data['usersDetails'] = $result[0];        
			}
			else {           
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";		   $this->prepare_flashmessage($msg, 2);            redirect(URL_CUSTOMERS, REFRESH);        }                $this->data['active_class'] = ACTIVE_MENU;        $this->data['title']        = (isset($this->phrases['customer details'])) ? $this->phrases['customer details'] : "Customer Details";        $this->data['content']      = 'view_customer_details';        $this->_render_page(TEMPLATE_ADMIN, $this->data);	
		}
    public function send_mail($customer_id='')
    {   
        if($this->input->post()){
                               $from_email = "yashhardia10@yahoo.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
        
         $this->email->send(); 
                                }
        else{
            $result = $this->base_model->fetch_records_from(TBL_USERS, array('id' => $customer_id));
                if (count($result) > 0) {            
			    $this->data['usersDetails'] = $result[0];
                    $this->data['active_class'] = ACTIVE_MENU;        $this->data['title']        = (isset($this->phrases['customer details'])) ? SendMail : "Mail"; $this->data['content']      = 'send_mail';        $this->_render_page(TEMPLATE_ADMIN, $this->data);        
			}
		}   
     	   
    }
}
