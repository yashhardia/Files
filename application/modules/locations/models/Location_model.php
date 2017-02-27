<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model
{
	  
	var $column_order = array('service_provide_location_id','locality','pincode', 'dn_service_provide_locations.city_id','dn_pl_cities.city_name','dn_service_provide_locations.status'); 
	   
    var $column_search = array('service_provide_location_id','locality','pincode', 'service_provide_locations.city_id','dn_pl_cities.city_name','dn_service_provide_locations.status'); 
   
   var $order = array('service_provide_location_id' => 'desc');  
	
	function __construct(){
		parent::__construct();
		
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
	}
	
	/*GET CITIES*/
	public function getCities($param = '')
	{
		$cities_rec =  $this->base_model->run_query("SELECT * FROM ".DBPREFIX."pl_cities WHERE  and status = 'Active' order by city_name ");
		
		return $cities_rec; 
		
	}
	
	 private function _get_datatables_query()
    {
        
        $this->db->select('dn_service_provide_locations.*,dn_pl_cities.city_name');
		$this->db->from($this->db->dbprefix('service_provide_locations'));
		$this->db->join($this->db->dbprefix('pl_cities'), $this->db->dbprefix('pl_cities').'.city_id = '.$this->db->dbprefix('service_provide_locations').'.city_id');
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
         $this->db->select('dn_service_provide_locations.*,dn_pl_cities.city_name');
         
		$this->db->from($this->db->dbprefix('service_provide_locations'));
		$this->db->join($this->db->dbprefix('pl_cities'), $this->db->dbprefix('pl_cities').'.city_id = '.$this->db->dbprefix('service_provide_locations').'.city_id');
		$query = $this->db->get();
        
       return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $this->db->select('dn_service_provide_locations.*,dn_pl_cities.city_name');
        
		$this->db->from($this->db->dbprefix('service_provide_locations'));
		$this->db->join($this->db->dbprefix('pl_cities'), $this->db->dbprefix('pl_cities').'.city_id = '.$this->db->dbprefix('service_provide_locations').'.city_id');
		$query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->select('dn_service_provide_locations.*,dn_pl_cities.city_name');
        
		$this->db->from($this->db->dbprefix('service_provide_locations'));
		$this->db->join($this->db->dbprefix('pl_cities'), $this->db->dbprefix('pl_cities').'.city_id = '.$this->db->dbprefix('service_provide_locations').'.city_id');
		$query = $this->db->get();
        return $this->db->count_all_results();
    }
	
}
?>