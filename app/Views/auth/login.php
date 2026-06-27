<h5 class="fw-bold mb-3">Connexion</h5>
<?php if (!empty($error)): ?><div class="alert alert-danger py-2"><?= e($error) ?></div><?php endif; ?>
<form method="POST" action="<?= url('login') ?>">
  <?= csrf_field() ?>
  <div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required autofocus>
  </div>
  <div class="mb-3">
    <label class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-primary w-100">Se connecter</button>
</form>
<p class="text-center text-muted small mt-3 mb-0">Pas de compte ? <a href="<?= url('register') ?>">S'inscrire</a></p>
