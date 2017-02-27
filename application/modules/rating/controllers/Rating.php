<?php 
class Rating extends MY_Controller
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
        $result_rating = $this->base_model->run_query( 'SELECT dn_food_rating.rating,dn_food_rating.restaurant_id,dn_food_rating.description,dn_users.first_name,dn_users.email,dn_users.phone,dn_items.item_name from dn_food_rating inner join dn_users on dn_food_rating.user_id = dn_users.id INNER JOIN dn_items ON dn_food_rating.item_id = dn_items.item_id');
        $user_id = json_decode(json_encode($result_rating),true);
        $this->data['result'] = $user_id;
         $this->data['active_class'] = ACTIVE_RATING;        $this->data['title']        = (isset($this->phrases['rating'])) ? Rating : "Rating"; $this->data['content']      = 'food_rating';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
     }
    function restaurant_rating()
    {
        $result_rating = $this->base_model->run_query( 'SELECT  dn_restaurant_rating.rating,dn_restaurant_rating.restaurant_id,dn_restaurant_rating.description,dn_users.first_name,dn_users.email,dn_users.phone from dn_restaurant_rating inner join dn_users on dn_restaurant_rating.user_id = dn_users.id');
        $user_id = json_decode(json_encode($result_rating),true);
        $this->data['result'] = $user_id;
         $this->data['active_class'] = ACTIVE_RATING;        $this->data['title']        = (isset($this->phrases['rating'])) ? Rating : "Rating"; $this->data['content']      = 'restaurant_rating';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
    }
}
?>
