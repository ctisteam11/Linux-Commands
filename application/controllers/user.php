<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function login(){
		$this->load->model('User_model');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$logged_in = $this->session->userdata("logged_in");
		if($this->User_model->authenticate($username, $password) or $logged_in){
			if($logged_in){
				$this->load->helper('url');
				redirect('/user/dashboard');
			}
			else{
				$user = $this->User_model->get_user_by_username_and_password($username,$password);
				$session_data = array(
	               'username'  => $username,
	               'logged_in' => TRUE,
	               'user_id' =>  $user[0]->id
	           	);

				$this->session->set_userdata($session_data);
				$this->load->helper('url');
				redirect('/user/dashboard');
			}
		}
		else{
			$data = array('error' => "Username or Password is wrong!");
			$this->load->view('login',$data);
		}
	}

	public function create_user(){
		$this->load->model('User_model');
		$name = $_POST['newName'];
		$surname = $_POST['newSurname'];
		$username = $_POST['newUsername'];
		$password = $_POST['newPassword'];

		$this->User_model->create_user($name, $surname, $username, $password);

		$this->load->helper('url');
		redirect('/user/login');
	}

	public function dashboard(){
		$logged_in = $this->session->userdata("logged_in");
		if(!$logged_in){
			$this->load->helper('url');
			redirect('/user/login');
		}
		else{

			$this->load->model('Follower_user_model');
			$array = $this->session->all_userdata();
			//takip edilen kullanicilari çek
			$array['sharers'] = $this->Follower_user_model->get_by_follower_id($array['user_id']);
			$followedUserIds = array();
			//takip edilen kullanicilarin user id lerini bir arrayde tut
			foreach ($array['sharers'] as $shr) {
				$followedUserIds[] = $shr->sharer;
			}

			$this->load->model('Script_model');
			if(count($followedUserIds) > 0){
				$array['sharer_scripts'] = $this->Script_model->get_by_created_user_id($followedUserIds);

				$this->load->model('User_model');
				$usersOfSharedScripts = array();//socialize sayfasinda gorunen scriptlerin kullanicilarinin tutuldugu array
				$this->load->model('Script_rating_model');
				$sharedScriptRatings = array();//socialize sayfasinda gorunen scriptlerin ratinglerinin tutuldugu array
				$sharedScriptCommands = array();//socialize sayfasinda gorunen scriptlerin commandlerinin tutuldugu array
				//her bir script icin olusturan useri çek
				foreach ($array['sharer_scripts'] as $shr_scrpts) {
					$usersOfSharedScripts[] = $this->User_model->get_user_by_id($shr_scrpts->created_user_id);
					$sharedScriptCommands[] = implode(" ", json_decode($shr_scrpts->commands));//scriptin commandleri db'de json formatinda oldugu icin
																						//commandleri ayirip aralarinda bosluk ekleyerek bir stringe ceviriyoruz
					$sharedScriptRatings[] = $this->Script_rating_model->get_by_user_and_script_id($array['user_id'], $shr_scrpts->id);
				}

				$array['shared_script_commands'] = $sharedScriptCommands;
				$scriptRatingDegrees = array();
				foreach ($sharedScriptRatings as $key => $value) {
					if(isset($value->rating))
						$scriptRatingDegrees[] = $value->rating;
					else
						$scriptRatingDegrees[] = 0;
				}
				$array['followed_script_ratings'] = $scriptRatingDegrees;

				$sharedScriptUsernames = array();//socialize sayfasinda gorunen scriptleri yaratan kullanicilarin usernamelerinin tutuldugu array
				//scripti olusturan userlarin usernamelerini çek(script paylasiminda kimin olusturdugunu gostermek icin)
				foreach ($usersOfSharedScripts as $key => $value) {
					$sharedScriptUsernames[] = $value->username;
				}
				$array['script_users'] = $sharedScriptUsernames;

				
				//daha sonra yapilacak:takip edilen kullanicilarin tekrar takip edilmesini onlemek icin
				//$array['users'] = $this->User_model->get_by_not_user_ids($arr);
				$array['users'] = $this->User_model->get_all_users();
			}


			//Top 5 Popular Scripts
			$this->load->model('Script_rating_model');
			$popularScripts = array();
			//En populer 5 scripti puanina gore cagir
			$popular_scripts = $this->Script_rating_model->get_most_popular_scripts();
			foreach ($popular_scripts as $script){
				$newArray = array();
				$newArray['user_name'] = $script->user_name;
				$newArray['script_name'] = $script->script_name;
				$newArray['rating'] = $script->rating;
				$newArray['command'] = implode(" ", json_decode($script->command));
				$popularScripts[] = $newArray;
			}
			$array['popularScripts'] = $popularScripts;

			$this->load->view('dashboard',$array);
		}
	}

	public function logout(){
		$array_items = array('username' => '', 'logged_in' => '');
		$this->session->unset_userdata($array_items);
		$this->load->view('login');
	}
}
