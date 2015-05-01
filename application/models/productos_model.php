
<?php
class productos_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get productos
    * @param int $product_id 
    * @return array of products
    */
    public function get_productos($tipodoc_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {	    
        $this->db->select('productos.id');
        $this->db->select('productos.nombre');
        $this->db->select('productos.precio');
        $this->db->select('productos.cantidad');        
        $this->db->from('productos');
                
        if($search_string){
            $this->db->like('nombre', $search_string);
        }
        
        if($order){
                $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('nombre', $order_type);
        }

        $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //exit;

        return $query->result_array(); 	
    } 
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function new_productos($data)
    {
        $insert = $this->db->insert('productos', $data);
        return $insert;
    }
    function delete_productos($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('productos'); 
    }
    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_productos($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('productos', $data);
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
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_producto_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('productos');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
}
