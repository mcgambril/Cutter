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

    public function loadScoreHomeView() {
        $this->load->view('header_view');
        $this->load->view('score_view');
        $this->load->view('footer_view');
    }
}