<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 11/19/2015
 * Time: 9:42 PM
 */

class Tempscore_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getTempScores() {
        $this->db->select('*');
        $this->db->from('tempscore');
        $this->db->where('tempActive', 1);
        $getTempScoresQuery = $this->db->get();
        return $getTempScoresQuery->result();
    }

    public function deactivateTempScores() {
        $data = array('tempActive' => 0);
        //$this->db->where('tempActive', 1);
        $this->db->update('tempscore', $data, "tempActive = 1");
        return;
    }

    public function insertTempscoreBatch($data) {
        $this->db->insert_batch('tempscore', $data);
        return;
    }

}
