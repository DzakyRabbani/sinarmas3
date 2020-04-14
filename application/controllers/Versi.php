<?php 

class Versi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') !="login") {
			redirect(base_url("Auth"));
		}
		$this->load->library(array('form_validation','session'));

	}
	
	public function index()
	{
        $data['versi'] = $this->M_photo_booth->getdata('tbl_version');

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
        $this->load->view('versi/v_versi',$data);
		$this->load->view('photo_booth/template/footer');
	}



}
 ?>