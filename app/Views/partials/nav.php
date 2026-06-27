<?php $u = $currentUser ?? null; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= url('reports') ?>">
      <img src="<?= url('assets/img/logo-mark.svg') ?>" alt="CityAlert" height="36">
      <span class="brand-wordmark">City<span class="ga">Alert</span></span>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?= url('reports') ?>">Signalements</a></li>
        <?php if ($u): ?>
          <li class="nav-item"><a class="nav-link" href="<?= url('reports/create') ?>">Signaler</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= url('dashboard') ?>">Mon espace</a></li>
          <?php if ($u->isAdmin()): ?>
            <li class="nav-item"><a class="nav-link" href="<?= url('admin/stats') ?>">Statistiques</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>
      <ul class="navbar-nav align-items-lg-center">
        <?php if ($u): ?>
          <li class="nav-item d-flex align-items-center text-muted me-3 small">
            <i class="bi bi-person-circle me-1"></i><?= e($u->getName()) ?> · <?= e($u->getRole()->label()) ?>
          </li>
          <li class="nav-item"><a class="btn btn-outline-secondary btn-sm" href="<?= url('logout') ?>">Déconnexion</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="<?= url('login') ?>">Connexion</a></li>
          <li class="nav-item"><a class="btn btn-primary btn-sm ms-2" href="<?= url('register') ?>">S'inscrire</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
