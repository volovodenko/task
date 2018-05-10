<?php

class View
{

    protected $data;

    protected $layout;


    protected function getDefaultViewPath()
    {

        $viewDir = $this->data["view"];

        $templateName = $this->data["layout"] . ".php";

        return VIEWS . DS . $viewDir . DS . $templateName;
    }


    public function __construct($data = [], $layout = null)
    {
        $this->data = $data;

        if (!$layout) {
            $layout = self::getDefaultViewPath();
        }

        $this->layout = $layout;

    }

    public function render()
    {
        ob_start();

        extract($this->data);
        require($this->layout);
        $content = ob_get_clean();

        return $content;
    }


}