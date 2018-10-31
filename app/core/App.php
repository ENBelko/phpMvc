<?php

class App
{
    protected $controller = 'IndexController';

    protected $method = 'index';

    protected $routes = [];

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();
        var_dump($url);
        if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php') and ucfirst($url[0]) != 'Index') {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }

        //var_dump($this->controller);
        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        /*$routePath = require '../app/core/routes.php';

        if($this->in_array_r('controller',$routePath)){
            var_dump('dfs');
        }*/

        if (isset($_SERVER['REQUEST_URI']) /*&& in_array('/', $routePath)*/) {
            //print_r($routePath);
            return $url = explode('/', filter_var(rtrim(str_replace('/mvc/','',$_SERVER['REQUEST_URI']), '/'), FILTER_SANITIZE_URL));
        }
    }

    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }
}