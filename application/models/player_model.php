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

    public function getPlayerIDsAtoZ($var) {
        $this->db->select('playerName, playerID');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $getPlayerIDsAtoZQuery = $this->db->get();
        if($var == 1) {
            return $getPlayerIDsAtoZQuery->result_array();
        }
        else {
            return $getPlayerIDsAtoZQuery->result();
        }
    }

    public function getPlayerByID($id) {
        $this->db->select('*');
        $this->db->from('player');
        $this->db->where('playerID', $id);
        $getPlayerByIDQuery = $this->db->get();
        return $getPlayerByIDQuery->result();
    }

    public function getPlayerNameByID($id) {
        $this->db->select('playerName');
        $this->db->from('player');
        $this->db->where('playerID', $id);
        $getPlayerNameByIDQuery = $this->db->get();
        return $getPlayerNameByIDQuery->result();
    }

    public function insertPlayer($player) {
        $queryString = "INSERT INTO player (playerName)
                        VALUES ('$player')";

        if($this->db->query($queryString) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }

    }

    public function updatePlayer($id, $data) {
        $this->db->where('playerID', $id);
        if ($this->db->update('player', $data) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

}
