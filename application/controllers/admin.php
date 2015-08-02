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
        $this->load->view('home_header_view');
        $this->load->view('admin_view');
        $this->load->view('footer_view');
    }
}