<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class Languages extends MY_Controller
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
			check_access(ADMIN);
		}
	
	
	function index($param = '', $param1 = '')
	{		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
						
		$this->data['ajaxrequest'] = array(
			'url' => URL_LANGUAGES_AJAX_DATA,
			'disablesorting' => '0',
		);
			$this->data['active_class'] 		= ACTIVE_LANGUAGES;
			$this->data['title'] 				= (isset($this->phrases['languages'])) ? $this->phrases['languages'] : 'Languages';
			$this->data['content'] 				= 'list_lang';
		

		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	/*** Function for Add Language ***/
	function add_edit_lang($param = '')
	{		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
		
		if ($this->input->post()) {
			$this->check_isdemo(URL_LANGUAGES);
			$this->form_validation->set_rules(
			'language_name', 
			$this->phrases['language name'], 
			'required');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() 	== TRUE) {
				$input_data['lang_name'] 		= strtolower(
				$this->input->post('language_name'));
				$input_data['lang_code'] 			= strtolower($this->input->post('lang_code'));
				$input_data['status'] 			= $this->input->post('status');

				// check whether the language is already exist or not--
				if(!$this->input->post('update_rec_id')){
					$languages 						= $this->base_model->fetch_records_from(TBL_LANGUAGES,array('lang_name'=>$this->input->post('language_name')));
									
					if (count($languages) > 0) {
						$msg = (isset($this->phrases['already existed'])) ? $this->phrases['already existed'] : "Already existed";
						$this->prepare_flashmessage($msg, 2);
						redirect(URL_ADMIN_ADD_LANG, REFRESH);
					}
					
					if ($this->base_model->insert_operation($input_data,TBL_LANGUAGES)) 
					{
						$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_LANGUAGES, REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
						$this->prepare_flashmessage($msg, 1);
						redirect(URL_LANGUAGES, REFRESH);
					}
				}else{
					$where['id'] = $this->input->post('update_rec_id');
					if ($this->base_model->update_operation($input_data,TBL_LANGUAGES,$where)) 
					{
						$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_LANGUAGES, REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
						$this->prepare_flashmessage($msg, 1);
						redirect(URL_LANGUAGES, REFRESH);
					}
				}
				
			}
		}
		$this->data['title'] 					= (isset($this->phrases['add language'])) ? $this->phrases['add language'] : 'Add Language';
		if($param!=''){
			$lang_rec 						= $this->base_model->fetch_records_from(TBL_LANGUAGES,array('id'=>$param));
			if(count($lang_rec)>0)
			{
				$this->data['lang_rec'] = $lang_rec[0]; 
				$this->data['title'] 					= (isset($this->phrases['edit language'])) ? $this->phrases['edit language'] : 'Edit Language';
			}else{
				$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
				$this->prepare_flashmessage($msg, 2);
				redirect(URL_LANGUAGES);
			}
		}
		
		$this->data['active_class'] 			= ACTIVE_LANGUAGES;
		
		$this->data['content'] 					= 'add_language';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	/*** Function for listing phrases ****/
	function phrases()
	{
		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
				
		$this->data['ajaxrequest'] = array(
			'url'=>URL_PHRASE_AJAX_DATA,
			'disablesorting'=>'0,2',
		);
				
		$this->data['active_class'] 		= ACTIVE_LANGUAGES;
		$this->data['title'] 				= (isset($this->phrases['phrases'])) ? $this->phrases['phrases'] : 'Phrases';
		$this->data['content'] 				= 'list_phrases';
		

		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function ajax_phrase_data()
	{
		//$this->isAdmin();
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('id', 'text', 'phrase_type');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_PHRASES, 'auto', $condition, $columns, array('phrase_type' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				
				$row[] = '<span>'.$no.'</span>';        
				$row[] = '<span>'.$record->text.'</span>';        
				$row[] = '<span>'.$record->phrase_type.'</span>';
			
				//add html for action
				$row[] = '
				<div class="digiCrud">
					<a href="'.URL_ADMIN_ADD_PHRASE . '/' . $record->id . '" class="btn btn-info"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>	
				';
				$data[] = $row;
			}
			
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_PHRASES, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_PHRASES, 'auto', $condition, $columns, array('phrase_type' => 'asc')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}  
	}
	
	/*** Function for Add Phrase ***/
	function add_edit_phrase($param = '')
	{
		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
		
		if ($this->input->post()) {
			$this->check_isdemo(URL_PHRASES);
			$this->form_validation->set_rules(
			'phrase_name', 
			$this->phrases['phrase'],
			'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			if ($this->form_validation->run() 	== TRUE) {
				$input_data['text'] 			= $this->input->post('phrase_name');
				if($this->input->post('phrase_type')=='app'){
					$input_data['text'] 			= camelize($this->input->post('phrase_name'));
				}
				
				$input_data['phrase_type'] 		= $this->input->post('phrase_type');
				
				if(!$this->input->post('update_rec_id')){
				$phrases 						= $this->base_model->fetch_records_from(TBL_PHRASES,array('text'=>$input_data['text'],'phrase_type'=>$this->input->post('phrase_type')));
								
				if (count($phrases) > 0) {
					$msg = (isset($this->phrases['already existed'])) ? $this->input->post('phrase_name').' '.$this->phrases['phrase'].' '.$this->phrases['already existed'] : "Already Existed";
					$this->prepare_flashmessage($msg, 2);
					redirect(URL_ADMIN_ADD_PHRASE);
				}
				$id = 	$this->base_model->insert_operation_id($input_data,TBL_PHRASES );
				if ($id ) {
					$this->base_model->insert_operation( 
					array('lang_id' 			=> 1,
						'phrase_id' 			=> $id,
						'phrase_type'			=> $this->input->post('phrase_type'),
						'text' 					=> $this->input->post('phrase_name')
					),TBL_MULTI_LANG);
					$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
					$this->prepare_flashmessage($msg, 0);
					redirect(URL_PHRASES, REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_PHRASES);
				}
			 }else{
					$where['id'] = $this->input->post('update_rec_id');
					if ($this->base_model->update_operation($input_data,TBL_PHRASES,$where)) 
					{
						$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_PHRASES, REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
						$this->prepare_flashmessage($msg, 1);
						redirect(URL_PHRASES, REFRESH);
					}
			 }
			}
		}
		
		$this->data['title']					= (isset($this->phrases['add phrase'])) ? $this->phrases['add phrase'] : "Add Phrase";
		if($param!='' && is_numeric($param)){
			$phrase_rec = $this->base_model->fetch_records_from(TBL_PHRASES,array('id'=>$param));
			if(count($phrase_rec)>0){
				$this->data['phrase_rec'] = $phrase_rec[0];
				$this->data['title']					= (isset($this->phrases['edit phrase'])) ? $this->phrases['edit phrase'] : "Edit Phrase";
			}else{
				$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
					$this->prepare_flashmessage($msg, 2);
					redirect(URL_PHRASES);
			}
		}
		
		$this->data['active_class'] 			= ACTIVE_LANGUAGES;
			
		$this->data['content'] 					= 'add_phrase';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}

	/*** Function for Edit Phrases ***/
	function update_web_phrases($param = '', $param1 = 1)
	{
		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
		if ($this->input->post()) {
			$this->check_isdemo(URL_LANGUAGES);
			
			// check whether existed phrases are present in table and delete them.
			$existed_phrases 					= $this->base_model->fetch_records_from(TBL_MULTI_LANG,array('lang_id'=>$param,'phrase_type'=>'web'));
						
			if (count($existed_phrases) > 0) {
				foreach($existed_phrases as $r) {
					$this->base_model->delete_record(DBPREFIX.TBL_MULTI_LANG, array('id'=> ($r->id)));
				}
			}

			// inserting new phrases

			$records 							= array();
			$data 								= $this->input->post();
			foreach( $data as $key 				=> $value ) {
				array_push($records, array(
					"lang_id" 					=> $param,
					"phrase_id" 				=> $key,
					"phrase_type" 				=> 'web',
					"text" 						=> $value
				));
			}

			if ($this->db->insert_batch(DBPREFIX.TBL_MULTI_LANG,$records)) {
				$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
				$this->prepare_flashmessage($msg, 0);
				redirect(URL_LANGUAGES, REFRESH);
			}
			else {
				$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
				$this->prepare_flashmessage($msg, 1);
				redirect(URL_LANGUAGES);
			}
		}

		$language_id 							= $param1;
		$phrases 								= $this->base_model->run_query(
		"SELECT p.id,p.text, ml.text as existing_text FROM " . DBPREFIX.TBL_PHRASES
		 . " p LEFT OUTER JOIN " . 
		DBPREFIX.TBL_MULTI_LANG . " ml ON ml.phrase_id=p.id 
		AND  ml.lang_id=" . $language_id." WHERE p.phrase_type='web'");
		
		if (count($phrases) 					== 0) {
			echo "True";
			$phrases 							= $this->base_model->run_query(
			"SELECT p.*, p.text AS existing_text FROM " . 
			DBPREFIX.TBL_MULTI_LANG . " p");
		}
			
			
		$lang_name 				= $this->base_model->fetch_records_from(
		TBL_LANGUAGES, array('id'=> $language_id));
		
		if(empty($lang_name)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);	
			redirect(URL_LANGUAGES);
		}
		$this->data['language_id'] 				= $language_id;
		$this->data['language_name'] 			= $lang_name[0]->lang_name;
		$this->data['phrases'] 					= $phrases;
		
		$this->data['active_class'] 			= ACTIVE_LANGUAGES;
		$this->data['title'] 					= (isset($this->phrases['edit web phrases'])) ? $this->phrases['edit web phrases'] : 'Edit Web Phrases';
		$this->data['content'] 					= 'web_phrase_list';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	// APP PHRASES List
	function update_app_phrases($param = '', $param1 = 1)
	{
		
		$this->data['message'] 					= (validation_errors()) ? 
		validation_errors() : $this->session->flashdata('message');
		if ($this->input->post()) {
				$this->check_isdemo(URL_LANGUAGES);
			// check whether existed phrases are present in table and delete them.
			$existed_phrases 					= $this->base_model->fetch_records_from(TBL_MULTI_LANG,array('lang_id'=>$param,'phrase_type'=>'app'));
						
			if (count($existed_phrases) > 0) {
				foreach($existed_phrases as $r) {
					$this->base_model->delete_record(DBPREFIX.TBL_MULTI_LANG, array('id'=> ($r->id)));
				}
			}

			// inserting new phrases

			$records 							= array();
			$data 								= $this->input->post();
			foreach( $data as $key 				=> $value ) {
				array_push($records, array(
					"lang_id" 					=> $param,
					"phrase_id" 				=> $key,
					"phrase_type" 				=> 'app',
					"text" 						=> $value
				));
			}

			if ($this->db->insert_batch(DBPREFIX.TBL_MULTI_LANG,$records)) {
				$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
				$this->prepare_flashmessage($msg, 0);
				redirect(URL_LANGUAGES, REFRESH);
			}
			else {
				$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
				$this->prepare_flashmessage($msg, 1);
				redirect(URL_LANGUAGES);
			}
		}

		$language_id = $param1;
		$phrases = $this->base_model->run_query("SELECT p.id,p.text, ml.text as existing_text FROM ".DBPREFIX.TBL_PHRASES. " p LEFT JOIN ".DBPREFIX.TBL_MULTI_LANG." ml ON ml.phrase_id=p.id 
		AND ml.lang_id=".$language_id." WHERE p.phrase_type='app'");
		
		if(empty($phrases)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);
			redirect(URL_LANGUAGES);
		}
		
			
			
		$lang_name 	= $this->base_model->fetch_records_from(TBL_LANGUAGES,array('id'=> $language_id));
		if(empty($lang_name)){
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
            $this->prepare_flashmessage($msg, 2);
			redirect(URL_LANGUAGES);
		}
		
		$this->data['language_id'] 				= $language_id;
		$this->data['language_name'] 			= $lang_name[0]->lang_name;
		$this->data['phrases'] 					= $phrases;
		
		$this->data['active_class'] 			= ACTIVE_LANGUAGES;
		$this->data['title'] 					= (isset($this->phrases['edit app phrases'])) ? $this->phrases['edit app phrases'] : 'Edit App Phrases';
		$this->data['content'] 					= 'app_phrase_list';
		$this->_render_page(TEMPLATE_ADMIN, $this->data);
	}
	
	function delete_language()

	{
		
		if(!$this->check_isdemo_ajax(URL_LANGUAGES)){
		$id = $this->input->post('id');

		if(!empty($id))

		{			

			$ids = explode(',', $id);
			
			$details = $this->base_model->fetch_records_from_in(TBL_LANGUAGES, 'id', $ids);

			if(!empty($details))

			{
			
				$this->base_model->delete_record_in(TBL_LANGUAGES, 'id',$ids);

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
		}else{
			
			$msg = 'Access Denied on demo server';	
			echo json_encode(array('status' => 0, 'message' => $msg, 'action' => 'failed'));
		}

	}
	
	
	
	/**
	* Languages AJAX DATA
	*/
	
	function ajax_get_languages_data()
	{
		
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('id', 'lang_name', 'lang_code','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_LANGUAGES, 'auto', $condition, $columns, array('lang_name' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				$delete_string = '<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->id . ',\''.URL_DELETE_LANGUAGE.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>';
				if($record->id==1){
					$row[] = '';	
					$delete_string = '';
				}else{
					$row[] = '<input id="checkbox-'.$record->id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->id.'">';	
				}
				
				
                $row[] = '<span>'.$record->lang_name.'</span>';        
				$row[] = '<span>'.$record->lang_code.'</span>';
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				//add html for action
				$row[] = '
				
				<div class="digiCrud">							
					<a href="'.URL_EDIT_WEB_PHRASES . '/editPhrase/' . $record->id . '" class="btn btn-info"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left"> '.$this->phrases['update web phrases'].'</i>
					</a>
				</div>
				<div class="digiCrud">							
					<a href="'.URL_EDIT_APP_PHRASE . '/editPhrase/' . $record->id . '" class="btn btn-info"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left"> '.$this->phrases['update app phrases'].'</i>
					</a>
				</div>
				<div class="digiCrud">
					<a href="'.URL_ADMIN_ADD_LANG . '/' . $record->id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>	
				<div class="digiCrud">							
					'.$delete_string.'
				</div>
				<div class="digiCrud">
				   <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->id . '" id="status_' . $record->id . '" name="check_' . $record->id . '" onclick="statustoggle(this, \'' .  URL_LANGUAGE_STATUSTOGGLE .'\')"'.$checked . '/>
					<div class="slider round"></div>
                </label>
				  </div>
				</div>
				
				';
				$data[] = $row;
			}
			
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_LANGUAGES, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_LANGUAGES, 'auto', $condition, $columns, array('lang_name' => 'asc')),
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
		if(!$this->check_isdemo_ajax(URL_LANGUAGES)){
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
			$this->base_model->update_operation_in( $filedata, TBL_LANGUAGES, 'id', explode(',', $id) );
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
