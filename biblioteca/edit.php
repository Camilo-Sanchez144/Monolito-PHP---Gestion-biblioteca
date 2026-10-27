<?php
require 'config/db.php';
$id = (int)($_GET['id'] ?? 0);
$error = '';

$stmt = $pdo->prepare('SELECT * FROM libros WHERE id = ?');
$stmt->execute([$id]);
$libro = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$libro) { http_response_code(404); exit('Libro no encontrado'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare(
            'UPDATE libros SET titulo=?, autor=?, categoria=?, anio_publicacion=?, cantidad=? WHERE id=?'
        );
        $stmt->execute([
            $_POST['titulo'], $_POST['autor'], $_POST['categoria'],
            $_POST['anio_publicacion'], $_POST['cantidad'], $id
        ]);
        header('Location: index.php'); exit;
    } catch (PDOException $e) {
        $error = 'Error al actualizar.';
        $libro = array_merge($libro, $_POST);
    }
}

$titulo_pagina = 'Editar libro';
include 'header.php';
?>
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body p-4">
        <h5 class="fw-semibold mb-3"><i class="bi bi-pencil-square me-2"></i>Editar libro</h5>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php include 'form.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>