<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [])
    {
        ob_start();
        require_once '../app/views/' . $view . '.php';
        $content = ob_get_clean();
        require_once '../app/views/layouts/app.php';
    }
}