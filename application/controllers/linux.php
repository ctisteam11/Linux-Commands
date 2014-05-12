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
	public function newcommand(){
		$array = $this->session->all_userdata();
		$this->load->view('ex_command',$array);
	}

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

	public function run_script($script_id){
		$this->load->model('Script_model');
		$script = $this->Script_model->get_by_id($script_id);
		$array = $this->session->all_userdata();
		$commands = json_decode($script->commands);
		$command_sentence = implode(' ',$commands);
		//Execute the Command
		exec($command_sentence, $output, $return);
		$array['output'] = $output;
		$array['commands'] = $commands;
		$this->load->view('run_command',$array);
	}

	//socialize sayfasinda run edilen scripti calistiran fonksiyon
	public function run_modified_script(){
		$array = $this->session->all_userdata();
		//tagit componentindan alinan commandleri cek ve jsondan arraya cevir
		$decoded_commands = json_decode($this->input->post('modified_commands'));
		//tagitteki commandleri aralarinda bosluk olan bir stringe cevir(exec commandini calistirmak icin)
		$decoded_command_sentence = implode(' ',$decoded_commands);
		exec($decoded_command_sentence, $output, $return);
		$array['output'] = $output;
		$array['commands'] = $decoded_commands;
		$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($array));	
	}

	//image upload edilirken cagrilan fonksiyon
	public function uploadfile(){
		$config['upload_path'] = './upload/';
		$config['max_size']	= '1000000000';
		$config['allowed_types'] = 'gif|jpg|png|doc|docx|xls|xlsx|ppt|pptx|txt';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$result['error'] = $error;
			$result['result'] = false;
			$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($result));	
		}
		else
		{
			$result['result'] = true;
			$uploadData = $this->upload->data();
			$result['file_path'] = $uploadData['full_path'];
			$this->output
			    ->set_content_type('application/json')
			    ->set_output(json_encode($result));
		}
	}
}
