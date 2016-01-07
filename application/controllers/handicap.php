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



    public function update() {
        $this->load->view('header_view');
        $this->load->view('handicap_update_view');
        $this->load->view('footer_view');
    }

    public function submitUpdate() {
        //create $data array and put the queries into []...maybe that somehow has something to do with it
        //commit
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
        if ($playerScoreCounts == FALSE) {
            $this->noHandicaps();
            return;
        }
        else {
            $dataSetScoreIDs = array();

            foreach($playerScoreCounts as $key => $row) {
                if ($row->scoreCount < 4) {
                    unset($playerScoreCounts[$key]);
                }
                else {
                    $dataSetScores = $this->score_model->getDataSetScores($row->scorePlayerID);
                    if ($dataSetScores == FALSE) {
                        unset($playerScoreCounts[$key]);
                    }
                    else {
                        foreach ($dataSetScores as $r) {
                            array_push($dataSetScoreIDs, $r->scoreID);
                        }
                    }
                }
            }
            //unset($row);

            if ($this->score_model->clearHandicapScores() == TRUE) {
                if ($this->validateNotEmpty($dataSetScoreIDs) == TRUE) {
                    if ($this->score_model->setHandicapScores($dataSetScoreIDs) == FALSE) {
                        $this->error();
                        return;
                    }
                }
                else {
                    $this->noHandicaps();
                    return;
                }
            }
            else {
                $this->error();
                return;
            }

            $updatedHandicaps = array();
            $errorUpdates = array();
            if ($this->validateNotEmpty($playerScoreCounts) == TRUE) {
                foreach($playerScoreCounts as $row) {
                    $scoreCount = $row->scoreCount;
                    if ($scoreCount > 20) {
                        $scoreCount = 20;
                    }
                    else {
                        $scoreCount = $row->scoreCount;
                    }
                    $limit = $differentialSchedule[$scoreCount];
                    $handicapIndex = $this->calculateHandicapIndex($row->scorePlayerID, $limit);
                    $handicap = $this->calculateHandicap($handicapIndex);
                    if ($this->player_model->updatePlayerHandicaps($row->scorePlayerID, $handicapIndex, $handicap) == FALSE) {
                        array_push($errorUpdates, $row);
                    }
                    else {
                        array_push($updatedHandicaps, $row);
                    }
                }
                //unset($row);

                $this->handicapUpdateResult($updatedHandicaps, $errorUpdates);
                return;
            }
            else {
                $this->noHandicaps();
                return;
            }

        }

    }

    public function calculateHandicapIndex($playerID, $limit) {
        $this->load->model('score_model');

        $constant = 0.96;
        $playerDifferentials = $this->score_model->getHandicapDifferentials($playerID, $limit);
        $diffIDs = array();
        foreach ($playerDifferentials as $row) {
            /*$temp = array(
                'scoreID' => $row->scoreID,
                'scoreDifferentialUsed' => 1
            );*/
            array_push($diffIDs, $row->scoreID);
        }
        $this->score_model->setDifferentialsUsed($playerID, $diffIDs);

        $diffTotal = 0;
        foreach ($playerDifferentials as $row) {
            $diffTotal = $diffTotal + $row->scoreDifferential;
        }
        $diffAverage = $diffTotal / (count($playerDifferentials));
        $handicapIndexTemp = $diffAverage * $constant;

        //potential truncating solution...probably would want to return the variable casted with int() to be sure it is interpreted properly
        /*function truncate($number, $decimals)
        {
            $point_index = strrpos($number, '.');
            return substr($number, 0, $point_index + $decimals+ 1);
        }*/

        //PHP cannot truncate inherently. Use floor to simulate truncating to a single decimal place
        //http://stackoverflow.com/questions/10643273/no-truncate-function-in-php-options
        $handicapIndex = floor($handicapIndexTemp * 100) / 100;
        return $handicapIndex;
    }

    public function calculateHandicap($handicapIndex) {
        $this->load->model('course_model');
        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
        if ($data['getHomeCourseQuery'] != FALSE) {
            foreach ($data['getHomeCourseQuery'] as $row) {
                $homeSlope = $row->courseSlope;
            }

            //handicap formula as provided by client (and USGA)
            //needs to take slope from current home course
            $handicapTemp = $handicapIndex * $homeSlope / 113;

            //rounding to nearest whole number
            $handicap = round($handicapTemp, 0);
            return $handicap;
        }
        else {
            return FALSE;
        }


    }

    public function handicapUpdateResult($updatedHandicaps, $errorUpdates) {
        //$length = 0;
        if ($this->validateNotEmpty($updatedHandicaps) == TRUE) {
            $data['updatedHandicaps'] = $updatedHandicaps;
            /*foreach ($updatedHandicaps as $row) {
                if (strlen($row->playerName) > $length) {
                    $length = strlen($row->playerName);
                }
            }*/
        }
        else {
            $data['updatedHandicaps'] = NULL;
        }

        if ($this->validateNotEmpty($errorUpdates) == TRUE) {
            $data['errorUpdates'] = $errorUpdates;
            /*foreach($errorUpdates as $row) {
                if (strlen($row->playerName) > $length) {
                    $length = strlen($row->playerName);
                }
            }*/
        }
        else {
            $data['errorUpdates'] = NULL;
        }
        /*$length = $length + 3;
        $data['length'] = $length;*/
        /*$data['trailer'] = "..................................................";*/

        $this->load->view('header_view');
        $this->load->view('handicap_update_result_view', $data);
        $this->load->view('footer_view');
    }

    public function validateNotEmpty($data) {
        if(empty($data)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function noHandicaps() {
        $this->load->view('header_view');
        $this->load->view('handicap_no_handicaps_view');
        $this->load->view('footer_view');
    }

    public function error() {
        $this->load->view('header_view');
        $this->load->view('handicap_error_view');
        $this->load->view('footer_view');
    }

    /*public function index() {
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['getPlayersQuery'] = $this->player_model->getPlayersAZ();
        foreach ($data['getPlayersQuery'] as $row) {
            if ($row->playerHandicap == "" || $row->playerHandicap == 0 || $row->playerHandicap == NULL) {
                $row->playerHandicap = "TBD";
            }
            if ($row->playerHandicapIndex == "" || $row->playerHandicapIndex == 0 || $row->playerHandicapIndex == NULL) {
                $row->playerHandicapIndex = "TBD";
            }
        }

        $this->load->view('header_view');
        $this->load->view('handicap_view', $data);
        $this->load->view('footer_view');
    }*/

}