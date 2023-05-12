<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/lk/tokenverify.php";

// Проверить, все ли поля были заполненны;
// Сравнить пароли на совпадение;
if (isset($_POST['popup2_id'])) {

    $popup2_id = $_POST['popup2_id'];
    $popup2_id = $mysqli->real_escape_string($popup2_id);

    $result = $auth->delCategoryById($popup2_id);

    if ($result) {
        $rezultmes = "Успешное удаление";
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
