<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_command_model extends CI_Model {

    var $script_id = '';
    var $command_id   = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_scriptcommands()
    {
        $query = $this->db->get('ScriptCommand');
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('ScriptCommand', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->script_id = $_POST['script_id'];
        $this->command_id   = $_POST['command_id'];

        $this->db->insert('ScriptCommand', $this);
    }

    function update_entry()
    {
        $this->script_id = $_POST['script_id'];
        $this->command_id   = $_POST['command_id'];

        $this->db->update('ScriptCommand', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('ScriptCommand', array('id' => $id)); 
    }

}
