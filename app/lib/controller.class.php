<?php


class Controller
{
    protected $data;

    protected $model;

    protected $params;


    public function getData()
    {
        return $this->data;
    }


    public function getModel()
    {
        return $this->model;
    }


    public function getParams()
    {
        return $this->params;
    }

    public function __construct($data = [])
    {
        $this->data = $data;
        $this->params = App::getRouter()->getParams();
    }


    public function login()
    {
        if (getPOST("userEmail")) {
            $user = new UserModel;
            $user->login();
        }

        Router::redirect("/" . App::getRouter()->getController());
        exit();
    }

    public function register()
    {
        if (getPOST("userEmail")) {
            $user = new UserModel;
            $user->register();
        }

        Router::redirect("/" . App::getRouter()->getController());
        exit();
    }


    public function logout()
    {
        session_destroy();
        setcookie(session_name(),'',0,'/');

        Router::redirect("/");
        exit();
    }


}