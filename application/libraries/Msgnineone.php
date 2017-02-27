<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

class Msgnineone
{
	
	private $authKey;
    private $senderId;
	
	public function __construct()
	{
		$this->_ci = & get_instance();
		$this->_ci->load->database();
		
		$query = 'SELECT sf.* FROM `dn_system_settings_fields` sf INNER JOIN `dn_sms_gate_ways` sst ON sf.sms_gateway_id = sst.sms_gateway_id WHERE sst.sms_gateway_name = "MSG91" ORDER BY field_name';		
		$gateway_details = $this->_ci->base_model->fetch_records_from_query_object( $query );
		
		if(count($gateway_details) > 0) {
			foreach($gateway_details as $selectedgateway) {
				switch($selectedgateway->field_key)
				{
					case 'AUTH':
						$this->authKey = $selectedgateway->field_output_value;
					break;
					case 'SENDER_ID':
						$this->senderId = $selectedgateway->field_output_value;
					break;
				}						
			}
		}
	}
	// Send SMS 
	 public function sendSMS($mobileNumber, $message)
    {
        //Your authentication key
        $authKey = $this->authKey;

        //Multiple mobiles numbers separated by comma
        $mobileNumber = $mobileNumber;

        //Sender ID,While using route4 sender id should be 6 characters long.
        $senderId = $this->senderId;

        //Your message to send, Add URL encoding here.
        $message = urlencode($message);

        //Define route 
        $route = "1";
        //Prepare you post parameters
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );

        //API URL
        $url="https://control.msg91.com/api/sendhttp.php";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }

        curl_close($ch);

        return $output;

    }
} 