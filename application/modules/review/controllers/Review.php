<?php 

	
	class Review extends MY_Controller
	{
		function __construct(){
			parent::__construct();
			
			 $this->load->library(array(
            'ion_auth',
            'form_validation'
	        ));
	        $this->load->helper('url');
	        $this->load->database();
	        $this->load->model('base_model');
	   
		}
	function index()
	{   
        $result_review = $this->base_model->run_query('SELECT customer_id,table_id,order_id,description,dn_users.first_name,dn_users.email,dn_users.phone from dn_review inner join dn_users on dn_review.customer_id = dn_users.id');
        $user_name = json_decode(json_encode($result_review),true);
        $this->data['result']=$user_name;                              
        $this->data['active_class'] = ACTIVE_REVIEW;        
        $this->data['title']        = (isset($this->phrases['review'])) ? Review : "Reviews"; 
        $this->data['content']      = 'review';        
        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
	}
    function reply($id)
     {
    $result_review = $this->base_model->fetch_records_from(TBL_USERS, $condition = 'id='.$id,$select = 'first_name', $order_by = '',$order_type='asc',$limit='' );          $user_name = json_decode(json_encode($result_review),true);
     $table = $this->input->get('table');
     $this->data['result'] = array('id'=>$id,'user_name'=>$user_name[0]['first_name'],'table_id'=>$table);
     $this->data['active_class'] = ACTIVE_REVIEW;   
     $this->data['title']        = (isset($this->phrases['review'])) ? Reply : "Reviews"; 
     $this->data['content']      = 'reply';        
     $this->_render_page(TEMPLATE_ADMIN, $this->data);
     }
	
}
?>
