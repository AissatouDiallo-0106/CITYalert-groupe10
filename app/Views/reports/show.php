<?php $u = $currentUser ?? null; $cat = $report->getCategory(); $st = $report->getStatus(); ?>
<a href="<?= url('reports') ?>" class="text-decoration-none small"><i class="bi bi-arrow-left"></i> Retour</a>

<div class="row g-4 mt-1">
  <div class="col-lg-8">
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-start mb-2">
        <span class="cat-pill"><i class="bi <?= e($cat->icon()) ?>"></i><?= e($cat->label()) ?></span>
        <span class="badge <?= e($st->badge()) ?>"><?= e($st->label()) ?></span>
      </div>
      <h3 class="fw-bold"><?= e($report->getTitle()) ?></h3>
      <div class="text-muted mb-3"><i class="bi bi-geo-alt me-1"></i><?= e($report->getAddress()) ?></div>
      <?php if ($report->getPhoto()): ?><img src="<?= e($report->getPhoto()) ?>" class="img-fluid rounded mb-3" alt=""><?php endif; ?>
      <p style="white-space:pre-line"><?= e($report->getDescription()) ?></p>
      <hr>
      <div class="row text-muted small">
        <div class="col"><strong>Auteur :</strong> <?= e($report->getAuthorName() ?? '—') ?></div>
        <div class="col"><strong>Priorité :</strong> <?= e($cat->priorityLabel()) ?></div>
        <div class="col"><strong>Échéance :</strong> <?= $report->dueDate()?->format('d/m/Y') ?? '—' ?></div>
      </div>

      <?php if ($u && ($u->getId() === $report->getAuthorId() || $u->isAdmin()) && $report->isEditable()): ?>
      <div class="mt-3 d-flex gap-2">
        <a href="<?= url('reports/' . $report->getId() . '/edit') ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-pencil"></i> Modifier</a>
        <form method="POST" action="<?= url('reports/' . $report->getId() . '/delete') ?>" onsubmit="return confirm('Supprimer ?')">
          <?= csrf_field() ?><button class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> Supprimer</button>
        </form>
      </div>
      <?php endif; ?>
    </div>

    <!-- Commentaires -->
    <div class="card p-4 mt-3">
      <h6 class="fw-bold mb-3"><i class="bi bi-chat-dots me-1"></i>Discussion</h6>
      <?php foreach ($comments as $c): ?>
        <div class="mb-2 pb-2 border-bottom">
          <strong class="small"><?= e($c->getAuthorName() ?? '—') ?></strong>
          <span class="text-muted small">· <?= $c->getCreatedAt()?->format('d/m/Y H:i') ?></span>
          <div><?= e($c->getBody()) ?></div>
        </div>
      <?php endforeach; ?>
      <?php if (empty($comments)): ?><div class="text-muted small mb-2">Aucun commentaire.</div><?php endif; ?>
      <?php if ($u): ?>
      <form method="POST" action="<?= url('reports/' . $report->getId() . '/comments') ?>" class="mt-2">
        <?= csrf_field() ?>
        <div class="input-group">
          <input type="text" name="body" class="form-control" placeholder="Votre message…" required>
          <button class="btn btn-primary">Envoyer</button>
        </div>
      </form>
      <?php endif; ?>
    </div>
  </div>

  <div class="col-lg-4">
    <!-- Cycle de vie -->
    <div class="card p-4">
      <h6 class="fw-bold mb-3"><i class="bi bi-clock-history me-1"></i>Historique</h6>
      <div class="timeline">
        <div class="timeline-item"><strong>Créé</strong><div class="text-muted small"><?= $report->getCreatedAt()?->format('d/m/Y H:i') ?></div></div>
        <?php foreach ($history as $h): ?>
          <div class="timeline-item">
            <strong><?= e($h->getStatus()->label()) ?></strong>
            <div class="text-muted small"><?= e($h->getAgentName() ?? 'Agent') ?> · <?= $h->getCreatedAt()?->format('d/m/Y H:i') ?></div>
            <?php if ($h->getComment()): ?><div class="small"><?= e($h->getComment()) ?></div><?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Action agent : changer le statut -->
    <?php if ($u && $u->isAgent() && $st->allowedTransitions()): ?>
    <div class="card p-4 mt-3">
      <h6 class="fw-bold mb-3"><i class="bi bi-gear me-1"></i>Traitement (agent)</h6>
      <form method="POST" action="<?= url('reports/' . $report->getId() . '/status') ?>">
        <?= csrf_field() ?>
        <select name="status" class="form-select mb-2">
          <?php foreach ($st->allowedTransitions() as $t): ?>
            <option value="<?= $t->value ?>"><?= e($t->label()) ?></option>
          <?php endforeach; ?>
        </select>
        <textarea name="comment" rows="2" class="form-control mb-2" placeholder="Remarque de traitement (facultatif)"></textarea>
        <button class="btn btn-primary w-100">Mettre à jour le statut</button>
      </form>
    </div>
    <?php endif; ?>
  </div>
</div>
