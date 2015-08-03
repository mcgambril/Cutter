<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 8/2/2015
 * Time: 5:45 PM
 */

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->view('home_header_view');
        $this->load->view('admin_view');
        $this->load->view('footer_view');
    }

    public function submitPass() {
        $this->load->model('cutterpassword_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'required|callback_passwordConfirm');

        if($this->form_validation->run()== FALSE) {
            $this->index();
        }
        else {
            $this->load->model('course_model');
            $this->load->model('player_model');
            $this->load->model('score_model');

            $data['getCoursesQuery'] = $this->course_model->getCourses();
            $data['getPlayersQuery'] = $this->player_model->getPlayers();
            $data['getScoresQuery'] = $this->score_model->getScores();
            $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();
            $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
            $data['IDs'] = $this->player_model->getPlayerIDs();

            $this->load->view('header_view');
            $this->load->view('home_view', $data);
            $this->load->view('footer_view');
        }
    }

    public function passwordConfirm($str) {
        $this->load->model('cutterpassword_model');
        $data['currentPass'] = $this->cutterpassword_model->getPassword();
        $string = "";
        foreach($data['currentPass'] as $row) {
            $string = $row->password;
        }
        if ($str == $string) {
            return TRUE;
        }
        else {
            $this->form_validation->set_message('passwordConfirm', 'Invalid Password.');
            return FALSE;
        }

    }
}