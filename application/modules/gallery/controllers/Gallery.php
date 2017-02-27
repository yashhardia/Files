 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Gallery extends MY_Controller
{
   /*
	| -----------------------------------------------------
	| PRODUCT NAME: 	RESTAURENT APP
	| -----------------------------------------------------
	| AUTHOR:			CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| -----------------------------------------------------
	| EMAIL:			samson@conquerorstech.net
	| -----------------------------------------------------
	| COPYRIGHTS:		CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| ----------------------------------------------------------
	| WEBSITE:			http://conquerorstech.net
	|                   http://conquerorstech.co.za
	| -----------------------------------------------------
	|
	| MODULE: 			GALLERY
	| -----------------------------------------------------
	| This is Gallery module controller file.
	| -----------------------------------------------------
	*/
    function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'ion_auth',
            'form_validation'
        ));
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('base_model');
        $this->load->library('upload');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
        $this->lang->load('auth');
        $this->load->helper('security');
        $this->load->helper('language');
		check_access(ADMIN);
    }
    // View Gallery
    function index()
    {
        $this->data['message']      = $this->session->flashdata('message');
        
        $this->data['ajaxrequest'] = array(
			'url' => URL_GALLERY_AJAX_GET_DATA,
			'disablesorting' => '0,4',
		);
        
        $this->data['active_class'] = ACTIVE_GALLERY;
        $this->data['title']        = (isset($this->phrases['gallery'])) ? $this->phrases['gallery'] : 'gallery';
        $this->data['content']      = 'view_gallery';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    // Add Gallery
    function add_gallery()
    {
        
        if ($this->input->post()) {
			$this->check_isdemo(URL_GALLERY);
            $this->form_validation->set_rules('alt_text', $this->phrases['alt text'], 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($_FILES['userfile']['name']) {
                $f_type  = explode(".", $_FILES['userfile']['name']);
                $last_in = (count($f_type) - 1);
                if (($f_type[$last_in] != "gif") && ($f_type[$last_in] != "jpg") && ($f_type[$last_in] != "png") && ($f_type[$last_in] != "jpeg")) {
					$msg = (isset($this->phrases['invalid file'])) ? $this->phrases['invalid file'] : "Invalid File";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADD_GALLERY);
                }
            }
            if ($this->form_validation->run() == TRUE) {
                $input_data['alt_text'] = $this->input->post('alt_text');
                $input_data['status']   = $this->input->post('status');
                $id                     = $this->base_model->insert_operation_id($input_data, TBL_GALLERY);
                if ($id) {
                    if (!empty($_FILES['userfile']['name'])) {
                        $config['upload_path']   = IMG_GALLERY_IMAGES;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = 'crunchy' . "_" . $id . "." . $f_type[$last_in];
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $where['gallery_id'] = $id;
                            $data['image_name']  = 'crunchy' . "_" . $id . "." . $f_type[$last_in];
                            $this->base_model->update_operation($data, TBL_GALLERY, $where);
							$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
                            $this->prepare_flashmessage($msg, 0);
                            redirect(URL_GALLERY);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                            redirect(URL_ADD_GALLERY);
                        }
                    }
                } else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_GALLERY);
                }
            } 
        } 
        $this->data['active_class'] = ACTIVE_GALLERY;
        $this->data['title']        = (isset($this->phrases['add gallery'])) ? $this->phrases['add gallery'] : 'Add Gallery';
        $this->data['content']      = 'add_gallery';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
	
	/*** Edit Gallery ****/
	function edit_gallery($param=null)
	{
		if($this->input->post()){
			$this->check_isdemo(URL_GALLERY);
			$this->form_validation->set_rules('alt_text', $this->phrases['alt text'], 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if ($_FILES['userfile']['name']) {
                $f_type  = explode(".", $_FILES['userfile']['name']);
                $last_in = (count($f_type) - 1);
                if (($f_type[$last_in] != "gif") && ($f_type[$last_in] != "jpg") && ($f_type[$last_in] != "png") && ($f_type[$last_in] != "jpeg")) {
					$msg = (isset($this->phrases['invalid file'])) ? $this->phrases['invalid file'] : "Invalid File";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADD_GALLERY);
                }
            }
            if ($this->form_validation->run() == TRUE) {
                $update_data['alt_text'] = $this->input->post('alt_text');
                $update_data['status']   = $this->input->post('status');
				$where['gallery_id']	 = $this->input->post('gallery_id');
                
                if ($this->base_model->update_operation($update_data, TBL_GALLERY,$where)) {
                    if (!empty($_FILES['userfile']['name'])) {
						$image_name = $this->input->post('image_name');
                        $config['upload_path']   = IMG_GALLERY_IMAGES;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = $image_name;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $msg = (isset($this->phrases['updated sucessfully'])) ? $this->phrases['updated sucessfully'] : "Updated Successfully";
                            $this->prepare_flashmessage($msg, 0);
                            redirect(URL_GALLERY,REFRESH);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                            redirect(URL_ADD_GALLERY);
                        }
                    }else{
						$msg = (isset($this->phrases['updated sucessfully'])) ? $this->phrases['updated sucessfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_GALLERY,REFRESH);
					}
                } else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable To update";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_GALLERY);
                }
            } 
		}
		
		$image_details = $this->base_model->fetch_records_from(TBL_GALLERY,array('gallery_id'=>$param));
		if(empty($image_details)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);
			redirect(URL_GALLERY);
		}
		$this->data['image_details'] = $image_details[0];
		$this->data['active_class'] = ACTIVE_GALLERY;
        $this->data['title']        = (isset($this->phrases['edit gallery'])) ? $this->phrases['edit gallery'] : 'Edit Gallery';
        $this->data['content']      = 'edit_gallery';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
      
    function delete_gallery()
    {
		
		if(!$this->check_isdemo_ajax(URL_GALLERY)){
		$id = $this->input->post('id');
		if(!empty($id))
		{			
			$ids = explode(',', $id);
			$details = $this->base_model->fetch_records_from_in(TBL_GALLERY, 'gallery_id', $ids);
			
			if(!empty($details))
			{				
				if($this->base_model->delete_record_in(TBL_GALLERY, 'gallery_id',$ids)){
					
				$this->load->helper("file");
				foreach($details as $recod)
				{
					if($recod->image_name != '')
					{
						if(file_exists(IMG_GALLERY_IMAGES .DS. $recod->image_name))
						{
							unlink(IMG_GALLERY_IMAGES .DS. $recod->image_name);
						}
						
					}
				}
					
					$msg = (isset($this->phrases['deleted successfully'])) ? $this->phrases['deleted successfully'] : "Deleted Successfully";
				echo json_encode(array('status' => 1, 'message' => $msg, 'action' => 'success','details'=>$details));
				}else{
					$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
				}
				
				
			}
			else
			{
				$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
			}
		}
		else
		{
			$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
		}
		}else{
			
			$msg = 'Access Denied on demo server';	
			echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
		}
	}
    
     /**
	 * Diaplays data
	 *
	 * @param	mixed	$type
	 * @return	void
	 */
	function ajax_get_data()
	{
		//$this->isAdmin();
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('gallery_id', 'alt_text', 'image_name','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_GALLERY, 'auto', $condition, $columns, array('gallery_id' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				$image = base_url().IMG_DEFAULT;
				if($record->image_name != '')
				{
					  $image = base_url().IMG_GALLERY_IMAGES .  $record->image_name;
				}
				$row[] = '<input id="checkbox-'.$record->gallery_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->gallery_id.'">';
				$row[] = '<span><img src="'.$image.'" height="100px" width="100px" class="img-responsive"/></span>';
                $row[] = '<span>'.$record->alt_text.'</span>';        
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				
				//add html for action
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->gallery_id . ',\''.URL_DELETE_GALLERY.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.URL_EDIT_GALLERY . '/' . $record->gallery_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				   <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->gallery_id . '" id="status_' . $record->gallery_id . '" name="check_' . $record->gallery_id . '" onclick="statustoggle(this, \'' .  URL_GALLERY_STATUSTOGGLE .'\')"'.$checked . '/>
					<div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_GALLERY, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_GALLERY, 'auto', $condition, $columns, array('gallery_id' => 'asc')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}        
	}
	
  
    
    /**
	 * Changes the status of the record
	 *
	 */
		
	function statustoggle()
	{
		if(!$this->check_isdemo_ajax(URL_GALLERY)){
		if($this->input->post())
		{
			$id = $this->input->post('id');
			$term_status = $this->input->post('status');
			$filedata = array();
			$message = '';
			if($term_status == 'false')
			{
				$filedata['status'] = 'Inactive';
				$message = $this->phrases['MSG DEACTIVATED'];
			}
			else
			{
				$filedata['status'] = 'Active';				
				$message = $this->phrases['MSG ACTIVATED'];
			}	
			$this->base_model->update_operation_in( $filedata, TBL_GALLERY, 'gallery_id', explode(',', $id) );
			echo json_encode(array('status' => 1, 'message' => $message, 'action' => 'success'));
		} 
		else
		{
			$message = $this->phrases['MSG WRONG OPERATION'];
			echo json_encode(array('status' => 0, 'message' => $message, 'action' => 'failed'));			
		}
		
		}else{
			
			$msg = 'Access Denied on demo server';	
			echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
		}
	}
} 
