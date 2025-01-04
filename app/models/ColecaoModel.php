<?php

require_once '../app/config/Database.php';

class ColecaoModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllColecoes() {
        $query = "SELECT * FROM collections";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createColecao($data) {
        $query = "INSERT INTO collections (name, description) VALUES (:name, :description)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->execute();
    }
}

?>
