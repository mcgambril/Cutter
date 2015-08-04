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
}