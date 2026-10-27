<?php
require 'config/db.php';
$libros = $pdo->query('SELECT * FROM libros ORDER BY estatus ASC, id DESC')->fetchAll(PDO::FETCH_ASSOC);

$activos   = array_filter($libros, fn($l) => (int)$l['estatus'] === ACTIVO);
$inactivos = array_filter($libros, fn($l) => (int)$l['estatus'] === INACTIVO);

$totalTitulos    = count($activos);
$totalEjemplares = array_sum(array_column($activos, 'cantidad'));
$totalInactivos  = count($inactivos);

$titulo_pagina = 'Inventario';
include 'header.php';
?>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card p-3 d-flex flex-row align-items-center gap-3">
      <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-journals"></i></div>
      <div><div class="text-muted small">Títulos activos</div><div class="fs-4 fw-bold"><?= $totalTitulos ?></div></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3 d-flex flex-row align-items-center gap-3">
      <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-stack"></i></div>
      <div><div class="text-muted small">Ejemplares</div><div class="fs-4 fw-bold"><?= $totalEjemplares ?></div></div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3 d-flex flex-row align-items-center gap-3">
      <div class="stat-icon bg-danger-subtle text-danger"><i class="bi bi-archive"></i></div>
      <div><div class="text-muted small">Inactivos</div><div class="fs-4 fw-bold"><?= $totalInactivos ?></div></div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0 fw-semibold">Libros registrados</h5>
      <a href="create.php" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Nuevo libro</a>
    </div>

    <?php if (!$libros): ?>
      <div class="text-center text-muted py-5">
        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
        Aún no hay libros. ¡Agrega el primero!
      </div>
    <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>#</th><th>Título</th><th>Autor</th><th>Categoría</th>
            <th>Año</th><th class="text-center">Cantidad</th>
            <th class="text-center">Estado</th><th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($libros as $l):
            $inactivo = (int)$l['estatus'] === INACTIVO;
            $c = (int)$l['cantidad'];
            $badge = $c === 0 ? 'danger' : ($c <= 2 ? 'warning' : 'success');
          ?>
          <tr class="<?= $inactivo ? 'table-light text-muted' : '' ?>" <?= $inactivo ? 'style="opacity:.65"' : '' ?>>
            <td><?= $l['id'] ?></td>
            <td class="fw-semibold"><?= htmlspecialchars($l['titulo']) ?></td>
            <td><?= htmlspecialchars($l['autor']) ?></td>
            <td><span class="badge text-bg-light border"><?= htmlspecialchars($l['categoria']) ?></span></td>
            <td><?= $l['anio_publicacion'] ?></td>
            <td class="text-center"><span class="badge text-bg-<?= $badge ?>"><?= $c ?></span></td>
            <td class="text-center">
              <?php if ($inactivo): ?>
                <span class="badge text-bg-secondary">Inactivo</span>
              <?php else: ?>
                <span class="badge text-bg-success-subtle text-success-emphasis border border-success-subtle">Activo</span>
              <?php endif; ?>
            </td>
            <td class="text-end">
              <?php if ($inactivo): ?>
                <form action="restore.php" method="post" class="d-inline">
                  <input type="hidden" name="id" value="<?= $l['id'] ?>">
                  <button class="btn btn-sm btn-outline-success" title="Reactivar"><i class="bi bi-arrow-counterclockwise"></i></button>
                </form>
              <?php else: ?>
                <a href="edit.php?id=<?= $l['id'] ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <form action="delete.php" method="post" class="d-inline"
                      onsubmit="return confirm('¿Desactivar «<?= htmlspecialchars($l['titulo'], ENT_QUOTES) ?>»?')">
                  <input type="hidden" name="id" value="<?= $l['id'] ?>">
                  <button class="btn btn-sm btn-outline-danger" title="Desactivar"><i class="bi bi-trash"></i></button>
                </form>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php include 'footer.php'; ?>