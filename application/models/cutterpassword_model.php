<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/2/2015
 * Time: 9:52 PM
 */

class Cutterpassword_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getPassword() {
        $this->db->select('password');
        $this->db->from('cutterpassword');
        $this->db->where('current', 1);
        $getPasswordQuery = $this->db->get();
        return $getPasswordQuery->result();
    }

}
