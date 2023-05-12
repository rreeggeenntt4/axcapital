<?php
if ($auth->isAuth()) {
?>
    <section>
        <div class="lktop authinfo text-muted" style="display:flex;">
            <div class="" style="text-align:center;"><?php echo $auth->getLogin(); ?> <span> | </span>
                <a href="/lk/exit.php?is_exit=1">Выход</a>
            </div>
        </div>
    </section>

<?php
} else {
?>
    <section>
        <div class="lktop authinfo text-muted">
            <a href="/auth.php">Авторизация</a> <span> | </span>
            <a href="/registration.php">Регистрация</a>
        </div>
    </section>
<?php
}
?>