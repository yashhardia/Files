<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class Notifications extends MY_Controller
	{
		function __construct(){
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
	        $this->load->library('OneSignalPush');
	        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	        // Load MongoDB library instead of native db driver if required
	        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
	        $this->lang->load('auth');
	        $this->load->helper('language');
			check_access(ADMIN);
		}
		
	/**
	* Notifications
	* @author JOHN PETER
	* @date 27-07-2016
	*/
	
	function index()
	{
		//$this->check_access();
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
		$osp = new OneSignalPush();
		$response = $osp->viewNotifications();
		$return = json_decode($response);
		
		$notifications = array();
		if(!empty($return)){
			$records = $return->notifications;
	
		 foreach($records as $record){
			$temp = array(
				'message'=>$record->contents->en,
				'failed'=>$record->failed,
				'successful'=>$record->successful,
				'queued_at'=>$record->queued_at,
				'send_after'=>$record->send_after,
			);
			
			array_push($notifications,$temp);
		 } 
		}
		
		$this->data['notifications'] = $notifications;
		$this->data['active_class'] = ACTIVE_NOTIFICATIONS;
        $this->data['title']        = (isset($this->phrases['list notifications'])) ? $this->phrases['list notifications'] : "List Notifications";
        $this->data['content']      = 'view_notifications';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
		
	function send_notification()
	{
		
		if($this->input->post()){
			$this->check_isdemo(URL_NOTIFICATIONS);				
			$this->form_validation->set_rules('title',$this->phrases['title'],'required');
			$this->form_validation->set_rules('message',$this->phrases['message'],'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run()==true){
				$message = array(
						  "en" => $this->input->post('message'),
						  "title" => $this->input->post('title').$this->config->item('site_settings')->site_title,
						  "icon" => "myicon",
						  "sound" => "default"
						);
					$data = array(
						"body" => $this->input->post('message'),
						  "title" => $this->input->post('title').$this->config->item('site_settings')->site_title,
					);	
					
					$gcpm = new OneSignalPush();
					
					$response = $gcpm->sendToAll($message,$data);
					
					$result  = json_decode($response);
					
					if(isset($result->errors)){
						$msg = $result->errors[0];
						$this->prepare_flashmessage($msg,1);
				
					}else{
						$msg = 'Notification send to users';
						$this->prepare_flashmessage($msg,0);
						redirect(URL_NOTIFICATIONS);
					}
					
				
			}else{
				$this->prepare_flashmessage(validation_errors(),1);
			}
		}
		$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['active_class'] = ACTIVE_NOTIFICATIONS;
        $this->data['title']        = (isset($this->phrases['new notification'])) ? $this->phrases['new notification'] : "New Notification";
        $this->data['content']      = 'new_notification';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
}

?>