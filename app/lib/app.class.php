<?php

class App
{
    protected static $router;


    public static function getRouter()
    {
        return self::$router;
    }


    public static function run()
    {
        clearFlash();

        self::$router = new Router;

        $controllerClass = ucfirst(self::$router->getController()) . 'Controller';
        $controllerAction = self::$router->getAction();
        $actionParams = self::$router->getParams();


        $controllerObject = new $controllerClass;

        if (method_exists($controllerObject, $controllerAction)) {
            $controllerObject->$controllerAction($actionParams);
        } else {
            Router::redirect("/notFound");
            exit();
        }

        $data = $controllerObject->getData();
        $viewObject = new View($data);
        $data["content"] = $viewObject->render();

        $template = VIEWS . DS . "template" . DS . "index.php";
        $templateViewObject = new View($data, $template);
        echo $templateViewObject->render();

    }
}