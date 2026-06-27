<h3 class="fw-bold mb-3"><i class="bi bi-bar-chart me-1"></i>Statistiques</h3>
<div class="row g-3">
  <div class="col-md-6">
    <div class="card p-4"><h6 class="fw-bold mb-3">Par statut</h6>
      <?php foreach ($byStatus as $row): $st=\App\Enums\ReportStatus::from($row['status']); ?>
        <div class="d-flex justify-content-between py-1"><span class="badge <?= e($st->badge()) ?>"><?= e($st->label()) ?></span><strong><?= (int)$row['n'] ?></strong></div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card p-4"><h6 class="fw-bold mb-3">Par catégorie</h6>
      <?php foreach ($byCategory as $row): $c=\App\Models\Categories\CategoryFactory::make($row['category']); ?>
        <div class="d-flex justify-content-between py-1"><span><i class="bi <?= e($c->icon()) ?> me-1 text-primary"></i><?= e($c->label()) ?></span><strong><?= (int)$row['n'] ?></strong></div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-12">
    <div class="card p-4 text-center">
      <div class="text-muted">Délai moyen de résolution</div>
      <div class="display-6 fw-bold text-primary"><?= $avgDays !== null ? e((string)$avgDays) . ' j' : '—' ?></div>
    </div>
  </div>
</div>
