<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Command_model extends CI_Model {

    var $name = '';
    var $details   = '';
    var $parameters   = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_commands()
    {
        $query = $this->db->get('command');
        return $query->result();
    }

    function get_all_commands_name()
    {
        $this->db->select('name');
        $query = $this->db->get('command');
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('command', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->name = $_POST['name'];
        $this->details   = $_POST['details'];
        $this->parameters   = $_POST['parameters'];

        $this->db->insert('command', $this);
    }

    function update_entry()
    {
        $this->name = $_POST['name'];
        $this->details   = $_POST['details'];
        $this->parameters   = $_POST['parameters'];

        $this->db->update('command', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('command', array('id' => $id)); 
    }

}
