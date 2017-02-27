<?php 
class Concerns extends MY_Controller
{   
    function __construct(){
			parent::__construct();
			 $this->load->library(array(
				'ion_auth',
				'form_validation'
	        ));
	        $this->load->model('base_model');
			check_access(ADMIN);
		}
    function index()
    {
    }
    function save_concern()
    {
        if($this->input->post()){
        
        $name = $this->input->post('name');
        $mobile = $this->input->post('mobile');
        $email = $this->input->post('email');
        $subject = $this->input->post('subject');
        $concern = $this->input->post('concern');if($name!=""&&$mobile!=""&&$subject!=""&&$email!=""&&$concern!=""){
        $this->data['message']="Concern Requested Succefully";
        $data = array('name'=>$name,'mobile_number'=>$mobile,'email_id'=>$email,'subject'=>$subject,'concern'=>$concern);  
        $id =  $this->base_model->insert_operation_id($data,TBL_CONCERN);}else {$this->data['message']="Please Select Mandetory Fileds";}
        }
        $this->data['active_class'] = ACTIVE_CONCERNS;        $this->data['title']        = (isset($this->phrases['concerns'])) ? Concerns : "Mail"; $this->data['content']      = 'save_concern';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
     }
}
?>
