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
        $this->db->join('player', 'score.scorePlayerID = player.playerID', 'inner');
        $this->db->join('course', 'score.scoreCourseID = course.courseID', 'inner');
        $getFullScoreInfoQuery = $this->db->get();
        return $getFullScoreInfoQuery->result();
    }

    public function getPlayersScoresByDate($date) {
        $this->db->select('p.playerName, count(*) as count, sum(s.scoreTime) as sum');
        $this->db->from('player p');
        $this->db->join('score s', '(p.playerID = s.scorePlayerID) AND (s.scoreDate = ' .$date. ')', 'left outer');
        $this->db->group_by('p.playerName');
        $getPlayersScoresByDateQuery = $this->db->get();
        return $getPlayersScoresByDateQuery->result();
    }




}