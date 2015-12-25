<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 12/24/2015
 * Time: 4:45 PM
 */

class Course extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index() {
        $this->load->model('course_model');
        $data['getCoursesQuery'] = $this->course_model->getCourses();
        foreach($data['getCoursesQuery'] as $row) {
            if ($row->courseDefault == 1) {
                $row->courseDefault = 'Home Course';
            }
            else {
                $row->courseDefault = '-';
            }
        }

        $this->load->view('header_view');
        $this->load->view('course_view', $data);
        $this->load->view('footer_view');
    }

    public function add() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->view('header_view');
        $this->load->view('course_add_view');
        $this->load->view('footer_view');

    }

    public function submitCourseAdd() {

    }

    public function edit() {

    }

    public function delete() {

    }

}