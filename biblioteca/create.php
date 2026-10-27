<?php
require 'config/db.php';
$libro = ['titulo'=>'','autor'=>'','categoria'=>'','anio_publicacion'=>date('Y'),'cantidad'=>1];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO libros (titulo, autor, categoria, anio_publicacion, cantidad) VALUES (?, ?, ?, ?, ?)'
        );
        $stmt->execute([
            $_POST['titulo'], $_POST['autor'], $_POST['categoria'],
            $_POST['anio_publicacion'], $_POST['cantidad']
        ]);
        header('Location: index.php'); exit;
    } catch (PDOException $e) {
        $error = 'Error al guardar.';
        $libro = $_POST;
    }
}

$titulo_pagina = 'Nuevo libro';
include 'header.php';
?>
<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body p-4">
        <h5 class="fw-semibold mb-3"><i class="bi bi-plus-circle me-2"></i>Nuevo libro</h5>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <?php include 'form.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>