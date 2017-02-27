<?php 
class Reports extends MY_Controller{
    

    function __construct(){
			parent::__construct();
			 $this->load->library(array(
				'ion_auth',
				'form_validation'
	        ));
            $this->load->model('base_model');
		}
    function index()
    {
		
    }
    public function show_reports()
    {  
        $p_category = $this->base_model->fetch_records_from(TBL_INFOTAINMENT, $condition = 'parent_category=0',$select = '*', $order_by = '',$order_type='asc',$limit='' );
		$sub_category = $this->base_model->fetch_records_from(TBL_INFOTAINMENT, $condition = 'parent_category!=0',$select = '*', $order_by = '',$order_type='asc',$limit='' );  
		$array = json_decode(json_encode($p_category), true);
        $this->data['data'] = $array;
		$array2 = json_decode(json_encode($sub_category), true);
		$data['sub_category'] = $array2;
		$this->data['sub_category'] = $array2;
        if($this->input->post()){
        $parent_category = $this->input->post('parent_category');
        $sub_category = $this->input->post('sub_category');
	if($parent_category!=0 && $sub_category!=0){
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter = ",";
		$newline = "\r\n";
		$date = date('Y-m-d');
		$filename = "Report(".$date.").xls";
		$query = "SELECT * FROM dn_infotainment_media where category=".$parent_category." OR sub_category=".$sub_category;
		$result = $this->db->query($query);
		$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        /*if (!file_exists('reports')) {
            mkdir('reports1'.$filename, 0777, true);
        }*/
        file_put_contents('reports/'.$filename,$data);
        redirect(base_url().'reports/'.$filename);
       
	}
        else{
                $this->data['message'] = "Please Select Mandetory Fields";
                $this->data['active_class'] = ACTIVE_REPORT;        
                $this->data['title']        = (isset($this->phrases['reports'])) ? Reports : "Reports"; 
                $this->data['content']      = 'reports';        $this->_render_page(TEMPLATE_ADMIN, $this->data); }}
                $this->data['active_class'] = ACTIVE_REPORT;        
                $this->data['title']        = (isset($this->phrases['reports'])) ? Reports : "Reports";
                $this->data['content']      = 'reports';        $this->_render_page(TEMPLATE_ADMIN, $this->data); 
    }      
                
}

?>
