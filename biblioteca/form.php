<form method="post" class="row g-3">
  <div class="col-md-8">
    <label class="form-label">Título</label>
    <input name="titulo" class="form-control" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Autor</label>
    <input name="autor" class="form-control" value="<?= htmlspecialchars($libro['autor']) ?>" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Categoría</label>
    <input name="categoria" class="form-control" value="<?= htmlspecialchars($libro['categoria']) ?>" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">Año de publicación</label>
    <input name="anio_publicacion" type="number" min="1000" max="2100" class="form-control"
           value="<?= htmlspecialchars($libro['anio_publicacion']) ?>" required>
  </div>
  <div class="col-md-3">
    <label class="form-label">Cantidad</label>
    <input name="cantidad" type="number" min="0" class="form-control"
           value="<?= htmlspecialchars($libro['cantidad']) ?>" required>
  </div>
  <div class="col-12 d-flex gap-2 justify-content-end">
    <a href="index.php" class="btn btn-light border">Cancelar</a>
    <button class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Guardar</button>
  </div>
</form>