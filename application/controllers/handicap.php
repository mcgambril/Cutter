<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/27/2015
 * Time: 12:41 PM
 */

class Handicap extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('header_view');
        $this->load->view('handicap_update_view');
        $this->load->view('footer_view');
    }

    public function update() {
        $this->load->model('score_model');
        $this->load->model('player_model');

        $differentialSchedule = array(
            4 => 2,
            5 => 3,
            6 => 3,
            7 => 4,
            8 => 4,
            9 => 5,
            10 => 5,
            11 => 6,
            12 => 6,
            13 => 7,
            14 => 7,
            15 => 8,
            16 => 8,
            17 => 9,
            18 => 9,
            19 => 10,
            20 => 10
        );

        $playerScoreCounts = $this->score_model->getScoreCounts();
        $data = array();
        $recentScoreIDs = array();

        foreach($playerScoreCounts as $row) {
            /*$scoreCount = $row->scoreCount;
            if ($scoreCount > 20) {
                $scoreCount = 20;
            }
            $temp = array(
                'scorePlayerID' => $row->scorePlayerID,
                'scoreCount' => $scoreCount,
                'diffNum' => $differentialSchedule[$scoreCount]
            );
            array_push($data, $temp);*/

            $recentScores = $this->score_model->getRecentScores($row->scorePlayerID);
            foreach ($recentScores as $row) {
                array_push($recentScoreIDs, $row->scoreID);
            }
        }

        $this->score_model->clearHandicapScores();
        $this->score_model->setHandicapScores($recentScoreIDs);

        foreach($playerScoreCounts as $row) {
            $scoreCount = $row->scoreCount;
            if ($scoreCount > 20) {
                $scoreCount = 20;
            }
            $limit = $differentialSchedule[$scoreCount];
            $handicapIndex = $this->calculateHandicapIndex($row->scorePlayerID, $limit);
            $handicap = $this->calculateHandicap($handicapIndex);
            $this->player_model->updatePlayerHandicaps($row->scorePlayerID, $handicapIndex, $handicap);
        }

        $this->handicapUpdateResult();
    }

    public function calculateHandicapIndex($playerID, $limit) {
        $this->load->model('score_model');

        $constant = 0.96;
        $playerDifferentials = $this->score_model->getHandicapDifferentials($playerID, $limit);
        $diffTotal = 0;
        foreach ($playerDifferentials as $row) {
            $diffTotal = $diffTotal + $row->scoreDifferential;
        }
        $diffAverage = $diffTotal / (count($playerDifferentials));
        $handicapIndexTemp = $diffAverage * $constant;
        $handicapIndex = floor($handicapIndexTemp * 100) / 100;
        return $handicapIndex;
    }

    public function calculateHandicap($handicapIndex) {
        $handicapTemp = $handicapIndex * 131 / 113;
        $handicap = round($handicapTemp, 0);
        return $handicap;
    }

    public function handicapUpdateResult() {
        $this->load->view('header_view');
        $this->load->view('handicap_update_result_view');
        $this->load->view('footer_view');
    }
}