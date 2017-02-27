<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

 class Items extends MY_Controller
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
        $this->load->model('crunchy_model');
        $this->load->model('item_model');
		$this->load->helper('inflector');
		$this->load->helper('security');
        $this->load->library('upload');
        
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        // Load MongoDB library instead of native db driver if required
        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
        $this->lang->load('auth');
        $this->load->helper('language');
		check_access(ADMIN);
	}
	
	function index()
    {
           
        $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
        $this->data['ajaxrequest'] = array(
			'url' => URL_ITEM_AJAX_GET_DATA,
			'disablesorting' => '0,4',
		);
		
        $this->data['active_class'] = ACTIVE_ITEMS;
        $this->data['title']        = (isset($this->phrases['items'])) ? $this->phrases['items'] : "Items";
        $this->data['content']      = 'items';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
	
	/*** Function For Adding Items ****/
    function add_item()
    {
        if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_ITEMS);
			
            $this->form_validation->set_rules('menu_name', $this->phrases['menu'], 'required');
            $this->form_validation->set_rules('item_name', $this->phrases['item name'], 'required');
            $this->form_validation->set_rules('item_cost', $this->phrases['item cost'], 'required|numeric');
            $this->form_validation->set_rules('item_type', $this->phrases['item type'], 'required');
            $this->form_validation->set_rules('description', $this->phrases['description'], 'required');
            
            if(empty($_FILES['userfile']['name']))
			{
				$this->form_validation->set_rules('userfile', $this->phrases['item image'], 'required');
			}
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
            if ($this->form_validation->run() == TRUE) {
                $input_data['menu_id']      	= $this->input->post('menu_name');
                $input_data['item_name']        = $this->input->post('item_name');
                $input_data['item_cost']        = $this->input->post('item_cost');
                $input_data['item_type']        = $this->input->post('item_type');
                $input_data['item_description'] = $this->input->post('description');
                $input_data['status']           = $this->input->post('status');
                $id                             = $this->base_model->insert_operation_id($input_data, TBL_ITEMS);
                if ($id) {
                	
                	if($this->input->post('addons')){
						$this->item_model->addAddons($id,$this->input->post('addons'));							    }
                	
                    if (!empty($_FILES['userfile']['name'])) {
						 $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $config['upload_path']   = IMG_ITEMS;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = ITEM . "_" . $id . "." . $ext;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $where['item_id']          = $id;
                            $update_data['item_image_name'] = ITEM . "_" . $id . "." . $ext;
							
							$this->create_thumbnail(IMG_ITEMS.ITEM.'_'.$id.'.' . $ext,IMG_ITEMS_THUMB,100,100);
							
                            $this->base_model->update_operation($update_data, TBL_ITEMS, $where);
							$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_ADMIN_ITEMS, REFRESH);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                            redirect(URL_ADMIN_ITEMS);
                        }
                    }
                } else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_ITEMS, REFRESH);
                }
            }
        }
        $this->data['addons'] = $this->base_model->prepareDropdown(TBL_ADDONS,'addon_id','addon_name',array('status'=>'Active'));
        $this->data['menus']   		= $this->base_model->prepareDropdown(TBL_MENU, 'menu_id', 'menu_name', array(
            'status' => 'Active'
        ));
        $this->data['active_class'] = ACTIVE_ITEMS;
        $this->data['title']        = (isset($this->phrases['add item'])) ? $this->phrases['add item'] : "Add Item";
        $this->data['content']      = 'add_item';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** End Of Adding Items ****/
    /*** Editing Items ****/
    function edit_item($item_id = null)
    {
        if ($this->input->post()) {
        	$this->check_isdemo(URL_ADMIN_ITEMS);
			// FOR SAVING THE OPTIONS DATA
			if($this->input->post('option')){
								
			$item_id = $this->input->post('item_id');
			 $this->form_validation->set_rules('option_counts','Option Count' , 'required|numeric');
			  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
             if ($this->form_validation->run() == TRUE) {
				 $option_count = $this->input->post('option_count');
				if($this->item_model->addOptions($item_id,$option_count,$this->input->post())){
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_EDIT_ITEMS.DS.$item_id);
				}else{
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_EDIT_ITEMS.DS.$item_id);
				}
			 }else{
				 $this->prepare_flashmessage(validation_errors(),1);
				 redirect(URL_EDIT_ITEMS.DS.$item_id);
			 }
			}
						
			$item_id = $this->input->post('item_id');
            $this->form_validation->set_rules('menu_name', $this->phrases['menu name'], 'required');
            $this->form_validation->set_rules('item_name', $this->phrases['item name'], 'required|callback_checkduplicate[item_name]');
            $this->form_validation->set_rules('item_cost', $this->phrases['item cost'], 'required|numeric');
            $this->form_validation->set_rules('item_type', $this->phrases['item type'], 'required');
            $this->form_validation->set_rules('description', $this->phrases['description'], 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $input_data['menu_id']      	= $this->input->post('menu_name');
                $input_data['item_name']        = $this->input->post('item_name');
                $input_data['item_cost']        = $this->input->post('item_cost');
                $input_data['item_type']        = $this->input->post('item_type');
                $input_data['item_description'] = $this->input->post('description');
                $input_data['status']           = $this->input->post('status');
                $id                             = $this->input->post('item_id');
                $where['item_id']               = $id;
                if ($this->base_model->update_operation($input_data, TBL_ITEMS, $where)) {
                	
            	$this->item_model->addAddons($item_id,$this->input->post('addons'));							
                	
                	
                    if (!empty($_FILES['userfile']['name'])) {
                         $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $config['upload_path']   = IMG_ITEMS;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = ITEM . "_" . $id . "." . $ext;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
										
                        if ($this->upload->do_upload()) {
							$data['item_image_name'] = ITEM.'_'.$id.'.' . $ext;
							$this->create_thumbnail(IMG_ITEMS.ITEM.'_'.$id.'.' . $ext,IMG_ITEMS_THUMB,100,100);
                        if ($this->base_model->update_operation($data, TBL_ITEMS, $where)) {
							$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_EDIT_ITEMS.DS.$item_id);
						}
                        } else {
							$this->prepare_flashmessage($this->upload->display_errors(), 1);
                            $item_id = $this->input->post('item_id');
                        }
                    } else {
                        $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
                        redirect(URL_EDIT_ITEMS.DS.$item_id);
                    }
                } else {
                    $msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_EDIT_ITEMS.DS.$item_id);
                }
            }
        }
        
       
        $item   = $this->base_model->fetch_records_from(TBL_ITEMS, array(
            'item_id' => $item_id
        ));
        if (count($item) < 1) {
            $msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);
            redirect(URL_ADMIN_ITEMS, REFRESH);
        }
		$this->data['menus'] = $this->base_model->prepareDropdown(TBL_MENU, 'menu_id', 'menu_name', array(
            'status' => 'Active'
        ));
		
		$this->data['option'] = $this->base_model->prepareDropdown(TBL_OPTIONS, 'option_id', 'option_name', array(
            'status' => 'Active'
        ));
		
		
		$this->data['addons'] = $this->base_model->prepareDropdown(TBL_ADDONS,'addon_id','addon_name',array('status'=>'Active'));
	
		$this->data['item_options'] = $this->item_model->getItemOptions($item_id);
		$this->data['item_addons'] = $this->item_model->getItemAddons($item_id);
		
		$this->data['message']  = $this->session->flashdata('message');
        $this->data['item']         = $item[0];
        $this->data['active_class'] = ACTIVE_ITEMS;
        $this->data['title']        = (isset($this->phrases['edit item'])) ? $this->phrases['edit item'] : "Edit Item";
        $this->data['content']      = 'edit_item';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** End of Editing Items ****/
  
    /*** Delete Item ****/
      function delete_item()
	{
				
		if(!$this->check_isdemo_ajax(URL_ADMIN_ITEMS)){
		$id = $this->input->post('id');
		if(!empty($id))
		{			
			$ids = explode(',', $id);
			$details = $this->base_model->fetch_records_from_in(TBL_ITEMS, 'item_id', $ids);
			if(!empty($details))
			{
				$this->base_model->delete_record_in(TBL_ITEMS, 'item_id',$ids);
				$this->load->helper("file");
				foreach($details as $recod)
				{
					if($recod->item_image_name != '')
					{
						if(file_exists(IMG_ITEMS . $recod->item_image_name))
						{
							unlink(IMG_ITEMS . $recod->item_image_name);
						}
						if(file_exists(IMG_ITEMS_THUMB . DS . $recod->item_image_name))
						{
							unlink(IMG_ITEMS_THUMB  . DS . $recod->item_image_name);
						}
					}
				}
				$msg = (isset($this->phrases['deleted successfully'])) ? $this->phrases['deleted successfully'] : "Deleted Successfully";
				echo json_encode(array('status' => 1, 'message' => $msg, 'action' => 'success'));
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
   
   	/*
	 * Diaplays data
	 * @author john peter
	 */
	function ajax_get_data()
	{
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
		 
			$records = $this->item_model->get_datatables();
		
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				$image = base_url().IMG_DEFAULT;
				if($record->item_image_name != '')
				{
					  $image = base_url().IMG_ITEMS_THUMB .  $record->item_image_name;
				}
				$row[] = '<input id="checkbox-'.$record->item_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->item_id.'">';
                $row[] = '<span>'.$record->menu_name.'</span>';        
                $row[] = '<span>'.$record->item_name.'</span>';        
				$row[] = '<span>'.$record->item_cost.'</span>';
				$row[] = '<span>'.$record->item_type.'</span>';
				$row[] = '<span>'.$record->item_description.'</span>';
				$row[] = '<span><img src="'.$image.'" class="img-responsive"/></span>';
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				//add html for action
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->item_id . ',\''.URL_DELETE_ITEMS.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.URL_EDIT_ITEMS . '/' . $record->item_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				  <label class="switch"style="width:50px">
                <input type="checkbox" value="' . $record->item_id . '" id="status_' . $record->item_id . '" name="check_' . $record->item_id . '" onclick="statustoggle(this, \'' .  URL_ITEM_STATUSTOGGLE .'\')"'.$checked . '/>
                <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->item_model->count_all(),
					"recordsFiltered" => $this->item_model->count_filtered(),
					"data" => $data,
			);				
			echo json_encode($output);		
		}        
	}
	
   
   function checkduplicate()
	{
		
		$column = 'item_name';
		$value  = $this->input->post('item_name');
		$id 	= 'item_id';
		$id_value = $this->input->post('item_id');
		$message = $this->phrases['duplicate'].' '.$this->phrases['item name'];
		$cond = array($column=>$value,$id.' !='=>$id_value);
			
		$records = $this->base_model->fetch_records_from(TBL_ITEMS,$cond);
		
		if(count($records)>0)
		{
			 $this->form_validation->set_message('checkduplicate', $message);
			return false;
		}else{
			return true;
		} 
	}
    
    /**
	 * Changes the status of the record
	 *
	 */
		
	function statustoggle()
	{
		if(!$this->check_isdemo_ajax(URL_ADMIN_ITEMS)){
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
			
			$this->base_model->update_operation_in( $filedata,TBL_ITEMS,'item_id', explode(',', $id) );
			echo json_encode(array('status' => 1, 'message' => $message, 'action' => 'success'));			} 
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

?>
