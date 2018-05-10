<?php


class NotFoundController extends Controller
{

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data["view"] = "notFound";
        $this->data["title"] = "Not Found";
    }

    public function index()
    {
        header("HTTP/1.1 404 Not Found");
        $this->data["layout"] = "index";
    }

}