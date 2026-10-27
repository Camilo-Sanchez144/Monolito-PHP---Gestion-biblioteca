<?php
require 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare('UPDATE libros SET estatus = ? WHERE id = ?');
    $stmt->execute([ACTIVO, (int)($_POST['id'] ?? 0)]);
}
header('Location: index.php'); exit;