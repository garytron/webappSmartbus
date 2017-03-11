<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MapsModel extends CI_Model
{
    function __construct()
    {
      // Call the Model constructor
      parent::__construct();
      $this->load->database();
      date_default_timezone_set('America/Mexico_City');
    }

    function findAll()
    {
      $query = $this->db->get("ubicacion");
      return $query->result();
    }

    function insertarCoordenadas($data)
    {
      $result = $this->db->insert('ubicacion',$data);

      if($result)
        return true;
      else
        return false;
    }

    function getRutas($nombre)
    {
      $this->db->where('nombre',$nombre);
      return json_encode($this->db->get('vruta')->row());
    }

}
?>