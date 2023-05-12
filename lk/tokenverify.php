<?php
/* Проверка токена csrf */
if (isset($_POST["token"])) {
    if ($_POST["token"] !== $_SESSION["token"]) {
        $auth->out();
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }
} else {
    $auth->out();
    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    exit;
}
