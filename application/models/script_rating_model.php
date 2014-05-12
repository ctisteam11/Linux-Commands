<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script_rating_model extends CI_Model {

    var $rating   = '';
    var $script_id = '';
    var $user_id   = '';

    function __construct()
    {
        parent::__construct();
    }

    function get_most_popular_scripts()
    {
        $query = $this->db->query('select Script.name as script_name, Script.commands as command, User.name as user_name, ScriptRating.rating as rating from ScriptRating, Script, User where ScriptRating.Script_id = Script.id and ScriptRating.User_id = User.id order by rating desc limit 0,10');
        return $query->result();
    }
    
    function get_all_scriptratings()
    {
        $query = $this->db->get('ScriptRating');
        return $query->result();
    }

    function get_by_user_and_script_id($userId, $scriptId)
    {
        $query = $this->db->get_where('ScriptRating', array('User_id' => $userId, 'Script_id' => $scriptId));
        $result = $query->result();
        if($result > 0){
            if(isset($result[(count($result))-1]))
                return $result[(count($result))-1];
            else
                return null;
        }
        return null;
    } 

    function get_by_id($id)
    {
        $query = $this->db->get_where('ScriptRating', array('id' => $id));
        return $query->result();
    }

    function add_entry($rate, $scriptId, $userId)
    {
        $this->rating   = $rate;
        $this->script_id   = $scriptId;
        $this->user_id = $userId;

        $this->db->insert('ScriptRating', $this);
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
