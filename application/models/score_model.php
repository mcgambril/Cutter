<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/1/2015
 * Time: 3:49 PM
 */

class Score_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getScores() {
        $getScoresQuery = $this->db->get('score');
        return $getScoresQuery->result();
    }

    public function getFullScoreInfo() {
        $this->db->select('score.*, player.*, course.*');
        $this->db->from('score');
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'INNER');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'INNER');
        $getFullScoreInfoQuery = $this->db->get();
        return $getFullScoreInfoQuery->result();
    }

    public function getPlayersScoresByDate($date) {

        $selectVar = "p.playerID
                    , p.playerName
                    , COUNT(*) as count
                    , SUM(s.scoreTime) AS sum
                    , CASE
                        WHEN (COUNT(*) = 1) AND (SUM(s.scoreTime) IS NULL)
                            THEN 'empty'
                        WHEN (COUNT(*) = 1) AND (SUM(s.scoreTime) = 0)
                            THEN 'pm empty'
                        WHEN (COUNT(*) = 1) AND (SUM(s.scoreTime) = 1)
                            THEN 'am empty'
                        WHEN (COUNT(*) = 2)
                            THEN 'full'
                        END AS scoreSummary ";
        $this->db->_protect_identifiers = false;
        $this->db->select("$selectVar", false);
        $this->db->from('player p');
        $this->db->join('score s', 'p.playerID = s.scorePlayerID  AND s.scoreDate = "' . $date . '"', 'LEFT OUTER');
        $this->db->group_by('p.playerID, p.playerName');
        $getPlayersScoresByDateQuery = $this->db->get();
        $this->db->_protect_identifiers = true;

        return $getPlayersScoresByDateQuery->result();
    }

    public function getScore($scorePlayerID, $scoreTime, $scoreDate) {
        $this->db->select('scoreScore');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $scorePlayerID);
        $this->db->where('scoreTime', $scoreTime);
        $this->db->where('scoreDate', $scoreDate);
        $getScoreQuery = $this->db->get();
        return $getScoreQuery->result();
    }

    public function insertScoreBatch($data) {
        $this->db->insert_batch('score', $data);
        return;
    }

    public function getFullScoreInfoByDate($date) {
        $this->db->select('score.*, player.*, course.*');
        $this->db->from('score');
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'INNER');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'INNER');
        $this->db->where('score.scoreDate', $date);
        $getFullScoreInfoQuery = $this->db->get();
        return $getFullScoreInfoQuery->result();
    }





}