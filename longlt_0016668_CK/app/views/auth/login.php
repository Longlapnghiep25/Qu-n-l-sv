<div class="card">
    <div class="card-header py-3">🔐 Đăng nhập hệ thống</div>
    <div class="card-body p-4">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="<?= BASE_URL ?>/auth/login">
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập</label>
                <input type="text" name="username" class="form-control"
                       placeholder="Họ tên viết liền không dấu" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu (MSSV)</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
        </form>
    </div>
</div>