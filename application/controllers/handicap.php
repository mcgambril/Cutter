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
        $this->load->model('score_model');
        $this->load->model('player_model');
        $this->load->model('course_model');

        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
        if ($this->validateNotEmpty($data['getHomeCourseQuery'] == FALSE)) {
            $data['errorMessage'] = 'There is no Home Course currently set.  Therefore, Handicaps cannot be updated at this time.';
            $data['link'] = 'course/setHomeCourse';
            $data['buttonText'] = 'Set Home Course Here';
            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            return;
        }

        //differential schedule as defined by John Lyon and/or USGA
        //# of most recent scores available is key on left
        //# of highest recent scores to use in calculations is value on right
        //no more than the 20 most recent scores will ever be used
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
            $resetHandicaps = array();

            foreach($playerScoreCounts as $key => $row) {
                if ($row->scoreCount < 4) {
                    //players w/ less than 4 scores will have handicaps and indexes of TBD
                    //this is updating them whether they are already set or not in order to cover any players whose score totals fell back below 4
                    $temp = array(
                        'playerID' => $row->scorePlayerID,
                        'playerHandicap' => NULL,
                        'playerHandicapIndex' => NULL
                    );
                    array_push($resetHandicaps, $temp);
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

            //this query ensures players with 0 scores have handicaps and indexes of NULL
            //this is mostly for players whose scores were all deleted; this is the only place where their previous handicaps could be reset to reflect no scores
            $getNoScorePlayersQuery = $this->player_model->getNoScorePlayers();
            if ($getNoScorePlayersQuery != FALSE) {
                foreach ($getNoScorePlayersQuery as $row) {
                    $temp = array(
                        'playerID' => $row->playerID,
                        'playerHandicap' => NULL,
                        'playerHandicapIndex' => NULL
                    );
                    array_push($resetHandicaps, $temp);
                }
            }

            if ($this->validateNotEmpty($resetHandicaps) == TRUE) {
                $this->player_model->resetHandicapsBatch($resetHandicaps);

            }

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
                    //using !== instead of != so as to avoid misinterpreting a handicap of 0 as FALSE
                    if ($handicap !== FALSE) {
                        if ($this->player_model->updatePlayerHandicaps($row->scorePlayerID, $handicapIndex, $handicap) == FALSE) {
                            array_push($errorUpdates, $row);
                        }
                        else {
                            array_push($updatedHandicaps, $row);
                        }
                    }
                    else {
                        //need to include an error message and button link if going to use the error view
                        //need to probably eliminate the use of this and simply add the errorm essages onto the result page to make it clean

                        //This is where the Active_Bug is indicating error

                        //$this->load->view('error_view');      //removed this...repetitive and ugly to show this error view
                        array_push($errorUpdates, $row);
                    }
                }

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
        if ($playerDifferentials != FALSE) {
            $diffIDs = array();
            foreach ($playerDifferentials as $row) {
                array_push($diffIDs, $row->scoreID);
            }
            if ($this->score_model->setDifferentialsUsed($playerID, $diffIDs) != FALSE) {
                $diffTotal = 0;
                foreach ($playerDifferentials as $row) {
                    $diffTotal = $diffTotal + $row->scoreDifferential;
                }
                $diffAverage = $diffTotal / (count($playerDifferentials));
                $handicapIndexTemp = $diffAverage * $constant;

                //PHP cannot truncate inherently. Use floor to simulate truncating to a single decimal place
                //potential solution commented below. doesnt seem to work for all instances...if average comes out to too many decimal points, it won't truncate to just 1 decimal
                //http://stackoverflow.com/questions/10643273/no-truncate-function-in-php-options
                //$handicapIndex = floor($handicapIndexTemp * 100) / 100;

                $handicapIndex = $this->truncate($handicapIndexTemp, 1);        //need to add comment on why I am using 1...I think it is number of decimal places desired
                return $handicapIndex;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }

    }

    public function truncate($handicapIndexTemp, $decimals) {
        //function found below
        //http://stackoverflow.com/questions/10643273/no-truncate-function-in-php-options
        //EX:  12.345

        //$pos = strrpos((string)$handicapIndexTemp, '.');
        //test this portion of code without  string conversiona nd see what happens
        $pos = strrpos(number_format($handicapIndexTemp,1,'.',''), '.');        //2finds position index of the decimal in the index:  $pos = 3
        $length = $pos + $decimals + 1;                                     //4calculates the length of the desired index:  3 + 1 + 1 = 4
        $truncatedIndex = substr(number_format($handicapIndexTemp, 1, '.', ''), 0, $length);    //grabs the truncated index:  12.345 -> takes substring, starting at position 0, and counts 4 characters:  12.3
        //$truncatedIndex = substr((string)$handicapIndexTemp, 0, $length);
        $handicapIndex = (float)$truncatedIndex;                            //cast to float to ensure proper number format
        return $handicapIndex;
    }

    public function calculateHandicap($handicapIndex) {
        //using !== instead of != so as to avoid misinterpreting a handicap index of 0 as FALSE
        if ($handicapIndex !== FALSE) {
            $this->load->model('course_model');
            $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
            if ($data['getHomeCourseQuery'] != FALSE) {
                foreach ($data['getHomeCourseQuery'] as $row) {
                    $homeSlope = $row->courseSlope;
                }

                //handicap formula as provided by client (and USGA)
                //needs to take slope from current home course
                $handicapTemp = $handicapIndex * ($homeSlope / 113);

                //rounding to nearest whole number
                $handicap = round($handicapTemp, 0);
                return $handicap;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }

    public function handicapUpdateResult($updatedHandicaps, $errorUpdates) {
        if ($this->validateNotEmpty($updatedHandicaps) == TRUE) {
            $data['updatedHandicaps'] = $updatedHandicaps;
        }
        else {
            $data['updatedHandicaps'] = NULL;
        }

        if ($this->validateNotEmpty($errorUpdates) == TRUE) {
            $data['errorUpdates'] = $errorUpdates;
        }
        else {
            $data['errorUpdates'] = NULL;
        }

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
}