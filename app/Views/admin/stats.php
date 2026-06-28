<!-- Hero admin -->
<div class="page-hero mb-4">
  <h3 class="mb-1"><i class="bi bi-bar-chart-line me-2"></i>Tableau de bord admin</h3>
  <p class="text-muted mb-0">Vue d'ensemble des signalements et performances</p>
</div>

<div class="row g-4">
  <!-- Par statut -->
  <div class="col-md-6">
    <div class="card p-4 h-100">
      <h6 class="section-title">Répartition par statut</h6>
      <?php
        $totalN = array_sum(array_column($byStatus, 'n'));
      ?>
      <?php foreach ($byStatus as $row):
        $st = \App\Enums\ReportStatus::from($row['status']);
        $pct = $totalN ? round($row['n'] / $totalN * 100) : 0;
      ?>
      <div class="admin-stat-row">
        <span class="badge <?= e($st->badge()) ?>" style="min-width:90px;text-align:center"><?= e($st->label()) ?></span>
        <div class="stat-bar-wrap">
          <div class="stat-bar" style="width:<?= $pct ?>%"></div>
        </div>
        <strong style="min-width:2rem;text-align:right;color:var(--navy)"><?= (int)$row['n'] ?></strong>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Par catégorie -->
  <div class="col-md-6">
    <div class="card p-4 h-100">
      <h6 class="section-title">Répartition par catégorie</h6>
      <?php
        $totalC = array_sum(array_column($byCategory, 'n'));
      ?>
      <?php foreach ($byCategory as $row):
        $c = \App\Models\Categories\CategoryFactory::make($row['category']);
        $pct = $totalC ? round($row['n'] / $totalC * 100) : 0;
      ?>
      <div class="admin-stat-row">
        <span style="min-width:110px;font-size:.85rem;font-weight:600;color:var(--navy)">
          <i class="bi <?= e($c->icon()) ?> me-1" style="color:var(--cyan)"></i><?= e($c->label()) ?>
        </span>
        <div class="stat-bar-wrap">
          <div class="stat-bar" style="width:<?= $pct ?>%;background:linear-gradient(90deg,var(--green),var(--cyan))"></div>
        </div>
        <strong style="min-width:2rem;text-align:right;color:var(--navy)"><?= (int)$row['n'] ?></strong>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Délai moyen -->
  <div class="col-12">
    <div class="card p-4 text-center">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div style="color:var(--muted);font-size:.9rem;font-weight:600;margin-bottom:.5rem">
            <i class="bi bi-stopwatch me-1"></i>Délai moyen de résolution
          </div>
          <div class="big-metric"><?= $avgDays !== null ? e((string)$avgDays) . ' j' : '—' ?></div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0" style="text-align:left">
          <p class="small mb-2" style="color:var(--muted)">Total des signalements traités :</p>
          <div class="d-flex align-items-center gap-3">
            <?php $totalAll = array_sum(array_column($byStatus, 'n')); ?>
            <div>
              <div style="font-size:1.5rem;font-weight:800;color:var(--navy)"><?= $totalAll ?></div>
              <div style="font-size:.78rem;color:var(--muted)">signalements</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
