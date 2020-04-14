<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_banner extends MY_Model{
	
	protected $tableName= "tbl_banner";
    public $primaryKey = "id_banner";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}	
}
?>