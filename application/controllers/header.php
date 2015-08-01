<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/31/2015
 * Time: 9:26 PM
 */

class Header extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function loadView($viewOne, $viewTwo, $viewThree) {
        $this->load->view($viewOne);
        $this->load->view($viewTwo);
        $this->load->view($viewThree);
    }

    public function loadHomeView() {
        $this->load->view('home_header_view');
        $this->load->view('home_view');
        $this->load->view('footer_view');
    }

    public function loadAdminView() {
        $this->load->view('header_view');
        $this->load->view('admin_view');
        $this->load->view('footer_view');
    }

    public function loadScoreHomeView() {
        $this->load->view('header_view');
        $this->load->view('score_view');
        $this->load->view('footer_view');
    }

    public function loadScoreEditView() {
        $this->load->view('header_view');
        $this->load->view('score_edit_view');
        $this->load->view('footer_view');
    }

    public function loadScoreUpdateSuccessView() {
        $this->load->view('header_view');
        $this->load->view('score_update_success_view');
        $this->load->view('footer_view');
    }

    public function loadScorePostView() {
        $this->load->view('header_view');
        $this->load->view('score_post_view');
        $this->load->view('footer_view');
    }

    public function loadPlayerHomeView() {
        $this->load->view('header_view');
        $this->load->view('player_view');
        $this->load->view('footer_view');
    }

    public function loadPlayerAddView() {
        $this->load->view('header_view');
        $this->load->view('player_add_view');
        $this->load->view('footer_view');
    }

    public function loadPlayerEditView() {
        $this->load->view('header_view');
        $this->load->view('player_edit_view');
        $this->load->view('footer_view');
    }

    public function loadPlayerUpdateSuccessView() {
        $this->load->view('header_view');
        $this->load->view('player_update_success_view');
        $this->load->view('footer_view');
    }

    public function loadPlayerDeleteView() {
        $this->load->view('header_view');
        $this->load->view('player_delete_view');
        $this->load->view('footer_view');
    }

    public function loadHandicapUpdateView() {
        $this->load->view('header_view');
        $this->load->view('handicap_update_view');
        $this->load->view('footer_view');
    }

    public function loadHandicapConfirmUpdateView() {
        $this->load->view('header_view');
        $this->load->view('handicap_confirm_update_view');
        $this->load->view('footer_view');
    }

    public function loadHandicapUpdateSuccessView() {
        $this->load->view('header_view');
        $this->load->view('handicap_update_success_view');
        $this->load->view('footer_view');
    }

    public function loadCourseHomeView() {
        $this->load->view('header_view');
        $this->load->view('course_view');
        $this->load->view('footer_view');
    }

    public function loadCourseAddView() {
        $this->load->view('header_view');
        $this->load->view('course_add_view');
        $this->load->view('footer_view');
    }

    public function loadCourseEditView() {
        $this->load->view('header_view');
        $this->load->view('course_edit_view');
        $this->load->view('footer_view');
    }

    public function loadCourseUpdateSuccessView() {
        $this->load->view('header_view');
        $this->load->view('course_update_success_view');
        $this->load->view('footer_view');
    }

    public function loadCourseDeleteView() {
        $this->load->view('header_view');
        $this->load->view('course_delete_view');
        $this->load->view('footer_view');
    }
}