<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/lk/tokenverify.php";

// Проверить, все ли поля были заполненны;
// Сравнить пароли на совпадение;
if ((isset($_POST['popup2_id'])) && (isset($_POST['popup2_title'])) && (isset($_POST['popup2_descr'])) && (isset($_POST['popup2_parent_id']))) {


    $popup2_id = $_POST['popup2_id'];
    $popup2_id = $mysqli->real_escape_string($popup2_id);

    $popup2_title = $_POST['popup2_title'];
    $popup2_title = $mysqli->real_escape_string($popup2_title);

    $popup2_descr = $_POST['popup2_descr'];
    $popup2_descr = $mysqli->real_escape_string($popup2_descr);

    $popup2_parent_id = $_POST['popup2_parent_id'];
    $popup2_parent_id = $mysqli->real_escape_string($popup2_parent_id);


    /* Корневая директория = 0 из js, значит устанавливаем в бд NULL */
    if ($popup2_parent_id == 0) {
        $sql2 = "UPDATE `categories` SET `title`='" . $popup2_title . "',`descr`='" . $popup2_descr . "',`parent_id`=NULL  WHERE `id`='" . $popup2_id . "'";
    } else {
        $sql2 = "UPDATE `categories` SET `title`='" . $popup2_title . "',`descr`='" . $popup2_descr . "',`parent_id`='" . $popup2_parent_id . "' WHERE `id`='" . $popup2_id . "'";
    }
    $result = $mysqli->query($sql2);


    if ($result) {
        $rezultmes = "Успешное обновление";
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
