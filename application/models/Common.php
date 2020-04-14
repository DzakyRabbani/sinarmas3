<?php

class Common extends CI_Model
{
	function GetDB()
	{
		return $this->db;
	}
	
	function get_trx($tid){
		$this->db->select('*');
		$query = $this->db->get_where('ssp_trans', array('tid' => $tid));
		$result = $query->result_array();
		
		$count = count($result);
		
		if(empty($count)){
			return false;
		}else{
			return $result;
		}
	}
}

?>