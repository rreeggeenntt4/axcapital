<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

if ($auth->isAuth()) {
    if (isset($_GET["is_exit"])) { //Если нажата кнопка выхода
        if ($_GET["is_exit"] == 1) {
            $auth->out(); //Выходим
            //Редирект после выхода
?>
            <script>
                document.location.href = "/";
            </script>
<?php
        }
    }
}
?>