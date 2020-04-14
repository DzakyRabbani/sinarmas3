<?php

defined('BASEPATH') OR exit('No direct script access allowed');
	
	use Firebase\JWT\JWT;

    class C_background extends MY_Controller {
		
		function __construct($config = 'rest') {
			parent::__construct($config);
			$this->load->helper(array('form', 'url'));
			$this->load->database();
			$this->cekToken();
			$this->load->model("api/M_background");
			$this->load->model('M_versi');
			$this->load->model('api/M_banner');
		}

		public function getAll_get(){
			$get_background	= $this->M_background->getAllData()->result();
		//echo json_encode($get_background);
		//die();
			for($i=0;$i<count($get_background);$i++){
			
				if($get_background[$i]->status == 1){
					$status_active	 = "active";
				} else{
					$status_active	 = "inactive";
				}

				if($get_background[$i]->update == 1){
					$status_update	 = "yes";
				} else{
					$status_update	 = "no";
				}
				
				$data_background[$i]		= [
												//"status_update"			=> $status_update,
												//"status_active"			=> $status_active,
												"background_id"				=> $get_background[$i]->background_id,
												"name"						=> $get_background[$i]->name,
												"button"					=> base_url("assets/img/button/" . $get_background[$i]->thumbnail),
												"background"				=> base_url("assets/img/background/" . $get_background[$i]->img_source),
												"icon"						=> base_url("assets/img/icon/" . $get_background[$i]->icon),
												"position"					=> $get_background[$i]->position,
												
											];
			}
			
			$get_versi = $this->M_versi->getdata('tbl_version');
			$versi = $get_versi->versi;
			$get_banner = $this->M_banner->getAllData()->last_row();
			
		$data_banner =[
			"banner" =>base_url("assets/img/banner/" . $get_banner->img_banner)
		];

		//	echo json_encode($versi);
		//	die();
		//	$get_versi = ;
			
			if(!empty($get_background)){
				$data_respond		= [
											"background"			=> $data_background,
											"banner"        		=> $data_banner
										];
				$respond["status"] 			= TRUE;
				$respond["header"]			= REST_Controller::HTTP_OK;
				$respond["message_system"]	= "success get background";
				$respond["version"]			= $versi;
				$respond["data"]			= $data_respond;
											  
				// display sukses login
				$this->displayToJSON($respond);
			}else{
				$this->displayDataNotFound("background not found","background not found");
			}
		}

		public function updateStatus_post() {
			// form validation
			$params   = $_REQUEST;
			$this->form_validation->set_rules("background_id", "Background ID", "required|numeric");
			
			if ($this->form_validation->run() === FALSE){
				// set the flash data error message if there is one
				exit($this->response([
					"status" 			=> FALSE,
					"header" 			=> REST_Controller::HTTP_BAD_REQUEST,
					"message_system" 	=> "error input",
					"data"				=> ["message"		=> explode("\n", strip_tags(validation_errors())) ? explode("\n", strip_tags(validation_errors())) : $this->session->flashdata("message")]
				],REST_Controller::HTTP_BAD_REQUEST));
			} else {
				$get_background	= $this->M_background->getAllData(["background_id"	=> $params["background_id"]])->first_row();
			
				if(!empty($get_background)) {
					$update_status = $this->M_background->update(["update"	=> 0], ["background_id"	=> $get_background->background_id]);
					
					$message		= [
						"message"				=> [],
					];

					//Respond Sukses
					$respond["status"] 			= TRUE;
					$respond["header"]			= REST_Controller::HTTP_OK;
					$respond["message_system"]	= "successfully update status";
					$respond["data"]			= $message;
					
					$this->displayToJSON($respond);
				} else {
					$this->displayDataNotFound("background not found","background id " . $params["background_id"] . " not found");
				}
			}
		}
    }
?>