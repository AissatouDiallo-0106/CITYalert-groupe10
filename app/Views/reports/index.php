<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <h3 class="fw-bold mb-0">Signalements <span class="text-muted fs-6">(<?= (int)($total ?? 0) ?>)</span></h3>
  <?php if ($currentUser ?? null): ?><a class="btn btn-primary" href="<?= url('reports/create') ?>"><i class="bi bi-plus-lg me-1"></i>Signaler</a><?php endif; ?>
</div>

<form method="GET" action="<?= url('reports') ?>" class="card p-3 mb-4">
  <div class="row g-2">
    <div class="col-md-4">
      <select name="status" class="form-select">
        <option value="">Tous les statuts</option>
        <?php foreach (\App\Enums\ReportStatus::cases() as $st): ?>
          <option value="<?= $st->value ?>" <?= (($filters['status']??'')===$st->value)?'selected':'' ?>><?= e($st->label()) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-4">
      <select name="category" class="form-select">
        <option value="">Toutes les catégories</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= $c->code() ?>" <?= (($filters['category']??'')===$c->code())?'selected':'' ?>><?= e($c->label()) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-4 d-grid"><button class="btn btn-outline-secondary"><i class="bi bi-funnel me-1"></i>Filtrer</button></div>
  </div>
</form>

<?php if (empty($reports)): ?>
  <div class="text-center text-muted py-5"><i class="bi bi-inbox fs-1 d-block mb-2"></i>Aucun signalement.</div>
<?php else: ?>
  <div class="row g-3">
    <?php foreach ($reports as $r): $cat=$r->getCategory(); ?>
    <div class="col-md-6">
      <a href="<?= url('reports/' . $r->getId()) ?>" class="text-decoration-none text-reset">
        <div class="card report-card h-100 p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="cat-pill"><i class="bi <?= e($cat->icon()) ?>"></i><?= e($cat->label()) ?></span>
            <span class="badge <?= e($r->getStatus()->badge()) ?>"><?= e($r->getStatus()->label()) ?></span>
          </div>
          <h6 class="fw-bold mb-1"><?= e($r->getTitle()) ?></h6>
          <div class="text-muted small mb-2"><i class="bi bi-geo-alt me-1"></i><?= e($r->getAddress()) ?></div>
          <p class="small text-muted mb-0"><?= e(mb_strimwidth($r->getDescription(), 0, 90, '…')) ?></p>
          <div class="small text-muted mt-2">Par <?= e($r->getAuthorName() ?? '—') ?> · priorité <?= e($cat->priorityLabel()) ?></div>
        </div>
      </a>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if (($pages ?? 1) > 1): ?>
  <nav class="mt-4"><ul class="pagination justify-content-center">
    <?php for ($p=1; $p <= $pages; $p++): $q = array_merge($filters, ['page'=>$p]); ?>
      <li class="page-item <?= $p===$page?'active':'' ?>"><a class="page-link" href="<?= url('reports?' . http_build_query($q)) ?>"><?= $p ?></a></li>
    <?php endfor; ?>
  </ul></nav>
  <?php endif; ?>
<?php endif; ?>
