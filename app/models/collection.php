<?php

namespace App\Models;

use PDO;

class Collection
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo; // Recebe a conexão PDO no momento da inicialização
    }

    // Retorna todas as coleções
    public function getAllCollections()
    {
        $stmt = $this->pdo->query("SELECT * FROM collections");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna uma coleção por ID
    public function getCollectionById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM collections WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
