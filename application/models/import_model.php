<?php
defined("BASEPATH") OR exit("El acceso directo al script no está permitido!!!");
 
class Import_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
 
  public function excel($table_name,$sql)
  {
    //si existe la tabla
    if ($this->db->table_exists("$table_name"))
    {
      //si es un array y no está vacio
      if(!empty($sql) && is_array($sql))
      {
        //si se lleva a cabo la inserción
        if($this->db->insert_batch("$table_name", $sql))
        {
          return TRUE;
        }else{
          return FALSE;
        }
      }
    }
  }
}