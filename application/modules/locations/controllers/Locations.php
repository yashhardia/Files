<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Locations extends MY_Controller {
	/*
	| -----------------------------------------------------
	| PRODUCT NAME: 	RESTAURENT APP
	| -----------------------------------------------------
	| AUTHOR:			CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| -----------------------------------------------------
	| EMAIL:			samson@conquerorstech.net
	| -----------------------------------------------------
	| COPYRIGHTS:		CONQUERORS SOFTWARE TECHNOLOGIES PVT LTD
	| -----------------------------------------------------
	| WEBSITE:			http://conquerorstech.net
	|                   http://conquerorstech.co.za
	| -----------------------------------------------------
	|
	| MODULE: 			Location
	| -----------------------------------------------------
	| This is Location module controller file.
	| -----------------------------------------------------
	*/
	
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('base_model');
		$this->load->model('location_model');
		$this->load->library('upload');
		$this->form_validation->set_error_delimiters(
		$this->config->item('error_start_delimiter', 'ion_auth') , 
		$this->config->item('error_end_delimiter', 'ion_auth'));

		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ? 
		$this->load->library('mongo_db') : $this->load->database();
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->load->helper('security');
		$this->load->helper('dn_helper');
		
		/***check user***/
		check_access(ADMIN);
			
	}	
	
	
	/***FUNCTION FOR CITIES***/
	public function cities($param = '', $param1 = '',$param2='')
	{
				
		$this->data['title'] 					= (isset($this->phrases['cities'])) ? $this->phrases['cities'] : "Cities";
		$this->data['content'] 					= 'cities/cities';
		
					
			/*Start*/
				
		if($this->input->post('submit') == "Add" || $this->input->post('submit') == "Update") {
				// FORM VALIDATIONS
				
				$this->form_validation->set_rules('city_name', $this->phrases['city'],'required');
				
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
								
				$inputdata['city_name'] 	= ucwords($this->input->post('city_name'));
				$inputdata['status'] 		= $this->input->post('status');
					
		}
		
		if ($param == "Add") {
			
			if ($this->input->post('submit') == "Add") {
				$this->check_isdemo(URL_CITIES);

				if ($this->form_validation->run() == TRUE) {
					
					
					/***check whether the city is existed***/
					
					$existed_city 	= getRecsTable(TBL_CITIES,array('city_name'=>$this->input->post('city_name')));
					
					if(count($existed_city) > 0) {
						$msg = (isset($this->phrases['already existed'])) ? $this->phrases['already existed'] : "Already Existed";
						$this->prepare_flashmessage($msg,2);
						redirect(URL_CITIES,REFRESH);
					}
					
					if ($this->base_model->insert_operation($inputdata, TBL_CITIES)) {
						$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
						$this->prepare_flashmessage($msg , 0);
						redirect(URL_CITIES,REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
						$this->prepare_flashmessage($msg , 1);
						redirect(URL_CITIES,REFRESH);
					}
				}else{
					$this->prepare_flashmessage(validation_errors(), 1);
					redirect(URL_CITIES,REFRESH);
				}
			}
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
									
			$this->data['title'] 				= (isset($this->phrases['add city'])) ? $this->phrases['add city'] : "Add City";
			$this->data['operation']			= "Add";
			$this->data['content'] 				= 'cities/add_city';
		}
		elseif ($param == "Edit") {
			
			
			 if ($this->input->post('submit') == "Update") {
				 $this->check_isdemo(URL_CITIES);
				 
				$param1 = $this->input->post('update_rec_id');
				if ($this->form_validation->run() == TRUE) {
				
					$where['city_id'] 				= $this->input->post('update_rec_id');
					
					if ($this->base_model->update_operation($inputdata, TBL_CITIES, $where)) {
						$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg , 0);
						redirect(URL_CITIES,REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
						$this->prepare_flashmessage($msg , 1);
						redirect(URL_CITIES, REFRESH);
					}
				}
				
			}
			
			if($param1 == "" || !is_numeric($param1)) {
				redirect(URL_CITIES,REFRESH);
			}
			
			
			$city_rec 							= getRecsTable(TBL_CITIES,array('city_id'=>$param1));
			$this->data['city_rec'] 			= count($city_rec) > 0 ? $city_rec[0] : array();
								
			$this->data['title'] 				= (isset($this->phrases['edit city'])) ? $this->phrases['edit city'] : "Edit City";
			$this->data['operation']			= "Edit";
			$this->data['content'] 				= 'cities/add_city';
		}
		elseif ($param == "Delete") {
			$this->check_isdemo(URL_CITIES);
			if($this->ion_auth->is_admin()) {
			
			$where['city_id'] 					= $param1;
			$cond 								= "city_id";
			$cond_val				 			= $param1;
			$locations = $this->base_model->fetch_records_from(TBL_SERVICE_DELIVERED_LOCATIONS, array($cond=>$cond_val));	
			if (count($locations)<1 && is_numeric($param1)) {
				if ($this->base_model->delete_record(TBL_CITIES, $where)) {
					$msg = (isset($this->phrases['deleted successfully'])) ? $this->phrases['deleted successfully'] : "Deleted Successfully";
					$this->prepare_flashmessage($msg , 0);
					redirect(URL_CITIES, REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to delete'])) ? $this->phrases['unable to delete'] : "Unable to delete";
					$this->prepare_flashmessage($msg, 1);
					redirect(URL_CITIES,REFRESH);
				}
			}
			else {
				$msg = (isset($this->phrases['you cannot delete cities cause delivered location exist under it'])) ? $this->phrases['you cannot delete cities cause delivered location exist under it'] : "You cannot delete cities cause delivered location exist under it";
				$this->prepare_flashmessage($msg, 1);
				redirect(URL_CITIES, REFRESH);
			}
		}
		}
		elseif($param == "cities") {
						
			$this->data['param']					= $param;
			$this->data['title']					= (isset($this->phrases['upload cities'])) ? $this->phrases['upload cities'] : "Upload Cities";
			$this->data['content'] 					= "locations/excel_page";
			
		}
			$this->data['message']      = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
			$this->data['ajaxrequest'] = array(
				'url'=>AJAX_CITIES_GET_DATA,
				'disablesorting'=>'0',
			);
			
			$this->data['active_class'] = ACTIVE_LOCATION;
			$this->_render_page(TEMPLATE_ADMIN, $this->data);	
	}
	
	function ajax_cities_get_data()
	{
		
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('city_id', 'city_name','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_CITIES, 'auto', $condition, $columns, array('menu_name' => 'asc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				
				$row[] = '<input id="checkbox-'.$record->city_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->city_id.'">';
                $row[] = '<span>'.$record->city_name.'</span>';        
				
				
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				
				//add html for action
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#myModal" onclick="changeDeleteId('.$record->city_id . ')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.CITIES_EDIT . '/' . $record->city_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				   <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->city_id . '" id="status_' . $record->city_id . '" name="check_' . $record->city_id . '" onclick="statustoggle(this, \'' .  CITIES_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_CITIES, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_CITIES, 'auto', $condition, $columns, array('addon_name' => 'asc')),
					"data" => $data,
			);					
			echo json_encode($output);		
			
		}        
	}
	
	function cities_statustogle()
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
			$this->base_model->update_operation_in( $filedata, TBL_CITIES, 'city_id', explode(',', $id) );
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
	
	/****Read Excel***/
	function readexcel($param = '')
	{
		$this->check_isdemo(URL_CITIES);   
		if ($_FILES['userfile']['name']) {
			$f_type							 = explode(".", $_FILES['userfile']['name']);
			$last_in 						 = (count($f_type) - 1);
			if ($f_type[$last_in] != "xls") {
				$this->prepare_flashmessage($this->phrases['invalid file format'], 1);
				redirect('location/'.$param);
			}
		}
			
		if ($param == "cities"){
		include (FCPATH.'/assets/excelassets/PHPExcel/IOFactory.php');

		$file 									= $_FILES['userfile']['tmp_name'];
		$inputFileName 							= $file;
		$objReader 								= new PHPExcel_Reader_Excel5();
		$objPHPExcel 							= $objReader->load($inputFileName);
		echo '<hr />';
		$sheetData 								= $objPHPExcel->getActiveSheet()->toArray(
		null, true, true, true
		);
		$i 										= 0;
		$j 										= 0;
		$data 									= array();
		$valid 									= 1;

		foreach($sheetData as $r) {
			if ($i++ != 0) {
				if ($valid == 1) {
					if ($param == 'cities') {
						$data[$j++] 			= array(
							'city_id' 			=> $r['A'],
							'city_name' 		=> $r['B'],
							'status' 			=> $r['C'],
						);
					}
					
				}
				else {
					break;
				}
			}
		}

		if ($valid == 1) {
			
			$this->db->insert_batch(DBPREFIX.TBL_CITIES,$data);
			
		}
		else {
			$msg = $this->phrases['invalid operation'];
			$this->prepare_flashmessage($msg, 1);
			redirect('locations/'.$param, 'refresh');
		}
		
		if ($this->db->affected_rows() > 0) {
			$msg = $this->phrases['added successfully'];
			$this->prepare_flashmessage($msg, 0);
		}
		else {
			$msg = $this->phrases['unable to add'];
			$this->prepare_flashmessage($msg, 1);
		}
	
		redirect('locations/'.$param, 'refresh');
		
		}
		else {
			$this->prepare_flashmessage($this->phrases['invalid operation'],2);
			redirect('locations/'.$param);
		} 
	}
	
	function add_delivery_locations()
	{
			
		if ($this->input->post())
		 {
			$this->check_isdemo(URL_SERVICE_LOCATIONS);		 
			$this->form_validation->set_rules('city_id', $this->phrases['city'],'required');
			$this->form_validation->set_rules('locality', $this->phrases['locality name'],'required');
			$this->form_validation->set_rules('pincode', $this->phrases['pincode'],'required|numeric');
			
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			if ($this->form_validation->run() == TRUE) {
				
			$inputdata['city_id'] 		= $this->input->post('city_id');
			$inputdata['locality'] 		= $this->input->post('locality');
			$inputdata['pincode'] 		= $this->input->post('pincode');
			$inputdata['status'] 		= $this->input->post('status');	
				
				/***check whether the service location is existed***/
				$existed_service_location 	= 
						getRecsTable(
						TBL_SERVICE_DELIVERED_LOCATIONS,
						array(
						'city_id'=>$this->input->post('city_id'),
						'locality'=>$this->input->post('locality'),
						'pincode'=>$this->input->post('pincode'))
						);
				if(count($existed_service_location) > 0) {
					$msg = (isset($this->phrases['already existed'])) ? $this->phrases['already existed'] : "Already Existed";
					$this->prepare_flashmessage($msg,2);
					redirect(URL_SERVICE_LOCATIONS,REFRESH);
				}
				if ($this->base_model->insert_operation($inputdata, TBL_SERVICE_DELIVERED_LOCATIONS)) {
					$msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
					$this->prepare_flashmessage($msg , 0);
					redirect(URL_SERVICE_LOCATIONS,REFRESH);
				}
				else {
					$msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable to add";
					$this->prepare_flashmessage($msg , 1);
					redirect(URL_SERVICE_LOCATIONS,REFRESH);
				}
			}
		}
			
		 $this->data['city_options']   		= $this->base_model->prepareDropdown(TBL_CITIES, 'city_id', 'city_name', array(
            'status' => 'Active'
        ));	
			
		$this->data['title'] 				= (isset($this->phrases['add service delivery location'])) ? $this->phrases['add service delivery location'] : "Add Service Delivery Location";
		$this->data['operation']			= "add";
		$this->data['content'] 				= 'service_provide_locations/add_location';	
				
		$this->data['active_class'] 		= ACTIVE_LOCATION;
		$this->_render_page(TEMPLATE_ADMIN, $this->data);	
	}
	
	function edit_delivery_location($param='')
	{
		
		 if ($this->input->post()) { 
			$this->check_isdemo(URL_SERVICE_LOCATIONS);		
			$this->form_validation->set_rules('city_id', $this->phrases['city'],'required');
			$this->form_validation->set_rules('locality', $this->phrases['locality name'],'required');
			$this->form_validation->set_rules('pincode', $this->phrases['pincode'],'required|numeric');
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
				$param = $this->input->post('update_rec_id');
				if ($this->form_validation->run() == TRUE) {
					
					$inputdata['city_id'] 		= $this->input->post('city_id');
					$inputdata['locality'] 		= $this->input->post('locality');
					$inputdata['pincode'] 		= $this->input->post('pincode');
					$inputdata['status'] 		= $this->input->post('status');
					
					/***check whether the service location is existed***/
					$existed_service_location 	= getRecsTable(TBL_SERVICE_DELIVERED_LOCATIONS,array(
								'city_id'=>$this->input->post('city_id'),
								'locality'=>$this->input->post('locality'),
								'pincode'=>$this->input->post('pincode'),
								'service_provide_location_id !='=>$param));
								
					if(count($existed_service_location) > 0) {
						
						$msg = (isset($this->phrases['already existed'])) ? $this->phrases['already existed'] : "Already Existed";
						$this->prepare_flashmessage($msg,2);
						redirect(URL_SERVICE_LOCATIONS,REFRESH);
					}
					
					
					$where['service_provide_location_id'] = $this->input->post('update_rec_id');
					if ($this->base_model->update_operation($inputdata, TBL_SERVICE_DELIVERED_LOCATIONS, $where)) {
						$msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
						redirect(URL_SERVICE_LOCATIONS,REFRESH);
					}
					else {
						$msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
						$this->prepare_flashmessage($msg, 1);
						redirect(URL_SERVICE_LOCATIONS,REFRESH);
					}
				}
			} 
			
			if($param == "" || !is_numeric($param)) {
				redirect(URL_SERVICE_LOCATIONS,REFRESH);
			} 
			$record 							= getRecsTable(TBL_SERVICE_DELIVERED_LOCATIONS,array('service_provide_location_id'=>$param));
			
					
			$this->data['record'] 				= count($record) > 0 ? $record[0] : array();
			
			$this->data['city_options']   		= $this->base_model->prepareDropdown(TBL_CITIES, 'city_id', 'city_name', array(
            'status' => 'Active'
        ));	 
		
					
			$this->data['title'] 				= (isset($this->phrases['edit service delivery locations'])) ? $this->phrases['edit service delivery locations'] : 'Edit Service Delivery Location';
			
			$this->data['content'] 				= 'service_provide_locations/edit_location';
			$this->data['active_class'] 		= ACTIVE_LOCATION;
			$this->_render_page(TEMPLATE_ADMIN, $this->data);	
	}
	
	function delivery_locations()
	{
		$this->data['message']      		= (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		
		 $this->data['ajaxrequest'] = array(
			'url' => URL_SERVICE_LOCATION_AJAX_GET_DATA,
			'disablesorting' => '0',
		);
		$this->data['title'] 					= (isset($this->phrases['service delivery locations'])) ? $this->phrases['service delivery locations'] : 'Service Delivered Locations';
		$this->data['content'] 					= 'service_provide_locations/locations';
		$this->data['active_class'] 		= ACTIVE_LOCATION;
		$this->_render_page(TEMPLATE_ADMIN, $this->data);	
	}
	
	function delete_locations()
	{
		
		if(!$this->check_isdemo_ajax(URL_SERVICE_LOCATIONS)){
		$id = $this->input->post('id');
		if(!empty($id))
		{			
			$ids = explode(',', $id);
			$details = $this->base_model->fetch_records_from_in(TBL_SERVICE_DELIVERED_LOCATIONS, 'service_provide_location_id', $ids);
			if(!empty($details))
			{
				$this->base_model->delete_record_in(TBL_SERVICE_DELIVERED_LOCATIONS, 'service_provide_location_id',$ids);
				
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
	
	function ajax_get_service_location_data()
	{
		if($this->input->post())
		{
			$data = array();
			
			$no = $_POST['start'];
		 
			$records = $this->location_model->get_datatables();
		
			foreach($records as $record)
			{	
				$no++;
				$row = array();
				
				$row[] = '<input id="checkbox-'.$record->service_provide_location_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->service_provide_location_id.'">';
                $row[] = '<span>'.$record->city_name.'</span>';        
                $row[] = '<span>'.$record->locality.'</span>';        
				$row[] = '<span>'.$record->pincode.'</span>';
				
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				//add html for action
								
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->service_provide_location_id . ',\''.URL_DELETE_SERVICE_LOCATIONS.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				<div class="digiCrud">
					<a href="'.URL_EDIT_SERVICE_LOCATIONS . '/' . $record->service_provide_location_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				
				<div class="digiCrud">
				  <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->service_provide_location_id . '" id="status_' . $record->service_provide_location_id . '" name="check_' . $record->service_provide_location_id . '" onclick="statustoggle(this, \'' .  URL_SERVICE_LOCATION_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}

			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->location_model->count_all(),
					"recordsFiltered" => $this->location_model->count_filtered(),
					"data" => $data,
			);				
			echo json_encode($output);		
		}    
	}
	
	function location_statustoggle()
	{
		if(!$this->check_isdemo_ajax(URL_SERVICE_LOCATIONS)){
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
			
			$this->base_model->update_operation_in( $filedata,TBL_SERVICE_DELIVERED_LOCATIONS,'service_provide_location_id', explode(',', $id) );
			echo json_encode(array('status' => 1, 'message' => $message.$this->db->affected_rows(), 'action' => 'success'));
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
	
	/***get cities through ajax call based on state id***/
	function get_cities()
	{
		$id = $this->input->get('id');
		
		$cities = $this->location_model->getCities($id);
		$no_data_avialable = (isset($this->phrases['no data available'])) ? $this->phrases['no data available'] : "No data available";
		
		if(count($cities)>0){
		$options = '<option value="">Select City</option>';
			foreach($cities as $s ) { 
			$options .= '<option value="'.$s->city_id.'">'
						.ucwords($s->city_name).'</option>';
			}	
		}
		else
		{
			$options = '<option value="">'.$no_data_avialable.'</option>';
		}
		echo $options;
	}
	
	
}
?>
