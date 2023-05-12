<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";



if (isset($_POST['id'])) {

    $id = trim($_POST['id']);
    $id = $mysqli->real_escape_string($id);

    $sql = "SELECT * FROM categories where id='" . $id . "'";
    $strline = $mysqli->query($sql);
    $firstline = $strline->fetch_assoc();

    if (isset($firstline)) {
        $rezultmes = "Успешно.";
        $rezultstatus = 1;
        $title = $firstline["title"];
        $descr = $firstline["descr"];
        $parent_id = (!empty($firstline["parent_id"]) ? $firstline["parent_id"] : 0);

        $mysqli->close();
        $res = array(
            "rezultmes" => $rezultmes,
            "rezultstatus" => $rezultstatus,
            "title" => $title,
            "descr" => $descr,
            "parent_id" => $parent_id
        );
        echo json_encode($res);
        exit;
    } else {
        $rezultmes = "Ошибка БД";
        $rezultstatus = 0;
    }
} else {
    $rezultstatus = "0";
    $rezultmes = "Данные не переданы";
}

$mysqli->close();
$res = array(
    "rezultmes" => $rezultmes,
    "rezultstatus" => $rezultstatus
);
echo json_encode($res);
