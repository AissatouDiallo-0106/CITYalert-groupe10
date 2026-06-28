<a href="<?= url('reports') ?>" class="back-link"><i class="bi bi-arrow-left"></i> Retour</a>
<div class="row justify-content-center">
  <div class="col-lg-7">
    <div class="card p-4">
      <h5 class="section-title mb-4">Nouveau signalement</h5>
      <form method="POST" action="<?= url('reports') ?>">
        <?= csrf_field() ?>
        <?= \App\Core\View::partial('reports/_form', compact('categories', 'errors')) ?>
        <button class="btn btn-primary w-100 mt-2"><i class="bi bi-send me-1"></i>Soumettre le signalement</button>
      </form>
    </div>
  </div>
</div>
