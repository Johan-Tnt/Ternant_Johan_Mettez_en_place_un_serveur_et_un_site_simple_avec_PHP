<?php

function connexion()
{
    return new PDO(
        "mysql:host=localhost;dbname=artbox;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
}