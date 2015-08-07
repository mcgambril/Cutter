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
        $this->load->helper('form');
        $this->load->library('form_validation');
        date_default_timezone_set('America/Mexico_City');

        $this->form_validation->set_rules('datepicker', 'Date', 'required|callback_validateDate');

        $data['players'] = $this->player_model->getPlayers();
        foreach($data['players'] as $row) {
            $this->form_validation->set_rules($row->playerID.'am-score', $row->playerName.' AM Score', 'integer|greater_than[17]');
            $this->form_validation->set_rules($row->playerID.'pm-score', $row->playerName.' PM Score', 'integer|greater_than[17]');
        }

        if($this->form_validation->run()== FALSE) {
            $this->post();
        }

        $data['date'] = $this->input->post('datepicker');
        $data['course'] = $this->input->post('course');
        $temp['ids'] = $this->player_model->getPlayerIDs(1);
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

        $data['ids'] = $ids;

        foreach( $amScores as $key => $value ) {
            if(empty($value)) {
                unset( $amScores[$key] );
            }
        }
        foreach($pmScores as $key => $value) {
            if(empty($value)) {
                unset($pmScores[$key]);
            }
        }
        if($this->validateEmpty($amScores, $pmScores) == FALSE) {
            $this->load->view('score_empty_post_view');
        }
        else {
            $data['amScores'] = $amScores;
            $data['pmScores'] = $pmScores;
            foreach($data['ids'] as $row) {
                //create a new element in $data['scoreRecords'] with playerID, date, course, am score (if there? how do I check?) and pm score (same question)
                //maybe need to name keys in earlier score arrays based on playerID...as long as those keys don't change when empties are unset
                //could use multi array w/ playerID=>am score as each element in amscore array
            }
            //rearrange arrays so there is a different array for each individual score record
            //then load those into the database
            //send them to success page
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

    public function validateEmpty($amScores, $pmScores) {
        if(empty($amScores) && empty($pmScores)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }


}