<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$pdo = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8mb4', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);
define('ACTIVO', 0);
define('INACTIVO', 1);