<?php
class areas_model extends CI_Model {
 
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
    public function getAreas()
    {	    
        $this->db->select('*');        
        $this->db->from('areas');
        $this->db->order_by('nombre', 'Asc');
        $query = $this->db->get();
        
        return $query->result_array(); 	
    }     
}
