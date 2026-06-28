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
      <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-check-circle-fill fs-5"></i><?= e($flashSuccess) ?>
      </div>
    <?php endif; ?>
    <?php if (!empty($flashError)): ?>
      <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i><?= e($flashError) ?>
      </div>
    <?php endif; ?>
    <?= $content ?>
  </main>

  <footer class="text-center">
    <div class="container">
      <div class="d-flex align-items-center justify-content-center gap-2 mb-1">
        <img src="<?= url('assets/img/logo-mark.svg') ?>" height="22" alt="">
        <span class="fw-600" style="color:rgba(255,255,255,.75)">CityAlert</span>
      </div>
      Plateforme de signalement citoyen · Projet POO PHP
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
