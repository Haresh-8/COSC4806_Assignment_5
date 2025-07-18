<?php
class LogModel {
    private $db;

    public function __construct() {
        $this->db = db_connect();
    }

    public function getLoginCounts() {
        $stmt = $this->db->query("SELECT username, COUNT(*) as total 
                                  FROM login_log 
                                  WHERE attempt = 'good' 
                                  GROUP BY username");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
