<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/2/2015
 * Time: 9:52 PM
 */

class Cutteradmin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getPassword() {
        $this->db->select('*');
        $this->db->from('cutteradmin');
        $this->db->where('current', 1);
        $getPasswordQuery = $this->db->get();
        if ($getPasswordQuery->num_rows() > 0) {
            return $getPasswordQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function insertNewPass($newPass) {
        $passwordColumn = '`password`';
        $currentColumn = '`current`';
        $queryString = "INSERT INTO cutteradmin (" . $passwordColumn . ", " . $currentColumn . ")
                        VALUES ('" . $newPass . "', 1)";

        if($this->db->query($queryString) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function deactivateOldPass($id) {
        $data = array(
            'current' => 0
        );

        $this->db->where('passwordID', $id);
        if ($this->db->update('cutteradmin', $data) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    //rename to key record?
    public function getBets() {
        $this->db->select('*');
        $this->db->from('config');
        $this->db->order_by('displayOrder','asc');
        $getBetsQuery = $this->db->get();
        if ($getBetsQuery->num_rows() > 0) {
            return $getBetsQuery->result();
        }
        else {
            return FALSE;
        }
    }
    
    public function insertKeyRecord() {
        
    }

}
