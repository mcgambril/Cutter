<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/1/2015
 * Time: 3:49 PM
 */

class Player_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getPlayers() {
        $getPlayersQuery = $this->db->get('player');
        return $getPlayersQuery->result();
    }

    public function getPlayerScores($playerID) {
        $this->db->select('*');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        $getPlayerScoresQuery = $this->db->get();
        return $getPlayerScoresQuery->result();
    }

    public function getPlayersAndScores() {
        $query = $this->db->get('player');
        $getPlayersAndScoresQuery = $query->result();
        foreach($getPlayersAndScoresQuery as &$row) {
            $row->scores = $this->getPlayerScores($row->playerID);
            if(is_null($row->playerHandicap)) {
                $row->playerHandicap = 'N/A';
            }
            if(is_null($row->playerHandicapIndex)) {
                $row->playerHandicapIndex = 'N/A';
            }
        }
        return $getPlayersAndScoresQuery;
    }

    public function getPlayerIDs($var) {
        $this->db->select('playerID');
        $this->db->from('player');
        $getPlayerIDsQuery = $this->db->get();
        if($var == 1) {
            return $getPlayerIDsQuery->result_array();
        }
        else {
            return $getPlayerIDsQuery->result();
        }
    }

}
