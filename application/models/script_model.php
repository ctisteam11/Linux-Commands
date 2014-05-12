<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_model extends CI_Model {

    var $name   = '';
    var $commands = '';
    var $details = '';
    var $created_user_id   = '';
    var $user_id = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_scripts()
    {
        $query = $this->db->get('Script');
        return $query->result();
    }

    function get_all_scripts_by_user_id($usr_id)
    {
        $query = $this->db->get_where('Script', array('user_id' => $usr_id));
        return $query->result();
    }

    function get_by_created_user_id($created_user_array)
    {
        $this->db->from('Script');
        $this->db->where_in('created_user_id', $created_user_array);
        $query = $this->db->get();
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('Script', array('id' => $id));
        $result = $query->result();
        if($result > 0){
            return $result[0];
        }
        return null;
    }

    function add_entry($name, $command, $detail, $user)
    {
        $this->name   = $name;
        $this->commands   = $command;
        $this->details = $detail;
        $this->created_user_id   = $user;
        $this->user_id = $user;

        $this->db->insert('Script', $this);
    }

    function insert_entry()
    {
        $this->name   = $_POST['name'];
        $this->commands   = $_POST['commands'];
        $this->details = $_POST['details'];
        $this->created_user_id   = $_POST['created_user_id'];
        $this->user_id = $_POST['user_id'];

        $this->db->insert('Script', $this);
    }

    function update_entry()
    {
        $this->name   = $_POST['name'];
        $this->commands   = $_POST['commands'];
        $this->details = $_POST['details'];
        $this->created_user_id   = $_POST['created_user_id'];
        $this->user_id = $_POST['user_id'];

        $this->db->update('Script', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('Script', array('id' => $id)); 
    }

}
