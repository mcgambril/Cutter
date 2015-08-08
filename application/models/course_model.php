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

    public function getCourseID($courseName) {
        $this->db->select('courseID');
        $this->db->from('course');
        $this->db->where('courseName', $courseName);
        $getCourseIDQuery = $this->db->get();
        return $getCourseIDQuery->result();
    }

    public function test_entry($data) {
        $this->db->insert('course', $data);
    }
}