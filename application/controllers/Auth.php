<?php 

class Auth extends CI_Controller
{
	public function index()
	{
		$this->load->view('login/login');
	}
	public function login_action()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
					'username' => $username,
					'password' => base64_encode($password)
					);
		$cek = $this->M_photo_booth->cek_login("tbl_user",$where)->num_rows();
		$data = $this->M_photo_booth->cek_login("tbl_user",$where)->row_array();
		if($cek >0 ) {
			
			$data_session = array(
					'username' => $username,
					'status'   => 'login' ,
					'hak' => $data['hak_akses']
					);
			$this->session->set_userdata($data_session);
			redirect('C_photo_booth');
		}else{
			echo "username dan password salah";
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Auth'));
	}
}
 ?>