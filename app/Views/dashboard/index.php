<!-- Welcome banner -->
<div class="dashboard-welcome">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
      <h3 class="mb-1"><i class="bi bi-person-circle me-2"></i>Bonjour, <?= e($currentUser->getName()) ?> 👋</h3>
      <p>Bienvenue dans votre espace personnel CityAlert</p>
      <span class="role-badge"><i class="bi bi-shield-check"></i><?= e($currentUser->getRole()->label()) ?></span>
    </div>
    <a href="<?= url('reports/create') ?>" class="btn btn-primary align-self-start">
      <i class="bi bi-plus-circle me-1"></i>Signaler
    </a>
  </div>
</div>

<!-- Stats rapides -->
<?php $total = count($reports); $resolved = array_filter($reports, fn($r)=>$r->getStatus()->value==='RESOLU'); ?>
<div class="row g-3 mb-4">
  <div class="col-6 col-md-4">
    <div class="stat-card">
      <div class="stat-icon cyan"><i class="bi bi-list-check"></i></div>
      <div class="stat-value"><?= $total ?></div>
      <div class="stat-label"><?= $currentUser->isAdmin()||$currentUser->isAgent() ? 'Signalements total' : 'Mes signalements' ?></div>
    </div>
  </div>
  <div class="col-6 col-md-4">
    <div class="stat-card">
      <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
      <div class="stat-value"><?= count($resolved) ?></div>
      <div class="stat-label">Résolus</div>
    </div>
  </div>
  <div class="col-12 col-md-4">
    <div class="stat-card">
      <div class="stat-icon navy"><i class="bi bi-hourglass-split"></i></div>
      <div class="stat-value"><?= $total - count($resolved) ?></div>
      <div class="stat-label">En traitement</div>
    </div>
  </div>
</div>

<!-- Liste signalements -->
<div class="card p-4">
  <h6 class="section-title"><?= $currentUser->isAdmin()||$currentUser->isAgent() ? 'Derniers signalements' : 'Mes signalements' ?></h6>
  <?php if (empty($reports)): ?>
    <div class="text-center py-4" style="color:var(--subtle)">
      <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:.75rem;opacity:.4"></i>
      <p class="small mb-0">Aucun signalement pour le moment.</p>
    </div>
  <?php else: ?>
    <div class="list-group">
      <?php foreach ($reports as $r): ?>
      <a href="<?= url('reports/' . $r->getId()) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center gap-2">
        <span class="d-flex align-items-center gap-2">
          <i class="bi <?= e($r->getCategory()->icon()) ?>" style="color:var(--cyan);font-size:1.05rem"></i>
          <span><?= e($r->getTitle()) ?></span>
        </span>
        <span class="badge <?= e($r->getStatus()->badge()) ?> flex-shrink-0"><?= e($r->getStatus()->label()) ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
