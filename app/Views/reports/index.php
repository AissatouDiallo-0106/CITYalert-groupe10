<?php $total = $total ?? 0; ?>

<!-- Hero -->
<div class="page-hero mb-4">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
    <div>
      <h3 class="mb-1"><i class="bi bi-map me-2"></i>Signalements</h3>
      <p class="text-muted mb-0">Consultez et suivez les signalements citoyens</p>
    </div>
    <?php if ($currentUser ?? null): ?>
      <a class="btn" href="<?= url('reports/create') ?>">
        <i class="bi bi-plus-circle me-1"></i>Nouveau signalement
      </a>
    <?php endif; ?>
  </div>
  <div class="d-flex gap-2 mt-3 flex-wrap">
    <span class="stat-pill"><i class="bi bi-list-check"></i><?= (int)$total ?> signalement<?= $total > 1 ? 's' : '' ?></span>
  </div>
</div>

<!-- Filtres -->
<div class="filter-card mb-4">
  <form method="GET" action="<?= url('reports') ?>">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label class="form-label">Statut</label>
        <select name="status" class="form-select">
          <option value="">Tous les statuts</option>
          <?php foreach (\App\Enums\ReportStatus::cases() as $st): ?>
            <option value="<?= $st->value ?>" <?= (($filters['status']??'')===$st->value)?'selected':'' ?>><?= e($st->label()) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label class="form-label">Catégorie</label>
        <select name="category" class="form-select">
          <option value="">Toutes les catégories</option>
          <?php foreach ($categories as $c): ?>
            <option value="<?= $c->code() ?>" <?= (($filters['category']??'')===$c->code())?'selected':'' ?>><?= e($c->label()) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary w-100"><i class="bi bi-funnel me-1"></i>Filtrer</button>
      </div>
    </div>
  </form>
</div>

<!-- Liste -->
<?php if (empty($reports)): ?>
  <div class="text-center py-5" style="color:var(--subtle)">
    <i class="bi bi-inbox" style="font-size:3.5rem;opacity:.4;display:block;margin-bottom:1rem"></i>
    <p class="fw-600 mb-1" style="color:var(--muted)">Aucun signalement trouvé</p>
    <p class="small">Essayez de modifier les filtres ou créez le premier signalement.</p>
  </div>
<?php else: ?>
  <div class="row g-3">
    <?php foreach ($reports as $r): $cat=$r->getCategory(); ?>
    <div class="col-md-6">
      <a href="<?= url('reports/' . $r->getId()) ?>" class="text-decoration-none">
        <div class="card report-card h-100 p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="cat-pill"><i class="bi <?= e($cat->icon()) ?>"></i><?= e($cat->label()) ?></span>
            <span class="badge <?= e($r->getStatus()->badge()) ?>"><?= e($r->getStatus()->label()) ?></span>
          </div>
          <h6 class="fw-bold mb-1" style="color:var(--navy)"><?= e($r->getTitle()) ?></h6>
          <div class="small mb-2" style="color:var(--muted)">
            <i class="bi bi-geo-alt me-1"></i><?= e($r->getAddress()) ?>
          </div>
          <div class="mt-auto pt-1" style="font-size:.75rem;color:var(--subtle)">
            <i class="bi bi-clock me-1"></i><?= $r->getCreatedAt()?->format('d/m/Y') ?>
          </div>
        </div>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
