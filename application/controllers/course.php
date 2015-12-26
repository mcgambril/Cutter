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
        $this->load->model('course_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'courseName',
                'label' => 'Course Name',
                'rules' => 'required|max_length[45]'
            ),
            array(
                'field' => 'courseRating',
                'label' => 'Course Rating',
                'rules' => 'required|decimal'
            ),
            array(
                'field' => 'courseSlope',
                'label' => 'Course Slope',
                'rules' => 'required|numeric'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->add();
        }
        else {
            $courseName = $this->input->post('courseName');
            $courseRating = $this->input->post('courseRating');
            $courseSlope = $this->input->post('courseSlope');
            $courseDefault = $this->input->post('courseDefault');
            if ($courseDefault == 'True') {
                $courseDefault = 1;
                $this->course_model->updateHomeCourse();
            }
            else {
                $courseDefault = 0;
            }

            if ($this->course_model->insertCourse($courseName, $courseRating, $courseSlope, $courseDefault) == TRUE) {
                $data['title'] = 'Success!';
                if($courseDefault == 1) {
                    $data['message'] = $courseName . ' was successfully added to the database and is set to be the new Home Course.';
                }
                else {
                    $data['message'] = $courseName . ' was successfully added to the database.';
                }
            }
            else {
                $data['title'] = 'Failure';
                $data['message'] = 'Error:  Something went wrong and ' . $courseName . ' was not added to the database.  Please try again later.';
            }
            $this->courseAddResult($data);
        }
        return;
    }

    public function edit() {

    }

    public function delete() {

    }

    public function courseAddResult($data) {
        $this->load->view('header_view');
        $this->load->view('course_add_result_view', $data);
        $this->load->view('footer_view');
    }

}