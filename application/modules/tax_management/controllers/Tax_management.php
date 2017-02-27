<?php 
class Tax_Management extends MY_Controller
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
        if($this->input->post()){
        if($this->input->post('sequence')==NULL||$this->input->post('name')==NULL||$this->input->post('percent')==NULL||$this->input->post('description')==NULL){
        $this->data['message'] = "Please Fill Manditory Fields";
            }
           else{ $sequence = $this->input->post('sequence');
            $name = $this->input->post('name');
            $percent = $this->input->post('percent');
            $description = $this->input->post('description');
            $this->data['message'] = "Added Succefully";
            $data = array('tax_sequence'=>$sequence,'tax_name'=>$name,'percent'=>$percent,'description'=>$description);
            $result = $this->base_model->insert_operation($data, TBL_TAX_MANAGEMENT, $email = '');
            }}
        $this->data['active_class'] = ACTIVE_TAX_MANAGEMENT;        
        $this->data['title']        = (isset($this->phrases['tax management'])) ? TaxManagement : "Rating"; 
        $this->data['content']      = 'tax_management';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
    }
}
?>
