<?php

// "Base class" controller yang akan diextends oleh class turunan lainnya di directory controller
class Controller
{
    // Panggil view berupa struktur html dengan data yang dapat dipakai dalam view
    public function view(array $views, array $data = [])
    {
        // Panggil header
        require_once '../app/views/template/header.view.php';

        // Lakukan perulangan pada setiap view dalam array views
        // Panggil setiap view
        foreach ($views as $view) {
            require_once '../app/views/' . $view . '.view.php';
        }

        // Panggil footer
        require_once '../app/views/template/footer.view.php';
    }

    // Memanggil model untuk berkomunikasi dengan database
    public function model(string $model)
    {
        require_once '../app/model/' . $model . '.php';

        return new $model;
    }
}
