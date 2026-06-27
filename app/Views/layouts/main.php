<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'CityAlert') ?> — CityAlert</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="icon" type="image/svg+xml" href="<?= url('assets/img/logo-mark.svg') ?>">
  <link href="<?= url('assets/css/app.css') ?>" rel="stylesheet">
</head>
<body>
  <?= \App\Core\View::partial('partials/nav', ['currentUser' => $currentUser ?? null]) ?>

  <main class="container py-4">
    <?php if (!empty($flashSuccess)): ?>
      <div class="alert alert-success"><i class="bi bi-check-circle me-1"></i><?= e($flashSuccess) ?></div>
    <?php endif; ?>
    <?php if (!empty($flashError)): ?>
      <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-1"></i><?= e($flashError) ?></div>
    <?php endif; ?>
    <?= $content ?>
  </main>

  <footer class="text-center text-muted small py-4">
    CityAlert — Plateforme de signalement citoyen · Projet POO PHP
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
