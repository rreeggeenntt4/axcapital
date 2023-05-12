<?php
/* Подключаем все include */
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";


/** 
 * Класс для авторизации
 * @author eugene 
 */
class AuthClass
{

    /**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth()
    {
        if (isset($_SESSION["is_auth"])) { //Если сессия существует
            return $_SESSION["is_auth"]; //Возвращаем значение переменной сессии is_auth (хранит true если авторизован, false если не авторизован)
        } else return false; //Пользователь не авторизован, т.к. переменная is_auth не создана
    }

    /**
     * Авторизация пользователя
     * @param string $login
     * @param string $passwors 
     * возврат true/false
     */
    public function auth($email, $password)
    {
        global $mysqli;

        $sql = "SELECT * FROM `users` WHERE `email`='" . $email . "'";
        $strline = $mysqli->query($sql);
        $firstline = $strline->fetch_assoc();
        if (isset($firstline)) {
            $salt = $firstline['salt'];

            if ($firstline['pass'] == sha1(sha1($password . $salt))) {
                //Если логин и пароль введены правильно
                $_SESSION["is_auth"] = true; //Делаем пользователя авторизованным
                $_SESSION["login"] = $firstline['email']; //Записываем в сессию логин пользователя
                /*  $_SESSION['ur_dost'] = $firstline['ur_dost']; */ //Записываем уровень доступа пользователя в сессию
                $_SESSION['firstname'] = $firstline['first_name'];
                $_SESSION['user_id'] = $firstline['id'];
                $_SESSION['created_at'] = $firstline['created_at'];
                return true;
            } else {
                //Логин и пароль не подошел
                $_SESSION["is_auth"] = false;
                /* echo "Пароль не верен"; */
                return false;
            }
        }
        $_SESSION["is_auth"] = false;
        return false;
    }


    /**
     * Регистрация пользователя
     * @param string $first_name
     * @param string $email
     * @param string $passwors 
     * @param int    $ur_dost 
     * 
     * возврат true/false
     */
    // public function reg($firstname, $email, $password)
    // {
    //     global $mysqli;

    //     /* Текущее время */
    //     $dt = new DateTime();
    //     $created_at = $dt->format('Y-m-d H:i:s');


    //     $password = md5($password);

    //     /* Проверка на существование в базе уже такого логина */
    //     $sql = "SELECT * FROM `users` where `email`='" . $email . "'";
    //     $strline = $mysqli->query($sql);
    //     $firstline = $strline->fetch_assoc();

    //     /* Если такого логина в базе не существует, добавляем пользователя */
    //     if (empty($firstline)) {
    //         /* Если такой токен в базе не существует добавляем в базу данных */
    //         $sql2 = "INSERT INTO `users` (`email`,`pass`,`firstname`,`ur_dost`,`created_at`) VALUES ('" . $email . "','" . $password . "','" . $firstname . "','1','" . $created_at . "')";
    //         $result = $mysqli->query($sql2);
    //         if ($result) {
    //             return true;
    //         } else {
    //             return false;
    //         }
    //     } else {
    //         return false;
    //     }
    // }


    /**
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin()
    {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }


    /**
     * Метод возвращает id авторизованного пользователя 
     */
    public function getUserId()
    {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["user_id"]; //Возвращаем id пользователя которые записаны в сессию 
        }
    }

    /**
     * Метод возвращает уровень доступа переданного id пользователя
     * Возвращает по данным текущего пользователя если $id не передан
     * в базе данных предусмотрено
     * 10 - администратор
     * 1  - пользователь
     */
    public function getUserUrDost($id = null)
    {
        global $mysqli;
        if ($this->isAuth()) { //Если пользователь авторизован
            /* Если аргумент был передан */
            if (!empty($id)) {
                $sql = "SELECT * FROM `users` where `id`='" . $id . "'";
                $strline = $mysqli->query($sql);
                $firstline = $strline->fetch_assoc();

                /* Если такой user существует */
                if (isset($firstline)) {
                    return $firstline['ur_dost'];
                }
            } else {
                return $_SESSION["ur_dost"]; //Возвращаем ur_dost пользователя которые записаны в сессию 
            }
        }
    }



    /**
     * Метод удаляет сессию
     */
    public function out()
    {
        /* Если сущестувет сессия */
        if (session_status() === PHP_SESSION_ACTIVE) {
            $_SESSION = array(); //Очищаем сессию
            session_unset();
            session_destroy(); //Уничтожаем
        }
    }


    /**
     * Метод возвращает created_at авторизованного пользователя 
     */
    public function getСreatedat()
    {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["created_at"]; //Возвращаем created_at, который записан в сессию
        }
    }

    /**
     * Метод возвращает случайную строку 
     */
    function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Метод устанавливает csrf, возвращает true или false
     */
    function csrf($length)
    {
        if (!isset($_SESSION["token"])) {
            $token = $this->generateRandomString($length);
            $_SESSION["token"] = $token;
        } else {
            $token = $_SESSION["token"];
        }

        return $token;
    }


    /**
     * Метод выстраивает массив по parent_id. Возвращает html
     */
    public function build_menu_list($tree)
    {
        $html = '<ul class="tree">';

        if ($this->isAuth()) {


            if (count($tree) === 0) {
                $html .= "<a href='#popup3' class='add_category'>Add</a>";
                return $html . '</ul>';
            }

            foreach ($tree as $item) {
                if (isset($item['children'])) {
                    $html .= "<li><details><summary><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a> <a href='#popup2' class='edit_category' data-id='{$item['id']}'>Edit</a> <a href='#popup3' class='add_category' data-id='{$item['id']}'>Add</a></summary>";
                    $html .= $this->build_menu_list($item['children']);
                    $html .= "</details></li>";
                } else {
                    $html .= "<li><span class='id_cat'>{$item['id']}</span> {$item['title']} <a href='#popup1' class='info_category button' data-id='{$item['id']}'>Info</a> <a href='#popup2' class='edit_category' data-id='{$item['id']}'>Edit</a> <a href='#popup3' class='add_category' data-id='{$item['id']}'>Add</a></li>";
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
     * Метод удаляет элемент включая всех потомков
     */
    public function delCategoryById($id)
    {
        global $mysqli;

        $sql2 = "DELETE FROM `categories` WHERE `id`='" . $id . "'";
        $result2 = $mysqli->query($sql2);

        if ($result2) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Метод выстраивает массив в удобном для чтения виде
     */
    function debug($data)
    {
        echo '<pre>' . print_r($data, 1) . '</pre>';
    }
}
