<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	public function upload_picture(){
		$config['upload_path'] = './upload/';
		$config['max_size']	= '1000000000';
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())//upload basarisiz olursa
		{
			$error = array('error' => $this->upload->display_errors());
			$result['error'] = $error;
			$result['result'] = false;
			$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($result));	
		}
		else//upload basarili olursa
		{
			$result['result'] = true;
			$uploadData = $this->upload->data();
			$result['file_path'] = $uploadData['full_path'];
			$this->load->model('User_model');
			$array = $this->session->all_userdata();
			//su anki useri dbden cek
			$user = $this->User_model->get_user_by_id($array['user_id']);
			//user bilgilerini update et. sadece profil fotosu degistigi icin profil fotosu haric tum bilgiler aynen gonderilir.
			$this->User_model->update_user($user->name, $user->surname, $user->username, $user->password, $result['file_path'], $array['user_id']);
			$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($result));
		}
	}

	//user idsi verilen userin fotografini gosterilecek halde donen fonksiyon. img componentinin src attribute unde kullanilir.
	public function show_picture($user_id){
		//codeigniterdan alindi
		$this->load->model('User_model');
		$array = $this->session->all_userdata();
		//fotosu gosterilmek istenen useri db'den cek
		$user = $this->User_model->get_user_by_id($user_id);
		//userin profil fotosunun file pathini filename variable ina ata
		$filename=$user->profile_picture; //<-- specify the image  file
		if(file_exists($filename)){ 
		  header('Content-Length: '.filesize($filename)); //<-- sends filesize header
		  //header('Content-Type: image/jpg'); //<-- send mime-type header
		  header('Content-Disposition: inline; filename="'.$filename.'";'); //<-- sends filename header
		  readfile($filename); //<--reads and outputs the file onto the output buffer
		  die(); //<--cleanup
		  exit; //and exit
		}
	}

	//profil sayfasinda gosterilecek bilgileri generate eden fonksiyon
	public function load_profile(){
		$this->load->model('User_model');
		$array = $this->session->all_userdata();
		$user = $this->User_model->get_user_by_id($array['user_id']);
		$array['uName'] = $user->name;
		$array['sName'] = $user->surname;
		$array['password'] = $user->password;

		$this->load->view('user_profile',$array);
	}
}