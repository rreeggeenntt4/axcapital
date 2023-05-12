<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/head.php";

if ($auth->isAuth()) {
?>
  <script>
    document.location.href = "/index.php";
  </script>
<?php
}

$title = "Авторизация";
require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/head.php";
?>

<body id="body">

  <div class="center_block form1">
    <form name="mainform" action="lk/login.php" method="post" class="" onsubmit="return(validateauth());">

      <div class="return_info text-muted"></div>

      <h2 class="text-muted" style="text-align:center;">Авторизация</h2>

      <div class="form_row">
        <!-- <label for="userEmail" class="text-muted">Email</label> -->
        <input type="email" class="form-control email_user" id="userEmail" name="userEmail" placeholder="name@example.com" required oninput="validateauth();">
      </div>
      <div class="form_row">
        <!-- <label for="Password" class="text-muted">Password</label> -->
        <input type="password" class="form-control pass_user" id="Password" name="Password" placeholder="Password" minlength="6" required oninput="validateauth();">
      </div>

      <div class="text-center" style="margin-top: 2rem;margin-bottom:1rem;">
        <!-- <button class="btnform1" onclick="clearFildsauth();">Очистить</button> -->
        <button class="btnform1 avtorize" type="submit">Войти</button>
      </div>

      <small class="text-muted">Все еще не зарегистрированы? <a href="/registration.php">Зарегистрироваться</a></small>

    </form>
  </div>

  <!-- identificator -->
  <div class="auth_id"></div>

  <?php
  require_once $_SERVER['DOCUMENT_ROOT'] . "/layouts/footerjs.php";
  ?>

</body>

</html>