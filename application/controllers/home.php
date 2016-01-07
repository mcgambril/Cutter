<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:07 PM
 * Cutter/application/controllers/home.php
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        date_default_timezone_set('America/Mexico_City');

        $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();
        foreach ($data['getPlayersAndScoresQuery'] as $row) {
            //getRecentScores returns FALSE to getPlayersAndScores if no scores are entered for that player
            if ($row->scores == FALSE) {
                $row->playerScoreCount = 0;
            }
            else {
                $row->playerScoreCount = count($row->scores);
                foreach( $row->scores as $r) {
                    $r->scoreDate = date("m/d/Y", strtotime($r->scoreDate));
                }
            }
        }

        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
        if ($this->validateNotEmpty($data['getHomeCourseQuery'] == TRUE)) {
            $data['empty'] = FALSE;
        }
        else {
            $data['empty'] = TRUE;
        }


        $this->load->view('home_header_view');
        $this->load->view('home_view', $data);
        $this->load->view('footer_view');
    }

    public function loadHomeLoggedIn() {
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();
        foreach ($data['getPlayersAndScoresQuery'] as $row) {
            //getRecentScores returns FALSE to getPlayersAndScores if no scores are entered for that player
            if ($row->scores == FALSE) {
                $row->playerScoreCount = 0;
            }
            else {
                $row->playerScoreCount = count($row->scores);
                foreach( $row->scores as $r) {
                    $r->scoreDate = date("m/d/Y", strtotime($r->scoreDate));
                }
            }
        }

        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
        if ($this->validateNotEmpty($data['getHomeCourseQuery'] == TRUE)) {
            $data['empty'] = FALSE;
        }
        else {
            $data['empty'] = TRUE;
        }

        $this->load->view('header_view');
        $this->load->view('home_view', $data);
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

}