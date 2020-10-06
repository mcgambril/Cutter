<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:50 PM
 * Cutter/application/models/course_model.php
 */

class Course_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getCourses() {
        //$getCoursesQuery = $this->db->get('course');
        $this->db->select('*');
        $this->db->from('course');
        $this->db->order_by('courseName', 'asc');
        $getCoursesQuery = $this->db->get();
        if ($getCoursesQuery->num_rows() > 0)
        {
            return $getCoursesQuery->result();
        }
        else {
            return FALSE;
        }

    }

    public function getHomeCourse() {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('courseDefault', 1);
        $getHomeCourseQuery = $this->db->get();
        if ($getHomeCourseQuery->num_rows() > 0) {
            return $getHomeCourseQuery->result();
        }
        else {
            return FALSE;
        }

    }

    public function getCourseID($courseName, $var) {
        $this->db->select('courseID');
        $this->db->from('course');
        $this->db->where('courseName', $courseName);
        $getCourseIDQuery = $this->db->get();
        if ($getCourseIDQuery->num_rows() > 0) {
            if($var == 1){
                return $getCourseIDQuery->result_array();
            }
            else {
                return $getCourseIDQuery->result();
            }
        }
        else {
            return FALSE;
        }

    }

    public function getCourse($id, $var) {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('courseID', (int)$id);
        $getCourseQuery = $this->db->get();
        if ($getCourseQuery->num_rows() > 0) {
            if($var == 1) {
                return $getCourseQuery->result_array();
            }
            else {
                return $getCourseQuery->result();
            }
        }
        else {
            return FALSE;
        }
    }

    public function getCourseName($id, $var) {
        $this->db->select('courseName');
        $this->db->from('course');
        $this->db->where('courseID', (int)$id);
        $getCourseNameQuery = $this->db->get();
        if ($getCourseNameQuery->num_rows() > 0) {
            if($var == 1) {
                return $getCourseNameQuery->result_array();
            }
            else {
                return $getCourseNameQuery->result();
            }
        }
        else {
            return FALSE;
        }
    }

    //need to test
    //courseRating and courseSlope are flip flopped in original code, inserting them into each others fields
    //have just moved them back in place ... not sure if this is bug in prod or if code somehow works around it
    //works fine in prod - need to understand why
    //I think it worked fine b/c I passed the params in the right order, so the variable names are abritrary b/c the values are still int he right order
    public function insertCourse($courseName, $courseSlope, $courseRating, $coursePar, $courseDefault) {
        $queryString = "INSERT INTO course (courseName, courseSlope, courseRating, coursePar, courseDefault)
                        VALUES ('$courseName', $courseSlope, $courseRating, $coursePar, $courseDefault)";

        if($this->db->query($queryString) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function clearHomeCourse() {
        $update = array(
            'courseDefault' => 0
        );
        $this->db->where('courseDefault', 1);
        if ($this->db->update('course', $update) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function updateHomeCourse($courseID) {
        if ($this->clearHomeCourse() == TRUE) {
            //$this->clearHomeCourse();
            $update = array(
                'courseDefault' => 1
            );
            $this->db->where('courseID', $courseID);
            if ($this->db->update('course', $update) == TRUE) {
                return TRUE;
            }
            else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }

    public function updateCourse($id, $data) {
        $this->db->where('courseID', $id);
        if ($this->db->update('course', $data) == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    public function deleteCourse($courseID) {
        $this->db->where('courseID', $courseID);
        if ($this->db->delete('course') == TRUE) {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

}