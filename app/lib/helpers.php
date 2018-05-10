<?php
/**
 * @param $name - наименование переменной
 * @return string
 * выборка переменной $string из массива _SESSION
 */
function getSESSION($name)
{
    return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}


function getPOST($name)
{
    return isset($_POST[$name])
        ? $_POST[$name]
        : null;
}


function setFlash($message, $status)
{
    $_SESSION["flash"] = $message;
    $_SESSION["status"] = $status; //true - сообщение Ok, false - сообщение Warning
    $_SESSION["setFlash"] = true;

}


function getFlash()
{
    if (isset($_SESSION["flash"])) {
        $status = $_SESSION["status"] ? "flash Ok" : "flash Alert";
        return "<div class='" . $status . "'>" . $_SESSION["flash"] . "</div>";
    } else {
        return "";
    }

}

function clearFlash()
{

    if (isset($_SESSION["flash"]) && $_SESSION["setFlash"] == false) {
        unset ($_SESSION["flash"]);
        unset ($_SESSION["status"]);
    }

    if (isset($_SESSION["setFlash"]) && $_SESSION["setFlash"] == true) {
        $_SESSION["setFlash"] = false;
    } else {
        unset($_SESSION["setFlash"]);
    }


}