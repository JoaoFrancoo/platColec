<?php

require_once '../app/config/Database.php';

class ItemModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllItems() {
        $query = "SELECT * FROM items";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createItem($data) {
        $query = "INSERT INTO items (name, description, collection_id, value, image_url) VALUES (:name, :description, :collection_id, :value, :image_url)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':collection_id', $data['collection_id']);
        $stmt->bindParam(':value', $data['value']);
        $stmt->bindParam(':image_url', $data['image_url']);
        $stmt->execute();
    }
}

?>
