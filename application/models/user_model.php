<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    var $name   = '';
    var $surname = '';
    var $username   = '';
    var $password = '';
    var $date_added    = '';
    var $date_modified    = '';

    function __construct()
    {
        parent::__construct();
    }
    
    function get_all_users()
    {
        $query = $this->db->get('User');
        return $query->result();
    }

    function insert_entry()
    {
        $this->name   = $_POST['name'];
        $this->surname = $_POST['surname'];
        $this->username   = $_POST['username'];
        $this->password = $_POST['password'];
        $this->date_added    = time();
        $this->date_modified    = time();

        $this->db->insert('User', $this);
    }

    function update_entry()
    {
        $this->name   = $_POST['name'];
        $this->surname = $_POST['surname'];
        $this->username   = $_POST['username'];
        $this->password = $_POST['password'];
        $this->date_modified    = time();

        $this->db->update('User', $this, array('id' => $_POST['id']));
    }

    function authenticate($username, $password)
    {
        $this->db->select('username,password');
        $this->db->where("username = '$username' AND password = '$password'");
        $query = $this->db->get('User');
        if($query->num_rows > 0)
        {
            return TRUE;
        }
        return FALSE;
    }

}
