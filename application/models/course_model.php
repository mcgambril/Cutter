<?php
/**
 * Created by PhpStorm.
 * User: Matthew
 * Date: 7/16/2015
 * Time: 9:50 PM
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

    public function test() {
        //$this->db->select('name, slope');
        $query = $this->db->get('course');
        return $query->result();

    }
}