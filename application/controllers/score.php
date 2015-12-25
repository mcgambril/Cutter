<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/3/2015
 * Time: 8:27 PM
 */

class Score extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index() {

        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        $data['getFullScoreInfoQuery'] = $this->score_model->getFullScoreInfo();

        $this->load->view('header_view');
        $this->load->view('score_view', $data);
        $this->load->view('footer_view');
    }

    public function edit() {

        $id['id'] = $this->uri->segment(3);
        $this->load->view('header_view');
        $this->load->view('score_edit_view', $id);
        $this->load->view('footer_view');
    }

    public function postDate() {

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->load->view('header_view');
        $this->load->view('score_post_choose_date_view');
        $this->load->view('footer_view');
    }

    public function post($buffer) {

        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $data['date'] = $buffer['date'];

        $data['getCoursesQuery'] = $this->course_model->getCourses();

        $data['getPlayersScoresByDateQuery'] = $this->score_model->getPlayersScoresByDate($data['date']);
        foreach ($data['getPlayersScoresByDateQuery'] as $row) {
            if ($row->scoreSummary == 'am empty') {
                $row->amScore = 'empty';
                $row->pmScore = $this->score_model->getScore($row->playerID, 1, $data['date']);
            }
            else if ($row->scoreSummary == 'pm empty') {
                $row->amScore = $this->score_model->getScore($row->playerID, 0, $data['date']);
                $row->pmScore = 'empty';
            }
            else if ($row->scoreSummary == 'full') {
                $row->amScore = $this->score_model->getScore($row->playerID, 0, $data['date']);
                $row->pmScore = $this->score_model->getScore($row->playerID, 1, $data['date']);
            }
            else if ($row->scoreSummary == 'empty') {
                $row->amScore = 'empty';
                $row->pmScore = 'empty';
            }
        }

        $this->load->view('header_view');
        $this->load->view('score_post_view', $data);
        $this->load->view('footer_view');
    }

    public function submitPost() {

        $this->load->model('score_model');
        $this->load->model('player_model');
        $this->load->model('course_model');
        $this->load->model('tempscore_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $this->form_validation->set_rules('datepicker', 'Date', 'required|callback_validateDate');

        $temp['players'] = $this->player_model->getPlayers();
        foreach($temp['players'] as $row) {
            $this->form_validation->set_rules($row->playerID.'am-score', $row->playerName.' AM Score', 'integer|greater_than[17]');
            $this->form_validation->set_rules($row->playerID.'pm-score', $row->playerName.' PM Score', 'integer|greater_than[17]');
        }

        if($this->form_validation->run()== FALSE) {
            $buffer['date'] = $this->input->post('datepicker');
            $this->post($buffer);
        }
        else {
            $temp['date'] = $this->input->post('datepicker');
            $temp['courseID'] = $this->input->post('course');
            $temp['ids'] = $this->player_model->getPlayerIDsAtoZ(1);
            $ids = array();
            $amScores = array();
            $pmScores = array();

            foreach($temp['ids'] as $row) {
                $var = $this->input->post(''.$row['playerID'].'');
                array_push($ids, $var);
                $var2 = $this->input->post(''.$row['playerID'].'am-score');
                array_push($amScores, $var2);
                $var3 = $this->input->post(''.$row['playerID'].'pm-score');
                array_push($pmScores, $var3);
            }

            $i = 0;
            $j = 0;
            $buffer = "temp";
            foreach($ids as $row) {
                $data[''.$i.'']['scorePlayerID'] = $row;
                $data[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                $data[''.$i.'']['scoreScore'] = $amScores[''.$j.''];
                $data[''.$i.'']['scoreDate'] = $temp['date'];
                $data[''.$i.'']['scoreTime'] = 0;
                $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($amScores[''.$j.''], $temp['courseID']);

                $data2[''.$i.'']['scorePlayerID'] = $row;
                $data2[''.$i.'']['tempPlayerName'] = $buffer;
                $data2[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                $data2[''.$i.'']['tempCourseName'] = $buffer;
                $data2[''.$i.'']['scoreScore'] = $amScores[''.$j.''];
                $data2[''.$i.'']['tempScore'] = $amScores[''.$j.''];
                $data2[''.$i.'']['scoreDate'] = $temp['date'];
                $data2[''.$i.'']['tempDate'] = $temp['date'];
                $data2[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($amScores[''.$j.''], $temp['courseID']);
                $data2[''.$i.'']['tempDifferential'] = $data[''.$i.'']['scoreDifferential'];
                $data2[''.$i.'']['scoreTime'] = 0;
                $data2[''.$i.'']['tempTime'] = 'AM';
                $data2[''.$i.'']['tempActive'] = 1;

                $i++;

                $data[''.$i.'']['scorePlayerID'] = $row;
                $data[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                $data[''.$i.'']['scoreScore'] = $pmScores[''.$j.''];
                $data[''.$i.'']['scoreDate'] = $temp['date'];
                $data[''.$i.'']['scoreTime'] = 1;
                $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($pmScores[''.$j.''], $temp['courseID']);

                $data2[''.$i.'']['scorePlayerID'] = $row;
                $data2[''.$i.'']['tempPlayerName'] = $buffer;
                $data2[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                $data2[''.$i.'']['tempCourseName'] = $buffer;
                $data2[''.$i.'']['scoreScore'] = $pmScores[''.$j.''];
                $data2[''.$i.'']['tempScore'] = $pmScores[''.$j.''];
                $data2[''.$i.'']['scoreDate'] = $temp['date'];
                $data2[''.$i.'']['tempDate'] = $temp['date'];
                $data2[''.$i.'']['tempDifferential'] = $data[''.$i.'']['scoreDifferential'];
                $data2[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($pmScores[''.$j.''], $temp['courseID']);
                $data2[''.$i.'']['scoreTime'] = 1;
                $data2[''.$i.'']['tempTime'] = 'PM';
                $data2[''.$i.'']['tempActive'] = 1;

                $i++;
                $j++;
            }

            for($k=0; $k <= (count($ids)*2); $k++) {
                if( empty($data[$k]['scoreScore'])) {
                    unset($data[$k]);
                }
                if (empty($data2[$k]['scoreScore'])) {
                    unset($data2[$k]);
                }
            }

            if($this->validateNotEmpty($data) == FALSE) {
                $this->load->view('score_empty_post_view');
            }
            else {
                $this->score_model->insertScoreBatch($data);

                $this->tempscore_model->insertTempscoreBatch($data2);
                //run the update tempscore function here
                if ($this->tempscore_model->updateTempScores() == True) {
                    $data3['getTempScoresQuery'] = $this->tempscore_model->getTempScores();
                    //might want to do a query to delete the temp scores instead of deactivate
                    $this->tempscore_model->deactivateTempScores();

                    $this->scoreEntrySuccess($data3);
                }
                else{
                    //return some error message or view...
                };

            }
        }
    }

    public function validateDate($date) {
        $future = date("Y-m-d");
        $future = date("Y-m-d", strtotime($future. ' + 1 days'));
        /*$future = date("Y-m-d", strtotime('+1 days', $future));*/

        $dateStamp = strtotime($date);
        $futureStamp = strtotime($future);
        if($dateStamp < $futureStamp) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validateDate', 'Cannot enter or edit scores for a future date.');
            return FALSE;
        }
    }

    public function validateNotEmpty($data) {
        if(empty($data)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function calculateDifferential($score, $courseID) {
        $this->load->model('course_model');
        $query['course'] = $this->course_model->getCourse((int)$courseID, 1);
        foreach($query['course'] as $row) {
            $differential = ((($score - $row['courseRating'])*113)/($row['courseSlope']));
        }
        return round($differential, 1);
    }

    public function scoreEntrySuccess($data) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->load->view('header_view');
        $this->load->view('score_entry_success_view', $data);
        $this->load->view('footer_view');


    }

    public function scoreEditResult($data) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->load->view('header_view');
        $this->load->view('score_edit_result_view', $data);
        $this->load->view('footer_view');
    }

    public function submitDate() {
        $this->load->model('score_model');
        $this->load->model('player_model');
        $this->load->model('course_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $this->form_validation->set_rules('datepicker', 'Date', 'required|callback_validateDate');

        if($this->form_validation->run()== FALSE) {
            $this->postDate();
        }
        else {
            $data['date'] = $this->input->post('datepicker');

            $data['getCoursesQuery'] = $this->course_model->getCourses();

            $data['getPlayersScoresByDateQuery'] = $this->score_model->getPlayersScoresByDate($data['date']);
            foreach ($data['getPlayersScoresByDateQuery'] as $row) {
                if ($row->scoreSummary == 'am empty') {
                    $row->amScore = 'empty';
                    $row->pmScore = $this->score_model->getScore($row->playerID, 1, $data['date']);
                }
                else if ($row->scoreSummary == 'pm empty') {
                    $row->amScore = $this->score_model->getScore($row->playerID, 0, $data['date']);
                    $row->pmScore = 'empty';
                }
                else if ($row->scoreSummary == 'full') {
                    $row->amScore = $this->score_model->getScore($row->playerID, 0, $data['date']);
                    $row->pmScore = $this->score_model->getScore($row->playerID, 1, $data['date']);
                }
                else if ($row->scoreSummary == 'empty') {
                    $row->amScore = 'empty';
                    $row->pmScore = 'empty';
                }
            }

            $this->load->view('header_view');
            $this->load->view('score_post_view', $data);
            $this->load->view('footer_view');

        }
    }

    public function chooseEditDate() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->load->view('header_view');
        $this->load->view('score_choose_edit_date_view');
        $this->load->view('footer_view');
    }

    //adding parameters to maybe know whether it needs to bring in date from form or just use the one it is given
    //need to post message if there are no scores for the current date to be edited
    public function postEditDate() {
        $this->load->model('score_model');
        $this->load->model('course_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $this->form_validation->set_rules('datepicker', 'Date', 'required|callback_validateDate');

        if($this->form_validation->run()== FALSE) {
            $this->chooseEditDate();
        }
        else {
            $data['date'] = $this->input->post('datepicker');
            $data['getFullScoreInfoByDate'] = $this->score_model->getFullScoreInfoByDate($data['date']);
            $data['getCoursesQuery'] = $this->course_model->getCourses();

            $this->load->view('header_view');
            $this->load->view('score_edit_by_date_view', $data);
            $this->load->view('footer_view');
        }
    }

    public function submitEditScore() {

        $this->load->model('score_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $this->form_validation->set_rules('date', 'Date', 'required|callback_validateDate');
        $date = $this->input->post('date');

        $temp['scoreList'] = $this->score_model->getFullScoreInfoByDate($date);

        foreach ($temp['scoreList'] as $row) {
            $this->form_validation->set_rules($row->playerID.'-new-score', $row->playerName.' New Score', 'integer|greater_than[17]');
        }

        if($this->form_validation->run()== FALSE) {
            //Need to figure out what to do if the date for some reason does not pass the validation rules
            //it should theoretically never fail the validation rules since it is being passed through after having passed the rules once
            //plus it is a read only field so it shouldn't be able to be altered
        }
        else {
            $deleteScores = array();
            foreach ($temp['scoreList'] as $key => $row) {
                if ($this->input->post($row->scoreID . '-delete') == "delete") {
                    array_push($deleteScores, $row->scoreID);
                    unset($temp['scoreList'][$key]);
                }
            }

            if($this->validateNotEmpty($deleteScores) == TRUE) {
                if ($this->score_model->deleteScores($deleteScores) == TRUE) {
                    $messageData['deleteResult'] = 'Success!';
                    $messageData['deleteMessage'] = 'The indicated scores were successfully deleted from the database';
                }
                else {
                    $messageData['deleteResult'] = 'Failed';
                    $messageData['deleteMessage'] = 'Error:  The indicated scores failed to be deleted from the database';
                }

            }
            else {
                $messageData['deleteResult'] = 'NULL';
            }
        }

            $updateScores = array();
            foreach ($temp['scoreList'] as $key => $row) {
                $id = $row->scoreID;
                if ($this->input->post($row->playerID . '-course_change') == "yes") {
                    $newCourse = $this->input->post('course-' . $row->scoreID);
                }
                else {
                    $newCourse = $row->scoreCourseID;
                }
                $tempNewScore = $this->input->post($row->playerID . '-new-score');
                if($tempNewScore == "" || $tempNewScore == null || $tempNewScore == 0){
                    $newScore = $row->scoreScore;
                }
                else {
                    $newScore = $tempNewScore;
                }
                $tempUpdate = array (
                    "scoreID" => $id,
                    "scoreCourseID" => $newCourse,
                    "scoreScore" => $newScore
                );
                array_push($updateScores, $tempUpdate);
            }

            if ($this->score_model->updateScoresBatch($updateScores) == TRUE) {
                $messageData['title'] = 'Success!';
                $messageData['message'] = 'The appropriate changes were made and the database updated accordingly.';
            }
            else {
                $messageData['title'] = 'Failure';
                $messageData['message'] = 'Error:  The changes were unable to be updated to the database.  Please try again later.';
            }

            $this->scoreEditResult($messageData);

        return;
    }
}