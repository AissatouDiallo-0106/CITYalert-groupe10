<?php $u = $currentUser ?? null; $cat = $report->getCategory(); $st = $report->getStatus(); ?>

<a href="<?= url('reports') ?>" class="back-link"><i class="bi bi-arrow-left"></i> Retour aux signalements</a>

<!-- Header du signalement -->
<div class="report-header mb-4">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
    <span class="cat-pill"><i class="bi <?= e($cat->icon()) ?>"></i><?= e($cat->label()) ?></span>
    <span class="badge <?= e($st->badge()) ?>" style="font-size:.82rem;padding:.4em .8em"><?= e($st->label()) ?></span>
  </div>
  <h3 class="mb-2"><?= e($report->getTitle()) ?></h3>
  <div style="color:rgba(255,255,255,.7);font-size:.88rem">
    <i class="bi bi-geo-alt me-1"></i><?= e($report->getAddress()) ?>
  </div>
</div>

<div class="row g-4">
  <!-- Colonne principale -->
  <div class="col-lg-8">

    <!-- Description -->
    <div class="card p-4 mb-4">
      <h6 class="section-title">Description</h6>
      <?php if ($report->getPhoto()): ?>
        <img src="<?= e($report->getPhoto()) ?>" class="img-fluid rounded mb-3" style="max-height:320px;object-fit:cover;width:100%" alt="">
      <?php endif; ?>
      <p style="white-space:pre-line;color:var(--ink);line-height:1.75"><?= e($report->getDescription()) ?></p>
      <div class="row g-2 mt-2" style="font-size:.82rem;color:var(--muted)">
        <div class="col-sm-4 d-flex align-items-center gap-1">
          <i class="bi bi-person"></i><span><strong>Auteur :</strong> <?= e($report->getAuthorName() ?? '—') ?></span>
        </div>
        <div class="col-sm-4 d-flex align-items-center gap-1">
          <i class="bi bi-flag"></i><span><strong>Priorité :</strong> <?= e($cat->priorityLabel()) ?></span>
        </div>
        <div class="col-sm-4 d-flex align-items-center gap-1">
          <i class="bi bi-calendar-check"></i><span><strong>Échéance :</strong> <?= $report->dueDate()?->format('d/m/Y') ?? '—' ?></span>
        </div>
      </div>
      <?php if ($u && ($u->getId() === $report->getAuthorId() || $u->isAdmin()) && $report->isEditable()): ?>
      <div class="d-flex gap-2 mt-3 pt-3 border-top">
        <a href="<?= url('reports/' . $report->getId() . '/edit') ?>" class="btn btn-outline-secondary btn-sm">
          <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <form method="POST" action="<?= url('reports/' . $report->getId() . '/delete') ?>" onsubmit="return confirm('Confirmer la suppression ?')">
          <?= csrf_field() ?>
          <button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash me-1"></i>Supprimer</button>
        </form>
      </div>
      <?php endif; ?>
    </div>

    <!-- Commentaires -->
    <div class="card p-4">
      <h6 class="section-title">Discussion (<?= count($comments) ?>)</h6>
      <?php if (empty($comments)): ?>
        <p class="small mb-3" style="color:var(--subtle)">Aucun commentaire pour l'instant.</p>
      <?php else: ?>
        <?php foreach ($comments as $c): ?>
        <div class="comment-item d-flex gap-3">
          <div class="comment-avatar"><?= mb_strtoupper(mb_substr($c->getAuthorName() ?? '?', 0, 1)) ?></div>
          <div>
            <div class="d-flex align-items-center gap-2 mb-1">
              <strong style="font-size:.88rem;color:var(--navy)"><?= e($c->getAuthorName() ?? '—') ?></strong>
              <span style="font-size:.76rem;color:var(--subtle)"><?= $c->getCreatedAt()?->format('d/m/Y H:i') ?></span>
            </div>
            <p class="mb-0" style="font-size:.9rem"><?= e($c->getBody()) ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <?php if ($u): ?>
      <form method="POST" action="<?= url('reports/' . $report->getId() . '/comments') ?>" class="mt-3">
        <?= csrf_field() ?>
        <div class="input-group">
          <input type="text" name="body" class="form-control" placeholder="Ajouter un commentaire…" required>
          <button class="btn btn-primary px-3"><i class="bi bi-send"></i></button>
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="col-lg-4">
    <!-- Historique -->
    <div class="card p-4 mb-4">
      <h6 class="section-title">Historique</h6>
      <div class="timeline">
        <div class="timeline-item">
          <strong>Créé</strong>
          <div class="text-muted small"><?= $report->getCreatedAt()?->format('d/m/Y H:i') ?></div>
        </div>
        <?php foreach ($history as $h): ?>
        <div class="timeline-item">
          <strong><?= e($h->getStatus()->label()) ?></strong>
          <div class="text-muted small"><?= e($h->getAgentName() ?? 'Agent') ?> · <?= $h->getCreatedAt()?->format('d/m/Y H:i') ?></div>
          <?php if ($h->getComment()): ?><div class="small mt-1"><?= e($h->getComment()) ?></div><?php endif; ?>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Action agent -->
    <?php if ($u && $u->isAgent() && $st->allowedTransitions()): ?>
    <div class="card p-4" style="border-top:3px solid var(--cyan)">
      <h6 class="section-title">Traitement (agent)</h6>
      <form method="POST" action="<?= url('reports/' . $report->getId() . '/status') ?>">
        <?= csrf_field() ?>
        <label class="form-label">Nouveau statut</label>
        <select name="status" class="form-select mb-3">
          <?php foreach ($st->allowedTransitions() as $t): ?>
            <option value="<?= $t->value ?>"><?= e($t->label()) ?></option>
          <?php endforeach; ?>
        </select>
        <label class="form-label">Remarque (facultatif)</label>
        <textarea name="comment" rows="3" class="form-control mb-3" placeholder="Informations de traitement…"></textarea>
        <button class="btn btn-primary w-100"><i class="bi bi-check2-circle me-1"></i>Mettre à jour</button>
      </form>
    </div>
    <?php endif; ?>
  </div>
</div>
