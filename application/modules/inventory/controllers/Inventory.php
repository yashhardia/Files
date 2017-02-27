<?php 
class Inventory extends MY_Controller
{   
    function __construct(){
			parent::__construct();
			 $this->load->library(array(
				'ion_auth',
				'form_validation'
	        ));
	        $this->load->helper('url');
	        $this->load->model('base_model');
	       	
		}
    function index()
    {   
        $result = $this->base_model->fetch_records_from( TBL_ITEMS, $condition = '',$select = '*', $order_by = '',$order_type='asc',$limit='15' );
        $result = json_decode(json_encode($result),true);$this->data['result'] = $result;
        $this->data['active_class'] = ACTIVE_INVENTORY;        $this->data['title']        = (isset($this->phrases['inventory'])) ? Inventory : "Inventory"; $this->data['content']      = 'inventory';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
    }
    function show_edit($id=NULL)
    {    
          if($this->input->post())
           {  
              
              $item_id = $this->input->post('item_id');
              $check_box = $this->input->post('check_box');
              $stock = $this->input->post('stock');
               $out_of_stock = 0;
              $backorder = $this->input->post('backorder');if($backorder=='on'){$backorder = 1;}else {$backorder =0;};
              $inputdata = array('item_id'=>$item_id,'quantity'=>$stock,'backorder'=>$backorder,'out_of_stock'=>$out_of_stock);
              $id = $this->base_model->insert_operation_id( $inputdata, TBL_INVENTORY, $email = '' );
              if($id){ 
                $result = $this->base_model->fetch_records_from( TBL_ITEMS, $condition = '',$select = '*', $order_by = '',$order_type='asc',$limit='' );
                $result = json_decode(json_encode($result),true);$this->data['result'] = $result;            
                $message ="Added Succesfully";$this->data['message'] = $message;
                $this->data['active_class'] = ACTIVE_INVENTORY;        
                $this->data['title']        = (isset($this->phrases['inventory'])) ? Inventory : "Inventory"; 
                $this->data['content']      = 'inventory';        
                $this->_render_page(TEMPLATE_ADMIN, $this->data); }
            }else{
        $result = $this->base_model->fetch_records_from( TBL_ITEMS, $condition = 'item_id='.$id,$select = '*', $order_by = '',$order_type='asc',$limit='' );
        $result = json_decode(json_encode($result),true);
        $this->data['result'] = $result;
        $this->data['active_class'] = ACTIVE_INVENTORY;        
        $this->data['title']        = (isset($this->phrases['inventory'])) ? Inventory : "Inventory"; 
        $this->data['content']      = 'show_edit';        $this->_render_page(TEMPLATE_ADMIN, $this->data); }
    }
        function set_out()
        {       
           
              $item_id = $this->input->post('item_id');
              $stock = $this->input->post('stock');
              $backorder = $this->input->post('backorder');
              $out_of_stock = 1;
              if($backorder=='on'){$backorder = 1;}
              else {$backorder =0;};
              $inputdata = array('item_id'=>$item_id,'quantity'=>$stock,'backorder'=>$backorder,'out_of_stock'=>$out_of_stock);
              $id = $this->base_model->insert_operation_id( $inputdata, TBL_INVENTORY, $email = '' );
              if($id){echo 1;}else{echo 0;}
        }
}
?>
