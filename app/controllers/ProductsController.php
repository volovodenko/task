<?php

class ProductsController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data["view"] = "products";
        $this->data["title"] = "Products";
    }

    public function index()
    {
        $this->data["layout"] = "index";
    }
}