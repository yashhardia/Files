<?php 
class Configurations extends MY_Controller
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
    }
    function add_configurations()
    {
        
        $this->data['active_class'] = ACTIVE_CONFIGURATIONS;        $this->data['title']        = (isset($this->phrases['configurations details'])) ? Configurations : "Mail"; $this->data['content']      = 'configurations';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
     }
}
?>
