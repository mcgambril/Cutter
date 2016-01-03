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
            $row->playerScoreCount = count($row->scores);
        }
        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();

        $this->load->view('home_header_view');
        $this->load->view('home_view', $data);
        $this->load->view('footer_view');
    }

    public function loadHomeLoggedIn() {
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();
        $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();

        $this->load->view('header_view');
        $this->load->view('home_view', $data);
        $this->load->view('footer_view');

    }

}