<?php
/* Подключаем глобальные переменные. Подключается в самом начале, homeurl из globals */
/* require_once $_SERVER['DOCUMENT_ROOT'] . "/include/globals.php"; */
require_once $_SERVER['DOCUMENT_ROOT'] . "/include/globals.php";

/* Требует подключения в приоритете. Если подключеить после тела ответа не отработает */
require_once $homeurl . "/include/session_start.php";

/* Подключение БД идет в приоритете выше */
require_once $homeurl . "/include/bdconnect.php";

/* Подключается для первого раза создание бд */
require_once $homeurl . "/include/createbd.php";

require_once $homeurl . "/include/showerrors.php";
require_once $homeurl . "/include/functions.php";
require_once $homeurl . "/include/Classes/CategoryClass.php";



/* Чтобы не объявлять на каждой странице auth, объявляем ее. Должно следовать после всех инклудов */
/* Не объявить в globals потому что глобалс подключается выше functions */
if (!isset($auth)) {
    $auth = new AuthClass();
}


if (!isset($cat_obj)) {
    $cat_global = new CategoryClass();
}