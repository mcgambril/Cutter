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
        if ($getScoresQuery->num_rows() > 0) {
            return $getScoresQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function getFullScoreInfo() {
        $this->db->select('score.*, player.*, course.*');
        $this->db->from('score');
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'INNER');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'INNER');
        $this->db->order_by('scoreDate', 'desc');
        $this->db->order_by('scoreTime', 'desc');
        $this->db->order_by('playerName', 'asc');
        $getFullScoreInfoQuery = $this->db->get();
        if ($getFullScoreInfoQuery->num_rows() > 0) {
            return $getFullScoreInfoQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function getFullScoreInfoByID($scoreID) {
        $this->db->select('score.*, player.playerName, course.courseName');
        $this->db->from('score');
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'INNER');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'INNER');
        $this->db->where('score.scoreID', $scoreID);
        $this->db->order_by('scoreDate', 'desc');
        $this->db->order_by('scoreTime', 'desc');
        $this->db->order_by('playerName', 'asc');
        $getFullScoreInfoByIDQuery = $this->db->get();
        if ($getFullScoreInfoByIDQuery->num_rows() > 0) {
            return $getFullScoreInfoByIDQuery->result();
        }
        else {
            return FALSE;
        }
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
        $this->db->_protect_identifiers = FALSE;
        $this->db->select("$selectVar", FALSE);
        $this->db->from('player p');
        $this->db->join('score s', 'p.playerID = s.scorePlayerID  AND s.scoreDate = "' . $date . '"', 'LEFT OUTER');
        $this->db->group_by('p.playerID, p.playerName');
        $this->db->order_by('p.playerName', 'asc');
        $getPlayersScoresByDateQuery = $this->db->get();
        $this->db->_protect_identifiers = TRUE;
        if ($getPlayersScoresByDateQuery->num_rows() > 0) {
            return $getPlayersScoresByDateQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function getScore($scorePlayerID, $scoreTime, $scoreDate) {
        $this->db->select('scoreScore');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $scorePlayerID);
        $this->db->where('scoreTime', $scoreTime);
        $this->db->where('scoreDate', $scoreDate);
        $getScoreQuery = $this->db->get();
        if ($getScoreQuery->num_rows() > 0) {
            return $getScoreQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function insertScoreBatch($data) {
        $this->db->trans_start();
        $this->db->insert_batch('score', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function getFullScoreInfoByDate($date) {
        $this->db->select('score.*, player.*, course.*');
        $this->db->from('score');
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'INNER');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'INNER');
        $this->db->where('score.scoreDate', $date);
        $this->db->order_by('player.playerName', 'asc');
        $this->db->order_by('score.scoreTime', 'asc');
        $getFullScoreInfoByDateQuery = $this->db->get();
        if($getFullScoreInfoByDateQuery->num_rows() > 0) {
            return $getFullScoreInfoByDateQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function updateScoresBatch($data) {
        $this->db->trans_start();
        $this->db->update_batch('score', $data, 'scoreID');
        $this->db->trans_complete();
        if( $this->db->trans_status() == FALSE) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function setDifferentialsUsed($playerID, $diffIDs) {
        if ($this->clearDifferentialsUsed($playerID) == TRUE) {
            $update = array(
                'scoreDifferentialUsed' => 1
            );

            $this->db->where_in('scoreID', $diffIDs);
            if ($this->db->update('score', $update) == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }

        }
        else {
            return FALSE;
        }
    }

    public function deleteScores($scores) {
        $this->db->where_in('scoreID', $scores);
        if ($this->db->delete('score') == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function getScoreCounts() {
        $groupByColumns = array(
            "scorePlayerID",
            "playerName"
        );

        $this->db->select('scorePlayerID, playerName, count(scoreScore) as scoreCount');
        $this->db->from('score');
        $this->db->join('player', 'scorePlayerID = playerID', 'INNER');
        $this->db->group_by($groupByColumns);
        $getScoreCountsQuery = $this->db->get();
        if ($getScoreCountsQuery->num_rows() == 0) {
            return FALSE;
        }
        else {
            return $getScoreCountsQuery->result();
        }

    }

    public function getDataSetScores($playerID) {
        $this->db->select('*');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        $this->db->order_by('scoreDate', 'desc');
        $this->db->order_by('scoreTime', 'desc');
        $this->db->limit(20);
        $getRecentScoresQuery = $this->db->get();
        if ($getRecentScoresQuery->num_rows() == 0) {
            return FALSE;
        }
        else {
            return $getRecentScoresQuery->result();
        }
    }

    public function getAllHandicapScores() {
        $this->db->select('scoreID');
        $this->db->from('score');
        $this->db->where('scoreUsedInHandicap', 1);
        $getAllHandicapScoresQuery = $this->db->get();
        if ($getAllHandicapScoresQuery->num_rows() > 0) {
            return $getAllHandicapScoresQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function clearHandicapScores() {
        $update = array(
            'scoreUsedInHandicap' => 0
        );

        $this->db->where('scoreUsedInHandicap', 1);
        if ($this->db->update('score', $update) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function clearDifferentialsUsed($playerID) {
        $update = array(
            'scoreDifferentialUsed' => 0
        );

        //$this->db->where('scoreDifferentialUsed', 1);
        $this->db->where('scorePlayerID', $playerID);
        if ($this->db->update('score', $update) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function setHandicapScores($recentScoreIDs) {
        $update = array(
            'scoreUsedInHandicap' => 1
        );

        $this->db->where_in('scoreID', $recentScoreIDs);
        if ($this->db->update('score', $update) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function getHandicapDifferentials($playerID, $limit) {
        $this->db->select('scoreID, scoreDifferential');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        $this->db->where('scoreUsedInHandicap', 1);
        $this->db->order_by('scoreDifferential', 'asc');
        $this->db->order_by('scoreDate', 'desc');
        $this->db->order_by('scoreTime', 'desc');
        $this->db->limit($limit);
        $getHandicapDifferentialsQuery = $this->db->get();
        if ($getHandicapDifferentialsQuery->num_rows() > 0) {
            return $getHandicapDifferentialsQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function insertDebug($column, $value) {
        $query = "INSERT INTO debug (" . $column . ")
                    VALUES (".$value.")";
        return $this->db->query($query);
    }

}