<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crunchy_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');

	}
		
		
	/* GET SERVICE DELEIVERY LOCATIONS */
	
	function getServiceDeliveryLocation()
	{
		return $serviceLocations = $this->base_model->run_query('SELECT sl.*,c.city_name FROM '.DBPREFIX.'service_provide_locations sl,'.DBPREFIX.'pl_cities c WHERE sl.status="Active" AND c.city_id=sl.city_id AND c.status="Active"');
   }
	
	/* GET SERVICE DELEIVERY CITIES */
	
	function getServiceDeliveryCities()
	{
		return $serviceLocations = $this->base_model->run_query('SELECT distinct c.city_name,c.city_id FROM '.DBPREFIX.'service_provide_locations sl,'.DBPREFIX.'pl_cities c WHERE  sl.status="Active" AND c.city_id=sl.city_id AND c.status="Active"');
	}
	
	/**
	* return types and sub types
	* @param	Int $id
	* @return	void
	*/
	function get_types($parent_id = '')
	{
		$where = '';
		if(!empty($parent_id))
			$where = ' WHERE t1.parent_id = '. $parent_id;
			
		$query = 'SELECT t1.type_title child, (SELECT type_title FROM '.$this->db->dbprefix(TBL_SETTINGS_TYPES).' t2 WHERE t2.type_id = t1.parent_id) AS parent, t1.type_id, t1.parent_id FROM '.$this->db->dbprefix(TBL_SETTINGS_TYPES).' t1 '.$where.' ORDER BY parent_id ASC,t1.type_title ASC,child ASC';
		return $this->db->query($query)->result();
	}
	
	// FUNCTION FOR ADDING THE POINTS FOR FOR ORDER TO THE USER
	
	function check_for_first_order($user_id)
	{
		// $orders = $this->base_model->run_query('SELECT count(user_id) as cnt FROM '.DBPREFIX.TBL_ORDERS.' WHERE user_id='.$user_id);
		
		$orders = $this->base_model->run_query('SELECT * FROM '.DBPREFIX.TBL_ORDERS.' WHERE user_id='.$user_id." and status='delivered' ");
		
		if(!empty($orders))
		{
			// $orders = $orders[0];
			if(count($orders)==1)
			{
				$is_points_enabled = $this->config->item('points_settings')->points_enabled;
				
				if($is_points_enabled==1)
				{ 
					$points_for_first_order = $this->config->item('points_settings')->points_for_first_order;
					
					$data=array();
					$data['user_id'] 			= $user_id;
					$data['transaction_type'] 	= "Earned";
					$data['order_id'] 			= $orders[0]->order_id;
					$data['description'] 		= "Points for first order";
					$data['points'] 	 		= $points_for_first_order;
									
					if($this->base_model->insert_operation($data,TBL_USER_POINTS))
					{
						unset($data);
						$user=getUserRec($user_id);
						
						$dataa=array();
						$dataa['user_points']=($user->user_points)+ $points_for_first_order;
						
						
						if($this->base_model->update_operation($dataa,TBL_USERS,array('id'=>($user->id))))
						{
							unset($dataa);
							return true;
						}
						else
						{
							return false;
						}
						return true;
					}
					else
						return false;
			   }
			   else
				  return true; 
			}
			else
				return true;
		}
		else
			return true;
	}
	
	//FUNCTION FOR ADDING THE POINTS ON PURCHASING THE ORDER
	
	// SAVE USER POINTS
	
	function saveUserPoints($user_id,$points,$transaction_type,$order_id,$cancelled = '')
	{
		$input_data['user_id'] 			= $user_id;
		$input_data['points'] 			= $points;
		$input_data['transaction_type'] = $transaction_type;
		
		$input_data['order_id'] 		= $order_id;
		
		if($transaction_type=='Earned')
		{
			if($cancelled==1)
				$input_data['description'] = "Points reverted by cancelled item";
			else
				$input_data['description'] = "Points gained by buy item Order";
		}
		else
			$input_data['description'] = "Points redeemed by buy item Order";
		
		
		 if($this->base_model->insert_operation($input_data,TBL_USER_POINTS))
		 {
			if($transaction_type=='Earned')
			{
				$this->db->where('id',$user_id);
				$this->db->set('user_points', 'user_points+'.$points, FALSE);
				return $this->db->update($this->db->dbprefix('users'));
			}
			else
			{
				$this->db->where('id',$user_id);  
				$this->db->set('user_points', 'user_points-'.$points, FALSE);
				return $this->db->update($this->db->dbprefix('users'));
			} 
		 }
		 else
			 return false;
	}
	
	// DELETE USER POINTS 
	
	function deleteUserPoints($order_id)
	{
		$msg = "<ul>";
		$user_points_log = $this->base_model->fetch_records_from(TBL_USER_POINTS,array('order_id'=>$order_id));
		if(!empty($user_points_log)){
			foreach($user_points_log as $points_log){
				
				if($points_log->transaction_type=='Earned'){
					$this->db->where('id',$points_log->user_id);
					$this->db->set('user_points', 'user_points-'.$points_log->points, FALSE);
					$this->db->update($this->db->dbprefix('users'));
					$msg .= "<li>".$points_log->points." Points debited from User</li>";
				}else if($points_log->transaction_type=='Redeem'){
					$this->db->where('id',$points_log->user_id);
					$this->db->set('user_points', 'user_points+'.$points_log->points, FALSE);
					$this->db->update($this->db->dbprefix('users'));
					$msg .= "<li>".$points_log->points." Points credited back to user</li>";
				}
			}
		
		}else{
			$msg = "<li>No Points gained</li>";
		}
		
			return $msg."</ul>";
	}
	
	//ADD POINTS FOR SHARING THE APP
	function add_points_to_user_for_sharing($user_id)
	{
		$is_points_enabled = $this->config->item('points_settings')->points_enabled;
		
		if($is_points_enabled==1){
			$points_for_sharing_app = $this->config->item('points_settings')->points_for_sharing_app;
			$data['user_id'] 	 		 = $user_id;
			$data['transaction_type'] 	 = "Earned";
			$data['description'] = "Points for sharing";
			$data['points'] 	 = $points_for_sharing_app;
			//$data['date_added']  = date('Y-m-d H:i:s');
			
			if($this->base_model->insert_operation($data,TBL_USER_POINTS)){
				$this->db->where('id',$user_id);
				$this->db->set('user_points', 'user_points+'.$points_for_sharing_app, FALSE);
				$this->db->update($this->db->dbprefix('users'));
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	
	//ADD POINTS FOR REVIEW THE RESTAURANT
	function add_points_to_user_for_review($user_id)
	{
		$is_points_enabled = $this->config->item('points_settings')->points_enabled;
		
		if($is_points_enabled==1){
			$points_for_restaurant_review = $this->config->item('points_settings')->points_for_restaurant_review;
			$data['user_id'] 	 		 = $user_id;
			$data['transaction_type'] 	 = "Earned";
			$data['description'] = "Points for review the restaurant";
			$data['points'] 	 = $points_for_restaurant_review;
			//$data['date_added']  = date('Y-m-d H:i:s');
			
			if($this->base_model->insert_operation($data,TBL_USER_POINTS)){
				$this->db->where('id',$user_id);
				$this->db->set('user_points', 'user_points+'.$points_for_restaurant_review, FALSE);
				$this->db->update($this->db->dbprefix('users'));
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		} 
	}
    
    // FETCH CUSTOMERS
    
    function getCustomers()
    {
        return $this->base_model->run_query('SELECT u.*,g.name as role FROM '.DBPREFIX.TBL_USERS.' u,'.DBPREFIX.TBL_USER_GROUPS.' ug,'.DBPREFIX.TBL_GROUPS.' g where u.id=ug.user_id AND ug.group_id=2 AND g.id=ug.group_id');
    }
	
	function getUsers()
	{
		 return $this->base_model->run_query('SELECT u.*,g.name as role FROM '.DBPREFIX.TBL_USERS.' u,'.DBPREFIX.TBL_USER_GROUPS.' ug,'.DBPREFIX.TBL_GROUPS.' g where u.id=ug.user_id AND ug.group_id!=2 AND g.id=ug.group_id');
	}
     
    function getUserDetials($user_id)
    {
        return  $this->base_model->run_query('SELECT u.*,g.name,g.id as role_id FROM '.DBPREFIX.TBL_USERS.' u,'.DBPREFIX.TBL_USER_GROUPS.' ug,'.DBPREFIX.TBL_GROUPS.' g where u.id=ug.user_id AND u.id="'.$user_id.'" AND g.id=ug.group_id');
        
    }
	
	function getAddonGroupsDropdown()
	{
		$addonGroups = $this->base_model->run_query('SELECT ag.adgrp_id,ag.addon_group_name  FROM dn_groups_addons ga,dn_addon_groups ag WHERE ag.adgrp_id=ga.adgrp_id group by ag.adgrp_id');
		$option_data = array(
            '' => 'Select'
        );
		if(!empty($addonGroups)){
			foreach ($addonGroups as $key => $val) {
				$option_data[$val->adgrp_id] = $val->addon_group_name;
			}
        }
		return $option_data;
	}
	
}
?>