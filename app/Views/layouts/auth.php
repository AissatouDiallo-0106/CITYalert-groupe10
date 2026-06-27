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
<body class="auth-wrap">
  <div class="auth-card">
    <div class="text-center mb-4">
      <img src="<?= url('assets/img/logo-mark.svg') ?>" alt="CityAlert" height="74" class="mb-2">
      <div class="brand-wordmark" style="font-size:1.7rem">City<span class="ga">Alert</span></div>
      <div class="text-muted small">Signalement citoyen</div>
    </div>
    <?= $content ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
