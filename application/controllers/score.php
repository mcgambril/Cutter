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

    public function post() {
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('date');
        date_default_timezone_set('America/Mexico_City');

        $data['getPlayersQuery'] = $this->player_model->getPlayers();
        $data['getCoursesQuery'] = $this->course_model->getCourses();

        $this->load->view('header_view');
        $this->load->view('score_post_view', $data);
        $this->load->view('footer_view');
    }

    public function submitPost() {
        $this->load->model('score_model');
        $this->load->model('player_model');
        $this->load->model('course_model');
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
            $this->post();
        }

        $temp['date'] = $this->input->post('datepicker');
        $temp['courseName'] = $this->input->post('course');
        $temp['courseID'] = (int)$this->course_model->getCourseID($this->input->post('course'), 0);
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
        foreach($ids as $row) {
            $data[''.$i.'']['scorePlayerID'] = $row;
            $data[''.$i.'']['scoreCourseID'] = /*$courseID;*/ $temp['courseID'];
            $data[''.$i.'']['scoreScore'] = $amScores[''.$j.''];
            $data[''.$i.'']['scoreDate'] = $temp['date'];
            $data[''.$i.'']['scoreTime'] = 0;
            $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($amScores[''.$j.''], $temp['courseID']);
            $i++;
            $data[''.$i.'']['scorePlayerID'] = $row;
            $data[''.$i.'']['scoreCourseID'] = $temp['courseID'];
            $data[''.$i.'']['scoreScore'] = $pmScores[''.$j.''];
            $data[''.$i.'']['scoreDate'] = $temp['date'];
            $data[''.$i.'']['scoreTime'] = 1;
            $data[''.$i.'']['scoreDifferential'] = $this->calculateDifferential($pmScores[''.$j.''], $temp['courseID']);
            $i++;
            $j++;
        }

        foreach($data as $row) {            //not successfully taking out rows with empty scores yet
            if (empty($row['scoreScore'])) {
                unset($data[$row]);
            }
        }

        if($this->validateEmpty($data) == FALSE) {
            $this->load->view('score_empty_post_view');
        }
        else {
            //might need to do a foreach data as row and do individual inserts...but this would take forever for
            //inserting a lot of data
            //might need to rearrange setting of data elements so the subarrays are in the same order as
            //the columns in the score table
            $this->db->insert_batch('score', $data);
            $this->load->view('score_update_success_view', $data);
        }
    }

    public function validateDate($date) {
        $future = date("Y-m-d");
        $future = date("Y-m-d", strtotime($future. ' + 1 days'));

        $dateStamp = strtotime($date);
        $futureStamp = strtotime($future);
        if($dateStamp < $futureStamp) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('validateDate', 'Cannot enter scores for a future date.');
            return FALSE;
        }
    }

    public function validateEmpty($data) {
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


}