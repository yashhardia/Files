<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Service_login extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
		
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','date','string'));
		$this->load->model('base_model');
		
		
		$this->load->model('ion_auth_model');
		$this->load->helper('security');
		$this->phrases = $this->config->item('words');
		/* Loading Language Files */
		$map = $this->config->item('languages');
		if (is_array($this->response->lang)) {
			
			$this->load->language('auth', $map[$this->response->lang[1]]);
			$this->load->language('ion_auth', $map[$this->response->lang[1]]);
		}
        

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
		//$this->authenticateUser($this->post('email'),$this->post('password'));
    }
	
	function authenticateUser($identity = NULL, $password = NULL)
	{		
		if($identity == ""  || $password == "") {
		
           $this->response(array('status' => 'Please provide Identity and Password'), 400);
        }
		
		//$remember = (bool) $this->post('remember');

		return $this->ion_auth->login($identity, $password, false);
	}
	/*
	*	Login Function 
	*	Returns Data
	*	John Peter @ 02-03-2016
	*/
	function login_post()
	{
		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'required|xss_clean');
		if($this->form_validation->run()==false)
		{
			$data 		=	validation_errors();
			$response 	= 	validation_errors();
			$status		=	0;	
		}else{
		
			if ($this->ion_auth->login($this->input->post('email'), $this->input->post('password'), false))
			{
				//if the login is successful
				$user_id 	= $this->ion_auth->get_user_id();
		
				$data 		= $this->base_model->fetch_records_from('users',array('id'=>$user_id));
				$response 	= (isset($this->phrases['login success'])) ? $this->phrases['login success'] : "Login Success";
				$status 	=	1;
			}
			else
			{
				$data 		=	array();
				$response 	= 	strip_tags($this->ion_auth->errors());
				$status		=	0;	
				
			}
		}
		$this->serviceResponse($data,$response,$status);
	}
	
	/**
	* METHOD FOR SIGNUP FOR  USER
	* SUCCESS MESSAGE OR ERROR MESSAGES WILL BE RETURNED
	*/
	function signup_post()
    { 
		$identity_column 				= $this->config->item('identity','ion_auth');
		
		$email    	= strtolower($this->post('identity'));
		$identity 	= ($identity_column==='email') ? $email : $this->post('identity');
		
		if($this->post('registered_by')== 'google' || $this->post('registered_by')==  'facebook')
		{
			//check user account already exists
			$record = $this->base_model->fetch_records_from(TBL_USERS,array('email'=>$email));
			if(!empty($record))
			{
				$status		= 1;
				$data 		= $record;
				$response 	= (isset($this->phrases['logged in successfully'])) ? $this->phrases['logged in successfully'] : 'Logged In Successfully';
				
				$this->serviceResponse($data,$response,$status);
			}
			else
			{
			$password 	= random_string('alnum', 5);
			}
		}
		else
		{
			$password 	= $this->post('password');	
		}
		
		$additional_data = array();
		$data			 = array();
		//Prepare User related data
		$name = ucfirst($this->post('first_name')).' '.ucfirst($this->post('last_name'));
		$additional_data = array(
			'username' => $name,
			'first_name' 			=> $this->post('first_name'),
			'last_name'  			=> $this->post('last_name'),
			'phone'  			    => $this->post('phone'),
			'device_id'  			=> $this->post('device_id'),
			'platform'  			=> $this->post('platform'),
			'registered_by'  		=> $this->post('registered_by'),
			'updated_on'  			=> date('Y-m-d')
			);
		$group = array(GRP_USER);
		 
		$id = $this->ion_auth->register($identity, $password, $email, $additional_data,$group);
		
		if ($id)
		{
			
			if($this->post('registered_by')=='google' || $this->post('registered_by')=='facebook' ||$this->post('registered_by')=='mobile')
			{
				$data = $this->base_model->fetch_records_from(TBL_USERS,array('id'=>$id));
				
				$this->base_model->update_operation(array('active'=>1),TBL_USERS,array('id'=>$id));
				
				$email_template = $this->base_model->fetch_records_from(TBL_EMAIL_TEMPLATES,array('subject'=>'fb_google_registration_template','status'=>'Active'));
				if(count($email_template)>0) 
				{
					$email_template = $email_template[0];			
					$content 		= $email_template->email_template;
					
					$content     	= str_replace("__USER_NAME__", $name,$content);
					
					$content     	= str_replace("__SITE_TITLE__",$this->config->item('site_settings')->site_title,$content);
					
					$content 	= str_replace("__EMAIL__", $email,$content);
					
					$content 	= str_replace("__PASSWORD__", $password,$content);	
									
					$content 	= str_replace("__CONTACT_US__", $this->config->item('site_settings')->portal_email,$content);
					
					$content 	= str_replace("__CONTACT__NO__", $this->config->item('site_settings')->land_line,$content);
					
					$content 	= str_replace("__SITE_TITLE__", $this->config->item('site_settings')->site_title,$content);
					
					$content 	= str_replace("__COPY_RIGHTS__", $this->config->item('site_settings')->rights_reserved_content,$content);
								
									
					$from 	= $this->config->item('site_settings')->portal_email;
					$to 	= $email;
					$sub 	= $this->config->item('site_settings')->site_title 
					. ' - ' . (isset($this->phrases['registration'])) ? $this->phrases['registration'] : "Registration";
					
					sendEmail($from, $to, $sub, $content);
					 
				}
				$response	=	(isset($this->phrases['registration completed successfully password sent to email'])) ? $this->phrases['registration completed successfully password sent to email'] : 'Registration completed successfully password sent to email';
			$status		=	1;
			}
			else
			{
				$email_template = $this->base_model->fetch_records_from(TBL_EMAIL_TEMPLATES,array('subject'=>'registration_template','status'=>'Active'));
				if(count($email_template)>0) 
				{
					$email_template = $email_template[0];			
					$content 		= $email_template->email_template;
					
					$content     	= str_replace("__USER__NAME__", $name,$content);
					
					$content     	= str_replace("__SITE_TITLE__",$this->config->item('site_settings')->site_title,$content);
					
					$content 		= str_replace("__EMAIL__", $email,$content);
					
					$content 	= str_replace("__PASSWORD__", $password,$content);	
					
					$user = $this->base_model->fetch_records_from(TBL_USERS,array('email'=>$email));
					
					if(count($user) > 0)
					{
						$link	= base_url().'auth/activate/'.$user[0]->id.'/'.$user[0]->activation_code;
					
						$content 	= str_replace("__ACCOUNT_ACTIVATOIN_LINK__",anchor($link,'Activation') ,$content);
					}
					else
					{
						$content 	= str_replace("__ACCOUNT_ACTIVATOIN_LINK__", anchor(base_url(),'Activation'),$content);	
					}
					
					$content 		= str_replace("__CONTACT_US__", $this->config->item('site_settings')->land_line,$content);
					
					$content 		= str_replace("__SITE_TITLE__", $this->config->item('site_settings')->site_title,$content);
					
					$content 		= str_replace("__COPY_RIGHTS__", $this->config->item('site_settings')->rights_reserved_content,$content);
								
									
					$from 	= $this->config->item('site_settings')->portal_email;
					$to 	= $email;
					$sub 	= $this->config->item('site_settings')->site_title 
					. ' - ' . (isset($this->phrases['registration'])) ? $this->phrases['registration'] : "Registration";
					$response	=	(isset($this->phrases['registration completed successfully activation email sent'])) ? $this->phrases['registration completed successfully activation email sent'] : 'Registration completed successfully activation email sent';
					$status		=	1;
					
					sendEmail($from, $to, $sub, $content); 
					// CHECK SMS IS ENABLE OR NOT. IF ENABLE SMS OTP TO USER  
					if($this->config->item('site_settings')->sms_notifications=='Yes'){
						$sms_details = $this->base_model->fetch_records_from(TBL_SMS_TEMPLATES,array('subject'=>'registration_otp'));
						if(!empty($sms_details)){
							$content = strip_tags($sms_details[0]->sms_template);
							$content     	= str_replace("__OTP__", $this->input->post('otp_string'),$content);
							
							$mobile_number 	= $this->input->post('phone');
							
							$res = sendSMS($mobile_number,$content);
							if($res['result'] == 1)
							{
								$data = array('email'=>$email);
								$response	=	(isset($this->phrases['registration completed successfully OTP sent to mobile'])) ? $this->phrases['registration completed successfully OTP sent to mobile'] : 'Registration completed successfully OTP sent to mobile';
								$status		=	2;
							}
							else
							{
								
								$response	=	(isset($this->phrases['registration completed successfully activation email sent'])) ? $this->phrases['registration completed successfully activation email sent'] : 'Registration completed successfully activation email sent';
								$status		=	1;
								
							}
						}else{
							$response	=	(isset($this->phrases['registration completed successfully activation email sent'])) ? $this->phrases['registration completed successfully activation email sent'] : 'Registration completed successfully activation email sent';
								$status		=	1;
						}
						
							
					}
					
				}
				
			}
			
			
			
		}
		else
		{
			$status		=	0;
			if($this->post('registered_by')=='google' || $this->post('registered_by')=='facebook'){
				$data = $this->base_model->fetch_records_from(TBL_USERS,array('email'=>$email));
				$status		=	1;
			}
			$response 	= 	strip_tags($this->ion_auth->errors());	
			
		}
	

		$this->serviceResponse($data,$response,$status);
		
    }
	
	/**
	* FORGOT PASSWORD THROUGH THE SMS
	* @author JOHN PETER
	* @return ARRAY
	*/
	function forgot_password_sms_post()
	{
		$this->form_validation->set_rules('phone', $this->phrases['phone'], 'xss_clean|numeric|required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run()==true){
				$mobile_no = $this->input->post('phone');
				$user_details = $this->base_model->fetch_records_from(TBL_USERS,array('phone'=>$mobile_no));
				if(!empty($user_details)){
					
					if($this->config->item('site_settings')->sms_notifications=='Yes'){
						
						$sms_details = $this->base_model->fetch_records_from(TBL_SMS_TEMPLATES,array('subject'=>'forgot_password_otp'));
						if(!empty($sms_details)){
							$content = strip_tags($sms_details[0]->sms_template);
							$content     	= str_replace("__OTP__", $this->input->post('otp_string'),$content);							
							$res = sendSMS($mobile_no,$content);
							if($res['result'] == 1)
							{
								$data = $user_details[0];
								$response = $res['message'];
								$status = 1;
							}
							else
							{	
								$data = array();
								$response = $res['message'];
								$status = 0;
							}
						}else{
							$data = array();
							$response	=	(isset($this->phrases['SMS notification template is not active,please contact admin'])) ? $this->phrases['SMS notification template is not active,please contact admin'] : 'SMS Notification Template is not active,Please Contact Admin';
							
							$status = 0;
						}
						
					}else{
							$data = array();
							$response	=	(isset($this->phrases['SMS notification is not enable,please contact admin'])) ? $this->phrases['SMS notification is not enable,please contact admin'] : 'SMS Notification is not Enable,Please Contact Admin';
							
							$status = 0;
					}
										
				}else{
					$data 		= array();
					$response	=	(isset($this->phrases['mobile number does not exists'])) ? $this->phrases['mobile number does not exists'] : 'Mobile Number does not exists';
					
					$status 	= 0;
				}
				
			}else{
				$data 		= array();
				$response 	= strip_tags(validation_errors());
				$status 	= 0;
			}
		$this->serviceResponse($data,$response,$status);
	}
	
	/**
	* RESET PASSWORD
	* @author JOHN PETER
	* @return 
	*/
	
	function reset_password_post()
	{
		$user_id    = $this->input->post('id');
		$user 		= $this->base_model->fetch_records_from(TBL_USERS,array('id'=>$user_id));
				
		if (!empty($user)) {

			$this->form_validation->set_rules('new_password', 
			$this->lang->line('reset_password_validation_new_password_label') , 
			'required|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 
			$this->lang->line('reset_password_validation_new_password_confirm_label') , 
			'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() 	== false	) {
					$response 	= strip_tags(validation_errors());
					$status 	= 0;		
				
			}
			else {
				
					$identity 					= $user[0]->{$this->config->item('identity', 
					'ion_auth') };
					$change 					= $this->ion_auth->reset_password(
					$identity, $this->input->post('new_password'));
					if ($change) {
						$response 	= strip_tags($this->ion_auth->messages());
						$status 	= 1;
					}
					else {
						$response = strip_tags($this->ion_auth->errors());
						$status = 0;						 
					}
		
			}
		}
		else {
			$response = 'User Not Found';
			$status = 0;
		}
		
		$this->serviceResponse(array(),$response,$status);
	}
	
	/**
	* Forgot Password
	* @author Navaneetha
	* @return boolean
	*/
	function forgot_password_post()
	{
		// get identity from username or email
		if ($this->config->item('identity', 'ion_auth') == 'username' ){
			$identity = $this->ion_auth->where('username', strtolower($this->post('email')))->users()->row();
		}
		else
		{
			$identity = $this->ion_auth->where('email', strtolower($this->post('email')))->users()->row();
		}
			
	    if(empty($identity)) 
		{			      
			$response	=	(isset($this->phrases['forgot password email not found'])) ? $this->phrases['forgot password email not found'] : 'Forgot Password Email Not Found';  	
		     
		     $status = 0;
			 $this->serviceResponse($data=array(),$response,$status);
		}
         
		//run the forgotten password method to email an activation code to the user
		$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

		if ($forgotten)
		{
			$response = strip_tags($this->ion_auth->messages());
			$status = 1;	
		}
		else
		{				
			$response = strip_tags($this->ion_auth->errors());
			$status = 0;			
		}
		
		$this->serviceResponse($data = array(),$response,$status);
	}
	
	// ACTIVE ACCOUNT ON SUCCESSFULLY OTP ENTERED
	
	function account_activate_post()
	{
		$email = $this->post('email');
		$data = array();
		$status = 0;
		$user = $this->base_model->fetch_records_from(TBL_USERS,array('email'=>$email));
		if(!empty($user)){
			$activation = $this->ion_auth->activate($user[0]->id,$user[0]->activation_code);
			if ($activation)
			{
				$data = $user;
				$response = $this->ion_auth->messages();
				$status = 1;
			}
			else
			{
				$response = strip_tags($this->ion_auth->errors());
				
			}
		}else{
			$response = 'Invalid Email Id';
			
		}
		$this->serviceResponse($data,$response,$status);
	}
	
	// Common Response Method 
	 
	 function serviceResponse($data=array(),$response,$status=0)
	 {
	 		$data = array('data'=>$data);
			$response = array('message'=>$response,'status'=>$status);
			$result = array();
			array_push($result,$data);
			array_push($result,array('response'=>$response));
			$this->response(json_decode(json_encode ($result), true), 200);	
	 }
}
