<?php

class Infotainment extends Base_Model 
{
	 function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');

	}
     function add_category($data)

    {
     $this->db->insert('dn_infotainment',$data);
    }
     function add_media($media = array())
    {
        
    }
}
?>
