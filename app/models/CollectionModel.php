<?php

require_once '../app/config/Database.php';

class CollectionModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCollections() {
        $query = "SELECT id, name FROM collections";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
