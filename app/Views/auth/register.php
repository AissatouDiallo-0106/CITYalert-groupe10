<h5 class="fw-bold mb-3">Inscription</h5>
<?php $errors = $errors ?? []; ?>
<form method="POST" action="<?= url('register') ?>">
  <?= csrf_field() ?>
  <div class="mb-3">
    <label class="form-label">Nom complet</label>
    <input type="text" name="name" class="form-control <?= isset($errors['name'])?'is-invalid':'' ?>" value="<?= old('name') ?>" required>
    <?php if (isset($errors['name'])): ?><div class="invalid-feedback"><?= e($errors['name']) ?></div><?php endif; ?>
  </div>
  <div class="mb-3">
    <label class="form-label">E-mail</label>
    <input type="email" name="email" class="form-control <?= isset($errors['email'])?'is-invalid':'' ?>" value="<?= old('email') ?>" required>
    <?php if (isset($errors['email'])): ?><div class="invalid-feedback"><?= e($errors['email']) ?></div><?php endif; ?>
  </div>
  <div class="mb-3">
    <label class="form-label">Mot de passe</label>
    <input type="password" name="password" class="form-control <?= isset($errors['password'])?'is-invalid':'' ?>" required>
    <?php if (isset($errors['password'])): ?><div class="invalid-feedback"><?= e($errors['password']) ?></div><?php endif; ?>
  </div>
  <button class="btn btn-primary w-100">Créer mon compte</button>
</form>
<p class="text-center text-muted small mt-3 mb-0">Déjà inscrit ? <a href="<?= url('login') ?>">Connexion</a></p>
