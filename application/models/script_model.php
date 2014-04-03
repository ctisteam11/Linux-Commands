<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_model extends CI_Model {

    var $name   = '';
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

    function get_by_id($id)
    {
        $query = $this->db->get_where('Script', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->name   = $_POST['name'];
        $this->details = $_POST['details'];
        $this->created_user_id   = $_POST['created_user_id'];
        $this->user_id = $_POST['user_id'];

        $this->db->insert('Script', $this);
    }

    function update_entry()
    {
        $this->name   = $_POST['name'];
        $this->details = $_POST['details'];
        $this->created_user_id   = $_POST['created_user_id'];
        $this->user_id = $_POST['user_id'];

        $this->db->update('Script', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('Script', array('id' => $id)); 
    }

}