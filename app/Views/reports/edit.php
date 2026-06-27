<div class="row justify-content-center"><div class="col-lg-7">
  <h3 class="fw-bold mb-3">Modifier le signalement</h3>
  <div class="card p-4">
    <form method="POST" action="<?= url('reports/' . $report->getId() . '/edit') ?>">
      <?= csrf_field() ?>
      <?= \App\Core\View::partial('reports/_form', ['errors'=>$errors??[], 'categories'=>$categories, 'report'=>$report]) ?>
      <button class="btn btn-primary">Enregistrer</button>
      <a href="<?= url('reports/' . $report->getId()) ?>" class="btn btn-link">Annuler</a>
    </form>
  </div>
</div></div>
