<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <div>
        <p class="eyebrow">Account management</p>
        <h1>User Accounts</h1>
    </div>
    <a class="button" href="<?= site_url('users/new') ?>">New User</a>
</div>

<div class="table-wrap">
    <table>
        <thead><tr><th>Avatar</th><th>Username</th><th>Full Name</th><th>Role</th><th>Action</th></tr></thead>
        <tbody>
        <?php if ($users === []): ?>
            <tr><td colspan="5" class="empty">No users found.</td></tr>
        <?php endif; ?>
        <?php foreach ($users as $user): ?>
            <?php $avatar = $user['avatar'] ? 'uploads/' . rawurlencode($user['avatar']) : 'images/avatar-placeholder.svg'; ?>
            <tr>
                <td><img class="avatar" src="<?= base_url($avatar) ?>" alt="<?= esc($user['full_name']) ?> avatar"></td>
                <td><?= esc($user['username']) ?></td>
                <td><?= esc($user['full_name']) ?></td>
                <td><span class="badge"><?= esc($user['role']) ?></span></td>
                <td><a class="text-link" href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
