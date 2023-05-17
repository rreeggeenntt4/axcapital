<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

$r = $cat_global->infoCategory();
echo json_encode($r);
