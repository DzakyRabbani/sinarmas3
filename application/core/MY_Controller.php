<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
//error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '../vendor/autoload.php';
require_once APPPATH . '/libraries/REST_Controller.php';
use \Firebase\JWT\JWT;

class MY_Controller extends REST_Controller {
	protected $secretkey = 'R4Ha5Ia S1NaRM45LaNd'; //ubah dengan kode rahasia apapun
	protected $decoded = null;
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function displayToJSON($content) {
		header("Content-type:application/json;charset=utf8;");
		exit($this->response($content,REST_Controller::HTTP_OK));
	}
	
	public function displayBadRequest($content) {
		header("Content-type:application/json;charset=utf8;");
		exit($this->response($content,REST_Controller::HTTP_BAD_REQUEST));
    }

    public function displayDataNotFound($message_system = 'data does not exists', $message = 'data does not exists') {
		$data = ["message"	=> $message];

		header("Content-type:application/json;charset=utf8;");

		exit($this->response([
			"status" 			=> FALSE,
			"header" 			=> REST_Controller::HTTP_NOT_FOUND,
			"message_system" 	=> $message_system,
			"data"				=> $data
		],REST_Controller::HTTP_NOT_FOUND));
    }
	
	function generateToken($user_id, $email, $tu_status){
			$date = new DateTime();
			
			$payload["id"] = $user_id;
			$payload["email"] = $email;
			$payload["tu_status"] = $tu_status;
			$payload["iat"] = $date->getTimestamp(); //waktu di buat
			//$payload['exp'] = $date->getTimestamp() + 3600; //satu jam
			$payload["exp"] = strtotime("+1 year"); //satu tahun
			
			return JWT::encode($payload,$this->secretkey);
	}
	
	// method untuk mengecek token setiap melakukan post, put, etc
	public function cekToken(){
		//$key 			= $this->input->get_request_header("key");
		$key = $this->secretkey;

		if ($key == $this->secretkey) {
			return true;
		} else {
			header("Content-type:application/json;charset=utf8;");

			$data_respond		= [
					"message"				=> [],
				];
			exit($this->response([
									"status" => FALSE,
									"header" => REST_Controller::HTTP_UNAUTHORIZED,
									"message_system" => "header required",
									"data"		=> $data_respond
			],REST_Controller::HTTP_UNAUTHORIZED));
		}
	}
	
	function dateNow(){
		date_default_timezone_set('Asia/Jakarta');
		$date_now = date("Y-m-d H:i:s");
		
		return $date_now;
	}
	
	function security($action, $string){
		$output = false;
		
		$secret_key = "R4Ha5Ia FrUt73aW0rLD SaNg4TR4hA51A";
		
		//hash
		$key = substr(hash("sha256", $secret_key), 0, 16);
		
		$enkripsi = $key . $string;
		
		if($action == "encrypt"){
			$output = base64_encode($enkripsi);
		} else if ($action == "decrypt"){
			$output = base64_decode($string);
			//$output = explode(';', $output);
			//$output = $output[1];
			if(substr($output, 0, 16) == $key){
				$output	= substr($output, 16);
			} else{
				$output = "failed";
			}
		}
		
		return $output;
	}
	
	function saveImage($path, $data, $name) {
		$folderPath 				= $path;
        $image_parts 			= explode(";base64,", $data);
        $image_type_aux 	= explode($path, $image_parts[0]);
		$image_type 			= $image_type_aux['0'];
        $image_base64 		= base64_decode($image_parts['1']);
        $file 						= $folderPath . $name . '.jpg';
		$file_name				= $name . ".jpg";
        $save 						= file_put_contents($file, $image_base64);
		return $file_name;
	}
	
	function uploadFile($path, $file, $file_name ) {
		$config['file_name']		= $file_name;
		$config['upload_path']		= $path;
		$config['allowed_types']	= '*';
		$config['max_size']			= 1000;
 
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($file)){
			return array('error' => $this->upload->display_errors());
		} else {
			return array('upload_data' => $this->upload->data());
		}
	}
	
	public function password_check($str, $format){
		$ret = TRUE;

		list($uppercase, $lowercase, $number, $alph) = explode(',', $format);

		$str_uc = $this->count_uppercase($str);
		$str_lc = $this->count_lowercase($str);
		$str_num = $this->count_numbers($str);
		$str_alph = $this->count_alphabets($str);
		
		if ($str_num < $number) //  lacking numbers
		{
			$ret = FALSE;
			//$this->form_validation->set_message('password_check', 'Password harus mengandung minimal ' . $number . ' karakter angka.');
			$this->form_validation->set_message('password_check', 'Password harus kombinasi huruf dan angka.');
		} 
		elseif ($str_alph < $alph) 
		{
			$ret = FALSE;
			$this->form_validation->set_message('password_check', 'Password harus kombinasi huruf dan angka.');
		}
		/*
		elseif ($str_uc < $uppercase) // lacking uppercase characters
		{
			$ret = FALSE;
			$this->form_validation->set_message('password_check', 'Password harus mengandung minimal ' . $uppercase . ' karakter huruf besar.');
		}
		elseif ($str_lc < $lowercase) // lacking lowercase characters
		{
			$ret = FALSE;
			$this->form_validation->set_message('password_check', 'Password harus mengandung minimal ' . $lowercase . ' karakter huruf kecil.');
		}
		*/

		return $ret;
	}	
}