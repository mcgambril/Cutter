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
                'field' => 'courseSlope',
                'label' => 'Course Slope',
                'rules' => 'required|numeric'
            ),
            array(
                'field' => 'courseRating',
                'label' => 'Course Rating',
                'rules' => 'required|decimal'
            )
        );

        $this->form_validation->set_rules($config);

        if($this->form_validation->run()== FALSE) {
            $this->add();
        }
        else {
            $courseName = $this->input->post('courseName');
            $courseSlope = $this->input->post('courseSlope');
            //need to make sure slope is in the proper format
            //actuall, mysql should do the rounding and formatting before insertion
            $courseRating = $this->input->post('courseRating');
            //need to make sure rating is in the proper format
            //mysql should handle the rounding and decimal formatting
            $courseDefault = $this->input->post('courseDefault');
            if ($courseDefault == 'True') {
                $courseDefault = 1;
                $this->course_model->updateHomeCourse();
            }
            else {
                $courseDefault = 0;
            }

            if ($this->course_model->insertCourse($courseName, $courseSlope, $courseRating, $courseDefault) == TRUE) {
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

    public function edit($paramID = NULL) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');

        if($paramID == NULL) {
            $id = $this->uri->segment(3);
        }
        else {
            $id = $paramID;
        }

        $data['getCourseQuery'] = $this->course_model->getCourse($id, 0);
        foreach($data['getCourseQuery'] as $row) {
            $data['courseName'] = $row->courseName;
            if($row->courseDefault == 0) {
                $data['checkedLabel'] = 'No ';
                $data['checked'] = 'unchecked';
                $data['changePrompt'] = 'Set as Home Course?';
            }
            else {
                $data['checkedLabel'] = 'Yes ';
                $data['checked'] = 'checked';
                $data['changePrompt'] = 'Remove as Home Course?';
            }
        }

        $this->load->view('header_view');
        $this->load->view('course_edit_view', $data);
        $this->load->view('footer_view');
    }

    public function submitCourseEdit() {
        $this->load->model('course_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $config = array(
            array(
                'field' => 'newCourseName',
                'label' => 'Course Name',
                'rules' => 'max_length[45]'
            ),
            array(
                'field' => 'newCourseRating',
                'label' => 'Course Rating',
                'rules' => 'decimal'
            ),
            array(
                'field' => 'newCourseSlope',
                'label' => 'Course Slope',
                'rules' => 'numeric'
            )
        );

        $this->form_validation->set_rules($config);
        $courseID = $this->input->post('courseID');

        if($this->form_validation->run()== FALSE) {
            $this->edit($courseID);
        }
        else {
            $newCourseName = $this->input->post('newCourseName');
            $newCourseSlope = $this->input->post('newCourseSlope');
            $newCourseRating = $this->input->post('newCourseRating');
            $changeDefault = $this->input->post('changeDefault');
            $newCourseDefault = NULL;

            $change = FALSE;
            $oldCourse = $this->course_model->getCourse($courseID, 0);
            foreach ($oldCourse as $row) {
                if ($changeDefault == TRUE) {
                    $change = TRUE;
                    if ($row->courseDefault == 0) {
                        $newCourseDefault = 1;
                    }
                    else {
                        $newCourseDefault = 0;
                    }
                }
                else {
                    $newCourseDefault = $row->courseDefault;
                }

                if ($newCourseName == "" || $newCourseName == NULL) {
                    $newCourseName = $row->courseName;
                }
                else {
                    $change = TRUE;
                }

                if ($newCourseSlope == "" || $newCourseSlope == 0 || $newCourseSlope == NULL) {
                    $newCourseSlope = $row->courseSlope;
                }
                else {
                    $change = TRUE;
                }

                if ($newCourseRating == "" || $newCourseRating == 0 || $newCourseRating == NULL) {
                    $newCourseRating = $row->courseRating;
                }
                else {
                    $change = TRUE;
                }
            }

            if ($change == TRUE) {
                //call model method to insert the data
                $data['courseName'] = $newCourseName;
                $data['courseSlope'] = $newCourseSlope;
                $data['courseRating'] = $newCourseRating;
                $data['courseDefault'] = $newCourseDefault;

                if ($this->course_model->updateCourse($courseID, $data) == TRUE) {
                    $data['title'] = 'Success!';
                    $data['message1'] = 'The appropriate changes were made and the database updated accordingly.';
                    $data['message2'] = $newCourseName . "'s information was updated as follows:";
                }
                else {
                    $data['title'] = 'Failure';
                    $data['message1'] = 'Error:  Something went wrong and the changes were not able to be applied to the database.';
                    $data['message2'] = 'Please try again later.';
                }

                if ($newCourseDefault == 0) {
                    $data['courseDefault'] = 'No';
                }
                else {
                    $data['courseDefault'] = 'Yes';
                }

                $data['courseID'] = $courseID;

                $this->courseEditResult($data);
            }
            else {
                $this->edit($courseID);
            }
        }
    }

    public function delete() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('course_model');

        $courseID = $this->uri->segment(3);
        $data['getCourseQuery'] = $this->course_model->getCourse($courseID, 0);
        foreach ($data['getCourseQuery'] as $row) {
            if ($row->courseDefault == 0) {
                $row->courseDefault = '-';
            }
            else {
                $row->courseDefault = 'Yes';
            }
        }

        $this->load->view('header_view');
        $this->load->view('course_delete_view', $data);
        $this->load->view('footer_view');
    }

    public function courseAddResult($data) {
        $this->load->view('header_view');
        $this->load->view('course_add_result_view', $data);
        $this->load->view('footer_view');
    }

    public function courseEditResult($data) {
        $this->load->view('header_view');
        $this->load->view('course_edit_result_view', $data);
        $this->load->view('footer_view');
    }

}