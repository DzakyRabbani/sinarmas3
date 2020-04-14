<?php 

class User extends CI_Controller
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
		$data['user'] = $this->M_photo_booth->getdata('tbl_user');

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('user/v_user',$data);
		$this->load->view('photo_booth/template/footer');
	}
	public function insert_action()
	{
		$name     =  $this->input->post('name');
		$username =  $this->input->post('username');
		$password =  $this->input->post('password');


		$data = array(
				'name' 		  => $name,
				'username'    => $username,
				'password'	  => base64_encode($password) 
			);
		$save = $this->db->insert('tbl_user',$data);
		if ($save) {
			$alert = '<div class="alert alert-success"><strong>Insert Data Complate</strong></div>';
			$this->session->set_flashdata('message',$alert);
		redirect('User/index');
		}
	}
	public function delete($id)
	{
		$where = array('user_id' => $id);
		$this->M_photo_booth->deletedata($where,'tbl_user');
		redirect('User/index');
	}
	public function edit($id)
	{
		$where = array('user_id' => $id);
		$data['user'] = $this->M_photo_booth->editdata($where,'tbl_user')->result();

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('user/edit_user',$data);
		$this->load->view('photo_booth/template/footer');		
	}
	public function update()
	{
		$user_id 	   = $this->input->post('user_id');
		$name 		   = $this->input->post('name');
		$username	   = $this->input->post('username');
		$password	   = $this->input->post('password');

		$data = array(
			'name'			=> $name,
			'username'		=> $username,
			'password'		=> base64_encode($password)
			);
		$where = array(
			'user_id' => $user_id 
			);
		$this->M_photo_booth->updatedata('tbl_user',$data,$where);
		redirect('User/index');
	}
}
 ?>