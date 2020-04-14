<?php 

class Banner extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') !="login") {
			redirect(base_url("Auth"));
		}
		$this->load->library(array('form_validation','session'));
	
		$this->load->model('M_versi');
	}
	
	public function index()
	{
		$data['banner'] = $this->M_photo_booth->getdata('tbl_banner');

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('banner/v_banner',$data);
		$this->load->view('photo_booth/template/footer');
	}
	public function insert_action()
	{
		$id_banner     =  $this->input->post('id_banner');
		$img_banner =  $_FILES['img_source'];
		$status =  $this->input->post('status');
	//	$created_at =  $this->input->post('created_at');

        $config = [];
			$config['upload_path']  = './assets/img/banner/';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config,'banner');
			$this->banner->initialize($config);
			$upload_cover = $this->banner->do_upload('img_source');
			$img_Data = $this->banner->data('file_name');

			$data = ['img_banner' => $img_Data, 'status'	  => $status,];

		$save = $this->db->insert('tbl_banner',$data);

		// buat nambahin versi 
		$get_versi = $this->M_versi->getdata('tbl_version');
		$versi = $get_versi->versi + 1;
		$data_versi = array(
			'versi' 		=> $versi,
			
		);
		$save_versi = $this->M_versi->insertdata($data_versi);
		// end buat nambahin versi 

		if ($save) {
			$alert = '<div class="alert alert-success"><strong>Insert Data Complate</strong></div>';
			$this->session->set_flashdata('message',$alert);
		redirect('Banner/index');
		

    	}	
		
	}
	public function delete($id)
	{
		$where = array('id_banner' => $id);
		$this->M_photo_booth->deletedata($where,'tbl_banner');
        
        $hapus = $this->M_photo_booth->deletedata($where,'tbl_banner');

		// buat nambahin versi 
		$get_versi = $this->M_versi->getdata('tbl_version');
		$versi = $get_versi->versi + 1;
		$data_versi = array(
			'versi' 		=> $versi,
			
		);
		$save_versi = $this->M_versi->insertdata($data_versi);
		// end buat nambahin versi 

        if ($hapus) {
			$link = "assets/img/banner/".$data['banner'];
			if(file_exists($link)){
                unlink($link);
                
            }else{
                echo "gagal";
			}
			redirect('Banner/index');
			
	  
		}
	}
	public function edit($id)
	{
		$where = array('id_banner' => $id);
		$data['banner'] = $this->M_photo_booth->editdata($where,'tbl_banner')->result();

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('banner/edit_banner',$data);
		$this->load->view('photo_booth/template/footer');		
	}
	public function update()
	{
		$id_banner    =  $this->input->post('id_banner');
        $img_banner =  $_FILES['img_source'];
		$where = ['id_banner'=> $id_banner];
		
        $config = [];
        $config['upload_path']  = './assets/img/banner/';
        $config['allowed_types'] = 'jpg|png|gif';
        $this->load->library('upload',$config,'banner');
        $this->banner->initialize($config);
        $upload_cover = $this->banner->do_upload('img_source');
        $img_Data = $this->banner->data('file_name');

		
		// buat nambahin versi 
		$get_versi = $this->M_versi->getdata('tbl_version');
		$versi = $get_versi->versi + 1;
		$data_versi = array(
			'versi' 		=> $versi,
			
		);
		$save_versi = $this->M_versi->insertdata($data_versi);
		// end buat nambahin versi 

        

        $img_banner   = $_FILES['img_source']['name'];
		if($img_banner ==  ""){
			$img_banner= $this->input->post('img_banner_edit');	
		}else{
			$img_banner = $_FILES['img_source']['name'];
		}
		$data = ['img_banner' => $img_Data];

           $this->M_photo_booth->updatedata('tbl_banner',$data,$where);
		redirect('Banner/index');
	}
}
?>	