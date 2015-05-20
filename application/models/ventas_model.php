<?php
class ventas_model extends CI_Model {
 
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
    public function get_ventas($tipodoc_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {	
        $this->db->select('ventas.*, trabajadores.dni, concat(trabajadores.apellidos,", ",trabajadores.nombres) as trabajador, areas.nombre as area, productos.nombre as producto', FALSE);
        $this->db->from('ventas');
                
        if($search_string){
            $this->db->like('nombre', $search_string);
        }
        
        if($order){
                $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id', 'Desc');
        }
        $this->db->join('productos', 'ventas.productos_id = productos.id', 'left');
        $this->db->join('trabajadores', 'ventas.trabajadores_id = trabajadores.id', 'left');
        $this->db->join('areas', 'trabajadores.areas_id = areas.id', 'left');
        

        $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query->result_array());
        //exit;

        return $query->result_array(); 	
    }
    
    public function get_ventas_by_trabajador($trabajadorId, $limit_start, $limit_end)
    {	
        $this->db->select('ventas.*, trabajadores.dni, concat(trabajadores.apellidos,", ",trabajadores.nombres) as trabajador, areas.nombre as area, productos.nombre as producto', FALSE);
        $this->db->from('ventas');
        $this->db->where('trabajadores.id', $trabajadorId);
        $this->db->order_by('id', 'Desc');

        $this->db->join('productos', 'ventas.productos_id = productos.id', 'left');
        $this->db->join('trabajadores', 'ventas.trabajadores_id = trabajadores.id', 'left');
        $this->db->join('areas', 'trabajadores.areas_id = areas.id', 'left');
        

        $this->db->limit($limit_start, $limit_end);

        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query->result_array());
        //exit;

        return $query->result_array(); 	
    }
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function new_ventas($data)
    {
        $insert = $this->db->insert('ventas', $data);
        return $insert;
    }
    function delete_ventas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ventas'); 
    }
    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_ventas($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('ventas', $data);
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
    public function get_venta_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('ventas');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array(); 
    }
    public function getVentaDiaria($trabajadoresId, $fecha)
    {	
        $this->db->select('trabajadores_id, sum(total) as total, sum(if(productos_id=1,total,0)) as total_almuerzo', FALSE);
        $this->db->from('ventas');
        $this->db->where('trabajadores_id', $trabajadoresId);
        $this->db->like('fecha_hora', $fecha);
        $this->db->group_by('trabajadores_id');
        //$this->db->having('trabajadores.id', $trabajadoresId);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query->result_array());
        //exit;

        return $query->result_array(); 	
    }
}
?>	
