<?php 
class Promotion extends MY_Controller
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
	       	$this->load->helper('inflector');
		
		}
    function index()
    {
         $this->data['active_class'] = ACTIVE_PROMOTION;        $this->data['title']        = (isset($this->phrases['promotion'])) ? Promotions : "promotion"; $this->data['content']      = 'promotion';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
     }
    function request_promotion(){
        if($this->input->post()){
        $package = $this->input->post('package');
        $select_sub_package = $this->input->post('select_sub_package');
        $description = $this->input->post('description');
        if($package!=""&&$select_sub_package!=""&&$description!=""){
        $data = array('package'=>$package,'sub_package'=>$select_sub_package,'description'=>$description);
        $return = $this->base_model->insert_operation($data,TBL_PROMOTION,$email = '');}else{$this->data['message']= "Select Manditory Fields";}
        if($return){$this->data['message'] = "Added Succefully";}$this->data['active_class'] = ACTIVE_PROMOTION;        $this->data['title']        = (isset($this->phrases['promotion'])) ? Promotions : "promotion"; $this->data['content']      = 'promotion';        $this->_render_page(TEMPLATE_ADMIN, $this->data);
        }
        
        else{
            $this->data['active_class'] = ACTIVE_PROMOTION;        $this->data['title']        = (isset($this->phrases['promotion'])) ? Promotions : "promotion"; $this->data['content']      = 'promotion';        $this->_render_page(TEMPLATE_ADMIN, $this->data);
            }}
    
}
?>
