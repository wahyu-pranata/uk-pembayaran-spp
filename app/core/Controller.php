<?php

class Controller {
    public function view(array $views, array $data = []) {
        require_once '../app/views/template/header.view.php';
        foreach($views as $view) {
            require_once '../app/views/' . $view . '.view.php';
        }
        require_once '../app/views/template/footer.view.php';
    }
    public function model(string $model)
    {
        require_once '../app/model/' . $model . '.php';
        return new $model;
    }
}