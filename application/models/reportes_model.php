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


}