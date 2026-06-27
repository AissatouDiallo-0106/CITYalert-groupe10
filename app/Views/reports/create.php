<div class="row justify-content-center"><div class="col-lg-7">
  <h3 class="fw-bold mb-3"><i class="bi bi-plus-circle me-1"></i>Nouveau signalement</h3>
  <div class="card p-4">
    <form method="POST" action="<?= url('reports') ?>">
      <?= csrf_field() ?>
      <?= \App\Core\View::partial('reports/_form', ['errors'=>$errors??[], 'categories'=>$categories, 'report'=>null]) ?>
      <button class="btn btn-primary"><i class="bi bi-send me-1"></i>Envoyer le signalement</button>
      <a href="<?= url('reports') ?>" class="btn btn-link">Annuler</a>
    </form>
  </div>
</div></div>
