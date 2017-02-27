<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Offers extends MY_Controller
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
	        $this->load->model('offer_model');
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
			'url' => URL_OFFER_AJAX_GET_DATA,
			'disablesorting' => '0,8',
			);
	        $this->data['active_class'] = ACTIVE_OFFERS;
	        $this->data['title']        = (isset($this->phrases['offers'])) ? $this->phrases['offers'] : "";
	        $this->data['content']      = 'offers';
	        $this->_render_page(TEMPLATE_ADMIN, $this->data);
		}
		
		/*** View Offer Details ****/
	function offer_details($offer_id)
	{
		$offer_details = $this->base_model->fetch_records_from(TBL_OFFERS,array('offer_id'=>$offer_id));
		
		if(!empty($offer_details)){
			$offer_products = $this->base_model->fetch_records_from(TBL_OFFER_PRODUCTS,array('offer_id'=>$offer_id));
			if(!empty($offer_products)){
				$this->data['offer_products'] = $offer_products;
			}else{
				$this->data['offer_products'] = array();
			}
			
			$this->data['offer_details'] = $offer_details[0];
			$this->data['active_class'] = ACTIVE_OFFERS;
			$this->data['title']        = (isset($this->phrases['offers'])) ? $this->phrases['offers'] : "Offers";
			$this->data['content']      = 'offer_details';
			$this->_render_page(TEMPLATE_ADMIN, $this->data);
		}else{
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
            $this->prepare_flashmessage($msg, 2);
            redirect(URL_ADMIN_OFFERS);
		}
	}
	/*** End of View Offer Details ****/
	
	/*** Create Offer ****/
    function create_offer()
    {
       
        if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_OFFERS);	
            $this->form_validation->set_rules('offer_name', $this->phrases['offer name'], 'required');
            $this->form_validation->set_rules('offer_cost', $this->phrases['offer cost'], 'required|numeric');
            $this->form_validation->set_rules('offer_start_date', $this->phrases['offer start date'], 'required');
            $this->form_validation->set_rules('offer_valid_date', $this->phrases['offer valid date'], 'required');
            $this->form_validation->set_rules('offer_conditions', $this->phrases['offer conditions'], 'required');
            $this->form_validation->set_rules('serve_no_of_people', $this->phrases['serve no of people'], 'required|numeric');
            $this->form_validation->set_rules('product_count', $this->phrases['product count'], 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $id = $this->offer_model->createOffer($this->input->post());
                if ($id) {
                    if (!empty($_FILES['userfile']['name'])) {
						$ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $config['upload_path']   = IMG_OFFER;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = true;
                        $config['file_name']     = OFFER. "_" . $id . "." . $ext;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $where['offer_id']          = $id;
                            $update_data['offer_image_name'] =  OFFER. "_" . $id . "." . $ext;
                            $this->base_model->update_operation($update_data, TBL_OFFERS, $where);
                            $msg = (isset($this->phrases['added sucessfully'])) ? $this->phrases['added sucessfully'] : "Added Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_ADMIN_OFFERS,REFRESH);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                            redirect(URL_ADMIN_OFFERS);
                        }
                    }
                } else {
                    $msg = (isset($this->phrases['unable to add'])) ? $this->phrases['unable to add'] : "Unable To Add";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_OFFERS,REFRESH);
                }
            }
        }
        
        $this->data['categories']   = $this->base_model->prepareDropdown(TBL_MENU, 'menu_id', 'menu_name', array(
            'status' => 'Active'
        ));
        
        
        $this->data['active_class'] = ACTIVE_OFFERS;
        $this->data['title']        = (isset($this->phrases['create offer'])) ? $this->phrases['create offer'] : "Create Offer";
        $this->data['content']      = 'create_offer';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    }
    /*** End of Create Offer ****/
    /*** Edit Offer ****/
     function edit_offer($offerId = null)
    {
        if ($this->input->post()) {
			$this->check_isdemo(URL_ADMIN_OFFERS);
            $offerId = $this->input->post('offer_id');
            $this->form_validation->set_rules('offer_name', $this->phrases['offer name'], 'required');
            $this->form_validation->set_rules('offer_cost', $this->phrases['offer cost'], 'required|numeric');
            $this->form_validation->set_rules('offer_start_date', $this->phrases['offer start date'], 'required');
            $this->form_validation->set_rules('offer_valid_date', $this->phrases['offer valid date'], 'required');
            $this->form_validation->set_rules('offer_conditions', $this->phrases['offer conditions'], 'required');
            $this->form_validation->set_rules('serve_no_of_people', $this->phrases['serve no of people'], 'required|numeric');
            $this->form_validation->set_rules('product_count', $this->phrases['product count'], 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            
            if ($this->form_validation->run() == TRUE) {
                $id = $this->input->post('offer_id');
                if ($this->offer_model->editOffer($id, $this->input->post())) {
                    if (!empty($_FILES['userfile']['name'])) {
                        $ext = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
                        $config['upload_path']   = IMG_OFFER;
                        $config['allowed_types'] = ALLOWED_TYPES;
                        $config['overwrite']     = TRUE;
                        $config['file_name']     = OFFER. "_" . $id . "." . $ext;
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload()) {
                            $where['offer_id']          = $id;
                            $update_data['offer_image_name'] = OFFER. "_" . $id . "." . $ext;
                            $this->base_model->update_operation($update_data, TBL_OFFERS, $where);
                            $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
							$this->prepare_flashmessage($msg, 0);
                            redirect(URL_ADMIN_OFFERS,REFRESH);
                        } else {
                            $this->prepare_flashmessage($this->upload->display_errors(), 1);
                            redirect(URL_ADMIN_OFFERS);
                        }
                    } else {
                        $msg = (isset($this->phrases['updated successfully'])) ? $this->phrases['updated successfully'] : "Updated Successfully";
						$this->prepare_flashmessage($msg, 0);
                        redirect(URL_ADMIN_OFFERS,REFRESH);
                    }
                } else {
                    $msg = (isset($this->phrases['unable to update'])) ? $this->phrases['unable to update'] : "Unable to update";
					$this->prepare_flashmessage($msg, 1);
                    redirect(URL_ADMIN_OFFERS,REFRESH);
                }
            }
        } 
		
        if ($offerId == null) {
            redirect(URL_ADMIN_OFFERS);
        }
		
        $this->data['message'] = $this->session->flashdata('message');
        $offer                 = $this->base_model->fetch_records_from(TBL_OFFERS, array(
            'offer_id' => $offerId
        ));
        if (count($offer) > 0) {
            $this->data['offer']         = $offer[0];
            $this->data['offerProducts'] = $this->base_model->fetch_records_from(TBL_OFFER_PRODUCTS, array('offer_id' => $offerId));
        }else{
			$msg = (isset($this->phrases['record not found'])) ? $this->phrases['record not found'] : "Record not found";
			$this->prepare_flashmessage($msg, 2);
			redirect(URL_ADMIN_OFFERS);	
		}
        $this->data['categories']   = $this->base_model->prepareDropdown(TBL_MENU, 'menu_id', 'menu_name', array(
            'status' => 'Active'
        ));
        $this->data['active_class'] = ACTIVE_OFFERS;
        $this->data['title']        = (isset($this->phrases['edit offer'])) ? $this->phrases['edit offer'] : "Edit Offer";
        $this->data['content']      = 'edit_offer';
        $this->_render_page(TEMPLATE_ADMIN, $this->data);
    } 
    /*** End of Edit Offer ****/
    /*** Delete Offer ****/   
    function delete_offer()
    {
		
		if(!$this->check_isdemo_ajax(URL_ADMIN_OFFERS)){
		$id = $this->input->post('id');
		if(!empty($id))
		{			
			$ids = explode(',', $id);
			$details = $this->base_model->fetch_records_from_in(TBL_OFFERS, 'offer_id', $ids);
			
			if(!empty($details))
			{
				
				if($this->base_model->delete_record_in(TBL_OFFERS, 'offer_id',$ids)){
					
				$this->load->helper("file");
				foreach($details as $recod)
				{
					if($recod->offer_image_name != '')
					{
						if(file_exists(IMG_OFFER .DS. $recod->offer_image_name))
						{
							unlink(IMG_OFFER .DS. $recod->offer_image_name);
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
		
		if($this->input->post())
		{
			
			$data = array();
			
			$no = $_POST['start'];
			
			$columns = array('offer_id', 'offer_name', 'offer_cost', 'offer_start_date','offer_valid_date','serve_no_of_people','no_of_products','status');
			
			$condition = array('1'=>'1');
			
			$records = $this->base_model->get_datatables(TBL_OFFERS, 'auto', $condition, $columns, array('offer_id' => 'desc'));
			
			foreach($records as $record)
			{	
				$no++;
				$row = array();
								
				$row[] = '<input id="checkbox-'.$record->offer_id.'" class="checkbox-custom checkbox_class" name="ids[]" type="checkbox" onclick="javascript:deselectall_check(\'selectall\')" value="'.$record->offer_id.'">';
                $row[] = '<span>'.$record->offer_name.'</span>';        
				$row[] = '<span>'.$record->offer_cost.'</span>';
				$row[] = '<span>'.$record->offer_start_date.'</span>';
				$row[] = '<span>'.$record->offer_valid_date.'</span>';								$row[] = '<span>'.$record->no_of_products.'</span>';
				$row[] = '<span>'.$record->serve_no_of_people.'</span>';
				
				$checked = '';
				$class = 'badge danger';
				if($record->status == 'Active'){
					$checked = ' checked';
					$class = 'badge success';	
				}
				$row[] = '<span class="'.$class.'">'.$record->status.'</span>';
				//add html for action
				$row[] = '<div class="digiCrud">							
					<a data-toggle="modal" class="btn btn-danger" data-target="#deletemodal" onclick="delete_record('.$record->offer_id . ',\''.URL_DELETE_OFFER.'\')">
						<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Remove"></i>
					</a>
				</div>
				
				<div class="digiCrud">
					<a href="'.URL_EDIT_OFFER . '/' . $record->offer_id . '" class="btn btn-info">
						<i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Edit"></i>
					</a>
				</div>
				
				<div class="digiCrud">
				   <label class="switch"style="width:50px">
					
					<input type="checkbox" value="' . $record->offer_id . '" id="status_' . $record->offer_id . '" name="check_' . $record->offer_id . '" onclick="statustoggle(this, \'' .  URL_OFFER_STATUSTOGGLE .'\')"'.$checked . '/>
					 <div class="slider round"></div>
                </label>
				  </div>
				</div>
				';
				$data[] = $row;
			}
			$output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->base_model->count_all(TBL_OFFERS, $condition),
					"recordsFiltered" => $this->base_model->count_filtered(TBL_OFFERS, 'auto', $condition, $columns, array('offer_id' => 'desc')),
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
		if(!$this->check_isdemo_ajax(URL_ADMIN_OFFERS)){
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
			$this->base_model->update_operation_in( $filedata, TBL_OFFERS, 'offer_id', explode(',', $id) );
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
