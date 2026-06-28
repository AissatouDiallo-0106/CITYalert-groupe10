<a href="<?= url('reports/' . $report->getId()) ?>" class="back-link"><i class="bi bi-arrow-left"></i> Retour</a>
<div class="row justify-content-center">
  <div class="col-lg-7">
    <div class="card p-4">
      <h5 class="section-title mb-4">Modifier le signalement</h5>
      <form method="POST" action="<?= url('reports/' . $report->getId() . '/edit') ?>">
        <?= csrf_field() ?>
        <?= \App\Core\View::partial('reports/_form', compact('report', 'categories', 'errors')) ?>
        <button class="btn btn-primary w-100 mt-2"><i class="bi bi-check2 me-1"></i>Enregistrer les modifications</button>
      </form>
    </div>
  </div>
</div>
