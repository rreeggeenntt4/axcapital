<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

$title = "Главная";
require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/head.php";
?>

<body id="body">
  <!-- Строка пользователь | авторизация | регистрация -->
  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/header.php";
  ?>

  <!-- Контент -->
  <div class="center_block form2">
    <?php
    $sql = "SELECT * FROM categories";
    $arr = $mysqli->query($sql);

    $all = array();
    while ($rez = $arr->fetch_assoc()) {
      $all[$rez['id']] = $rez;
    }

    $tree = $auth->getTree($all);

    /* $auth->debug($tree); */

    echo $auth->build_menu_list($tree);
    ?>

  </div>


  <!-- popup1 -->
  <div id="popup1" class="overlay">
    <div class="popup">
      <h2 class="popup1_title"></h2>
      <a class="close" href="#">&times;</a>
      <div class="content popup1_descr">

      </div>
    </div>
  </div>
  <!-- /popup1 -->


  <!-- popup2 -->
  <div id="popup2" class="overlay">
    <div class="popup popup2">
      <a class="close" href="#">&times;</a>

      <div class="center_block form3">
        <form name="mainform" action="/lk/cat_update.php" method="post" class="" onsubmit="return(validatepopup2());">

          <input type="hidden" name="token" id="token2" value="<?php echo $auth->csrf(30); ?>">

          <div class="return_info2 text-muted"></div>

          <h3 class="text-muted" style="text-align:center;">Редактирование</h3>

          <div class="form_row">
            <input type="hidden" class="form-control popup2_id" id="popup2_id" name="popup2_id" placeholder="id" required oninput="validatepopup2();">
          </div>

          <div class="form_row">
            <input type="text" class="form-control popup2_title" id="popup2_title" name="popup2_title" placeholder="Наименование" required oninput="validatepopup2();">
          </div>
          <div class="form_row">
            <textarea class="form-control popup2_descr" name="popup2_descr" id="popup2_descr" cols="30" rows="10" placeholder="Описание" required oninput="validatepopup2();"></textarea>
          </div>

          <div class="form-row">
            <select class="popup2_parent_id" id="popup2_parent_id">
              <option value="0">Верхний уровень</option><?php echo $auth->build_menu_select($tree); ?>
            </select>
          </div>


          <div class="text-center" style="margin-top: 2rem;margin-bottom:1rem;">
            <button class="btnform1 update" type="submit">Обновить</button>
            <button class="btnform2 del" type="submit">Удалить включая вложения</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- /popup2 -->


  <!-- popup3 -->
  <div id="popup3" class="overlay">
    <div class="popup popup3">
      <a class="close" href="#">&times;</a>

      <div class="center_block form3">
        <form name="mainform" action="/lk/add_category.php" method="post" class="" onsubmit="return(validatepopup3());">

          <input type="hidden" name="token" id="token3" value="<?php echo $auth->csrf(30); ?>">

          <div class="return_info3 text-muted"></div>

          <h3 class="text-muted" style="text-align:center;">Добавление</h3>

          <div class="form_row">
            <input type="text" class="form-control popup3_title" id="popup3_title" name="popup3_title" placeholder="Наименование" required oninput="validatepopup3();">
          </div>
          <div class="form_row">
            <textarea class="form-control popup3_descr" name="popup3_descr" id="popup3_descr" cols="30" rows="10" placeholder="Описание" required oninput="validatepopup3();"></textarea>
          </div>

          <div class="form-row">
            <select class="popup3_parent_id" id="popup3_parent_id">
              <option value="0">Верхний уровень</option><?php echo $auth->build_menu_select($tree); ?>
            </select>
          </div>


          <div class="text-center" style="margin-top: 2rem;margin-bottom:1rem;">
            <button class="btnform1 add" type="submit">Добавить</button>
          </div>

        </form>
      </div>
    </div>
  </div>
  <!-- /popup3 -->




  <!-- identificator -->
  <div class="index_id"></div>

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/footerjs.php";
  ?>

</body>

</html>