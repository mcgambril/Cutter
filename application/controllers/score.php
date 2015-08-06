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

        $this->form_validation->set_rules('datepicker', 'Date', 'required|less_than['.date("Y/m/d").']');

        $data['players'] = $this->player_model->getPlayers();
        foreach($data['players'] as $row) {
            $this->form_validation->set_rules($row->playerID.'am-score', $row->playerName.' AM Score', 'integer|greater_than[0]');
            $this->form_validation->set_rules($row->playerID.'pm-score', $row->playerName.' PM Score', 'integer|greater_than[0]');
        }

        if($this->form_validation->run()== FALSE) {
            $this->post();
        }
    }
}