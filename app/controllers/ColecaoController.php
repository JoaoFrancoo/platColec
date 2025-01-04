<?php

require_once '../app/models/ColecaoModel.php';

class ColecaoController {
    private $model;

    public function __construct() {
        $this->model = new ColecaoModel();
    }

    public function index() {
        $colecoes = $this->model->getAllColecoes();
        require '../app/views/colecoesView.php';
    }

    public function create() {
        require '../app/views/colecoesCreateView.php';
    }

    public function store() {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description']
        ];
        $this->model->createColecao($data);
        header('Location: /colecoes');
    }
}

?>
