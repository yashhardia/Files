<?php 
class Tax_management extends MY_Controller
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
			$this->load->helper('security');
	        $this->load->library('OneSignalPush');
	        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	        // Load MongoDB library instead of native db driver if required
	        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
	        $this->lang->load('auth');
	        $this->load->helper('language');
			check_access(ADMIN);
		}
    function index()
    {
        echo "heelo";
        $this->data['result'] = $user_id;
         $this->data['active_class'] = ACTIVE_TAX_MANAGEMENT;        $this->data['title']        = (isset($this->phrases['tax management'])) ? TaxManagement : "Rating"; $this->data['content']      = 'tax_management';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
     }
}
?>
