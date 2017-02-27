<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model
{
 
 
    var $column_order = array('item_id','item_name','item_cost', 'item_type','menu_id','item_description','item_image_name','menu_name','status'); //set column field database for datatable orderable
    var $column_search = array('item_id','item_name','item_cost', 'item_type','dn_items.menu_id','item_description','item_image_name','menu_name','dn_items.status'); 
   var $order = array('item_id' => 'desc'); // default order 
    
	function __construct(){
		
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
	}
	
	/*** Add Options to Item ****/
	
	function addOptions($item_id,$option_count,$options_data = array())
	{
		$item_details = $this->base_model->fetch_records_from(TBL_ITEMS,array('item_id'=>$item_id));
		if (!empty($item_details)) {
			$option_details = $this->base_model->fetch_records_from(TBL_ITEM_OPTIONS,array('item_id'=>$item_id));
			if(!empty($option_details)){
				$where['item_id'] = $item_id;
				$this->base_model->delete_record(DBPREFIX.TBL_ITEM_OPTIONS,$where);
			}
			   
				$batch_data = array();
				for ($i = 1; $i < $option_count; $i++) {
					$data['option_id']      = $options_data['option_id' . $i];
					$data['item_id']     	= $item_id;
					$data['price']          = $options_data['price' . $i];
					
					array_push($batch_data, $data);
				}
				if ($this->db->insert_batch(DBPREFIX.TBL_ITEM_OPTIONS, $batch_data)) {
					return true;
				}else{
					return false;
				}
			
		}else{
			return false;
		}
        
	}
	
	/*** Add Addons to Item ****/
	
	function addAddons($item_id,$addon_data = array())
	{
		
		$item_details = $this->base_model->fetch_records_from(TBL_ITEMS,array('item_id'=>$item_id));
		if (!empty($item_details)) {
			$addon_details = $this->base_model->fetch_records_from(TBL_ITEM_ADDONS,array('item_id'=>$item_id));
			if(!empty($addon_details)){
				$where['item_id'] = $item_id;
				$this->base_model->delete_record(DBPREFIX.TBL_ITEM_ADDONS,$where);
			}
			   if(!empty($addon_data)){
				   				   
					$batch_data = array();
					foreach($addon_data as $addon){
						$data['addon_id']       = $addon;
						$data['item_id']     	= $item_id;
						array_push($batch_data, $data);
					}
					
					if ($this->db->insert_batch(DBPREFIX.TBL_ITEM_ADDONS, $batch_data)) {
						return true;
					}else{
						return false;
					}
				}
			return true;	
			
		}else{
			return false;
		}
        
	}
	
	function getItemAddons($item_id)
	{
		$addons_per_item = $this->base_model->fetch_records_from(TBL_ITEM_ADDONS,array('item_id'=>$item_id),'addon_id');
		
		$selected = array();
		 if(isset($addons_per_item)){
			 foreach($addons_per_item as $row){
				array_push($selected,$row->addon_id);
			}
		 }
		return $selected;
		
	}
	function getAppItemAddons($item_id)	{		return $this->base_model->run_query('SELECT a.*,ia.* FROM '.DBPREFIX.TBL_ADDONS.' a,'.DBPREFIX.TBL_ITEM_ADDONS.' ia WHERE ia.item_id='.$item_id.' AND a.status="Active" AND ia.addon_id=a.addon_id');	}
	function getItemOptions($item_id)
	{
		return $this->base_model->run_query('SELECT o.*,io.* FROM '.DBPREFIX.TBL_OPTIONS.' o,'.DBPREFIX.TBL_ITEM_OPTIONS.' io WHERE io.item_id='.$item_id.' AND o.status="Active" AND io.option_id=o.option_id');
	}
	
	// ajax data tables
	
	 private function _get_datatables_query()
    {
       $this->db->select(DBPREFIX.'items.*,'.DBPREFIX.'menu.menu_name');
       
		$this->db->from($this->db->dbprefix('items'));
		$this->db->join($this->db->dbprefix('menu'), $this->db->dbprefix('menu').'.menu_id = '.$this->db->dbprefix('items').'.menu_id');
		$query = $this->db->get();
 		 		 		
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->select(DBPREFIX.'items.*,'.DBPREFIX.'menu.menu_name');
        
        $this->db->from($this->db->dbprefix('items'));
		$this->db->join($this->db->dbprefix('menu'), $this->db->dbprefix('menu').'.menu_id = '.$this->db->dbprefix('items').'.menu_id');
		$query = $this->db->get();
        
       return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select(DBPREFIX.'items.*,'.DBPREFIX.'menu.menu_name');
        
		$this->db->from($this->db->dbprefix('items'));
		$this->db->join($this->db->dbprefix('menu'), $this->db->dbprefix('menu').'.menu_id = '.$this->db->dbprefix('items').'.menu_id');
		$query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->select(DBPREFIX.'items.*,'.DBPREFIX.'menu.menu_name');
        
		$this->db->from($this->db->dbprefix('items'));
		$this->db->join($this->db->dbprefix('menu'), $this->db->dbprefix('menu').'.menu_id = '.$this->db->dbprefix('items').'.menu_id');
		$query = $this->db->get();
        return $this->db->count_all_results();
    }
	
}	

?>