<?php

class App
{
    protected $controller = "Home",
        $method = "index",
        $params = [],
        $url;
    public function __construct()
    {
        $this->url = $this->parseUrl();
        if (isset($this->url[0]) && file_exists('../app/controller/' . $this->url[0] . '.php')) {
            $this->controller = $this->url[0];
            unset($this->url[0]);
        }
        require_once '../app/controller/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($this->url[1]) && method_exists($this->controller, $this->url[1])) {
            $this->method = $this->url[1];
            unset($this->url[1]);
        }

        if (!empty($this->url)) {
            $this->params = array_values($this->url);
        }
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
            $this->url = rtrim($this->url);
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode('/', $this->url);
            return $this->url;
        }
        return [];
    }
}