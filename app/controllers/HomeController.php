<?php


class HomeController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data["view"] = "home";
        $this->data["title"] = "Home";
    }

    public function index()
    {
        $this->data["layout"] = "index";

    }
}