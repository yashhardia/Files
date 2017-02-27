<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	
	class Options extends MY_Controller
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
	        $this->load->library('upload');
	        
	        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	        // Load MongoDB library instead of native db driver if required
	        $this->config->item('use_mongodb', 'ion_auth') ? $this->load->library('mongo_db') : $this->load->database();
	        $this->lang->load('auth');
	        $this->load->helper('language');
			check_access(ADMIN);
		}
		
	/*
	* ADD OPTIONS 
	* DATE 19-10-2016
	*/
	
	function index()
	{
		$this->data['ajaxrequest'] = array(
			'url' => URL_OPTION_AJAX_GET_DATA,
			'disablesorting' => '0,2',
		);
		$this->data['message']      = ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message'));
        $this->data['active_class'] = ACTIVE_OPTIONS;
        $this->data['title']        = (isset($this->phrases['options'])) ? $this->phrases['options'] : "Options";
        $this->data['content']      = 'options';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function add_option()
	{		
		if ($this->input->post()) 
		{	
			$this->check_isdemo(URL_ADMIN_OPTIONS);
            $this->form_validation->set_rules('option_name', $this->phrases['option name'], 'required|is_unique[' . DBPREFIX.TBL_OPTIONS . '.option_name]');
            
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $input_data['option_name'] 	 = $this->input->post('option_name');
                $input_data['status']        = $this->input->post('status');
               
                if ($this->base_model->insert_operation($input_data, TBL_OPTIONS)) {
					$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
					$this->prepare_flashmessage($msg,0);
                    redirect(URL_ADMIN_OPTIONS);
                    
                } else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_OPTIONS);
                }
            }
			
        }
		
        $this->data['active_class'] = ACTIVE_OPTIONS;
        $this->data['title']        = (isset($this->phrases['add option'])) ? $this->phrases['add option'] : "Add Option";
        $this->data['content']      = 'add_option';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function edit_option($option_id=false)
	{		
		if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_OPTIONS);
            $option_id = $this->input->post('option_id');									
            $this->form_validation->set_rules('option_name', $this->phrases['option name'], 'required|callback_checkduplicate[]');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if($this->form_validation->run()==true){
				$update_data['option_name'] 	  = $this->input->post('option_name');
				$update_data['status']        = $this->input->post('status');
				$where['option_id']           = $option_id;
				if ($this->base_model->update_operation($update_data, TBL_OPTIONS, $where)) {
					$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_ADMIN_OPTIONS, REFRESH);
				} else {
					$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_ADMIN_OPTIONS, REFRESH);
				}
			}
			
        }
		
		$options = $this->base_model->fetch_records_from(TBL_OPTIONS,array('option_id'=>$option_id));
		if(empty($options)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
		   $this->prepare_flashmessage($msg, 2);
            redirect(URL_ADMIN_SIZES, REFRESH);
		}else{
			$this->data['option'] = $options[0];
		}
		
        $this->data['active_class'] = ACTIVE_OPTIONS;
        $this->data['title']        = (isset($this->phrases['edit option'])) ? $this->phrases['edit option'] : "Edit option";
        $this->data['content']      = 'edit_option';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function delete_option()
	{	
	
		if(!$this->check_isdemo_ajax(URL_ADMIN_OPTIONS)){
		$id = $this->input->post('id');
		if(!empty($id))
		{			
			$ids = explode(',', $id);
			$details = $this->base_model->fetch_records_from_in(TBL_OPTIONS, 'option_id', $ids);
			
			if(!empty($details))
			{
				
				if($this->base_model->delete_record_in(TBL_OPTIONS, 'option_id',$ids)){
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
		}		}else{						$msg = 'Access Denied on demo server';				echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));		}
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
			
			$columns = array('option_id','option_name','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_OPTIONS, 'auto', $condition, $columns, array('option_name' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				
				$row[] = '<input id="checkbox-'.$record->option_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->option_id.'">';
                $row[] = '<span>'.$record->option_name.'</span>';        
				
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				
				
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';;
				//add html for action
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->option_id . ',\''.URL_DELETE_OPTION.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.URL_EDIT_OPTION . '/' . $record->option_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				  <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->option_id . '" id="status_' . $record->option_id . '" name="check_' . $record->option_id . '" onclick="statustoggle(this, \'' .  URL_OPTION_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}
			
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_OPTIONS, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_OPTIONS, 'auto', $condition, $columns, array('option_name' => 'asc')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}        
	}
	
   
   function checkduplicate()
	{
		
		$column = 'option_name';
		$value  = $this->input->post('option_name');
		$id 	= 'option_id';
		$id_value = $this->input->post('option_id');
		$message = $this->phrases['duplicate'].' '.$this->phrases['option name'];
		$cond = array($column=>$value,$id.' !='=>$id_value);
			
		$records = $this->base_model->fetch_records_from(TBL_OPTIONS,$cond);
		
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
		if(!$this->check_isdemo_ajax(URL_ADMIN_OPTIONS)){
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
			$this->base_model->update_operation_in( $filedata, TBL_OPTIONS, 'option_id', explode(',', $id) );
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

?>
