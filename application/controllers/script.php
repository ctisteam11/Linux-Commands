<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Script extends CI_Controller {

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
	public function load_scripts(){
		$this->load->model('Script_model');
		$session_array = $this->session->all_userdata();
		$array = $this->session->all_userdata();
		$array['scripts'] = $this->Script_model->get_all_scripts_by_user_id($session_array['user_id']);
		$this->load->view('scripts',$array);
	}

	public function add_command(){
		$this->load->model('Script_model');
		//Decoding the JSON string to PHP Array
		$array = $this->session->all_userdata();
		$this->Script_model->add_entry($this->input->post('name'), $this->input->post('comms'), "", $array['user_id']);
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode(true));
	}

	public function add_user_script(){
		$this->load->model('Script_model');
		$array = $this->session->all_userdata();
		$found_script = $this->Script_model->get_by_id($this->input->post('scriptToBeAdded'));
		$this->Script_model->add_entry($found_script->name, $found_script->commands, $found_script->details, $array['user_id']);
		echo true;
	}

	public function delete_script($id){
		$this->load->model('Script_model');
		//Decoding the JSON string to PHP Array
		$this->Script_model->delete_entry($id);
		$this->load->helper('url');
		redirect('/script/load_scripts');
	}

}
