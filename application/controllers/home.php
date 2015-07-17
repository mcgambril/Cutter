<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:07 PM
 */

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
    }


    public function index() {

        $this->load->model('course_model');

        $data['query'] = $this->course_model->test();


        $this->load->view('home_view', $data);
    }
}