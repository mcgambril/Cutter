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

    public function updateTempScores() {

        $queryString = "update tempscore t
                          set
                              t.tempPlayerName = (select p.playerName from player p where p.playerID = t.scorePlayerID),
                              t.tempCourseName = (select c.courseName from course c where c.courseID = t.scoreCourseID)
                          where t.tempActive = 1";
        $this->db->_protect_identifiers = false;
        $result = $this->db->query($queryString);
        $this->db->_protect_identifiers = true;
        return $result;
    }

    public function insertTempscoreBatch($data) {
        $this->db->insert_batch('tempscore', $data);

        return;
    }

}
