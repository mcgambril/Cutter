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

        $data['query'] = $this->course_model->test();


        $this->load->view('header_view');
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