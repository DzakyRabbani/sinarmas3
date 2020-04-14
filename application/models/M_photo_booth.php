<?php 

class M_photo_booth extends CI_Model
{
	public function cek_login($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
	public function getdata($table)
	{
		return $this->db->get($table)->result();
	}
	public function deletedata($where,$table)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}
	public function editdata($where,$table)
	{
		return $this->db->get_where($table,$where);
	}
	public function updatedata($table,$data,$where)
	{
		$this->db->where($where);
		return $this->db->update($table,$data);
	}
	public function delete_data($where,$table,$data)
	{
		$this->db->where($where);
		return $this->db->delete($table,$data);
	}
}
 ?>
