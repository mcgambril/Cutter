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
        $this->db->select('p.playerName, count(*), sum(s.scoreTime');
        $this->db->from('player p');
        $this->db->join('score s', '(p.playerID = s.scorePlayerID) AND (s.scoreDate = ' .$date. ')', 'left outer');
        $this->db->group_by('p.playerName');
        $getPlayersScoresByDateQuery = $this->db->get();
        return $getPlayersScoresByDateQuery->result();
    }
/*select p.playerName, count(*), sum(s.scoreTime)
from player p
left outer join score s
on (p.playerID = s.scorePlayerID)
and s.scoreDate = '2015-08-01'
group by p.playerName*/



}