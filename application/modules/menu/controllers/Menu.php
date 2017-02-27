<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends MY_Controller 
{
	function __construct()
    {
        parent::__construct();
        $this->load->library(array('ion_auth','form_validation'));
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('base_model');
        
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
    
        /*** Function for Add Menu ***/
    function add_menu()
    {
    				
        if ($this->input->post()) 
		{
			$this->check_isdemo(URL_ADMIN_MENU);	
            $this->form_validation->set_rules('menu_name', $this->phrases['menu name'], 'required|is_unique[' . DBPREFIX.TBL_MENU . '.menu_name]');
            $this->form_validation->set_rules('punch_line', $this->phrases['punch line'], 'required');
            $this->form_validation->set_rules('description', $this->phrases['description'], 'required');
			if(empty($_FILES['userfile']['name']))
			{
				$this->form_validation->set_rules('userfile', $this->phrases['menu image'], 'required');
			}
			
			if(!empty($_FILES['userfile']['name'])){
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				if(!$ext='jpg'|| !$ext='png' || !$ext='jpeg'){
								
					$this->prepare_flashmessage($this->phrases['invalid file'],2);
					redirect(URL_ADD_MENU,REFRESH);
				}
			}
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $input_data['menu_name'] 	 = $this->input->post('menu_name');
                $input_data['punch_line'] 	 = $this->input->post('punch_line');
                $input_data['description']   = $this->input->post('description');
                $input_data['status']        = $this->input->post('status');
                $id                          = $this->base_model->insert_operation_id($input_data, TBL_MENU);
                if ($id) {
                    if (!empty($_FILES['userfile']['name'])) {
                        
                        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
							$config['file_name'] 		= MENU.'_'.$id.'.' . $ext;
							$config['upload_path']   = IMG_MENU;
							$config['allowed_types'] = ALLOWED_TYPES;
							$config['overwrite'] = true;
							$this->load->library('upload');
							$this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $where['menu_id']        = $id;
                            $data['menu_image_name'] 	 = MENU.'_'.$id.'.' . $ext;
                            $this->base_model->update_operation($data, TBL_MENU, $where);
							
							$this->create_thumbnail(IMG_MENU.MENU.'_'.$id.'.' . $ext,IMG_MENU_THUMB,100,100);
														
							$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
                            $this->prepare_flashmessage($msg,0);
                            
							redirect(URL_ADMIN_MENU);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                        
                        }
                    }
                } else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_MENU);
                }
            }
			
        }
		
        
        $this->data['active_class'] = ACTIVE_MENU;
        $this->data['title']        = (isset($this->phrases['add menu'])) ? $this->phrases['add menu'] : "Add Menu";
        $this->data['content']      = 'add_menu';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** Function for Edit Menu ***/
    function edit_menu($menu_id = false)
    {
					
        if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_MENU);	
             $menu_id = $this->input->post('menu_id');									
            $this->form_validation->set_rules('menu_name', $this->phrases['menu name'], 'required|callback_checkduplicate[]');
			
            $this->form_validation->set_rules('punch_line', $this->phrases['punch line'], 'required');
            $this->form_validation->set_rules('description', $this->phrases['description'], 'required');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run()==true){
            $update_data['menu_name'] 	  = $this->input->post('menu_name');
            $update_data['punch_line'] 	  = $this->input->post('punch_line');
            $update_data['description']   = $this->input->post('description');
            $update_data['status']        = $this->input->post('status');
            $id                           = $this->input->post('menu_id');
            $where['menu_id']         	  = $id;
            if ($this->base_model->update_operation($update_data, TBL_MENU, $where)) {
                if (!empty($_FILES['userfile']['name'])) {
					 $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                    $config['upload_path']   = IMG_MENU;
                    $config['allowed_types'] = ALLOWED_TYPES;
                    $config['overwrite']     = true;
                    $config['file_name'] 	 = MENU.'_'.$id.'.' . $ext;
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload()) {
                        $data['menu_image_name'] = MENU.'_'.$id.'.' . $ext;
						$this->create_thumbnail(IMG_MENU.MENU.'_'.$id.'.' . $ext,IMG_MENU_THUMB,100,100);
                        if ($this->base_model->update_operation($data, TBL_MENU, $where)) {
                           $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_ADMIN_MENU, REFRESH);
                        }
                    } else {
                        $this->prepare_flashmessage($this->upload->display_errors(), 1);
                        $menu_id = $this->input->post('menu_id');
                    }
                } else {
                    $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
                    redirect(URL_ADMIN_MENU, REFRESH);
                }
            } else {
                $msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
				$this->prepare_flashmessage($msg, 1);
                redirect(URL_ADMIN_MENU, REFRESH);
            }
			}
			
        }
        $result = $this->base_model->fetch_records_from(TBL_MENU, array(
            'menu_id' => $menu_id
        ));
        if (count($result) > 0) {
            $this->data['result'] = $result[0];
        } else {
           $msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
		   $this->prepare_flashmessage($msg, 2);
            redirect(URL_ADMIN_MENU, REFRESH);
        }
        
        $this->data['active_class'] = ACTIVE_MENU;
        $this->data['title']        = (isset($this->phrases['edit menu'])) ? $this->phrases['edit menu'] : "Edit Menu";
        $this->data['content']      = 'edit_menu';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** Function to List Menus ***/
    function index()
    {
       
	   $this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
	 	
		$this->data['ajaxrequest'] = array(
			'url' => URL_MENU_AJAX_GET_DATA,
			'disablesorting' => '0,4,6',
		);
		
        $this->data['active_class'] = ACTIVE_MENU;
        $this->data['title']        = (isset($this->phrases['menu'])) ? $this->phrases['menu'] : "Menu";
        $this->data['content']      = 'menus';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** Function for Delete Categories ***/
    function delete_menu()
    {
       $this->check_isdemo(URL_ADMIN_MENU);				
        $menu_id        = $this->input->post('menu_id');
		
        $items = $this->base_model->fetch_records_from(TBL_ITEMS,array('menu_id'=>$menu_id));
               
        if (!empty($items)) {
        	
            $this->prepare_flashmessage('You cannot delete the Menu, since items are there for this menu', 2);
            redirect(URL_ADMIN_MENU, REFRESH);
        } else {
           
            if ($this->base_model->check_duplicate(TBL_MENU, 'menu_id', $menu_id) && is_numeric($menu_id)) {
				$where['menu_id'] 		= $menu_id;
                $res = $this->base_model->fetch_single_column_value(TBL_MENU, 'menu_image_name', $where);
				if(count($res)>0 && $res!=''){
					
					if (file_exists(IMG_MENU . $res)) {
						unlink(IMG_MENU . $res);
						if (file_exists(IMG_MENU_THUMB . $res)){
							unlink(IMG_MENU_THUMB . $res);
						}
					}
				}
                if ($this->base_model->delete_record(TBL_MENU, $where)) {
					$msg = (isset($this->phrases['deleted successfully'])) ? $this->phrases['deleted successfully'] : "Deleted Successfully";
					$this->prepare_flashmessage($msg, 0);
                    redirect(URL_ADMIN_MENU, REFRESH);
                } else {
					$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
                    $this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_MENU, REFRESH);
                }
            } else {
					$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
                    $this->prepare_flashmessage($msg, 1);
					redirect(URL_ADMIN_MENU, REFRESH);
            }
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
			
			$columns = array('menu_id', 'menu_name', 'punch_line', 'description','menu_image_name','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_MENU, 'auto', $condition, $columns, array('menu_name' => 'ASC'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				$image = base_url().IMG_DEFAULT;
				if($record->menu_image_name != '')
				{
					  $image = base_url().IMG_MENU_THUMB .  $record->menu_image_name;
				}
				$row[] = '<input id="checkbox-'.$record->menu_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->menu_id.'">';
                $row[] = '<span>'.$record->menu_name.'</span>';        
				$row[] = '<span>'.$record->punch_line.'</span>';
				$row[] = '<span>'.$record->description.'</span>';
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
					<a data-toggle="modal" class="btn btn-danger" data-target="#myModal" onclick="changeDeleteId('.$record->menu_id . ',\''.URL_DELETE_MENU.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.URL_EDIT_MENU . '/' . $record->menu_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				  <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->menu_id . '" id="status_' . $record->menu_id . '" name="check_' . $record->menu_id . '" onclick="statustoggle(this, \'' .  URL_MENU_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_MENU, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_MENU, 'auto', $condition, $columns, array('menu_name' => 'ASC')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}        
	}
	
   
   function checkduplicate()
	{
		
		$column = 'menu_name';
		$value  = $this->input->post('menu_name');
		$id 	= 'menu_id';
		$id_value = $this->input->post('menu_id');
		$message = $this->phrases['duplicate'].' '.$this->phrases['menu name'];
		$cond = array($column=>$value,$id.' !='=>$id_value);
			
		$records = $this->base_model->fetch_records_from(TBL_MENU,$cond);
		
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
		if(!$this->check_isdemo_ajax(URL_ADMIN_MENU)){
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
			$this->base_model->update_operation_in( $filedata, TBL_MENU, 'menu_id', explode(',', $id) );
			echo json_encode(array('status' => 1, 'message' => $message, 'action' => 'success'));
		} 
		else
		{
			$message = $this->phrases['MSG WRONG OPERATION'];
			echo json_encode(array('status' => 0, 'message' => $message, 'action' => 'failed'));			
		}
		}
		else{						
				$msg = 'Access Denied on demo server';				
				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));		
			}
	}
    
}
