<?php
class Infotainment extends MY_Controller {


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
	public function add_category()
	{    
		
		$p_category = $this->base_model->fetch_records_from(TBL_INFOTAINMENT, $condition = "parent_category=0",$select = '*', $order_by = '',$order_type='asc',$limit='' );
		$array = json_decode(json_encode($p_category), true);
		$this->data['data'] = $array;
		if ($this->input->post()) 
		{	

			$category_name = $this->input->post('category_name');
			$parent_category = $this->input->post('parent_category');
			if($parent_category == '0')$parent_category='0';
            if($category_name!=NULL){
			$data = array('category_name'=>$category_name,'parent_category'=>$parent_category);
			$this->base_model->insert_operation($data,TBL_INFOTAINMENT, $email = '' );
            
		}  }
        $this->data['active_class'] = ACTIVE_INFOTAINMENT;        $this->data['title']        = (isset($this->phrases['infotainment'])) ? AddCategory : "Mail"; $this->data['content']      = 'add_category';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
	}
	public function add_media()
	{   
		
		$p_category = $this->base_model->fetch_records_from(TBL_INFOTAINMENT, $condition = 'parent_category=0',$select = '*', $order_by = '',$order_type='asc',$limit='' );
		$sub_category = $this->base_model->fetch_records_from(TBL_INFOTAINMENT, $condition = 'parent_category!=0',$select = '*', $order_by = '',$order_type='asc',$limit='' );  
		$array = json_decode(json_encode($p_category), true);
        $this->data['data'] = $array;
		$array2 = json_decode(json_encode($sub_category), true);
		$data['sub_category'] = $array2;
		$this->data['sub_category'] = $array2;
		if ($this->input->post()) 
		{        
            $input_data['media_name']           = $this->input->post('media_name');;
	        $input_data['file_name']           = $_FILES["userfile"]["name"];
			$input_data['category']            = $this->input->post('parent_category');
			$input_data['sub_category']            = $this->input->post('sub_category');
			$input_data['description']             = $this->input->post('description');
            if($input_data['category']!=0){
			$id = $this->base_model->insert_operation_id($input_data, TBL_INFOTAINMENT_MEDIA);}
			 if($id){
   //                  if(move_uploaded_file($_FILES["userfile"]["tmp_name"],"uploads/media/".$_FILES["userfile"]["name"])){redirect('infotainment/view_list');}                        		
		 //            }
			 	$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
						$config['upload_path']   = IMG_MEDIA;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = MEDIA . "_" . $id. "." . $ext;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
							$update_data['file_name'] = MEDIA . "_" . $id. "." . $ext;
							$this->base_model->create_thumbnail(IMG_MEDIA.MEDIA.'_'.$id.'.' . $ext,'uploads',100,100);
							$where['media_id'] = $id;
							$this->base_model->update_operation($update_data, TBL_INFOTAINMENT_MEDIA, $where);
        }
    }}
$this->data['active_class'] = ACTIVE_INFOTAINMENT;        $this->data['title']        = (isset($this->phrases['infotainment'])) ? $this->phrases['infotainment'] : "Mail"; $this->data['content']      = 'add_media';        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	
	}
	public function view_list()
	{
		$list = $this->base_model->run_query('SELECT file_name,media_name,category_name,dn_infotainment_media.sub_category sub_category,dn_infotainment_media.description FROM `dn_infotainment` inner JOIN  dn_infotainment_media on dn_infotainment.category_id = dn_infotainment_media.category');
		$this->data['data'] = $list_array = json_decode(json_encode($list), true);
		
	
$this->data['active_class'] = ACTIVE_INFOTAINMENT;        $this->data['title']        = (isset($this->phrases['infotainment'])) ? $this->phrases['infotainment'] : "Mail"; $this->data['content']      = 'view_list';        $this->_render_page(TEMPLATE_ADMIN, $this->data);}


public function view_category()
	{
    $category = $this->base_model->run_query('SELECT A.category_name as category, B.category_name as parent FROM dn_infotainment A Left Join dn_infotainment B on A.parent_category = B.category_id');
    $this->data['parent_category'] = json_decode(json_encode($category),true);   
    $this->data['active_class'] = ACTIVE_INFOTAINMENT;        
    $this->data['title']        = (isset($this->phrases['infotainment'])) ? $this->phrases['infotainment'] : "Mail"; 
    $this->data['content']      = 'view_category';        $this->_render_page(TEMPLATE_ADMIN, $this->data);}

}
?>
