<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Social extends CI_Controller {

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
	public function load_shares(){
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
		//takip edilen kullanicilarin olusturdugu scriptleri çek
		if(count($followedUserIds) > 0){
			$array['sharer_scripts'] = $this->Script_model->get_by_created_user_id($followedUserIds);

			$this->load->model('User_model');
			$usersOfSharedScripts = array();//socialize sayfasinda gorunen scriptlerin kullanicilarinin tutuldugu array
			$this->load->model('Script_rating_model');
			$sharedScriptRatings = array();//socialize sayfasinda gorunen scriptlerin ratinglerinin tutuldugu array
			$sharedScriptCommands = array();//socialize sayfasinda gorunen scriptlerin commandlerinin tutuldugu array
			$sharedScriptCommandsExploded = array();//socialize sayfasinda gorunen scriptlerin commandlerinin array seklinde tutuldugu array(2 dimensional)
			//her bir script icin olusturan useri çek
			foreach ($array['sharer_scripts'] as $shr_scrpts) {
				$usersOfSharedScripts[] = $this->User_model->get_user_by_id($shr_scrpts->created_user_id);
				$sharedScriptCommands[] = implode(" ", json_decode($shr_scrpts->commands));//scriptin commandleri db'de json formatinda oldugu icin
																					//commandleri ayirip aralarinda bosluk ekleyerek bir stringe ceviriyoruz
				$sharedScriptCommandsExploded[] = json_decode($shr_scrpts->commands);

				$sharedScriptRatings[] = $this->Script_rating_model->get_by_user_and_script_id($array['user_id'], $shr_scrpts->id);
			}

			$array['shared_script_commands_exploded'] = $sharedScriptCommandsExploded;
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

			$this->load->view('socialize',$array);
		}
		else{
			$this->load->model('User_model');
			$array['users'] = $this->User_model->get_all_users();

			$this->load->view('socialize',$array);
		}
	}

	public function add_sharer(){
		$this->load->model('Follower_user_model');
		//Decoding the JSON string to PHP Array
		$this->Follower_user_model->add_entry($this->input->post('followerUserId'), $this->input->post('sharerUserId'));

		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(true));
	}

	//linux.js ten rating degismesi durumunda cagrilan fonksiyon. verilen yildiz(rating degree), yildiz verilen scriptin idsi(ratedScriptId) ve
	//yildiz veren kullanicinin idsi parametre olarak verilerek Script_rating_model tarafindan dbye eklenir.(ayni scriptin oyu degistiginde ona gore yeni
	//kayit degil bulunan kaydin degistirilmesi dusunulebilir)
	public function save_rating(){
		$this->load->model('Script_rating_model');
		$array = $this->session->all_userdata();
		$this->Script_rating_model->add_entry($this->input->post('ratingDegree'), $this->input->post('ratedScriptId'), $array['user_id']);
		$this->output
	    ->set_content_type('application/json')
	    ->set_output(json_encode(true));
	}

}
