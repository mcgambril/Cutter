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
        $this->db->where('playerID', $playerID);
        $getPlayerScoresQuery = $this->db->get();
        return $getPlayerScoresQuery->result();
    }

}
