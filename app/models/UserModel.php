<?php


class UserModel extends Model
{
    private $userEmail;
    private $userPassword;


    public function __construct()
    {
        parent::__construct();

        $this->userEmail = trim(getPOST("userEmail"));
        $this->userPassword = getPOST("userPassword");

    }


    private static function emailValidation($email)
    {
        return preg_match("/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+$)/", $email)
            ? true
            : false;
    }


    public function login()
    {

        if (!self::emailValidation($this->userEmail)) {
            setFlash("Incorrect Email", false);
            return;
        }

        $this->userEmail = self::escape($this->userEmail);

        $user = self::dbQuery("SELECT * FROM users WHERE email = $this->userEmail AND is_active=1 LIMIT 1");

        //Если email не найден
        if (!isset($user[0])) {
            setFlash("Wrong data", false);
            return;
        }

        $user = $user[0];

        if (password_verify(Config::get("salt") . $this->userPassword, $user["password"])) { //если пароль верный
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
        } else {
            setFlash("Wrong data", false);
            return;
        }


    }


    public function register()
    {

        if (!self::emailValidation($this->userEmail)) {
            setFlash("Incorrect Email", false);
            return;
        }

        $this->userEmail = self::escape($this->userEmail);

        //Запрос из базы на наличие аналогичного email
        $user = self::dbQuery("SELECT * FROM users WHERE email = $this->userEmail LIMIT 1");

        //Если email найден
        if (isset($user[0])) {
            setFlash("E-mail already exists", false);
            return;
        }

        $this->userPassword = password_hash(Config::get("salt") . $this->userPassword, PASSWORD_DEFAULT);

        //Регистрация пользователя. Запись в базу email, password
        $queryString = "INSERT INTO users (email, password) VALUES ("
            . $this->userEmail . ", '"
            . $this->userPassword
            . "')";

        $result = self::dbQuery($queryString);

        if (isset($result)) {
            setFlash("Successfully registered", true);
        }


    }


    public function getAllUsers()
    {
        return self::dbQuery("SELECT * FROM users ORDER BY email ASC");
    }


    public function getUsers($name)
    {
        $name = $name . "%";
        $name = self::escape($name);

        return self::dbQuery("SELECT * FROM users WHERE email LIKE $name ORDER BY email ASC");
    }


    public function delUser()
    {
        $name = isset($_GET["name"]) ? $_GET["name"] : null;

        $name = self::escape($name);

        self::dbQuery("DELETE FROM users WHERE email=$name LIMIT 1");


    }


    public function editUser()
    {
        $name = isset($_GET["name"]) ? $_GET["name"] : null;
        $password = isset($_GET["password"]) ? $_GET["password"] : null;
        $role = isset($_GET["role"]) ? $_GET["role"] : null;
        $isActive = isset($_GET["isactive"]) ? $_GET["isactive"] : null;
        $id = isset($_GET["id"]) ? $_GET["id"] : null;

        if ($password != null) {
            $password = password_hash(Config::get("salt") . $password, PASSWORD_DEFAULT);
        }

        $role = $role === "admin" ? "admin" : "user";

        $isActive = ($isActive === "true") ? 1 : 0;


        $name = self::escape($name);
        $role = self::escape($role);
        $isActive = self::escape($isActive);
        $id = self::escape($id);

        //Запрос из базы на наличие аналогичного email
        $user = self::dbQuery("SELECT * FROM users WHERE email = $name AND id <> $id LIMIT 1");

        //Если email найден
        if (isset($user[0])) {
            echo "Alert";
            exit;
        }


        $string = "UPDATE users SET email = $name, "
            . (($password != null) ? "password = '" . $password . "', " : "")
            . "role=$role, is_active=$isActive WHERE id=$id";


        self::dbQuery($string);

    }


}