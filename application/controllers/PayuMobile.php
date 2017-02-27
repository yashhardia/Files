<?php defined('BASEPATH') OR exit('No direct script access allowed');
class PayuMobile extends MY_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
		 
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language','date'));
		$this->load->model('base_model');
		$this->load->model('ion_auth_model');
		$this->load->helper('security');
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
			
    }
	
	public function dopayMobile()
	{
		
		$data 		= array();
		$response 	= "Payment not done";
		$status     = 0; 
		
		$payment_details = array();
		$payment_details['user_id']          = $this->input->get('userId');
		$payment_details['email']      = $this->input->get('email');
		$payment_details['amount'] 			= $this->input->get('total_cost');
		$payment_details['order_date']       = date("Y-m-d", strtotime($this->input->get('order_date')));
        $payment_details['order_time']       = $this->input->get('order_time');
        $payment_details['total_cost']       = $this->input->get('total_cost');
        $payment_details['customer_name']    = $this->input->get('customer_name');
        $payment_details['phone']            = $this->input->get('phone');
        $payment_details['house_no']         = $this->input->get('house_no');
        $payment_details['address']         = $this->input->get('address');
        $payment_details['apartment_name']   = $this->input->get('apartment_name');
        $payment_details['pincode']   = $this->input->get('pincode');
        $payment_details['other']   		 = $this->input->get('other');
        $payment_details['landmark']         = $this->input->get('landmark');
        $payment_details['city']             = $this->input->get('city');
        
        $payment_details['order_type']     	 = $this->input->get('order_type');
        $payment_details['status']           = "new";
		$payment_details['message']          = $this->input->get('message');
        $payment_details['payment_type']     = $this->input->get('payment_type');
        $payment_details['no_of_items']      = $this->input->get('no_of_items');
        $payment_details['order_by_device_id']      = $this->input->get('order_by_device_id');
        $payment_details['isAddons']      = $this->input->get('isAddons');
        
		 
        $payment_details['addons_summary']      = $this->input->get('addons_summary');
        $payment_details['order_summary']      = $this->input->get('order_summary');
        
        $payment_details['date_updated']     = date('Y-m-d');
		$this->session->set_userdata('pay_details',$payment_details);
		
		$payment_settings 	= $this->config->item('payu_settings');
		
		$MERCHANT_KEY 		= $payment_settings->merchant_key;
		$SALT 				= $payment_settings->salt;
		$PAYU_BASE_URL 		= $payment_settings->test_url;
		if($payment_settings->account_type=='live'){
			$PAYU_BASE_URL 		= $payment_settings->live_url;;	
		}
		
		$action 				= '';
		$posted 				= array();
		$posted['key'] 			= $MERCHANT_KEY;
		$posted['txnid'] 		= substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		
		$posted['amount'] 		= $this->input->get('total_cost');
		$posted['firstname'] 	= $this->input->get('customer_name');
		$posted['email'] 		= $this->input->get('email');
		$posted['phone'] 		= $this->input->get('phone');
		$posted['productinfo']  = 'Crunchy';
		$posted['surl'] 		= base_url().'payuMobile/payDone';
		$posted['furl'] 		= base_url().'payuMobile/payFailure';
		$posted['service_provider'] = 'payu_paisa';
		
		$formError 							= 0;

		if(empty($posted['txnid'])) {
		  // Generate random transaction id
		  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		} else {
		  $txnid = $posted['txnid'];
		}
		$hash = '';
		// Hash Sequence
		$hashSequence = 
		"key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
		
		if(empty($posted['hash']) && sizeof($posted) > 0) {
		  if(
		          empty($posted['key'])
		          || empty($posted['txnid'])
		          || empty($posted['amount'])
		          || empty($posted['firstname'])
		          || empty($posted['email'])
		          || empty($posted['phone'])
		          || empty($posted['productinfo'])
		          || empty($posted['surl'])
		          || empty($posted['furl'])
				  || empty($posted['service_provider'])
		  ) {
		  	redirect('payuMobile/payFailure');
		    $formError 		= 1;
		  } else {
		  	$hashVarsSeq 	= explode('|', $hashSequence);
		    $hash_string 	= '';	
			foreach($hashVarsSeq as $hash_var) {
		      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
		      $hash_string .= '|';
		    }
			$hash_string 	.= $SALT;
			$hash 			= strtolower(hash('sha512', $hash_string));
		    $posted['hash'] = $hash;
		    $action 		= $PAYU_BASE_URL . '/_payment';
		    $data['action'] = $action;
		 	$data['posted'] = $posted;
			
			//echo "<pre>";
			
			//print_r($data); die();
			
			$this->load->view('admin/pay-submit-form',$data);
		  }
		} elseif(!empty($posted['hash'])) {
		  $hash 			= $posted['hash'];
		  $action 			= $PAYU_BASE_URL . '/_payment';
 		  $data['action'] 	= $action;
		  $data['posted'] 	= $posted;
		  $this->load->view('admin/payu/pay-submit-form',$data);
		}
		
	}
	
	public function payDone()
	{
				
		$payment_settings 	= 	$this->config->item('payu_settings');
		$SALT 				= 	$payment_settings->salt;
		$status				=	$_POST["status"];
		$firstname  		= 	$_POST["firstname"];
		$amount				=	$_POST["amount"];
		$txnid				=	$_POST["txnid"];
		$posted_hash		=	$_POST["hash"];
		$key				=	$_POST["key"];
		$productinfo		=	$_POST["productinfo"];
		$email				=	$_POST["email"];
		$salt				=	$SALT;
		$payment_details 	= $this->session->userdata('pay_details');
		
		$user = $this->base_model->fetch_records_from(TBL_USERS,$payment_details['user_id']);
		
		if (isset($_POST["additionalCharges"])) {
		       $additionalCharges=$_POST["additionalCharges"];
		        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'
		        .$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
		else {	  
		        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'
		        .$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		}
		
		$hash = hash("sha512", $retHashSeq);
	    if ($hash != $posted_hash) {
			$this->data['status'] = "invalid";
	    }
	    else {
			
		$payment_details 				= $this->session->userdata('pay_details');
		$this->data['payment_details'] 	= $payment_details;
		$input_data['transaction_id']	= $txnid;
			
		$input_data['order_date']       = date("Y-m-d", strtotime($payment_details['order_date']));
		$input_data['user_id']          = $payment_details['user_id'];
        $input_data['order_time']       = $payment_details['order_time'];
        $input_data['total_cost']       = $payment_details['amount'];
        $input_data['customer_name']    = $payment_details['customer_name'];
        $input_data['phone']            = $payment_details['phone'];
        $input_data['house_no']         = $payment_details['house_no'];
        $input_data['apartment_name']   = $payment_details['apartment_name'];
        $input_data['other']   			= $payment_details['other'];
        $input_data['landmark']         = $payment_details['landmark'];
        $input_data['city']             = $payment_details['city'];
        
        $input_data['order_type']     	= $payment_details['order_type'];
        $input_data['status']           = "new";
		$input_data['message']          = '';
        $input_data['payment_type']     = 'online';
        $input_data['payment_gateway']     = 'PayU';
        $input_data['no_of_items']      = $payment_details['no_of_items'];
        $input_data['device_id']      = $payment_details['order_by_device_id'];
        
        $input_data['date_updated']     = date('Y-m-d');
		
		$input_data['paid_date']      	= date('Y-m-d');
		$input_data['paid_amount']     	= $payment_details['amount'];
		$input_data['payer_name']      	= $payment_details['customer_name'];
		$input_data['payer_email']      = $payment_details['email'];
		$input_data['payment_status']   = $status;
		
		
        if ($this->base_model->insert_operation($input_data,TBL_ORDERS)) {
            $order_id = $this->db->insert_id();
           
			if($payment_details['isAddons']!=0){
									
				$addons_summarys = json_decode($payment_details['addons_summary']);
				$summary_data     = array();
				foreach ($addons_summarys as $addon) {
                	array_push($summary_data, array(
						"order_id" => $order_id,
						"addon_name" => $addon->addon_name,
						"price"=>$addon->price,
						"quantity"=>$addon->quantity,
						"final_cost"=>$addon->finalCost,
						"is_deleted"=>0
					));
				}
				$this->db->insert_batch(DBPREFIX.TBL_ORDER_ADDONS, $summary_data);
			}
            
			$summarys = json_decode($payment_details['order_summary']);
            $products_data     = array();
            foreach ($summarys as $summary) {
                
                array_push($products_data, array(
                    "order_id" => $order_id,
                    "item_name" => $summary->item_name,
					"size_id"=>$summary->size_id,
					"size_name"=>$summary->size_name,
					"item_size_id"=>$summary->item_size_id,
					"size_price"=>$summary->size_price,
                    "item_qty" => $summary->quantity,
                    "item_cost" => $summary->item_cost,
                    "final_cost" => $summary->finalCost
                ));
            }
			
            if ($this->db->insert_batch(DBPREFIX.TBL_ORDER_PRODUCTS, $products_data)) {
				
				/**send email to user**/
				$email_template = $this->db->get_where(DBPREFIX.TBL_EMAIL_TEMPLATES,array('subject'=>'when_user_order_booked_template_mail_to_user','status'=>'Active'))->result();
				
				if(count($email_template)>0) 
				{
					
					$from 	= $this->config->item('site_settings')->portal_email;
					$to 	= $payment_details['email'];
					$sub 	= $this->config->item('site_settings')->site_title 
				. ' - ' . (isset($this->phrases['order'])) ? $this->	phrases['order'] : " ORDER ";
				
					$email_template = $email_template[0];			
					$content 		= $email_template->email_template;
					
					$content     	= str_replace("__USER_NAME__",ucwords($payment_details['customer_name']),$content);
					
					$content     	= str_replace("__SITE_TITLE__",$this->config->item('site_settings')->site_title,$content);
					
					$content 		= str_replace("__ORDER_TYPE__",ucfirst($payment_details['order_type']),$content);
					
					$content 	= str_replace("__NO_OF_ITEMS__", $payment_details['no_of_items'],$content);

					$content 		= str_replace("__ORDER_TIME__", $payment_details['order_time'],$content);
				
					$content 		= str_replace("__TOTAL_COST__", $payment_details['amount'].' '.$this->config->item('site_settings')->currency_symbol,$content);
				
					$content 		= str_replace("__PAYMENT_MODE__",ucfirst($payment_details['payment_type']),$content);
					
					$content 		= str_replace("__CUSTOMER_MESSAGE__",'',$content);
					
					$content 		= str_replace("__CONTACT_US__",$this->config->item('site_settings')->land_line,$content);
				
					$content 		= str_replace("__SITE_TITLE__", $this->config->item('site_settings')->site_title,$content);
				
					$content 		= str_replace("__COPY_RIGHTS__", $this->config->item('site_settings')->rights_reserved_content,$content);
					
					sendEmail($from, $to, $sub, $content);
								
					// SEND SMS IF ENABLE
					if($this->config->item('site_settings')->sms_notifications=='Yes'){
						
						$sms_details = $this->base_model->fetch_records_from(TBL_SMS_TEMPLATES,array('subject'=>'order_saved'));
						if(!empty($sms_details)){
							$content = strip_tags($sms_details[0]->sms_template);
							$content     	= str_replace("__SITE__TITLE__", $this->config->item('site_settings')->site_title,$content);
							$content     	= str_replace("__ORDER__NO__", $order_id,$content);
							$content     	= str_replace("__TOTAL__COST__", $payment_details['amount'],$content);
							$mobile_number 	= $payment_details['phone'];
							sendSMS($mobile_number,$content);
						}
						
					}
					// SEND SMS END
				}
							
				$email_template = $this->db->get_where(DBPREFIX.TBL_EMAIL_TEMPLATES,array('subject'=>'when_user_order_booked_template_mail_to_admin','status'=>'Active'))->result();
				
				if(count($email_template)>0) 
				{
					
					$from 	= $payment_details['email'];
					$to 	= $this->config->item('site_settings')->portal_email;
					$sub 	= $this->config->item('site_settings')->site_title 
				. ' - ' . (isset($this->phrases['order'])) ? $this->	phrases['order'] : " ORDER ";
				
					$email_template = $email_template[0];			
					$content 		= $email_template->email_template;
					
					$content     	= str_replace("__SITE_TITLE__",$this->config->item('site_settings')->site_title,$content);
					
					$content     	= str_replace("__USER_NAME__", $payment_details['customer_name'],$content);
					
					
					$content     	= str_replace("__EMAIL__", $payment_details['email'],$content);
					
					$content     	= str_replace("__PHONE__", $payment_details['phone'],$content);
					
					$content     	= str_replace("__ADDRESS__", $payment_details['address'],$content);
					
					$content     	= str_replace("__LAND_MARK__", $payment_details['landmark'],$content);
					
					$content     	= str_replace("__CITY__", $payment_details['city'],$content);
										
					$content     	= str_replace("__PIN_CODE__", $payment_details['pincode'],$content);
					
					$content 		= str_replace("__ORDER_TYPE__", $payment_details['order_type'],$content);
					
					$content 	= str_replace("__NO_OF_ITEMS__", $payment_details['no_of_items'],$content);

					$content 		= str_replace("__ORDER_TIME__", $payment_details['order_time'],$content);
				
					$content 		= str_replace("__TOTAL_COST__", $payment_details['amount'].' '.$this->config->item('site_settings')->currency_symbol,$content);
				
					$content 		= str_replace("__PAYMENT_MODE__", "PayU",$content);
					
					$content 		= str_replace("__CUSTOMER_MESSAGE__", "",$content);
					
					$content 		= str_replace("__CONTACT_US__", $this->config->item('site_settings')->address,$content);
				
					$content 		= str_replace("__SITE_TITLE__", $this->config->item('site_settings')->site_title,$content);
				
					$content1 		= str_replace("__COPY_RIGHTS__", $this->config->item('site_settings')->rights_reserved_content,$content);
					
					sendEmail($from, $to, $sub, $content1);
				}
				
				
                $data 		= array('order_id'=>$order_id);
				$response 	= "Order Saved Successfully";
				$status		= 1;
				$this->session->unset_userdata('payment_details');
				redirect('payuMobile/success');
            } else {
					$this->base_model->delete_record(TBL_ORDERS,array('order_id'=>$order_id));
					$data = array();
					$response = 'Unable To Save Order';
					$status	=	0;
					$this->session->unset_userdata('payment_details');
					redirect('payuMobile/success');
            }
        } else {
				$data = array();
				$response = 'Unable To Save Order';
				$status	=	0;
            	redirect('payuMobile/payFailure');
        }
	 }
	}
	
	public function payFailure()
	{
		
	}
	
	public function failure()
	{
		
	}
	
	function success()
	{
		
		
	}
}