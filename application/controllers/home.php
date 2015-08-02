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

        //$this->update();

        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        $data['getCoursesQuery'] = $this->course_model->getCourses();
        $data['getPlayersQuery'] = $this->player_model->getPlayers();
        $data['getScoresQuery'] = $this->score_model->getScores();
        $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();

        $playerID = 1;
        $data['getPlayerScoresQuery'] = $this->player_model->getPlayerScores($playerID);

        $scores = array();
        $data['IDs'] = $this->player_model->getPlayerIDs();

        $i = 0;
        foreach($data['IDs'] as $row) {
            $data['Scores'] = $this->player_model->getPlayerScores($row->playerID);
            $i++;
        }

        $this->load->view('home_header_view');
        $this->load->view('home_view', $data);
        $this->load->view('footer_view');
    }

    public function update() {

        $data = array(
                        "name" => "Vestavia",
                        "slope" => 132.00,
                        "rating" => 72,
                        "default" => 0
        );

        $this->load->model('course_model');

        $this->course_model->test_entry($data);
    }
}