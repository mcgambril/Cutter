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
        if ($getPlayersQuery->num_rows() > 0) {
            return $getPlayersQuery->result();
        }
        else {
            return FALSE;
        }

    }

    public function getPlayersAZ() {
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $getPlayersQuery = $this->db->get();
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            return FALSE;
        }
        else {
            if ($getPlayersQuery->num_rows() > 0) {
                return $getPlayersQuery->result();
            }
            else {
                return 'empty';
            }
        }
    }

    public function getPlayerScores($playerID) {
        $this->db->select('*');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        $getPlayerScoresQuery = $this->db->get();
        if ($getPlayerScoresQuery->num_rows() > 0) {
            return $getPlayerScoresQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function getPlayerRecentScores($playerID) {
        $this->db->select('*');
        $this->db->from('score');
        $this->db->where('scorePlayerID', $playerID);
        $this->db->order_by('scoreDate', 'desc');
        $this->db->order_by('scoreTime', 'desc');
        $this->db->limit(20);
        $getRecentScoresQuery = $this->db->get();
        if ($getRecentScoresQuery->num_rows() > 0) {
            if ($getRecentScoresQuery->num_rows() == 0) {
                return FALSE;
            }
            else {
                return $getRecentScoresQuery->result();
            }
        }
        else {
            return FALSE;
        }
    }

    public function getPlayersAndScores() {
        $this->db->select('*');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $getPlayersAndScoresQuery = $query->result();
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
        else {
            return FALSE;
        }

    }

    public function getPlayerIDs($var) {
        $this->db->select('playerID');
        $this->db->from('player');
        $getPlayerIDsQuery = $this->db->get();
        if ($getPlayerIDsQuery->num_rows() > 0) {
            if($var == 1) {
                return $getPlayerIDsQuery->result_array();
            }
            else {
                return $getPlayerIDsQuery->result();
            }
        }
        else {
            return FALSE;
        }

    }

    public function getPlayerIDsAtoZ($var) {
        $this->db->select('playerName, playerID');
        $this->db->from('player');
        $this->db->order_by('playerName', 'asc');
        $getPlayerIDsAtoZQuery = $this->db->get();
        if ($getPlayerIDsAtoZQuery->num_rows() > 0) {
            if($var == 1) {
                return $getPlayerIDsAtoZQuery->result_array();
            }
            else {
                return $getPlayerIDsAtoZQuery->result();
            }
        }
        else {
            return FALSE;
        }

    }

    public function getPlayerByID($id) {
        $this->db->select('*');
        $this->db->from('player');
        $this->db->where('playerID', $id);
        $getPlayerByIDQuery = $this->db->get();
        if ($getPlayerByIDQuery->num_rows() > 0) {
            return $getPlayerByIDQuery->result();
        }
        else {
            return FALSE;
        }

    }

    public function getPlayerNameByID($id) {
        $this->db->select('playerName');
        $this->db->from('player');
        $this->db->where('playerID', $id);
        $getPlayerNameByIDQuery = $this->db->get();
        if ($getPlayerNameByIDQuery->num_rows() > 0) {
            return $getPlayerNameByIDQuery->result();
        }
        else {
            return FALSE;
        }
    }
    
    public function getPlayerPhoneByID($id) {
        $this->db->select('playerPhone');
        $this->db->from('player');
        $this->db->where('playerID', $id);
        $getPlayerPhoneByIDQuery = $this->db->get();
        if ($getPlayerPhoneByIDQuery->num_rows() > 0) {
            return $getPlayerPhoneByIDQuery->result();
        }
        else {
            return FALSE;
        }
    }

    public function insertPlayer($player, $phone) {
        $queryString = "INSERT INTO player (playerName, playerPhone)
                        VALUES ('$player', $phone)";

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

    public function getNoScorePlayers() {
        $queryString = "
          SELECT playerID
          FROM player
          WHERE playerID NOT IN (
                                  SELECT scorePlayerID
                                  FROM score
                                  GROUP BY scorePlayerID
          )";
        $this->db->_protect_identifiers = FALSE;
        $getNoScorePlayers = $this->db->query($queryString);
        $this->db->_protect_identifiers = TRUE;
        if ($getNoScorePlayers->num_rows() > 0){
            return $getNoScorePlayers->result();
        }
        else {
            return FALSE;
        }

    }

    public function resetHandicapsBatch($playerIDs) {
        $this->db->trans_start();
        $this->db->update_batch('player', $playerIDs, 'playerID');
        $this->db->trans_complete();
        if( $this->db->trans_status() == FALSE) {
            return FALSE;
        }
        else {
            return TRUE;
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
    
    public function validateUniquePhone($phone, $id) {
        $this->db->select('playerPhone');
        $this->db->from('player');
        if ($id == "" || is_null($id)) {
            $whereClause = "playerPhone = '" . $phone ."'"; 
        }
        else {
            $whereClause = "playerPhone = '" . $phone . "' and playerID <> " . $id;
        }
        $this->db->where($whereClause);
        $validateUniquePhoneQuery = $this->db->get();
        if ($phone == "" || is_null($phone)) {
            return TRUE;
        }
        elseif ($validateUniquePhoneQuery->num_rows() > 0) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
    
    public function getBets() {
        $this->db->select('symbol, description');
        $this->db->from('config');
        $this->db->where('displayToggle', '1');
        $this->db->order_by('displayOrder','asc');
        $getBetsQuery = $this->db->get();
        if ($getBetsQuery->num_rows() > 0) {
            return $getBetsQuery->result();
        }
        else {
            return FALSE;
        }
    }

}
