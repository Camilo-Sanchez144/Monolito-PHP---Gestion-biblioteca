<?php $titulo_pagina = $titulo_pagina ?? 'Biblioteca'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($titulo_pagina) ?> | Biblioteca</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { background: #f4f6fb; }
    .navbar { background: linear-gradient(135deg, #1e3a8a, #6d28d9); }
    .card { border: 0; border-radius: 14px; box-shadow: 0 4px 18px rgba(30,58,138,.08); }
    .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: grid; place-items: center; font-size: 1.4rem; }
    .table thead th { font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; color: #6b7280; border-bottom: 2px solid #e5e7eb; }
    .table td { vertical-align: middle; }
    .btn-primary { background: #4f46e5; border-color: #4f46e5; }
    .btn-primary:hover { background: #4338ca; border-color: #4338ca; }
  </style>
</head>
<body>
<nav class="navbar navbar-dark mb-4">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="index.php">
      <i class="bi bi-book-half me-2"></i>Inventario de Biblioteca
    </a>
  </div>
</nav>
<main class="container pb-5">