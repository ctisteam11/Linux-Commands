<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Linux extends CI_Controller {

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
	//Execute a command
	public function executecommand(){
		//Decoding the JSON string to PHP Array
		$comm = json_decode($this->input->post('commands'));
		//Joining the Array with Space
		$command_sentence = implode(' ',$comm);
		//Execute the Command
		exec($command_sentence, $output, $return);
		//Return the output in the JSON format
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($output));
	}

	//List commands
	public function listcommands(){
		//Load Command Model
		$this->load->model('Command_model');
		//Fetch all commands from database
		$result = $this->Command_model->get_all_commands();
		//Return all commands in the JSON format
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($result));		
	}
}
