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
			$session_data = array(
               'username'  => $username,
               'logged_in' => TRUE
           	);

			$this->session->set_userdata($session_data);
			$this->load->view('admin',$session_data);
		}
		else{
			$data = array('error' => "Username or Password is wrong!");
			$this->load->view('login',$data);
		}
	}

	public function logout(){
		$array_items = array('username' => '', 'logged_in' => '');
		$this->session->unset_userdata($array_items);
		$this->load->view('login');
	}
}
