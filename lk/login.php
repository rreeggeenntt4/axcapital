<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

/* Возвращает true и созадет сессию если логин и пароль верны, иначе вернет текст данные не верны */

if ((isset($_POST['email'])) && (isset($_POST['pass']))) {

    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    $email = $mysqli->real_escape_string($email);
    $pass = $mysqli->real_escape_string($pass);


    if ($auth->auth($email, $pass)) {
        $rezultstatus = "1";
        $rezultmes = "Успешная авторизация";
    } else {
        $rezultstatus = "0";
        $rezultmes = "Данные не верны";
    }

    /* echo $log_pass; */
} else {
    $rezultstatus = "0";
    $rezultmes = "Проверьте вводимые данные";
}

$mysqli->close();
$res = array(
    "rezultmes" => $rezultmes,
    "rezultstatus" => $rezultstatus
);
echo json_encode($res);
