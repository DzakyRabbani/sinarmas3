<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_background extends MY_Model{
	
	protected $tableName= "tbl_background";
    public $primaryKey = "background_id";
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}	
}
?>