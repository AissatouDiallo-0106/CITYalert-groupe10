<h3 class="fw-bold mb-3">Mon espace</h3>
<p class="text-muted">Bonjour <?= e($currentUser->getName()) ?> — rôle : <strong><?= e($currentUser->getRole()->label()) ?></strong>.</p>

<h6 class="fw-bold mt-4 mb-2"><?= $currentUser->isAdmin()||$currentUser->isAgent() ? 'Derniers signalements' : 'Mes signalements' ?></h6>
<?php if (empty($reports)): ?>
  <div class="text-muted">Aucun signalement.</div>
<?php else: ?>
  <div class="list-group">
    <?php foreach ($reports as $r): ?>
    <a href="<?= url('reports/' . $r->getId()) ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
      <span><i class="bi <?= e($r->getCategory()->icon()) ?> me-2 text-primary"></i><?= e($r->getTitle()) ?></span>
      <span class="badge <?= e($r->getStatus()->badge()) ?>"><?= e($r->getStatus()->label()) ?></span>
    </a>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
