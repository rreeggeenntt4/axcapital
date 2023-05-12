<?php
/* Чтобы не добавлять на каждой странице, добавляем в head */
if (!isset($_SESSION)) {
    session_start();
}
