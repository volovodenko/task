<?php


class DashboardController extends Controller
{
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->data["view"] = "dashboard";
        $this->data["title"] = "Dashboard";
    }

    public function index()
    {
        $this->data["layout"] = "index";

    }

    public function products()
    {
        echo "hello products";
        exit();
    }

    public function users()
    {

        $this->data["layout"] = "users";

        $user = new UserModel();
        $users = $user->getAllUsers();


        $this->data["users"] = $users;

        $view = new View($this->data);
        echo $view->render();

        exit();
    }

    public function findUser()
    {
        $userName = isset($_GET["find"]) ? $_GET["find"] : null;
        $this->data["layout"] = "userstable";

        $user = new UserModel();
        $users = $user->getUsers($userName);
        $this->data["users"] = $users;

        $view = new View($this->data);
        echo $view->render();

        exit();

    }

    public function delUser()
    {

        $this->data["layout"] = "userstable";

        $user = new UserModel();
        $user->delUser();

        exit();

    }

    public function editUser()
    {

        $this->data["layout"] = "userstable";

        $user = new UserModel();
        $user->editUser();

        exit();

    }
}