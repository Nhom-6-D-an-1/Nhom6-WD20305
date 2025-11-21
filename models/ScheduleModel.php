<?php

class ScheduleModel{
    private $conn;
    public function __construct() {
        $db = new BaseModel();
        $this->conn = $db->getConnection();
    }
    
    public function getAll()  {
        
    }
}