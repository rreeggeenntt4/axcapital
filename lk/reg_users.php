<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/lk/tokenverify.php";

// Проверить, все ли поля были заполненны;
// Сравнить пароли на совпадение;
if ((isset($_POST['userName'])) && (isset($_POST['userEmail'])) && (isset($_POST['Password'])) && (isset($_POST['RePassword'])) && ($_POST['Password'] == $_POST['RePassword'])) {

    $salt = $auth->generateRandomString();

    $userName = $_POST['userName'];
    $userName = $mysqli->real_escape_string($userName);

    $userEmail = $_POST['userEmail'];
    $userEmail = $mysqli->real_escape_string($userEmail);

    $Password = $_POST['Password'];
    $Password = $mysqli->real_escape_string($Password);
    $passhash = sha1(sha1($Password . $salt));

    $RePassword = $_POST['RePassword'];
    $RePassword = $mysqli->real_escape_string($RePassword);


    // Текущее время
    $now = new DateTime();
    $nowdatetime = $now->format('Y-m-d H:i:s');



    // Сделать sql запрос к таблице users, и проверить есть ли строка с таким email;
    $sql = "SELECT * FROM `users` WHERE `email`='" . $userEmail . "'";
    $strline = $mysqli->query($sql);
    $firstline = $strline->fetch_assoc();

    if (isset($firstline)) {
        $rezultstatus = 0;
        $rezultmes = "Пользователь с таким email уже есть в базе.";
    } else {
        // Сделать sql запрос к таблице users и создать новго пользователя в таблице.
        $sql = "INSERT INTO `users` (`first_name`,`email`,`pass`,`salt`,`created_at`) VALUES ('" . $userName . "','" . $userEmail . "','" . $passhash . "','" . $salt . "','" . $nowdatetime . "')";
        $result = $mysqli->query($sql);

        if ($result) {
            $rezultmes = "Пользователь был добавлен.";
            $rezultstatus = 1;
        } else {
            $rezultmes = "Ошибка БД";
            $rezultstatus = 0;
        }
    }
} else {
    $rezultmes = "Не пройдена проверка";
    $rezultstatus = 0;
}

$mysqli->close();
$r = array(
    "rezultmes" => $rezultmes,
    "rezultstatus" => $rezultstatus
);
echo json_encode($r);
