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

    public function deleteTempScores() {
        $this->db->empty_table('tempscore');
        return;
    }

    public function updateTempScores() {

        $queryString = "UPDATE tempscore t
                          SET
                              t.tempPlayerName = (SELECT p.playerName FROM player p WHERE p.playerID = t.scorePlayerID),
                              t.tempCourseName = (SELECT c.courseName FROM course c WHERE c.courseID = t.scoreCourseID)
                          WHERE t.tempActive = 1";
        $this->db->_protect_identifiers = FALSE;
        $result = $this->db->query($queryString);
        $this->db->_protect_identifiers = TRUE;
        return $result;
    }

    public function insertTempscoreBatch($data) {
        $this->db->insert_batch('tempscore', $data);
        return;
    }
}
