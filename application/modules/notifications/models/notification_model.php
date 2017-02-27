<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Notification_model extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
	}
	
	function get_devices_ids()
	{
		$users  = $this->base_model->fetch_records_from(TBL_USERS,array('active'=>'1'));
		$data = array();
		if(!empty($users)){
			foreach($users as $user){
				array_push($data,$user->device_id);
			}
		}
		return $data;
	}
}	

?>