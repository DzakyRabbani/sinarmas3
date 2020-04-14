<?php 

class M_versi extends CI_Model{


public function getdata($table)
	{
		return $this->db->get($table)->last_row();
    }
public function insertdata($data)
{
  return $this->db->insert('tbl_version', $data);  
}

}
    ?>