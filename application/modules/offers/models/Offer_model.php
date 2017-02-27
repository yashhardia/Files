<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

	class Offer_model extends CI_Model
{
		public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');

	}
	
	// Create Offer
    function createOffer($offerData = array())
    {
        $input_data['offer_name']            = $offerData['offer_name'];
        $input_data['offer_cost']            = $offerData['offer_cost'];
        $input_data['offer_start_date']      = date('Y-m-d', strtotime($offerData['offer_start_date']));
        $input_data['offer_valid_date']      = date('Y-m-d', strtotime($offerData['offer_valid_date']));
        $input_data['offer_conditions']      = $offerData['offer_conditions'];
        $input_data['serve_no_of_people']    = $offerData['serve_no_of_people'];
        $no_of_products                      = $offerData['product_count'];
        $input_data['no_of_products']        = $no_of_products - 1;
        $input_data['status']                = $offerData['status'];
        $id                                  = $this->base_model->insert_operation_id($input_data, TBL_OFFERS);
        if ($id) {
            if ($no_of_products > 1) {
                $batch_data = array();
                for ($i = 1; $i < $no_of_products; $i++) {
                    $data['offer_id']    = $id;
                    $data['menu_name']   = $offerData['menu' . $i];
                    $data['item_name']   = $offerData['item_name' . $i];
                    $data['item_id']     = $offerData['item_id' . $i];
                    $data['quantity']    = $offerData['quantity' . $i];
                    array_push($batch_data, $data);
                }
                if ($this->db->insert_batch(DBPREFIX.TBL_OFFER_PRODUCTS, $batch_data)) {
                    return $id;
                }
            }
        } else {
            return false;
        }
    }
    //Edit Offer
    function editOffer($offerId, $offerData = array())
    {
        $input_data['offer_name']         = $offerData['offer_name'];
        $input_data['offer_cost']         = $offerData['offer_cost'];
        $input_data['offer_start_date']   = date('Y-m-d', strtotime($offerData['offer_start_date']));
        $input_data['offer_valid_date']   = date('Y-m-d', strtotime($offerData['offer_valid_date']));
        $input_data['offer_conditions']   = $offerData['offer_conditions'];
        $input_data['serve_no_of_people'] = $offerData['serve_no_of_people'];
        $no_of_products                   = $offerData['product_count'];
        $input_data['no_of_products']     = $no_of_products - 1;
        $input_data['status']             = $offerData['status'];
        $where['offer_id']                = $offerId;
        if ($this->base_model->update_operation($input_data, TBL_OFFERS, $where)) {
            if ($no_of_products > 1) {
                $this->db->where('offer_id', $offerId);
                if ($this->db->delete(DBPREFIX.TBL_OFFER_PRODUCTS)) {
                    $batch_data = array();
                    for ($i = 1; $i < $no_of_products; $i++) {
                        $data['offer_id']    = $offerId;
					    $data['menu_name']   = $offerData['menu' . $i];
						$data['item_id']     = $offerData['item_id' . $i];
                        $data['item_name']   = $offerData['item_name' . $i];
                        $data['quantity']    = $offerData['quantity' . $i];
                        array_push($batch_data, $data);
                    }
                    if ($this->db->insert_batch(DBPREFIX.TBL_OFFER_PRODUCTS, $batch_data)) {
                        return true;
                    }
                }
            }
        } else {
            return false;
        }
    }
	
}

?>