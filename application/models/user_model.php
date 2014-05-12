<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    var $name   = '';
    var $surname = '';
    var $username   = '';
    var $password = '';
    var $profile_picture = '';
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

    function get_by_not_user_ids($user_id_array)
    {
        $this->db->from('User');
        $this->db->where_not_in('id', $user_id_array);
        $query = $this->db->get();
        return $query->result();
    }

    function get_user_by_id($user_id)
    {
        $query = $this->db->get_where('User', array('id' => $user_id));
        return $query->row();
    }

    function create_user($nName, $nSurname, $nUsername, $nPassword)
    {
        $this->name   = $nName;
        $this->surname = $nSurname;
        $this->username   = $nUsername;
        $this->password = $nPassword;
        date_default_timezone_set('Europe/Istanbul');
        $this->date_added    = date('Y-m-d H:i:s');
        $this->date_modified    = date('Y-m-d H:i:s');

        $this->db->insert('User', $this);
    }

    function update_user($nName, $nSurname, $nUsername, $nPassword, $nProfile_picture, $db_id)
    {
        $this->name   = $nName;
        $this->surname = $nSurname;
        $this->username   = $nUsername;
        $this->password = $nPassword;
        date_default_timezone_set('Europe/Istanbul');
        $this->date_added    = date('Y-m-d H:i:s');
        $this->date_modified    = date('Y-m-d H:i:s');
        $this->profile_picture = $nProfile_picture;

        $this->db->update('User', $this, array('id' => $db_id));
    }

    function insert_entry()
    {
        $this->name   = $_POST['name'];
        $this->surname = $_POST['surname'];
        $this->username   = $_POST['username'];
        $this->password = $_POST['password'];
        $this->date_added    = time();
        $this->date_modified    = time();
        $this->profile_picture = $_POST['profile_picture'];

        $this->db->insert('User', $this);
    }

    function update_entry()
    {
        $this->name   = $_POST['name'];
        $this->surname = $_POST['surname'];
        $this->username   = $_POST['username'];
        $this->password = $_POST['password'];
        $this->date_modified    = time();
        $this->profile_picture = $_POST['profile_picture'];

        $this->db->update('User', $this, array('id' => $_POST['id']));
    }

    function get_user_by_username_and_password($username, $password)
    {
        $this->db->select('id');   
        $this->db->where("username = '$username' AND password = '$password'");
        $query = $this->db->get('User');
        if($query->num_rows > 0){
            return $query->result();
        }
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
