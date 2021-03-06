<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Share_model extends CI_Model {

    var $details   = '';
    var $script_id = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_shares()
    {
        $query = $this->db->get('Share');
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('Share', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->details   = $_POST['details'];
        $this->script_id = $_POST['script_id'];

        $this->db->insert('Share', $this);
    }

    function update_entry()
    {
        $this->details   = $_POST['details'];
        $this->script_id = $_POST['script_id'];

        $this->db->update('Share', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('Share', array('id' => $id)); 
    }

}
