<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class Addons extends MY_Controller
{
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
		$this->load->helper('inflector');
		$this->load->helper('security');
		$this->load->library('upload');

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
		$this->lang->load('auth');
		$this->load->helper('language');
		check_access(ADMIN);						/*if($this->input->post()){				$this->check_isdemo(URL_ADD_ADDON);			}*/
	}

	function index()
	{
		$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['ajaxrequest'] = array(
				'url' => URL_ADDON_AJAX_GET_DATA,
				'disablesorting' => '0,4,6',
				);

		$this->data['active_class'] = ACTIVE_ADDONS;
		$this->data['title']        = (isset($this->phrases['addons'])) ? $this->phrases['addons'] : "Addons";
		$this->data['content']      = 'addons';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	function add_addon()
	{		
		if ($this->input->post()) 
		{
			$this->check_isdemo(URL_ADMIN_ADDONS);
			$this->form_validation->set_rules('item_name', $this->phrases['item name'], 'required|is_unique[' . DBPREFIX.TBL_ADDONS . '.addon_name]');
			$this->form_validation->set_rules('price', $this->phrases['price'], 'required|numeric');
			$this->form_validation->set_rules('description', $this->phrases['description'], 'required');
			if(empty($_FILES['userfile']['name']))
			{
				$this->form_validation->set_rules('userfile', $this->phrases['item image'], 'required');
			}

			if(!empty($_FILES['userfile']['name'])){
				$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				if(!$ext='jpg'|| !$ext='png' || !$ext='jpeg'){

					$this->prepare_flashmessage($this->phrases['invalid file'],2);
					redirect(URL_ADD_ADDON,REFRESH);
				}
			}

			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

			if ($this->form_validation->run() == TRUE) {
				$input_data['addon_name'] 	= $this->input->post('item_name');
				$input_data['price'] 	 	= $this->input->post('price');
				$input_data['description']  = $this->input->post('description');
				$input_data['status']       = $this->input->post('status');
				$id                         = $this->base_model->insert_operation_id($input_data, TBL_ADDONS);
				if ($id) {
					if (!empty($_FILES['userfile']['name'])) {

						$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
						$config['file_name'] 		= ADDON.'_'.$id.'.' . $ext;
						$config['upload_path']   = IMG_ADDONS;
						$config['allowed_types'] = ALLOWED_TYPES;
						$config['overwrite'] = true;
						$this->load->library('upload');
						$this->upload->initialize($config);
						if ($this->upload->do_upload()) {
							$where['addon_id']        = $id;
							$data['addon_image'] 	 = ADDON.'_'.$id.'.' . $ext;
							$this->create_thumbnail(IMG_ADDONS.ADDON.'_'.$id.'.' . $ext,IMG_ADDONS_THUMB,200,200);
							$this->base_model->update_operation($data, TBL_ADDONS, $where);

							$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
							$this->prepare_flashmessage($msg,0);

							redirect(URL_ADMIN_ADDONS);
						} else {
							$this->prepare_flashmessage($this->upload->display_errors(), 1);

						}
					}
				} else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_ADMIN_ADDONS);
				}
			}

		}

		$this->data['active_class'] = ACTIVE_ADDONS;
		$this->data['title']        = (isset($this->phrases['add addon'])) ? $this->phrases['add addon'] : "Add Addon";
		$this->data['content']      = 'add_addon';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	function edit_addon($addon_id = false)
	{		
		if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_ADDONS);
			$addon_id = $this->input->post('addon_id');									
			$this->form_validation->set_rules('item_name', $this->phrases['item name'], 'required|callback_checkduplicate[item_name]');
			$this->form_validation->set_rules('price', $this->phrases['price'], 'required|numeric');
			$this->form_validation->set_rules('description', $this->phrases['description'], 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if($this->form_validation->run()==true){
				$update_data['addon_name'] 	  = $this->input->post('item_name');
				$update_data['price'] 	      = $this->input->post('price');
				$update_data['description']   = $this->input->post('description');
				$update_data['status']        = $this->input->post('status');

				$where['addon_id']         	  = $addon_id;
				if ($this->base_model->update_operation($update_data, TBL_ADDONS, $where)) {
					if (!empty($_FILES['userfile']['name'])) {
						$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
						$config['upload_path']   = IMG_ADDONS;
						$config['allowed_types'] = ALLOWED_TYPES;
						$config['overwrite']     = true;
						$config['file_name'] 	 = ADDON.'_'.$addon_id.'.' . $ext;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						if ($this->upload->do_upload()) {
							$data['addon_image'] = ADDON.'_'.$addon_id.'.' . $ext;
							$this->create_thumbnail(IMG_ADDONS.ADDON.'_'.$id.'.' . $ext,IMG_ADDONS_THUMB,200,200);
							if ($this->base_model->update_operation($data, TBL_ADDONS, $where)) {
								$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
								$this->prepare_flashmessage($msg, 0);
								redirect(URL_ADMIN_ADDONS, REFRESH);
							}
						} else {
							$this->prepare_flashmessage($this->upload->display_errors(), 1);

						}
					} else {
						$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_ADMIN_ADDONS, REFRESH);
					}
				} else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_ADMIN_ADDONS, REFRESH);
				}
			}

		}
		$result = $this->base_model->fetch_records_from(TBL_ADDONS, array(
					'addon_id' => $addon_id
					));
		if (count($result) > 0) {
			$this->data['addon'] = $result[0];
		} else {
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);
			redirect(URL_ADMIN_ADDONS, REFRESH);
		}
		$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['active_class'] = ACTIVE_ADDONS;
		$this->data['title']        = (isset($this->phrases['edit addon'])) ? $this->phrases['edit addon'] : "Edit Addon";
		$this->data['content']      = 'edit_addon';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	function delete_addon()
	{				

		if(!$this->check_isdemo_ajax(URL_ADMIN_ADDONS)){
			$id = $this->input->post('id');
			if(!empty($id))
			{			
				$ids = explode(',', $id);
				$details = $this->base_model->fetch_records_from_in(TBL_ADDONS, 'addon_id', $ids);

				if(!empty($details))
				{

					$this->base_model->delete_record_in(TBL_ADDONS, 'addon_id',$ids);
					$this->load->helper("file");
					foreach($details as $recod)
					{
						if($recod->addon_image != '')
						{
							if(file_exists(IMG_ADDONS . $recod->addon_image))
							{
								unlink(IMG_ADDONS . $recod->addon_image);
							}
							if(file_exists(IMG_ADDONS_THUMB . DS . $recod->addon_image))
							{
								unlink(IMG_ADDONS_THUMB  . DS . $recod->addon_image);
							}
						}
					}
					$msg = (isset($this->phrases['deleted successfully'])) ? $this->phrases['deleted successfully'] : "Deleted Successfully";
					echo json_encode(array('status' => 1, 'message' => $msg, 'action' => 'success','details'=>$details));
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
		}
		else{						
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

		if($this->input->post())
		{
			$data = array();

			$no = $_POST['start'];

			$columns = array('addon_id', 'addon_name', 'price', 'description','addon_image','status');

			$condition = array('1'=>'1');

			$records = $this->base_model->get_datatables(TBL_ADDONS, 'auto', $condition, $columns, array('menu_name' => 'asc'));

			foreach($records as $record)
			{	
				$no++;
				$row = array();
				$image = base_url().IMG_DEFAULT;
				if($record->addon_image != '')
				{
					$image = base_url().IMG_ADDONS_THUMB .  $record->addon_image;
				}
				$row[] = '<input id="checkbox-'.$record->addon_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->addon_id.'">';
				$row[] = '<span>'.$record->addon_name.'</span>';        
				$row[] = '<span>'.$record->price.'</span>';
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
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->addon_id . ',\''.URL_DELETE_ADDON.'\')">
					<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
					</div>

					<div class="digiCrud">
					<a href="'.URL_EDIT_ADDON . '/' . $record->addon_id . '" class="btn btn-info">
					<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
					</div>

					<div class="digiCrud">
					<label class="switch"style="width:50px">
					<input type="checkbox" value="' . $record->addon_id . '" id="status_' . $record->addon_id . '" name="check_' . $record->addon_id . '" onclick="statustoggle(this, \'' .  URL_ADDON_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
					</div>
					</div>
					';
				$data[] = $row;
			}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_ADDONS, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_ADDONS, 'auto', $condition, $columns, array('addon_name' => 'asc')),
					"data" => $data,
				       );					
			echo json_encode($output);		

		}        
	}


	function checkduplicate()
	{

		$column = 'addon_name';
		$value  = $this->input->post('item_name');
		$id 	= 'addon_id';
		$id_value = $this->input->post('addon_id');
		$message = $this->phrases['duplicate'].' '.$this->phrases['item name'];
		$cond = array($column=>$value,$id.' !='=>$id_value);

		$records = $this->base_model->fetch_records_from(TBL_ADDONS,$cond);

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
		if(!$this->check_isdemo_ajax(URL_ADMIN_ADDONS)){
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
				$this->base_model->update_operation_in( $filedata, TBL_ADDONS, 'addon_id', explode(',', $id) );
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

?>
