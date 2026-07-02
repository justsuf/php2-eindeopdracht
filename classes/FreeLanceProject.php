<?php
require_once 'Project.php';
class FreelanceProject extends Project {
    private $clientName;
    public function __construct($title, $description, $date, $category, $clientName) {
        parent::__construct($title, $description, $date, $category);
        $this->clientName = $clientName;
    }
    public function getClientName() {
        return $this->clientName;
    }
}
?>