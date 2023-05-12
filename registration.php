<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

$title = "Регистрация";
require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/head.php";
?>

<body id="body">

  <div class="center_block form1">
    <form name="mainform" action="/lk/reg_users.php" method="post" class="" onsubmit="return(validate());">

      <input type="hidden" name="token" id="token" value="<?php echo $auth->csrf(30); ?>">

      <div class="return_info text-muted"></div>

      <h2 class="text-muted" style="text-align:center;">Регистрация</h2>

      <div class="form_row">
        <!-- <label for="userName" class="text-muted">Имя</label> -->
        <input type="text" class="form-control" id="userName" name="userName" placeholder="Имя" required oninput="validate();">
      </div>
      <div class="form_row">
        <!-- <label for="userEmail" class="text-muted">Email</label> -->
        <input type="email" class="form-control email_user" id="userEmail" name="userEmail" placeholder="name@example.com" required oninput="validate();">
      </div>
      <div class="form_row">
        <!-- <label for="Password" class="text-muted">Password</label> -->
        <input type="password" class="form-control pass_user" id="Password" name="Password" placeholder="Password" minlength="6" required oninput="validate();">
      </div>
      <div class="form_row">
        <!-- <label for="RePassword" class="text-muted">RePassword</label> -->
        <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="RePassword" minlength="6" required oninput="validate();">
      </div>

      <div class="text-center" style="margin-top: 2rem;margin-bottom:1rem;">
        <button class="btnform1" onclick="clearFilds();">Очистить</button>
        <button class="btnform1 reg" type="submit">Отправить</button>
        <!-- <button class="btnform1" type="submit">Отправить</button> -->
      </div>

      <hr class="">
      <small class="text-muted">Нажимая Отправить, вы соглашаетесь с условиями использования.<br> Уже зарегистрированы? <a href="/auth.php">Войти</a></small>
    </form>
  </div>

  <!-- identificator -->
  <div class="registration_id"></div>

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/footerjs.php";
  ?>

</body>

</html>