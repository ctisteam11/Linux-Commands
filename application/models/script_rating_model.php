<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_rating_model extends CI_Model {

    var $rating   = '';
    var $script_id = '';
    var $user_id   = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_scriptratings()
    {
        $query = $this->db->get('ScriptRating');
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('ScriptRating', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->rating   = $_POST['rating'];
        $this->script_id = $_POST['script_id'];
        $this->user_id   = $_POST['user_id'];

        $this->db->insert('ScriptRating', $this);
    }

    function update_entry()
    {
        $this->rating   = $_POST['rating'];
        $this->script_id = $_POST['script_id'];
        $this->user_id   = $_POST['user_id'];

        $this->db->update('ScriptRating', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('ScriptRating', array('id' => $id)); 
    }

}
