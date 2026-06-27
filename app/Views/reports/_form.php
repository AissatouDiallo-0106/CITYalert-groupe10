<?php $errors = $errors ?? []; $r = $report ?? null; ?>
<div class="mb-3">
  <label class="form-label">Titre</label>
  <input type="text" name="title" class="form-control <?= isset($errors['title'])?'is-invalid':'' ?>" value="<?= e($r?->getTitle() ?? old('title')) ?>" required>
  <?php if (isset($errors['title'])): ?><div class="invalid-feedback"><?= e($errors['title']) ?></div><?php endif; ?>
</div>
<div class="mb-3">
  <label class="form-label">Catégorie</label>
  <select name="category" class="form-select">
    <?php foreach ($categories as $c): $sel = $r ? $r->getCategory()->code()===$c->code() : false; ?>
      <option value="<?= $c->code() ?>" <?= $sel?'selected':'' ?>><?= e($c->label()) ?> (délai <?= $c->processingDays() ?> j)</option>
    <?php endforeach; ?>
  </select>
</div>
<div class="mb-3">
  <label class="form-label">Adresse</label>
  <input type="text" name="address" class="form-control <?= isset($errors['address'])?'is-invalid':'' ?>" value="<?= e($r?->getAddress() ?? old('address')) ?>" required>
  <?php if (isset($errors['address'])): ?><div class="invalid-feedback"><?= e($errors['address']) ?></div><?php endif; ?>
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" rows="4" class="form-control <?= isset($errors['description'])?'is-invalid':'' ?>" required><?= e($r?->getDescription() ?? old('description')) ?></textarea>
  <?php if (isset($errors['description'])): ?><div class="invalid-feedback"><?= e($errors['description']) ?></div><?php endif; ?>
</div>
<div class="mb-3">
  <label class="form-label">Photo (URL, facultatif)</label>
  <input type="text" name="photo" class="form-control" value="<?= e($r?->getPhoto() ?? '') ?>" placeholder="https://...">
</div>
