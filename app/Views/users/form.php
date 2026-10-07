<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="form-card">
    <p class="eyebrow">User account</p>
    <h1><?= esc($title) ?></h1>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>
    <?php if ($errors): ?>
        <div class="alert error" role="alert">
            <strong>Please correct the following:</strong>
            <ul><?php foreach ($errors as $error): ?><li><?= esc($error) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <form action="<?= esc($action) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <label for="username">Username <span>*</span></label>
        <input id="username" name="username" value="<?= esc(old('username', $user['username'] ?? '')) ?>" required maxlength="50">

        <label for="full_name">Full name <span>*</span></label>
        <input id="full_name" name="full_name" value="<?= esc(old('full_name', $user['full_name'] ?? '')) ?>" required maxlength="120">

        <label for="role">Role</label>
        <select id="role" name="role">
            <?php $selectedRole = old('role', $user['role'] ?? 'Staff'); ?>
            <?php foreach (['Administrator', 'Cashier', 'Staff'] as $role): ?>
                <option value="<?= esc($role) ?>" <?= $selectedRole === $role ? 'selected' : '' ?>><?= esc($role) ?></option>
            <?php endforeach; ?>
        </select>

        <?php if ($user !== null): ?>
            <label for="avatar">Profile picture</label>
            <input id="avatar" type="file" name="avatar" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            <p class="help">JPG or PNG only, maximum 2 MB. The image will be cropped to a 300 × 300 thumbnail.</p>
        <?php endif; ?>

        <div class="form-actions">
            <button class="button" type="submit">Save User</button>
            <a class="button secondary" href="<?= site_url('users') ?>">Cancel</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
