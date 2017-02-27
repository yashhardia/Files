<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Base_Model extends CI_Model  

{

		

	function __construct()

	{

		parent::__construct();

	}

	

	function create_thumbnail($sourceimage,$newpath, $width, $height)

	{
		$this->load->library('image_lib');

		$this->image_lib->clear();

		

		$config['image_library'] = 'gd2';

		$config['source_image'] = $sourceimage;

		$config['create_thumb'] = TRUE;

		$config['new_image'] = $newpath;

		$config['dynamic_output'] = FALSE;

		$config['maintain_ratio'] = TRUE;

		$config['width'] = $width;

		$config['height'] = $height;

	    $config['thumb_marker'] = '';

		

		$this->image_lib->initialize($config); 

		return $this->image_lib->resize();

	}

	function fetch_records_from_query( $query = '' , $offset = '', $perpage = '' )	{		$rs = $this->db->query($query);		$this->numrows = $rs->num_rows();		if($offset != '' && $perpage != '')		$this->db->limit($perpage,$offset);		return $rs->result();	}

	function validate_upload_image($fieldmessage,$fieldname,$filepath,$thumbnailpath='',$width='',$height='')

	{

		$config['upload_path'] = $filepath;

		$config['allowed_types'] = 'gif|jpeg|jpg|png';

		//$config['max_size']	= '500';

		//$config['max_width']  = '1024';

		//$config['max_height']  = '768';

		$config['remove_spaces'] = TRUE;

		$config['overwrite'] = FALSE;

		//print_r($config);

		//die();

		$this->load->library('upload', $config);



		if(!$this->upload->do_upload($fieldname))

		{

			$this->form_validation->set_message($fieldmessage,$this->upload->display_errors());

			return $this->upload->display_errors();

			//return FALSE;

		}

		else

		{

			$filedata = $this->upload->data();

			

			$this->uploadedimagename = $filedata['file_name'];

			if(!empty($thumbnailpath))

			{

				 $this->create_thumbnail($filedata['full_path'],$thumbnailpath,$width,$height);

			}

			return TRUE;

		}

	}

	

	//General database operations

	function run_query( $query )

	{

		return($this->db->query( $query )->result());  

	}

	

	function getMaxId($TableName,$ColName)

	{

		$query = $this->db->query("select max(".$ColName.") as Id from ".$this->db->dbprefix($TableName))->result();

		return $query[0]->Id;

		

	}

	

	function insert_operation( $inputdata, $table, $email = '' )

	{

		//echo $this->db->dbprefix($table);

		if($this->db->insert($this->db->dbprefix($table),$inputdata))

		return 1;

		else 

		return 0;

	}

	

	function insert_operation_id( $inputdata, $table, $email = '' )

	{

		$result  = $this->db->insert($this->db->dbprefix($table),$inputdata);

		return $this->db->insert_id();

	}

	

	

	function update_operation( $inputdata, $table, $where )
	{
		
		$result  = $this->db->update($this->db->dbprefix($table),$inputdata, $where);
		
		return $result;

	}

	function fetch_records_from_in($table, $column, $value, $select = '*', $order_by = '', $like = '')
	{
		$this->db->start_cache();
			$this->db->select($select, FALSE);
			$this->db->from( $this->db->dbprefix( $table ) );
			$this->db->where_in( $column, $value );
			if( !empty( $like ) )
					$this->db->like( $like );
			if( !empty( $order_by ) )
				$this->db->order_by( $order_by );
		$this->db->stop_cache();    
		$this->numrows = $this->db->count_all_results();
		
		$result = $this->db->get();
		$this->db->flush_cache();
		return $result->result();
	}

	function fetch_records_from( $table, $condition = '',$select = '*', $order_by = '',$order_type='asc',$limit='' )
	{		$this->db->select($select, FALSE);
		$this->db->from( $this->db->dbprefix( $table ) );
		if( !empty( $condition ) )			$this->db->where( $condition );
		
		if( !empty( $order_by ) )			
		$this->db->order_by( $order_by,$order_type );				
		
		if(!empty( $limit) )			
		$this->db->limit( $limit );

		$result = $this->db->get();

		return $result->result();

	}

	

	function fetch_single_column_value($table, $column, $where)
	{

		$this->db->select($column,FALSE);

		$this->db->from( $this->db->dbprefix( $table ) );

		

		if( !empty( $where ) )

			$this->db->where( $where );

		$result_rs = $this->db->get();

		$result = $result_rs->result();

		if( count( $result ) > 0 )

			$ret = $result[0]->$column;

		else

			$ret = '-';

		return $ret;

	}

	

	

	function changestatus( $table, $inputdata, $where  )

	{

		$result = $this->db->update($this->db->dbprefix($table),$inputdata, $where);

		return $result;

	}

	

	function delete_record($table, $where)

	{	

		$result = $this->db->delete( $table, $where );

		return $result;

	}

	function delete_record_in($table, $where,$value)

	{	
		$this->db->where_in($where, $value);

		$result = $this->db->delete( $this->db->dbprefix($table));

		return $result;

	}	

	

	function check_duplicate($table_name,$cond,$cond_val)

	{

		$col_name='*';

		$this->db->where(array($cond=>$cond_val));

		$this->db->from($this->db->dbprefix($table_name));

		$query = $this->db->get();

		$rows = $query->num_rows();

		if( $rows > 0 )

		{

			return TRUE;

		}

		else

		{

			return FALSE;

		}

	}

	public function get_details($table)

	{

		$query	=	$this->db->get($table);

		return $query->result_array();

	}

	
	 public function getLanguageWords($language_id = 1)
    {
        $lang_words = array();
        if ($language_id != "" && $language_id > 0) {
            $query      = "SELECT ml . * , l . * , p . text AS phrase  
                        FROM " . $this->db->dbprefix('multi_lang') . " ml, 
                        " . $this->db->dbprefix('languages') . " l, 
                        " . $this->db->dbprefix('phrases') . " p 
                        WHERE l.id = ml.lang_id
                        AND l.status = 'Active' 
                        AND p.id = ml.phrase_id  
                        AND ml.lang_id =" . $language_id;
            $lang_words = $this->db->query($query)->result();
        }
        if (count($lang_words) == 0) {
            $lang_words = $this->db->query("SELECT text AS phrase, text AS text, 'English' AS lang_name, 1 AS lang_id FROM " . $this->db->dbprefix('phrases') . " ")->result();
        }
        return $lang_words;
    } 
	
	// Prepare Dropdown Data
    function prepareDropdown($table, $column_id, $column_name, $cond = array())
    {
        $list        = $this->db->get_where($this->db->dbprefix($table), $cond)->result();
        $option_data = array(
            '' => 'Select'
        );
        foreach ($list as $key => $val) {
            $option_data[$val->$column_id] = $val->$column_name;
        }
        return $option_data;
    }
	
	/*function prepareDropdownAddon()
	{
		$list        = $this->db->get_where($this->db->dbprefix(TBL_ADDONS), array('status' => 'Active'))->result();
        $option_data = array(
            '' => 'Select'
        );
        foreach ($list as $key => $val) {
            $option_data[$val->addon_id.'_'.$val->price] = $val->addon_name;
        }
        return $option_data;
	}*/
	
	function fetch_records_from_query_object($query, $offset = '', $perpage = '')
	{
		$resultset = $this->db->query( $query );
		$this->numrows = $resultset->num_rows();
		if( $perpage != '' )
			$query = $query . ' limit ' . $offset . ',' . $perpage;
		$resultsetlimit = $this->db->query( $query );
		return $resultsetlimit->result();
	}
	
	// Below functions added on 18-10-16
	
	function count_records( $table, $condition = '' )
	{
		if( !(empty($condition)) )
		$this->db->where( $condition );
		$this->db->from( $this->db->dbprefix( $table ) );
		$reocrds = $this->db->count_all_results();
		//echo $this->db->last_query();
		return $reocrds;
	}
	
	function fetch_value($table, $column, $where)
	{
		$this->db->select($column, FALSE);
		$this->db->from( $this->db->dbprefix( $table ) );
		$this->db->where( $where );
		$this->db->limit(0, 1);
		$result = $this->db->get()->result();
		$str = '-';
		if(count($result))
		{
			foreach($result as $row)
			{
				$str = $row->$column;
			}
		}
		return $str;
	}
	
	function build_query($table, $condition = array(), $columns = array(), $order = array())
	{
		$this->db->from($table);
		$this->db->group_start();
			if(isset($condition['condition']) && !empty($condition['condition']))
				$this->db->where( $condition['condition'] );
		$this->db->group_end();
		
		//$this->db->group_start();
			if(isset($condition['join']) && !empty($condition['join']))
			{
				foreach($condition['join'] as $key => $val)
				{
					$type = isset($val['type']) ? $val['type'] : 'inner';
					$this->db->join($val['table'], $val['left'] . ' = ' . $val['right'], $type);
				}
			}			
		//$this->db->group_end();
	}
	
	////////////////////////////Data Tables//////////////////////////
	private function _get_datatables_query_complex($table, $condition = array(), $columns = array(), $order = array())
	{	
		$this->db->start_cache();
		$this->db->from($table);
		$this->db->group_start();
			if(!empty($condition['condition']))
				$this->db->where( $condition['condition'] );
		$this->db->group_end();

		
			if(isset($condition['join']) && !empty($condition['join']))
			{
				foreach($condition['join'] as $key => $val)
				{
					$type = isset($val['type']) ? $val['type'] : 'inner';
					$this->db->join($val['table'], $val['left'] . ' = ' . $val['right'], $type);
				}
			}				
		
		if($_POST['search']['value'])
		$this->db->group_start();		
			$i = 0;
			$column = array();			
			foreach ($columns as $item) 
			{
				if($_POST['search']['value'])
					($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
				$column[$i] = $item;
				$i++;
			}			
		if($_POST['search']['value'])
		$this->db->group_end();
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(count($order) > 0)
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}		
		
		echo $this->db->query(); die();
		$this->db->stop_cache();	
	}
	
	private function _get_datatables_query($table, $condition = array(), $columns = array(), $order = array())
	{	
		$this->db->start_cache();
		$this->db->from($table);
		$this->db->group_start();
			if(!empty($condition))
				$this->db->where( $condition );
		$this->db->group_end();
		
		if($_POST['search']['value'])
		$this->db->group_start();
			$i = 0;
			$column = array();			
			foreach ($columns as $item) 
			{
				if($_POST['search']['value'])
					($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
				$column[$i] = $item;
				$i++;
			}			
		if($_POST['search']['value'])
		$this->db->group_end();
	
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($order))
		{
			$order = $order;
			$this->db->order_by(key($order), $order[key($order)]);
		}		
		$this->db->stop_cache();	
	}
	
	private function _get_datatables_query_new($table, $condition = array(), $columns = array(), $order = array())
    {
         
        $this->db->from($table);
        
        if(!empty($condition))
				$this->db->where( $condition );
 
        $i = 0;
        
        $column = array();		
     
        foreach ($columns as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($columns) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            //$column[$i] = $item;
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($order))
        {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    } 
	
	private function _get_datatables_customquery($query, $condition=array(),$columns = array(), $order = array())
	{	
		if($_POST['search']['value'])
		$this->db->group_start();
		$i = 0;
		$column = array();
		$str = '';
			foreach ($columns as $item) 
		{
			
			if($_POST['search']['value'])
					($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
				$column[$i] = $item;
				$i++;
		}		
		if($_POST['search']['value'])
		$this->db->group_end();
			
		//$this->db->query( $query . $str );
		if($str != '')
			$str = ' WHERE 1 = 1 '.$str;
		if(isset($_POST['order']))
		{
			$str .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'];
		} 
		else if(count($order) > 0)
		{
			$order = $order;
			$str .= ' ORDER BY ' . key($order) . ' ' . $order[key($order)];
		}
		
		return 	$query . $str;	
	}
	
	function get_datatables($table, $type = 'auto', $condition = array(), $columns = array(), $order = array())
	{
		if($type == 'custom')
		{
			$query_str = $this->_get_datatables_customquery($table, $condition, $columns, $order);
			//echo $query_str;die();
			$query = $this->db->query( $query_str );
			$this->numrows = $this->db->affected_rows();
			if($_POST['length'] != -1)
			$query = $this->db->query($query_str . ' LIMIT ' . $_POST['start'] . ',' . $_POST['length']);
		}
		else if($type == 'complex')
		{
			$this->_get_datatables_query_complex($table, $condition, $columns, $order);
			$queryall = $this->db->get();
			$this->numrows = $this->db->affected_rows();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			
		}
		else
		{
			$this->_get_datatables_query($table, $condition, $columns, $order);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			
		}		
		$this->db->flush_cache();
		
		return $query->result();
	}
	
	function count_filtered($table, $type = 'auto', $condition = array(), $columns = array(), $order = array())
	{
		if($type == 'custom')
		{
			$query_str = $this->_get_datatables_customquery($table, $condition, $columns, $order);
			//$query = $this->db->query( $query_str );
			//echo $query_str;
			$this->numrows = $this->db->affected_rows();
			if($_POST['length'] != -1)
			$query = $this->db->query($query_str . ' LIMIT ' . $_POST['start'] . ',' . $_POST['length']);
			$query = $this->db->query($query_str);
			//echo "<pre>";//
			//print_r($query); die();
		}
		if($type == 'complex')
		{
			$this->_get_datatables_query_complex($table, $condition, $columns, $order);
			$query = $this->db->get();
		}
		else
		{
			$this->_get_datatables_query($table, $condition, $columns, $order);
			$query = $this->db->get();
		}
		
		return $query->num_rows();
	}
	
	public function count_all($table, $condition = array())
	{
		$this->db->from($table);
		if(!empty($condition))
			$this->db->where( $condition );
		return $this->db->count_all_results();
	}
	
	function update_operation_in( $inputdata, $table, $column, $values )
	{
		$this->db->where_in($column, $values);
		$result  = $this->db->update($this->db->dbprefix($table),$inputdata);
		
		return $result;
	}
	
	
}

?>