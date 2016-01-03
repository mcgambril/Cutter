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

    public function getPlayersAZ() {
        $this->db->select('*');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $getPlayersQuery = $this->db->get();
        return $getPlayersQuery->result();
    }

    public function getPlayerScores($playerID) {
        $this->db->select('*');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        //$this->db->where('scoreUsedInHandicap', 1);
        $getPlayerScoresQuery = $this->db->get();
        return $getPlayerScoresQuery->result();
    }

    public function getPlayerRecentScores($playerID) {
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

    public function getPlayersAndScores() {
        //$query = $this->db->get('player');
        $this->db->select('*');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $query = $this->db->get();
        /*$this->db->_protect_identifiers = FALSE;*/
        $getPlayersAndScoresQuery = $query->result();
        /*$this->db->_protect_identifiers = FALSE;*/
        foreach($getPlayersAndScoresQuery as &$row) {
            $row->scores = $this->getPlayerRecentScores($row->playerID);
            if(is_null($row->playerHandicap)) {
                $row->playerHandicap = 'TBD';
            }
            if(is_null($row->playerHandicapIndex)) {
                $row->playerHandicapIndex = 'TBD';
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

    public function updatePlayerHandicaps($playerID, $handicapIndex, $handicap) {
        $handicapUpdates = array(
            'playerHandicap' => $handicap,
            'playerHandicapIndex' => $handicapIndex
        );

        $this->db->where('playerID', $playerID);
        if($this->db->update('player', $handicapUpdates) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function deletePlayer($id) {
        $this->db->where('playerID', $id);
        if ($this->db->delete('player') == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

}
