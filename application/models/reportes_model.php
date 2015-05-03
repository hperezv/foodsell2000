<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_model extends CI_Model {


    public function getTrabareportes()
    {
        $query=$this->db
                ->select("*")
                ->from("trabajadores")
                ->get();
                return $query->result();
    }
    public function getAreas()
    {	    
        $this->db->select('*');        
        $this->db->from('areas');
        $this->db->order_by('nombre', 'Asc');
        $query = $this->db->get();
        
        return $query->result_array(); 	
    }     
    function getTrabajadoresByArea($areasId){
        $this->db->select('*');        
        $this->db->from('trabajadores');
        $this->db->where('areas_id', $areasId);
        $query = $this->db->get();
        return $query->result_array(); 	
    }
    public function getVentaDiaria($trabajadoresId, $fecha)
    {	
        $this->db->select('trabajadores_id, sum(total) - sum(acuenta) as total, sum(if(productos_id=1,total,0)) as total_almuerzo', FALSE);
        $this->db->from('ventas');
        $this->db->where('trabajadores_id', $trabajadoresId);
        $this->db->like('fecha_hora_reporte', $fecha);
        $this->db->group_by('trabajadores_id');
        //$this->db->having('trabajadores.id', $trabajadoresId);
        
        $query = $this->db->get();
        //echo $this->db->last_query();
        //print_r($query->result_array());
        //exit;

        return $query->result_array(); 	
    }
}