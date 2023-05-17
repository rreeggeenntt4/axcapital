<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

require_once $_SERVER['DOCUMENT_ROOT'] . "/lk/tokenverify.php";

$r = $cat_global->addCategory();
echo json_encode($r);
