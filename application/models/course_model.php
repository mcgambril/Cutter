<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:50 PM
 * Cutter/application/models/course_model.php
 */

class Course_model extends CI_Model {

    var $courseID = '';
    var $name = '';
    var $slope = '';
    var $rating = '';
    var $default = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function getCourses() {
        $getCoursesQuery = $this->db->get('course');
        return $getCoursesQuery->result();
    }

    public function getHomeCourse() {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('courseDefault', 1);
        $getHomeCourseQuery = $this->db->get();
        return $getHomeCourseQuery->result();
    }

    public function getCourseID($courseName, $var) {
        $this->db->select('courseID');
        $this->db->from('course');
        $this->db->where('courseName', $courseName);
        $getCourseIDQuery = $this->db->get();
        if($var == 1){
            return $getCourseIDQuery->result_array();
        }
        else {
            return $getCourseIDQuery->result();
        }
    }

    public function getCourse($id, $var) {
        $this->db->select('*');
        $this->db->from('course');
        $this->db->where('courseID', (int)$id);
        $getCourseQuery = $this->db->get();
        if($var == 1) {
            return $getCourseQuery->result_array();
        }
        else {
            return $getCourseQuery->result();
        }
    }

    public function getCourseName($id, $var) {
        $this->db->select('courseName');
        $this->db->from('course');
        $this->db->where('courseID', (int)$id);
        $getCourseNameQuery = $this->db->get();
        if($var == 1) {
            return $getCourseNameQuery->result_array();
        }
        else {
            return $getCourseNameQuery->result();
        }
    }

    public function insertCourse($courseName, $courseRating, $courseSlope, $courseDefault) {
        $queryString = "INSERT INTO course (courseName, courseRating, courseSlope, courseDefault)
                        VALUES ('$courseName', $courseSlope, $courseRating, $courseDefault)";

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


    /*public function test_entry($data) {
        $this->db->insert('course', $data);
    }*/


}