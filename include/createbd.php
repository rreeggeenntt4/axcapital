<?php

/* Создаем базу если не сущствует */
mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS users (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    first_name char(255) DEFAULT NULL,
    email char(255) NOT NULL unique,
    pass char(255) NOT NULL,
    salt char(255) NOT NULL,
    created_at char(255) DEFAULT NULL,
    PRIMARY KEY (id)
)");


mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS categories (
    id INT NOT NULL AUTO_INCREMENT,
    title TEXT NOT NULL,
    descr TEXT NULL,
    parent_id INT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE = InnoDB");

