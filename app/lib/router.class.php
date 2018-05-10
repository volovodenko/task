<?php

class Router
{
    protected $uri;

    protected $route;

    protected $controller;

    protected $action;

    protected $params;


    public function getUri()
    {
        return $this->uri;
    }


    public function getRoute()
    {
        return $this->route;
    }


    public function getController()
    {
        return $this->controller;
    }


    public function getAction()
    {
        return $this->action;
    }


    public function getParams()
    {
        return $this->params;
    }


    public function __construct()
    {
        $request = $_SERVER['REQUEST_URI'];

        $this->uri = trim($request, "/");
        $this->route = explode('?', $this->uri)[0];

        $route_parts = explode('/', $this->route);

        $this->controller = !empty($route_parts[0]) ? $route_parts[0] : "home";
        $this->action = !empty($route_parts[1]) ? $route_parts[1] : "index";
        $this->params = !empty($route_parts[2]) ? $route_parts[2] : null;

        if (getSESSION("role") != "admin" && $this->controller == "dashboard") {
            $this->controller = "notFound";
        }

        if (!in_array($this->controller, array_keys(Config::get("routes")))) {
            $this->controller = "notFound";
        }

    }


    public static function redirect($location)
    {
        header("Location: $location");
    }

}