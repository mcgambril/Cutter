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

    public function chooseDate() {

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $this->load->view('header_view');
        $this->load->view('score_choose_date_view');
        $this->load->view('footer_view');
    }

    public function submitDate() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $config = array(
            array(
                'field' => 'datepicker',
                'label' => 'Date',
                'rules' => 'required|callback_validateDate|trim'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->chooseDate();
        }
        else {
            //date is currently posted in mm/dd/yyyy format
            $date = $this->input->post('datepicker');

            $submit = $this->input->post('submit');
            if ($submit == "Post Scores") {
                $this->postByDate($date);
            }
            else {
                $this->editByDate($date);
            }
        }
    }

    public function postByDate($date) {
        $this->load->model('score_model');
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $data['date'] = $date; // date is posted from date picker in format mm/dd/yyyy, passed to view in this format

        //reformat date here to MySQL date format to retrieve scores from db
        $date = date('Y-m-d', strtotime($date));
        $data['getCoursesQuery'] = $this->course_model->getCourses();
        if ($data['getCoursesQuery'] != FALSE) {
            $data['getPlayersScoresByDateQuery'] = $this->score_model->getPlayersScoresByDate($date);
            if ($data['getPlayersScoresByDateQuery'] == FALSE) {
                $data['noPlayers'] = TRUE;
            }
            else {
                $data['noPlayers'] = FALSE;
                foreach ($data['getPlayersScoresByDateQuery'] as $row) {
                    if ($row->scoreSummary == 'am empty') {
                        $row->amScore = 'empty';
                        $row->pmScore = $this->score_model->getScore($row->playerID, 1, $date);
                    }
                    else if ($row->scoreSummary == 'pm empty') {
                        $row->amScore = $this->score_model->getScore($row->playerID, 0, $date);
                        $row->pmScore = 'empty';
                    }
                    else if ($row->scoreSummary == 'full') {
                        $row->amScore = $this->score_model->getScore($row->playerID, 0, $date);
                        $row->pmScore = $this->score_model->getScore($row->playerID, 1, $date);
                    }
                    else if ($row->scoreSummary == 'empty') {
                        $row->amScore = 'empty';
                        $row->pmScore = 'empty';
                    }
                }
            }

            $this->load->view('header_view');
            $this->load->view('score_post_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }
        else {
            $data['errorMessage'] = "Something went wrong.  Either there are no courses in the system or the courses' information failed to load at this time.";
            $data['link'] = 'score/chooseDate';
            $data['buttonText'] = 'Back';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }
    }

    public function submitPost() {

        $this->load->model('score_model');
        $this->load->model('player_model');
        $this->load->model('course_model');
        $this->load->model('tempscore_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $config = array(
            array(
                'field' => 'datepicker',
                'label' => 'Date',
                'rules' => 'required|callback_validateDate|trim'
            )
        );

        $temp['players'] = $this->player_model->getPlayers();
        if ($temp['players'] != FALSE) {
            foreach($temp['players'] as $row) {
                $temp2 = array(
                    'field' => $row->playerID.'am-score',
                    'label' => $row->playerName.' AM Score',
                    'rules' => 'trim|integer|greater_than[17]'
                );
                $temp3 = array(
                    'field' => $row->playerID.'pm-score',
                    'label' => $row->playerName.' PM Score',
                    'rules' => 'trim|integer|greater_than[17]'
                );
                array_push($config, $temp2);
                array_push($config, $temp3);
            }
            $this->form_validation->set_rules($config);

            if($this->form_validation->run()== FALSE) {
                $buffer = $this->input->post('datepicker');
                $this->postByDate($buffer);
                RETURN;
            }
            else {
                $date = $this->input->post('datepicker');  //submitted as mm/dd/YYYY
                $temp['date'] = date("Y-m-d", strtotime($date));
                $temp['courseID'] = $this->input->post('course');
                $temp['ids'] = $this->player_model->getPlayerIDsAtoZ(1);
                if ($temp['ids'] != FALSE) {
                    $ids = array();
                    $amScores = array();
                    $pmScores = array();

                    foreach($temp['ids'] as $row) {
                        $var = $this->input->post(''.$row['playerID'].'');
                        array_push($ids, $var);
                        $var2 = $this->input->post(''.$row['playerID'].'am-score');
                        //if score is not empty, then push to array?
                        array_push($amScores, $var2);
                        $var3 = $this->input->post(''.$row['playerID'].'pm-score');
                        //if score is not empty, then push to array?
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
                        //calculate diff throws error when the row's score is empty
                        if($this->validateNotEmpty($amScores[''.$j.''])) {
                            $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($amScores[''.$j.''], $temp['courseID']);
                        } else {$data[''.$i.'']['scoreDifferential'] = 0;}
                        $data[''.$i.'']['scoreUsedInHandicap'] = 0;
                        $data[''.$i.'']['scoreDifferentialUsed'] = 0;

                        $data2[''.$i.'']['scorePlayerID'] = $row;
                        $data2[''.$i.'']['tempPlayerName'] = $buffer;
                        $data2[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                        $data2[''.$i.'']['tempCourseName'] = $buffer;
                        $data2[''.$i.'']['scoreScore'] = $amScores[''.$j.''];
                        $data2[''.$i.'']['tempScore'] = $amScores[''.$j.''];
                        $data2[''.$i.'']['scoreDate'] = $temp['date'];
                        $data2[''.$i.'']['tempDate'] = $temp['date'];
                        //calculate diff throws error when the row's score is empty
                        if($this->validateNotEmpty($amScores[''.$j.''])) {
                            $data2[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($amScores[''.$j.''], $temp['courseID']);
                        } else {$data[''.$i.'']['scoreDifferential'] = 0;}
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
                        //calculate diff throws error when the row's score is empty
                        if($this->validateNotEmpty($pmScores[''.$j.''])) {
                            $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($pmScores[''.$j.''], $temp['courseID']);
                        } else {$data[''.$i.'']['scoreDifferential'] = 0;}
                        $data[''.$i.'']['scoreUsedInHandicap'] = 0;
                        $data[''.$i.'']['scoreDifferentialUsed'] = 0;

                        $data2[''.$i.'']['scorePlayerID'] = $row;
                        $data2[''.$i.'']['tempPlayerName'] = $buffer;
                        $data2[''.$i.'']['scoreCourseID'] = $temp['courseID'];
                        $data2[''.$i.'']['tempCourseName'] = $buffer;
                        $data2[''.$i.'']['scoreScore'] = $pmScores[''.$j.''];
                        $data2[''.$i.'']['tempScore'] = $pmScores[''.$j.''];
                        $data2[''.$i.'']['scoreDate'] = $temp['date'];
                        $data2[''.$i.'']['tempDate'] = $temp['date'];
                        $data2[''.$i.'']['tempDifferential'] = $data[''.$i.'']['scoreDifferential'];
                        //calculate diff throws error when the row's score is empty
                        if($this->validateNotEmpty($pmScores[''.$j.''])) {
                            $data2[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($pmScores[''.$j.''], $temp['courseID']);
                        } else {$data[''.$i.'']['scoreDifferential'] = 0;}
                        $data2[''.$i.'']['scoreTime'] = 1;
                        $data2[''.$i.'']['tempTime'] = 'PM';
                        $data2[''.$i.'']['tempActive'] = 1;

                        $i++;
                        $j++;
                    }

                    $errors = array();
                    for($k=0; $k <= (count($ids)*2); $k++) {
                        if( empty($data[$k]['scoreScore'])) {
                            unset($data[$k]);
                        }
                        else if ($data[$k]['scoreDifferential'] == FALSE) {
                            array_push($errors, $data[$k]);
                            unset($data[$k]);
                        }
                        if (empty($data2[$k]['scoreScore'])) {
                            unset($data2[$k]);
                        }
                        else if ($data2[$k]['scoreDifferential'] == FALSE) {
                            unset($data2[$k]);
                        }
                    }

                    if($this->validateNotEmpty($data) == FALSE) {
                        $this->postByDate($date);
                    }
                    else {
                        if ($this->score_model->insertScoreBatch($data) == TRUE) {
                            if ($this->tempscore_model->insertTempscoreBatch($data2) == TRUE) {

                                if ($this->tempscore_model->updateTempScores() == True) {
                                    $data3['tempScoresError'] = FALSE;
                                    $data3['getTempScoresQuery'] = $this->tempscore_model->getTempScores();

                                    if ($data3['getTempScoresQuery'] != FALSE) {
                                        $data3['tempScoresError'] = FALSE;
                                        foreach ($data3['getTempScoresQuery'] as $row) {
                                            $row->tempDate = date("m/d/Y", strtotime($row->tempDate));
                                        }

                                        if ($this->tempscore_model->deleteTempScores() == FALSE) {
                                            $data3['tempScoresError'] = TRUE;
                                            $this->scoreEntryResult($data3);
                                            RETURN;
                                        }
                                        else {
                                            $data3['errors'] = $errors;
                                            $this->scoreEntryResult($data3);
                                            RETURN;
                                        }
                                    }
                                    else {
                                        $data3['tempScoresError'] = TRUE;
                                        $this->scoreEntryResult($data3);
                                        RETURN;
                                    }
                                }
                                else{
                                    $data3['tempScoresError'] = TRUE;
                                    $this->scoreEntryResult($data3);
                                    RETURN;
                                }
                            }
                            else {
                                $data3['tempScoresError'] = TRUE;
                                $this->scoreEntryResult($data3);
                                RETURN;
                            }
                        }
                        else {
                            $data['errorMessage'] = 'Something went wrong and the scores were unable to be posted at this time. Please try again later.';
                            $data['link'] = 'score/postByDate/' . $date;
                            $data['buttonText'] = 'Back';

                            $this->load->view('header_view');
                            $this->load->view('error_view', $data);
                            $this->load->view('footer_view');
                            RETURN;
                        }
                    }
                }
                else {
                    //$date = $this->input->post('datepicker');
                    $data['errorMessage'] = 'Something went wrong and the scores were unable to be posted at this time. Please try again later.';
                    $data['link'] = 'score/postByDate/' . $date;
                    $data['buttonText'] = 'Back';

                    $this->load->view('header_view');
                    $this->load->view('error_view', $data);
                    $this->load->view('footer_view');
                    RETURN;
                }
            }
        }
        else {
            $date = $this->input->post('datepicker');
            $data['errorMessage'] = 'Something went wrong and the scores were unable to be posted at this time. Please try again later.';
            $data['link'] = 'score/postByDate/' . $date;
            $data['buttonText'] = 'Back';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }


    }

    public function scoreEntryResult($data) {
        $this->load->view('header_view');
        $this->load->view('score_entry_result_view', $data);
        $this->load->view('footer_view');
    }

    public function editByDate($date) {
        $this->load->model('score_model');
        $this->load->model('course_model');

        $data['date'] = $date;

        //reformat date to MySQL yyyy-mm-dd to query from db
        $date = date('Y-m-d', strtotime($date));
        $data['getFullScoreInfoByDateQuery'] = $this->score_model->getFullScoreInfoByDate($date);
        if ($this->validateNotEmpty($data['getFullScoreInfoByDateQuery'] == FALSE)) {
            $data['empty'] = TRUE;
        }
        else {
            $data['empty'] = FALSE;
            foreach ($data['getFullScoreInfoByDateQuery'] as $row) {
                $row->scoreDate = date("m/d/Y", strtotime($row->scoreDate));
            }
        }
        $data['getCoursesQuery'] = $this->course_model->getCourses();

        $this->load->view('header_view');
        $this->load->view('score_edit_by_date_view', $data);
        $this->load->view('footer_view');
    }

    //adding parameters to maybe know whether it needs to bring in date from form or just use the one it is given
    public function submitEditScore() {

        $this->load->model('score_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $config = array(
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'required|trim|callback_validateDate'
            )
        );
        //$this->form_validation->set_rules('date', 'Date', 'required|trim|callback_validateDate');

        $date = $this->input->post('date');        //date is posted in mm/dd/yyyy format
        $bufferDate = $date;

        $date = date("Y-m-d", strtotime($date));            //reformat date to MySQL yyyy-mm-dd to retrieve scores from db

        $temp['scoreList'] = $this->score_model->getFullScoreInfoByDate($date);
        if ($temp['scoreList'] != FALSE) {
            foreach ($temp['scoreList'] as $row) {
                $temp2 = array(
                    'field' => $row->scoreID.'-new-score',
                    'label' => $row->playerName.' New Score',
                    'rules' => 'trim|integer|greater_than[17]'
                );
                array_push($config, $temp2);
                //$this->form_validation->set_rules($row->playerID.'-new-score', $row->playerName.' New Score', 'integer|greater_than[17]');
            }
            $this->form_validation->set_rules($config);

            if($this->form_validation->run()== FALSE) {
                //Need to figure out what to do if the date for some reason does not pass the validation rules
                //it should theoretically never fail the validation rules since it is being passed through after having passed the rules once
                //plus it is a read only field so it shouldn't be able to be altered
                $this->editByDate($bufferDate);
                RETURN;
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
                        $messageData['deleteMessage'] = 'The selected score(s) were successfully deleted from the database';
                    }
                    else {
                        $messageData['deleteResult'] = 'Failed';
                        $messageData['deleteMessage'] = 'Error:  The selected score(s) failed to be deleted from the database';
                    }

                }
                else {
                    $messageData['deleteResult'] = 'NULL';
                }

                if($this->validateNotEmpty($temp['scoreList'] == TRUE)) {
                    $updateScores = array();
                    $errors = array();
                    foreach ($temp['scoreList'] as $key => $row) {
                        $change = FALSE;
                        $id = $row->scoreID;

                        $newCourseID = $this->input->post('course-' . $row->scoreID);
                        if($newCourseID != $row->scoreCourseID) {
                            $change = TRUE;
                            //need to recalculate differential b/c rating and slope changed with the course
                            $newDiff = $this->calculateDifferential($row->scoreScore, $newCourseID);
                        }
                        $tempNewScore = $this->input->post($row->scoreID . '-new-score');
                        if($tempNewScore == "" || $tempNewScore == null || $tempNewScore == 0){
                            $newScore = $row->scoreScore;
                            if(empty($newDiff)) {
                                $newDiff = $row->scoreDifferential;
                            }
                            else {
                                $newDiff = $newDiff;
                            }
                        }
                        else {
                            $newScore = $tempNewScore;
                            //need to use new course in calc diff if course is changed in same submission
                            $newDiff = $this->calculateDifferential($newScore, $newCourseID);
                            if ($newDiff == FALSE) {
                                $tempError = array(
                                    "scoreID" => $id,
                                    "scoreCourseID" => $newCourseID,
                                    "scoreScore" => $newScore,
                                    "scoreDifferential" => $newDiff
                                );
                                array_push($errors, $tempError);
                            }
                            else {
                                $change = TRUE;
                            }
                        }
                        if ($change == TRUE && $newDiff != FALSE) {
                            $tempUpdate = array (
                                "scoreID" => $id,
                                "scoreCourseID" => $newCourseID,
                                "scoreScore" => $newScore,
                                "scoreDifferential" => $newDiff
                            );
                            array_push($updateScores, $tempUpdate);
                        }
                    }

                    if ($this->validateNotEmpty($errors) == TRUE) {
                        $messageData['errors'] = TRUE;
                        $messageData['errorTitle'] = 'Error:';
                        $messageData['errorMessage'] = 'An error occurred and ' . count($errors) . ' of the edited scores were unable to be applied to the database.  Identify those that failed and try again later.';
                    }
                    else {
                        $messageData['errors'] = 'FALSE';
                        $messageData['errorTitle'] = '';
                        $messageData['errorMessage'] = '';
                    }

                    if($this->validateNotEmpty($updateScores) == TRUE) {
                        //workOnDate
                        if ($this->score_model->updateScoresBatch($updateScores) == TRUE) {
                            $messageData['title'] = 'Success!';
                            $messageData['message'] = 'The appropriate change(s) were made and the database updated accordingly.';
                        }
                        else {
                            $messageData['title'] = 'Failure';
                            $messageData['message'] = 'Error:  The change(s) were unable to be updated to the database.  Please try again later.';
                        }
                    }
                    else {
                        $messageData['title'] = 'Note:';
                        $messageData['message'] = 'There were no changes entered to be made.  No scores were updated.';
                    }
                }
                else {
                    $messageData['title'] = 'Note:';
                    $messageData['message'] = 'There were no changes entered to be made.  No scores were updated.';
                    $messageData['errors'] = 'FALSE';
                    $messageData['errorTitle'] = '';
                    $messageData['errorMessage'] = '';
                }
                $this->scoreEditResult($messageData);
            }

            return;
        }
        else {
            $data['errorMessage'] = "Something went wrong and the scores were not able to be submitted. Please try again later.";
            $data['link'] = 'score/chooseDate';
            $data['buttonText'] = 'Score - Home';

            $this->load->view('header_view');
            $this->load->view('error_view', $data);
            $this->load->view('footer_view');
            RETURN;
        }
    }

    public function scoreEditResult($data) {
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');
        //workOnDate

        $this->load->view('header_view');
        $this->load->view('score_edit_result_view', $data);
        $this->load->view('footer_view');
    }

    public function validateDate($date) {

        $future = date("m/d/Y");
        $future = date("m/d/Y", strtotime($future. ' + 1 days'));

        //http://php.net/manual/en/function.strtotime.php
        //Note:  dates formatted with '-' instead of '/' are assumed to be european so m-d-Y is inherently switched to d-m-Y
        $dateStamp = strtotime($date);

        $futureStamp = strtotime($future);
        if($dateStamp < $futureStamp) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validateDate', 'ERROR:  Cannot enter or edit scores for a future date.');
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
        if ($query['course'] != FALSE) {
            foreach($query['course'] as $row) {
                //USGA handicap formula definitions:  https://www.usga.org/handicapping/handicap-manual.html#!rule-14389
                //score - rating = A
                // A x 113 = B
                //B / Slope = Differential->round to nearest 10th
                $differential = ((($score - $row['courseRating']) * 113) / ($row['courseSlope']));
            }
            return round($differential, 1);
        }
        else {
            return FALSE;
        }
    }
}