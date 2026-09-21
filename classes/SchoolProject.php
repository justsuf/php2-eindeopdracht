<?php
require_once 'Project.php';

class SchoolProject extends Project {
    private $schoolSubject;
    public function __construct($title, $description, $date, $category, $schoolSubject) {
        parent::__construct($title, $description, $date, $category);
        $this->schoolSubject = $schoolSubject;
    }
    public function getSchoolSubject() {
        return $this->schoolSubject;
    }
}
?>