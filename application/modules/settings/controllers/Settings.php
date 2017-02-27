<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends MY_Controller
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
	| -----------------------------------------------------
	| WEBSITE:			http://conquerorstech.net
	|                  
	| -----------------------------------------------------
	|
	| MODULE: 			SETTINGS
	| -----------------------------------------------------
	| This is settings module controller file.
	| -----------------------------------------------------
	*/
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('base_model');
		$this->load->library('upload');
		$this->form_validation->set_error_delimiters(
		$this->config->item('error_start_delimiter', 'ion_auth') , 
		$this->config->item('error_end_delimiter', 'ion_auth'));

		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ? 
		$this->load->library('mongo_db') : $this->load->database();
		$this->lang->load('auth');
		$this->load->helper('language');
		check_access(ADMIN);
	}

	/*** FUNCTION FOR SITE SETTGINS***/
	function app_settings()
	{
				
	$this->data['message'] 	= ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));
		if ($this->input->post()) 
		{
			$this->check_isdemo(URL_SITE_SETTINGS);
			$this->form_validation->set_rules(
			'site_title', 
			$this->phrases['site title'], 
			'required');
			$this->form_validation->set_rules(
			'sitename', 
			$this->phrases['site name'], 
			'required');
			$this->form_validation->set_rules(
			'address', 
			$this->phrases['address'], 
			'required');
			$this->form_validation->set_rules(
			'city', 
			$this->phrases['city'], 
			'required');
			$this->form_validation->set_rules(
			'state', 
			$this->phrases['state'], 
			'required');
			$this->form_validation->set_rules(
			'country', 
			$this->phrases['country'], 
			'required');
			$this->form_validation->set_rules(
			'latitude', 
			$this->phrases['latitude'], 
			'required');
			$this->form_validation->set_rules(
			'longitude', 
			$this->phrases['longitude'], 
			'required');
			$this->form_validation->set_rules(
			'zip', 
			$this->phrases['zip code'], 
			'required');
			$this->form_validation->set_rules(
			'phone', 
			$this->phrases['phone'], 
			'required|min_length[10])|max_length[11]');
			$this->form_validation->set_rules(
			'portal_email', 
			$this->phrases['contact email'], 
			'required|valid_email');
			
			$this->form_validation->set_rules(
			'language_id', 
			$this->phrases['select language'], 
			'required');
			$this->form_validation->set_rules(
			'design_by', 
			$this->phrases['design by'], 
			'required');
			$this->form_validation->set_rules(
			'rights_reserved_content', 
			$this->phrases['rights reserved'], 
			'required');
			$this->form_validation->set_rules(
			'ios_url', 
			$this->phrases['ios url'], 
			'required');
			$this->form_validation->set_rules(
			'android_url', 
			$this->phrases['android url'], 
			'required');
			$this->form_validation->set_rules(
			'from_time', 
			$this->phrases['from time'], 
			'required');
			$this->form_validation->set_rules(
			'to_time', 
			$this->phrases['to time'], 
			'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if (!empty($_FILES['userfile']['name'])) {
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				
				if (($ext != "gif") && ($ext != "jpg") && ($ext != "png") && ($ext != "jpeg")) {
					$msg = (isset($this->phrases['invalid file'])) ? $this->phrases['invalid file'] : "Invalid File";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_SITE_SETTINGS);
				}
			}

			if ($this->form_validation->run() 	== TRUE	) {
				
				$inputdata['site_title'] 		= $this->input->post('site_title');
				$inputdata['site_name'] 		= $this->input->post('sitename');
				$inputdata['address'] 			= $this->input->post('address');
				$inputdata['city'] 				= $this->input->post('city');
				$inputdata['state'] 			= $this->input->post('state');
				$inputdata['country'] 			= $this->input->post('country');
				$inputdata['longitude'] 		= $this->input->post('longitude');
				$inputdata['latitude'] 			= $this->input->post('latitude');
				$inputdata['zip'] 				= $this->input->post('zip');
				$inputdata['phone'] 			= $this->input->post('phone');
				$inputdata['from_time'] 		= $this->input->post('from_time');
				$inputdata['to_time'] 			= $this->input->post('to_time');
				$inputdata['land_line'] 		= $this->input->post('land_line');
				$inputdata['fax'] 				= $this->input->post('fax');
				$inputdata['portal_email'] 		= $this->input->post('portal_email');
				$inputdata['language_id'] 		= $this->input->post('language_id');
				$inputdata['currency'] 			= $this->input->post('currency');
				$inputdata['currency_symbol'] 	= $this->input->post('currency_symbol');
				$inputdata['country_code'] 		= $this->input->post('country_code');
				$inputdata['ios_url'] 			= $this->input->post('ios_url');
				$inputdata['android_url'] 		= $this->input->post('android_url');
				$inputdata['design_by'] 		= $this->input->post('design_by');
				$inputdata['rights_reserved_content'] = $this->input->post(
				'rights_reserved_content');
							
				$inputdata['facebook_api'] 		= $this->input->post('facebook_api');
				$inputdata['google_api'] 		= $this->input->post('google_api');
				
				$sms_notifications = 'No';
				if($this->input->post('sms_notifications')=='on'){
					$sms_notifications = 'Yes';	
				}
				$inputdata['sms_notifications'] 		= $sms_notifications;
				
				
				$push_notifications = 'No';
				if($this->input->post('fcm_push_notifications')=='on'){
					$push_notifications = 'Yes';	
				}
				$inputdata['fcm_push_notifications'] 		= $push_notifications;
				
				$where['id'] 					= $this->input->post('update_record_id');
				
				if ($this->base_model->update_operation(
				$inputdata, TBL_SITE_SETTINGS, $where)) 
				{
					if (!empty($_FILES['userfile']['name'])) {
						
						$config['upload_path'] 	 = IMG_SITE_LOGO;
						$config['allowed_types'] = ALLOWED_TYPES;
						$config['overwrite']    = TRUE;
						$config['file_name'] 	 = 'site_logo.'. $ext;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						
						if (!$this->upload->do_upload()) {
							$this->prepare_flashmessage(
							$this->upload->display_errors() , 1);
							redirect(URL_SITE_SETTINGS,REFRESH);
						}
						else {
							
							$input1['site_logo']= 'site_logo.'. $ext;
							$this->base_model->update_operation(
							$input1, TBL_SITE_SETTINGS, $where);
							$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
							$this->prepare_flashmessage($msg, 0);
							redirect(URL_SITE_SETTINGS,REFRESH);
						}
					}

					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_SITE_SETTINGS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_SITE_SETTINGS,REFRESH);
				}
			}
			else
			{
				$this->prepare_flashmessage(validation_errors(),1);
				redirect(URL_SITE_SETTINGS,REFRESH);
			}
		}
		
		$site_settings 	= $this->base_model->fetch_records_from(TBL_SITE_SETTINGS);
		if (count($site_settings) > 0) 
			$this->data['site_settings'] 		= $site_settings[0];
		else 
			$this->data['site_settings'] 		= array();
		
		// LANGUAGE OPTIONS
		$lang_options 							= array('' => $this->phrases['select language']);
		$languages 								= $this->base_model->fetch_records_from(TBL_LANGUAGES,array('status'=>'Active'));
		foreach($languages as $row):
			$lang_options[$row->id] 			= ucfirst($row->lang_name);
		endforeach;
		
		// CURRENCY OPTIONS
		
		$currency_options  = array(''=>$this->phrases['select currency']);
		
		$currencies = $this->base_model->fetch_records_from(TBL_CURRENCY);
		foreach($currencies as $row):
			$currency_options[$row->currency_code_alpha] = ucfirst($row->currency_name);
		endforeach;
		
		//echo "<pre>";
		//print_r($this->data['site_settings']); die();
		$this->data['lang_options'] 			= $lang_options;
		$this->data['currency_options'] 		= $currency_options;
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['app settings'])) ? $this->phrases['app settings'] : "App Settings";
		$this->data['content'] 					= 'site_settings';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	
	/*** FUNCTION FOR EMAILSETTINGS***/
	public function email_settings()
	{
		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
		
		if ($this->input->post('update_record_id')) {
			$this->check_isdemo(URL_EMAIL_SETTINGS);
			$this->form_validation->set_rules(
			'mail_config', 
			$this->phrases['web mail'],
			 'required');
			if($this->input->post('mail_config')=='mandrill'){
				$this->form_validation->set_rules(
				'api_key',
				$this->phrases['api key'],
				'required');
			}else{
					$this->form_validation->set_rules(
				'smtp_host', 
				$this->phrases['host'], 
				'trim|required');
				$this->form_validation->set_rules(
				'smtp_user', 
				$this->phrases['email'], 
				'trim|required');
				$this->form_validation->set_rules(
				'smtp_port', 
				$this->phrases['port'], 
				'trim|required');
			}
			
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() 	== TRUE	) {
				
				$inputdata['smtp_host'] 		= $this->input->post('smtp_host');
				$inputdata['smtp_user'] 		= $this->input->post('smtp_user');
				$inputdata['smtp_password'] 	= $this->input->post('smtp_password');
				$inputdata['smtp_port'] 		= $this->input->post('smtp_port');
				$inputdata['api_key'] 			= $this->input->post('api_key');
				$inputdata['mail_config'] 		= $this->input->post('mail_config');
				
				$where['id'] 					= $this->input->post('update_record_id');
				if ($this->base_model->update_operation(
				$inputdata, TBL_EMAIL_SETTINGS, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_EMAIL_SETTINGS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_EMAIL_SETTINGS,REFRESH);
				}
			}
		}

		$email_settings 						= $this->base_model->fetch_records_from(
		TBL_EMAIL_SETTINGS);
		if (count($email_settings) > 0) 
			$this->data['email_settings'] 		= $email_settings[0];
		else $this->data['email_settings'] 		= array();
		
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['email settings'])) ? $this->phrases['email settings'] : "Email Settings";
		$this->data['content'] 					= 'email_settings';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	
	
	/****** Change Language ******/
	function change_language($language_id = null)
	{		
		if($language_id > 0) {
			
			$check_strings = $this->base_model->fetch_records_from(TBL_MULTI_LANG,array('lang_id'=>$language_id,'phrase_type'=>'web'));
			
			
			if(count($check_strings)>0){
					if($this->base_model->update_operation(array('language_id' => $language_id), 'site_settings')) {
					$msg = (isset($this->phrases['language changed successfully'])) ? $this->phrases['language changed successfully'] : "Language Changed Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_ADMIN);				
				}
			}else{
				$language_name = $this->base_model->fetch_records_from(TBL_LANGUAGES,array('id'=>$language_id));
				$msg = "Please update ".$language_name[0]->lang_name." language strings";
					$this->prepare_flashmessage($msg, 2);
					redirect(URL_ADMIN);	
			}
			
		}
	}
	
	/****** Paypal Settings ******/
	function paypal_settings()
	{
		
		if ($this->input->post()) 
		{
			$this->check_isdemo(URL_PAYPAL_SETTINGS);
			$this->form_validation->set_rules(
			'PayPalEnvironmentProduction', 
			$this->phrases['paypal environment production'], 
			'required');
			$this->form_validation->set_rules(
			'PayPalEnvironmentSandbox', 
			$this->phrases['paypal environment sandbox'], 
			'required');
			$this->form_validation->set_rules(
			'merchantName', 
			$this->phrases['merchant name'], 
			'required');
			$this->form_validation->set_rules(
			'merchantPrivacyPolicyURL', 
			$this->phrases['merchant privacy policy URL'], 
			'required');
			$this->form_validation->set_rules(
			'merchantUserAgreementURL', 
			$this->phrases['merchant user agreement URL'], 
			'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() 	== TRUE	) 
			{
				$inputdata['PayPalEnvironmentProduction'] 	= $this->input->post('PayPalEnvironmentProduction');
				$inputdata['PayPalEnvironmentSandbox'] 	= $this->input->post('PayPalEnvironmentSandbox');
				$inputdata['merchantName'] 			    = $this->input->post('merchantName');
				$inputdata['merchantPrivacyPolicyURL'] 	= $this->input->post('merchantPrivacyPolicyURL');
				$inputdata['merchantUserAgreementURL'] 	= $this->input->post('merchantUserAgreementURL');
				$inputdata['currency'] 					= $this->input->post('currency');
				$inputdata['account_type'] 				= $this->input->post('account_type');
				$inputdata['status'] 					= $this->input->post('status');
				$where['id'] 							= $this->input->post('update_rec_id');
				if ($this->base_model->update_operation(
				$inputdata, TBL_PAYPAL_SETTINGS, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_PAYPAL_SETTINGS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_PAYPAL_SETTINGS,REFRESH);
				}
			}
		}
		$this->data['message'] 	= $this->session->flashdata('message');
		
		$paypal_settings = $this->base_model->fetch_records_from(TBL_PAYPAL_SETTINGS);
		
		$currency_options  = array(''=>$this->phrases['select currency']);
		
		$currencies = $this->base_model->fetch_records_from(TBL_CURRENCY);
		foreach($currencies as $row):
			$currency_options[$row->currency_code_alpha] 			= ucfirst($row->currency_name);
		endforeach;	
	
		if (count($paypal_settings) > 0) 
			$this->data['paypal_settings'] 	= $paypal_settings[0];
		else 
			$this->data['paypal_settings'] 	= array();
		
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
		$this->data['currency_options'] 	= $currency_options;
		
		$this->data['active_class'] 		= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 				= (isset($this->phrases['paypal settings'])) ? $this->phrases['paypal settings'] : 'Paypal Settings';
		$this->data['content'] 				= 'paypal_settings';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	 
	public function email_templates($param = '', $param1 = '')
	{
		$email_templates 						= getRecsTable(TBL_EMAIL_TEMPLATES);
		$this->data['email_templates'] 			= count($email_templates)>0 ? $email_templates : array();
		$this->data['title'] 				= (isset($this->phrases['email template settings'])) ? $this->phrases['email template settings'] : 'Email Template Settings';
			
		$this->data['content'] 					= 'email_templates';
		
		if ($param == "edit") {
		
			$template							= getRecsTable(TBL_EMAIL_TEMPLATES,array('id'=>$param1));
			$this->data['template_info'] 		= count($template) > 0 ? $template[0] : array();
			
			$this->data['opt']					= UPDATE;
			$this->data['title'] 				= (isset($this->phrases['edit email template'])) ? $this->phrases['edit email template'] : 'Edit Email Template Settings';
			$this->data['content'] 				= 'edit_email_template';
		}
		elseif ($param == "update" || $this->input->post('submit') == 'update') {
			$this->check_isdemo(URL_EMAIL_TEMPLATE_SETTINGS);
			$this->form_validation->set_rules(
			'email_template', 
			$this->phrases['email template'], 
			'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() == True) {
				
				$inputdata['email_template'] 	= $this->input->post('email_template');
				$inputdata['status'] 			= $this->input->post('status');
				
				$where['id'] 					= $this->input->post('id');
				if ($this->base_model->update_operation($inputdata, TBL_EMAIL_TEMPLATES, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_EMAIL_TEMPLATE_SETTINGS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_EMAIL_TEMPLATE_SETTINGS,REFRESH);
				}
			}
			
			$template 							= getRecsTable(TBL_EMAIL_TEMPLATES,array('id'=>$this->input->post('id')));
			$this->data['template_info'] 		= count($template) > 0 ? $template[0] : array();
			
			$this->data['opt']					= UPDATE;
			
			$this->data['content'] 				= 'edit_email_template';
		}
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		 
		 $this->data['active_class'] 		= ACTIVE_MASTER_SETTINGS;
		 $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	// SMS TEMPLATES
	
	public function sms_templates($param = '', $param1 = '')
	{
		$sms_templates 						= getRecsTable(TBL_SMS_TEMPLATES);
		$this->data['sms_templates'] 			= count($sms_templates)>0 ? $sms_templates : array();
		$this->data['title'] 				= (isset($this->phrases['sms templates'])) ? $this->phrases['sms templates'] : 'SMS Templates';
			
		$this->data['content'] 					= 'settings/sms_templates';
		
		if ($param == "edit") {
		
			$template							= getRecsTable(TBL_SMS_TEMPLATES,array('sms_template_id'=>$param1));
			$this->data['template_info'] 		= count($template) > 0 ? $template[0] : array();
			
			$this->data['opt']					= UPDATE;
			$this->data['title'] 				= (isset($this->phrases['edit sms template'])) ? $this->phrases['edit sms template'] : 'Edit SMS Template';
			$this->data['content'] 				= 'settings/edit_sms_template';
		}
		elseif ($param == "update" || $this->input->post('submit') == 'update') {
			$this->check_isdemo(URL_SMS_TEMPLATES);
			$this->form_validation->set_rules(
			'sms_template', 
			$this->phrases['sms template'], 
			'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() == True) {
				
				
				$inputdata['sms_template'] 		= $this->input->post('sms_template');
				$inputdata['status'] 			= $this->input->post('status');
				
				$where['sms_template_id'] 					= $this->input->post('id');
				if ($this->base_model->update_operation($inputdata, TBL_SMS_TEMPLATES, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_SMS_TEMPLATES,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_SMS_TEMPLATES,REFRESH);
				}
			}
			
			$template 							= getRecsTable(TBL_SMS_TEMPLATES,array('sms_template_id'=>$this->input->post('id')));
			$this->data['template_info'] 		= count($template) > 0 ? $template[0] : array();
			
			$this->data['opt']					= UPDATE;
			
			$this->data['content'] 				= 'edit_sms_template';
		}
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		 
		 $this->data['active_class'] 		= ACTIVE_MASTER_SETTINGS;
		 $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function sms_gateways()
	{
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$sms_gateways 						= $this->base_model->fetch_records_from(
		TBL_SMS_GATEWAYS);
		if (count($sms_gateways) > 0) 
			$this->data['sms_gateways'] 		= $sms_gateways;
		else $this->data['sms_gateways'] 		= array();
		
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['sms gateways'])) ? $this->phrases['sms gateways'] : "SMS Gateways";
		$this->data['content'] 					= 'sms_gateways';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function add_sms_gateway()
	{
		if($this->input->post()){
			$this->check_isdemo(URL_SMS_GATEWAYS);
			 $this->form_validation->set_rules('sms_gateway_name', $this->phrases['menu name'], 'required|is_unique[' . DBPREFIX.TBL_SMS_GATEWAYS . '.sms_gateway_name]');
                        
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $input_data['sms_gateway_name'] 	 	= $this->input->post('sms_gateway_name');
                $input_data['is_default'] 	 			= $this->input->post('is_default');
                $input_data['status']        			= $this->input->post('status');
                
                if ($this->base_model->insert_operation_id($input_data, TBL_SMS_GATEWAYS)) {
                	$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
                            $this->prepare_flashmessage($msg,0);
                            
							redirect(URL_SMS_GATEWAYS);
                    
                } else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_SMS_GATEWAYS);
                }
            }
		}
		$this->data['message'] = $this->session->flashdata('message');
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['add sms gateway'])) ? $this->phrases['add sms gateway'] : "Add SMS Gateway";
		$this->data['content'] 					= 'add_sms_gateway';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	/**
	 * Displays add or edit category form
	 *
	 * @param	mixed $_POST
	 * @return	void
	 */
	function fieldaddedit($id = '')
	{
		
		$this->data['message'] = $this->session->flashdata('message');
		
		if( $this->input->post())
		{
			$this->check_isdemo(URL_SMS_GATEWAYS);
			/*print_r($this->input->post()); die();*/
			$this->load->library('form_validation');
			$this->form_validation->set_rules('field_name','field name','trim|required|callback_checkduplicatetypefield');
			$this->form_validation->set_rules('field_output_value','Value','trim|required');
			$this->form_validation->set_rules('sms_gateway_id','sms gateway','required');
									
			if($this->form_validation->run()!=false)
			{
				
				$inputdata['sms_gateway_id'] 		= $this->input->post('sms_gateway_id');
				$inputdata['field_name'] 			= $this->input->post('field_name');
				$inputdata['field_output_value'] 	= $this->input->post('field_output_value');
				$inputdata['is_required'] 			= $this->input->post('is_required');
				
				if( $this->input->post('id') == '' )
				{
					$inputdata['created'] = date('Y-m-d H:i:s');					
					$id = $this->base_model->insert_operation( $inputdata, TBL_SETTINGS_FIELDS );
					
					$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
                            $this->prepare_flashmessage($msg,0);				
				}
				else
				{
					$id = $this->input->post('id');
					$inputdata['updated'] = date('Y-m-d H:i:s');
					$where = array();
					$where['field_id'] = $id;					
					$this->base_model->update_operation( $inputdata, TBL_SETTINGS_FIELDS, $where );
					$msg = (isset($this->phrases['updated sucessfully'])) ? $this->phrases['updated sucessfully'] : "Updated Successfully";
                            $this->prepare_flashmessage($msg,0);	
						
				}
				
				redirect(URL_SMS_GATEWAYS);			
			}
			else
			{
				
				$this->data['message'] = $this->prepare_flashmessage(validation_errors(),1);
				
			}
			
		}	
		$sms_gateways 							= $this->base_model->prepareDropdown(
		TBL_SMS_GATEWAYS,'sms_gateway_id','sms_gateway_name');
		$this->data['sms_gateways']				= $sms_gateways;
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['add sms gateway'])) ? $this->phrases['add sms gateway'] : "Add SMS Gateway";
		$this->data['content'] 					= 'fieldaddedit';
		$this->data['gateway_id']				= $id;
		
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	/**
	 * Duplicate check for type_title
	 *
	 * @param	String	$type_title
	 * @return	Boolean
	 */	
	function checkduplicatetypefield()
	{

		$check = $this->base_model->fetch_records_from(TBL_SETTINGS_FIELDS,array('field_name' => $this->input->post('field_name'), 'sms_gateway_id' => $this->input->post('sms_gateway_id')));		
		if (count($check) == 0 && $this->input->post('id') == '') {
		  return true;
		} elseif((count($check) >= 1 || count($check) == 0)&& $this->input->post('id') != '') {
			return true;
		}else {
		  $this->form_validation->set_message('checkduplicatetypefield', $this->phrases['duplicate']);
		  return false;
		}
	}
	
	/**
	* UPDATE SMS FIEDL VALUES 
	*/
	function update_sms_field_values($sms_gateway_id='')
	{		
		if($this->input->post()){
			$this->check_isdemo(URL_SMS_GATEWAYS);
			$field_values  = $this->input->post();
			//echo "<pre>";
			//print_r($field_values); die();
			foreach($field_values as $field_id => $val) {
				$fld_id = explode('_',$field_id);
				if(is_array($fld_id) && isset($fld_id[1])){
					$inputdata = array(
						'field_output_value' => $val,
						'updated' => date('Y-m-d H:i:s'),
					);
			//	echo $fld_id[1];	
				$where = array('field_id' => $fld_id[1]);
			//	die();
				$this->base_model->update_operation( $inputdata, TBL_SETTINGS_FIELDS, $where );
				}
			}		
				
			$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
		   $this->prepare_flashmessage($msg, 0);
            redirect(URL_SMS_GATEWAYS, REFRESH);
		}
		if(empty($sms_gateway_id)){
			  $msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
		   $this->prepare_flashmessage($msg, 2);
            redirect(URL_SMS_GATEWAYS, REFRESH);
		}
		$sms_gateway_details = $this->base_model->fetch_records_from(TBL_SETTINGS_FIELDS,array('sms_gateway_id'=>$sms_gateway_id));
		$sms_gateways 						= $this->base_model->fetch_records_from(
		TBL_SMS_GATEWAYS,array('sms_gateway_id'=>$sms_gateway_id));
		if(empty($sms_gateway_details) || empty($sms_gateways)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
		   $this->prepare_flashmessage($msg, 2);
            redirect(URL_SMS_GATEWAYS, REFRESH);
		}
				
		$this->data['sms_gateway_details']		= $sms_gateway_details;
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= $sms_gateways[0]->sms_gateway_name; 
		$this->data['content'] 					= 'sms_update_field_values';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	// MAKE default
	function makedefault($sms_gateway_id)
	{
		$details = $this->base_model->fetch_records_from(TBL_SMS_GATEWAYS);
		if(!empty($details))
		{
			$this->db->query('UPDATE '.DBPREFIX.TBL_SMS_GATEWAYS.' SET is_default="No"');
			
			$this->db->query('UPDATE '.DBPREFIX.TBL_SMS_GATEWAYS.' SET is_default="Yes" WHERE sms_gateway_id = '.$sms_gateway_id);
			$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
		   $this->prepare_flashmessage($msg, 0);
            
			
		}
		else
		{
			$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
		   $this->prepare_flashmessage($msg, 2);
            
		}
		redirect(URL_SMS_GATEWAYS, REFRESH);		
	}
	
	// GCM PUSH NOTIFICATIONS
	function push_notifications()
	{
		
		if($this->input->post()){
			$this->check_isdemo(URL_PUSH_NOTIFICATIONS);
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('one_signal_server_api_key',$this->phrases['one signal server api key'],'required');
			$this->form_validation->set_rules('one_signal_app_id',$this->phrases['one signal app id'],'required');
														
			if($this->form_validation->run()==true)
			{
				$update_data['one_signal_server_api_key'] 	= $this->input->post('one_signal_server_api_key');
				$update_data['one_signal_app_id'] 	= $this->input->post('one_signal_app_id');
				
				
				$where['id'] 						= $this->input->post('update_record_id');
			
				if ($this->base_model->update_operation(
				$update_data, TBL_SITE_SETTINGS, $where)){
								
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
		   			$this->prepare_flashmessage($msg, 0);
				}else{
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
		   			$this->prepare_flashmessage($msg, 1);	
		   			redirect(URL_PUSH_NOTIFICATIONS);
				}
			}else{
					$this->prepareflash_message(validation_errors(),1);
					redirect(URL_PUSH_NOTIFICATIONS);
			}
		}
		$gcm_settings 	= $this->base_model->fetch_records_from(TBL_SITE_SETTINGS);
		if(!empty($gcm_settings)){
			 $gcm_settings = $gcm_settings[0];
		}else{
			$gcm_settings = array();
		}
		$this->data['message'] 	= ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));
		$this->data['gcm_settings']				= $gcm_settings;
		$this->data['active_class'] 			= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 					= (isset($this->phrases['Push Notifications'])) ? $this->phrases['Push Notifications'] : "Push Notifications";
		$this->data['content'] 					= 'gcm_push_notifications';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	
	// PAYU SETTINGS 
	
	function payu_settings()
	{
		if ($this->input->post()) 
		{
			$this->check_isdemo(URL_PAYU_SETTINGS);
			$this->form_validation->set_rules(
			'merchant_key', 
			$this->phrases['merchant key'], 
			'required');
			$this->form_validation->set_rules(
			'salt', 
			$this->phrases['salt'], 
			'required');
			$this->form_validation->set_rules(
			'live_url', 
			$this->phrases['live URL'], 
			'required');
			$this->form_validation->set_rules(
			'test_url', 
			$this->phrases['test URL'], 
			'required');
						
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() 	== TRUE	) 
			{
				$inputdata['merchant_key'] 	= $this->input->post('merchant_key');
				$inputdata['salt'] 	= $this->input->post('salt');
				$inputdata['live_url'] 	 = $this->input->post('live_url');
				$inputdata['test_url'] 	= $this->input->post('test_url');
				$inputdata['account_type'] 	= $this->input->post('account_type');
				$inputdata['status'] 	= $this->input->post('status');
				
				$where['payu_id'] 	= $this->input->post('update_rec_id');
				if ($this->base_model->update_operation(
				$inputdata, TBL_PAYU_SETTINGS, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_PAYU_SETTINGS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_PAYU_SETTINGS,REFRESH);
				}
			}
		}
		$this->data['message'] 	= $this->session->flashdata('message');
		
		$payu_settings = $this->base_model->fetch_records_from(TBL_PAYU_SETTINGS);
			
		
		if (count($payu_settings) > 0) 
			$this->data['payu_settings'] 	= $payu_settings[0];
		else 
			$this->data['payu_settings'] 	= array();
		
		 $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');	
				
		$this->data['active_class'] 		= ACTIVE_MASTER_SETTINGS;
		$this->data['title'] 				= (isset($this->phrases['payu settings'])) ? $this->phrases['payu settings'] : 'Payu Settings';
		$this->data['content'] 				= 'payu_settings';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
}
?>