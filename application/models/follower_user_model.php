<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Follower_user_model extends CI_Model {

    var $follower = '';
    var $sharer   = '';
    var $share_id   = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_followerusers()
    {
        $query = $this->db->get('FollowerUser');
        return $query->result();
    }

    function get_by_id($id)
    {
        $query = $this->db->get_where('FollowerUser', array('id' => $id));
        return $query->result();
    }

    function insert_entry()
    {
        $this->follower = $_POST['follower'];
        $this->sharer   = $_POST['sharer'];
        $this->share_id   = $_POST['share_id'];

        $this->db->insert('FollowerUser', $this);
    }

    function update_entry()
    {
        $this->follower = $_POST['follower'];
        $this->sharer   = $_POST['sharer'];
        $this->share_id   = $_POST['share_id'];

        $this->db->update('FollowerUser', $this, array('id' => $_POST['id']));
    }

    function delete_entry($id){
        $this->db->delete('FollowerUser', array('id' => $id)); 
    }

}