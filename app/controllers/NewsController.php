<?php


class NewsController extends Controller
{
    public function index($name = '')
    {
        echo 'this is news motherfucker';
        /*$user = $this->model('User');
        $user->name = $name;

        $this->view('index/index', ['name' => $user->name]);*/
    }
}