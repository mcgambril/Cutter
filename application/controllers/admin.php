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
        $this->load->model('cutteradmin_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim|callback_passwordConfirm|'
            )
        );

        //$this->form_validation->set_rules('password', 'Password', 'required|callback_passwordConfirm');
        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->index();
        }
        else {
            $this->loadHomeLoggedIn();
        }
    }

    public function passwordConfirm($str) {
        $this->load->model('cutteradmin_model');
        $data['currentPass'] = $this->cutteradmin_model->getPassword();
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

    public function changePassword() {
        $this->load->model('cutteradmin_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('header_view');
        $this->load->view('admin_change_pass_view');
        $this->load->view('footer_view');
    }

    public function submitChangePassword() {
        $this->load->model('cutteradmin_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|trim|callback_passwordConfirm'
            ),
            array(
                'field' => 'newPass',
                'label' => 'New Password',
                'rules' => 'required|trim|matches[confirmPass]|max_length[45]|is_unique[cutteradmin.password]|min_length[4]|valid_base64'
            ),
            array(
                'field' => 'confirmPass',
                'label' => 'Confirm New Password',
                'rules' =>'required|trim|matches[newPass]|max_length[45]'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->changePassword();
        }
        else {
            $newPass = $this->input->post('newPass');
            $oldPassID = NULL;
            $currentPass = $this->cutteradmin_model->getPassword();
            foreach ($currentPass as $row) {
                if ($row->current == 1) {
                    $oldPassID = $row->passwordID;
                }
            }

            if ($this->cutteradmin_model->insertNewPass($newPass) == TRUE) {
                if ($this->cutteradmin_model->deactivateOldPass($oldPassID) == TRUE) {
                    $data['message1'] = 'Success!';
                    $data ['message2'] = 'The password has been successfully updated.';
                }
            }
            else {
                $data['message1'] = 'Failed.';
                $data['message2'] = 'Error:  Something went wrong and the password was not able to be updated';
            }

            $this->load->view('header_view');
            $this->load->view('admin_change_pass_result_view', $data);
            $this->load->view('footer_view');
        }
    }

    public function loadHomeLoggedIn() {
        $this->load->model('course_model');
        $this->load->model('player_model');
        $this->load->model('score_model');

        $data['getPlayersAndScoresQuery'] = $this->player_model->getPlayersAndScores();
        if ($data['getPlayersAndScoresQuery'] != FALSE) {
            $data['noPlayers'] = FALSE;
            foreach ($data['getPlayersAndScoresQuery'] as $row) {
                //getRecentScores returns FALSE to getPlayersAndScores if no scores are entered for that player
                if ($row->scores == FALSE) {
                    $row->playerScoreCount = 0;
                } else {
                    $row->playerScoreCount = count($row->scores);
                    foreach ($row->scores as $r) {
                        $r->scoreDate = date("m/d/Y", strtotime($r->scoreDate));
                    }
                }
            }

            $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
            if ($this->validateNotEmpty($data['getHomeCourseQuery'] == TRUE)) {
                $data['empty'] = FALSE;
            } else {
                $data['empty'] = TRUE;
            }
        }
        else {
            $data['getHomeCourseQuery'] = $this->course_model->getHomeCourse();
            if ($this->validateNotEmpty($data['getHomeCourseQuery'] == TRUE)) {
                $data['empty'] = FALSE;
            } else {
                $data['empty'] = TRUE;
            }
            $data['noPlayers'] = TRUE;
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