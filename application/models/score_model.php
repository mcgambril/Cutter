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

}