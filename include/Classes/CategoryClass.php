<?php
/* Подключаем все include */
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";


/** 
 * Класс для category
 * @author eugene 
 */
class CategoryClass
{
    /**
     * Метод выстраивает массив по parent_id. Возвращает html
     */
    public function build_menu_list($tree)
    {
        global $auth;
        $html = '<ul class="tree">';

        if ($auth->isAuth()) {


            if (count($tree) === 0) {
                $html .= "<a href='#popup3' class='add_category'>Add</a>";
                return $html . '</ul>';
            }

            foreach ($tree as $item) {
                if (isset($item['children'])) {
                    $html .= "<li><details><summary><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a> <a href='#popup2' class='edit_category' data-id='{$item['id']}'>Edit</a> <a href='#popup3' class='add_category' data-id='{$item['id']}'>Add</a> <a href='#popup3' class='del' data-id='{$item['id']}'>Del</a></summary>";
                    $html .= $this->build_menu_list($item['children']);
                    $html .= "</details></li>";
                } else {
                    $html .= "<li><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a> <a href='#popup2' class='edit_category' data-id='{$item['id']}'>Edit</a> <a href='#popup3' class='add_category' data-id='{$item['id']}'>Add</a> <a href='#popup3' class='del' data-id='{$item['id']}'>Del</a></li>";
                }
            }
        } else {
            foreach ($tree as $item) {
                if (isset($item['children'])) {
                    $html .= "<li><details><summary><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a></summary>";
                    $html .= $this->build_menu_list($item['children']);
                    $html .= "</details></li>";
                } else {
                    $html .= "<li><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a></li>";
                }
            }
        }


        return $html . '</ul>';
    }


    /**
     * Метод выстраивает массив по parent_id. Возвращает html
     */
    public function build_menu_select($tree, $tab = '')
    {
        $html = '';

        foreach ($tree as $item) {
            if (isset($item['children'])) {
                $html .= "<option value='" . $item['id'] . "'>" . $tab . $item['title'] . "</option>";
                $html .= $this->build_menu_select($item['children'], ' &nbsp; ' . $tab . ' &#10147; ');
            } else {
                $html .= "<option value='" . $item['id'] . "'>" . $tab . $item['title'] . "</option>";
            }
        }

        return $html;
    }


    /**
     * Метод выстраивает массив без сортировки по parent_id. Возвращает массив
     */
    public function getTree($data)
    {
        $tree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['children'][$id] = &$node;
            }
        }
        return $tree;
    }


    /**
     * Метод удаляет элемент включая всех потомков. Принцип заложен в БД
     * @return array
     */
    public function delCategoryById()
    {
        global $mysqli;

        // Проверить, все ли поля были заполненны;
        // Сравнить пароли на совпадение;
        if (isset($_POST['popup2_id'])) {

            $popup2_id = $_POST['popup2_id'];
            $popup2_id = $mysqli->real_escape_string($popup2_id);

            $sql = "DELETE FROM `categories` WHERE `id`='" . $popup2_id . "'";
            $result = $mysqli->query($sql);

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

        return $r;
    }


    /**
     * Метод выстраивает массив в удобном для чтения виде
     */
    public function debug($data)
    {
        echo '<pre>' . print_r($data, 1) . '</pre>';
    }


    /**
     * Метод добавляет элемент
     * @return array
     */
    public function addCategory()
    {
        global $mysqli;

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
        return $r;
    }



    /**
     * Метод обновляет элемент
     * @return array
     */
    public function updateCategory()
    {
        global $mysqli;

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
        return $r;
    }



    /**
     * Метод возвращает элемент
     * @return array
     */
    public function infoCategory()
    {
        global $mysqli;

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
        $r = array(
            "rezultmes" => $rezultmes,
            "rezultstatus" => $rezultstatus
        );
        return $r;
    }
}
