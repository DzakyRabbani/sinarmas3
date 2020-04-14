	<?php 

class C_photo_booth extends CI_Controller
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
		$data['background'] = $this->M_photo_booth->getdata('tbl_background');

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('photo_booth/v_photo_booth',$data);
		$this->load->view('photo_booth/template/footer');
	}
	public function insert_action()
	{
		$update = '1';
		$name   =  $this->input->post('name');
		$thumbnail    =  $_FILES['thumbnail'];
		$img    =  $_FILES['img_source'];
		$icon    =  $_FILES['icon'];
		$position =  $this->input->post('position');
		$status =  $this->input->post('status');
			$config = [];
			$config['upload_path']  = './assets/img/button/';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config,'button');
			$this->button->initialize($config);
		    $upload_cover = $this->button->do_upload('thumbnail');
			$thumbnail = $this->button->data('file_name');

			$config = [];
			$config['upload_path']  = './assets/img/background/';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config,'background');
			$this->background->initialize($config);
		    $upload_cover = $this->background->do_upload('img_source');
			$img = $this->background->data('file_name');

			$config = [];
			$config['upload_path']  = './assets/img/icon/';
			$config['allowed_types'] = 'jpg|png|gif';
			$this->load->library('upload',$config,'icon');
			$this->icon->initialize($config);
			$upload_cover = $this->icon->do_upload('icon');
			$icon = $this->icon->data('file_name');


		// if ($thumbnail == '') {}else{
		// 	$config =[];
		// 	$config['upload_path']  = './assets/img/button/  ';
		// 	$config['allowed_types'] = 'jpg|png|gif';

		// 	$this->load->library('upload',$config);
		// 	if (!$this->upload->do_upload('thumbnail')) {
		// 		echo json_encode(array('error' => $this->upload->display_errors()));die();
		// 	}else{
		// 		$thumbnail = $this->upload->data('file_name');
		// 	}

		// }if ($img == '') {}else{
		// 	$config =[];
		// 	$config['upload_path']  = './assets/img/background/';
		// 	$config['allowed_types'] = 'jpg|png|gif';

		// 	$this->load->library('upload',$config);
		// 	if (!$this->upload->do_upload('img_source')) {
		// 		echo json_encode(array('error' => $this->upload->display_errors()));die();
		// 	}else{
		// 		$img = $this->upload->data('file_name');
		// 	}

		// }if ($icon == '') {}else{
		// 	$config =[];
		// 		$config['upload_path']  = './assets/img/icon/';
		// 		$config['allowed_types'] = 'jpg|png|gif';
	
		// 		$this->load->library('upload',$config);
		// 		if (!$this->upload->do_upload('icon')) {
		// 			echo json_encode(array('error' => $this->upload->display_errors()));die();
		// 		}else{
		// 			$icon = $this->upload->data('file_name');
		// 		}

		// 	}if ($banner == '') {}else{
		// 		$config =[];
		// 			$config['upload_path']  = './assets/img/banner/';
		// 			$config['allowed_types'] = 'jpg|png|gif';
		
		// 			$this->load->library('upload',$config);
		// 			if (!$this->upload->do_upload('banner')) {
		// 				echo json_encode(array('error' => $this->upload->display_errors()));die();
		// 			}else{
		// 				$banner = $this->upload->data('file_name');
		// 			}
		// }

		$data = array(
				'name' 		  => $name,
				'thumbnail'   => $thumbnail,
				'img_source'  => $img,
				'icon'        => $icon,
				'position'	  => $position, 
				'update'	  => $update,
				'status'	  => $status,
			);
		$save = $this->db->insert('tbl_background',$data);
		
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
		redirect('C_photo_booth/index');
		}
	}


	public function delete($id)
	{
		$where = array('background_id' => $id);
		$data   = $this->db->get_where('tbl_background',$where)->row_array(); 
		
		$hapus = $this->M_photo_booth->deletedata($where,'tbl_background');

		// buat nambahin versi 
		$get_versi = $this->M_versi->getdata('tbl_version');
		$versi = $get_versi->versi + 1;
		$data_versi = array(
			'versi' 		=> $versi,
			
		);
		$save_versi = $this->M_versi->insertdata($data_versi);
		// end buat nambahin versi 


		if ($hapus) {
			$link = "assets/img/button/".$data['thumbnail'];
			if(file_exists($link)){
				unlink($link);
			}
			$link_img = "assets/img/background/".$data['img_source'];
			if(file_exists($link_img)){
				unlink($link_img);
			}
			$link_icon = "assets/img/icon/".$data['icon'];
			if(file_exists($link_icon)){
				unlink($link_icon);
			}		
		}else{
			echo "gagal";
		}
		redirect('C_photo_booth/index');
	}


	public function edit($id)
	{
		$where = array('background_id' => $id);
		$data['background'] = $this->M_photo_booth->editdata($where,'tbl_background')->result();

		$this->load->view('photo_booth/template/header');
		$this->load->view('photo_booth/template/sidebar');
		$this->load->view('photo_booth/edit_photo_booth',$data);
		$this->load->view('photo_booth/template/footer');		
	}
	public function update()
	{
		$update = '1';
		$background_id = $this->input->post('background_id');
		$name 		   = $this->input->post('name');
		$thumbnail	   = $_FILES['thumbnail']['name'];

		if($thumbnail == ""){
			$thumbnail = $this->input->post('thumbnail_edit');
		}else{
			$thumbnail = $_FILES['thumbnail']['name'];
		}


		$img_source	   = $_FILES['img_source']['name'];
		if($img_source == ""){
			$img_source = $this->input->post('img_source_edit');	
		}else{
			$img_source = $_FILES['img_source']['name'];
		}


		$icon	       = $_FILES['icon']['name'];
		if($icon == ""){
			$icon = $this->input->post('icon_edit');	
		}else{
			$icon = $_FILES['icon']['name'];
		}

		$position	   = $this->input->post('position');
		$status		   = $this->input->post('status');
		
			$where = array('background_id' => $background_id);
			
			$button   = $this->db->get_where('tbl_background',$where)->row_array(); 	


			if($thumbnail != $button['thumbnail']){

				

				$link = "assets/img/button/".$button['thumbnail'];
				if(file_exists($link)){
					unlink($link);
				}

				$config = [];
				$config['upload_path']  = './assets/img/button/';
				$config['allowed_types'] = 'jpg|png|gif';
				$this->load->library('upload',$config,'button');
				$this->button->initialize($config);
				$upload_cover = $this->button->do_upload('thumbnail');
				$thumbnail = $this->button->data('file_name');

			}

			$background   = $this->db->get_where('tbl_background',$where)->row_array(); 	
		
			if($img_source != $background['img_source']){

				$link_background = "assets/img/background/".$background['img_source'];
				if(file_exists($link_background)){
					unlink($link_background);
				}	
	
				$config = [];
				$config['upload_path']  = './assets/img/background/';
				$config['allowed_types'] = 'jpg|png|gif';
				$this->load->library('upload',$config,'background');
				$this->background->initialize($config);
				$upload_cover = $this->background->do_upload('img_source');
				$img_source = $this->background->data('file_name');

			}
		
			$icon_data   = $this->db->get_where('tbl_background',$where)->row_array(); 	 	
		
			if($icon != $icon_data['icon']){

				$link_icon = "assets/img/icon/".$icon_data['icon'];	
				if(file_exists($link_icon)){
					unlink($link_icon);
				}	
	
				$config = [];
				$config['upload_path']  = './assets/img/icon/';
				$config['allowed_types'] = 'jpg|png|gif';
				$this->load->library('upload',$config,'icon');
				$this->icon->initialize($config);
				$upload_cover = $this->icon->do_upload('icon');
				$icon = $this->icon->data('file_name');

			}
			

			

			

		// if ($thumbnail =='') {}else{
			
		// 	$where = array('background_id' => $background_id);
		// 	$thumbnail   = $this->db->get_where('tbl_background',$where)->row_array(); 	

		// 	unlink("assets/img/button/".$thumbnail['thumbnail']);
				

		// 	$config['upload_path']   = './assets/img/button/';
		// 	$config['allowed_types'] = 'jpg|png|gif';
			
		// 	$this->load->library('upload',$config);
		// 	if (!$this->upload->do_upload('thumbnail')) {
		// 		$thumbnail = $this->input->post('img_update');
				

		// 	}else{
		// 		$thumbnail = $this->upload->data('file_name');
		// 	}

		// }if ($img_source =='') {}else{
			
		// 	$where = array('background_id' => $background_id);
		// 	$img   = $this->db->get_where('tbl_background',$where)->row_array(); 	

		// 	unlink("assets/img/background/".$img['img_source']);

		// 	$config['upload_path']   = './assets/img/background/';
		// 	$config['allowed_types'] = 'jpg|png|gif';
			
		// 	$this->load->library('upload',$config);
		// 	if (!$this->upload->do_upload('img_source')) {
		// 		$img_source = $this->input->post('img_update');

		// 	}else{
			
		// 		$img_source = $this->upload->data('file_name');
		// 	}


		// }if ($icon =='') {}else{
			
		// 	$where = array('background_id' => $background_id);
		// 	$icon   = $this->db->get_where('tbl_background',$where)->row_array(); 	

		// 	unlink("assets/img/icon/".$icon['icon']);

		// 		$config['upload_path']   = './assets/img/icon/';
		// 		$config['allowed_types'] = 'jpg|png|gif';
				
		// 		$this->load->library('upload',$config);
		// 		if (!$this->upload->do_upload('icon')) {
		// 			$icon = $this->input->post('img_update');
	
		// 		}else{
				
		// 			$icon = $this->upload->data('file_name');
		// 		}


		// 	}if ($banner =='') {}else{
			
		// 		$where = array('background_id' => $background_id);
		// 			$banner   = $this->db->get_where('tbl_background',$where)->row_array(); 	
		
		// 			unlink("assets/img/banner/".$banner['banner']);

		// 			$config['upload_path']   = './assets/img/banner/';
		// 			$config['allowed_types'] = 'jpg|png|gif';
					
		// 			$this->load->library('upload',$config);
		// 			if (!$this->upload->do_upload('banner')) {
		// 				$banner = $this->input->post('img_update');
		
		// 			}else{
					
		// 				$banner = $this->upload->data('file_name');
		// 			}

		// }

		$data = array(
			'name'			=> $name,
			'thumbnail'	    => $thumbnail,
			'img_source'	=> $img_source,
			'icon'	        => $icon,
			'position'		=> $position,
			'update'		=> $update,
			'status'		=> $status,
			
			);
		
		$where = array(
			'background_id' => $background_id 
			);
		$this->M_photo_booth->updatedata('tbl_background',$data,$where);

		// buat nambahin versi 
		$get_versi = $this->M_versi->getdata('tbl_version');
		$versi = $get_versi->versi + 1;
		$data_versi = array(
			'versi' 		=> $versi,
			
		);
		$save_versi = $this->M_versi->insertdata($data_versi);
		// end buat nambahin versi 


		redirect('C_photo_booth/index');
	}
}
 ?>