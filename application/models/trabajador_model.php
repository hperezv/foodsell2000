<?php
class trabajador_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_trabaj_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('trabajadores');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

  
    public function get_trabaj($tipodoc_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('trabajadores.id');
		$this->db->select('trabajadores.codigo');
		$this->db->select('trabajadores.nombres');
		$this->db->select('trabajadores.apellidos');
		$this->db->select('trabajadores.dni');
		$this->db->select('trabajadores.area');
		$this->db->select('areas.nombre ');
		$this->db->from('trabajadores');
		if($tipodoc_id != null && $tipodoc_id != 0){
			$this->db->where('id', $tipodoc_id);
		}
		if($search_string){
			$this->db->like('codigo', $search_string);
		}

		$this->db->join('areas', 'trabajadores.area = areas.id', 'left');

		$this->db->group_by('trabajadores.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}


		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');


		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $tipodoc_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_trabaj($tipodoc_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('trabajadores');
		if($tipodoc_id != null && $tipodoc_id != 0){
			$this->db->where('area', $tipodoc_id);
		}
		if($search_string){
			$this->db->like('codigo', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_trabaj($data)
    {
		$insert = $this->db->insert('trabajadores', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_trabaj($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('trabajadores', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	function delete_trabaj($id){
		$this->db->where('id', $id);
		$this->db->delete('trabajadores'); 
	}
 
}
?>	
