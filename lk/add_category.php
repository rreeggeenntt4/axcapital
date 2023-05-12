<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/lk/tokenverify.php";

// Проверить, все ли поля были заполненны;
// Сравнить пароли на совпадение;
if ((isset($_POST['popup3_title'])) && (isset($_POST['popup3_descr'])) && (isset($_POST['popup3_parent_id']))) {


    $popup3_title = $_POST['popup3_title'];
    $popup3_title = $mysqli->real_escape_string($popup3_title);

    $popup3_descr = $_POST['popup3_descr'];
    $popup3_descr = $mysqli->real_escape_string($popup3_descr);

    $popup3_parent_id = $_POST['popup3_parent_id'];
    $popup3_parent_id = $mysqli->real_escape_string($popup3_parent_id);


    /* Корневая директория = 0 из js, значит устанавливаем в бд NULL */
    if ($popup3_parent_id == 0) {
        $sql2 = "INSERT INTO `categories` (`title`,`descr`,`parent_id`) VALUES ('" . $popup3_title . "','" . $popup3_descr . "',NULL)";
    } else {
        $sql2 = "INSERT INTO `categories` (`title`,`descr`,`parent_id`) VALUES ('" . $popup3_title . "','" . $popup3_descr . "','" . $popup3_parent_id . "')";
    }
    $result = $mysqli->query($sql2);


    if ($result) {
        $rezultmes = "Успешное добавление";
        $rezultstatus = 1;
    } else {
        $rezultmes = "Ошибка БД";
        $rezultstatus = 0;
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
