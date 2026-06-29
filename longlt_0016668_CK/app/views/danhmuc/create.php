<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm">
    <div class="card-header bg-success text-white fw-bold">➕ Thêm danh mục</div>
    <div class="card-body">
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger"><ul class="mb-0">
            <?php foreach($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
        </ul></div>
        <?php endif; ?>
        <p class="text-muted small">Mã danh mục phải bắt đầu bằng <b><?= X.Y ?></b> (vd: <?= X.Y ?>AB)</p>
        <form method="POST" action="<?= BASE_URL ?>/danhmuc/create">
            <div class="mb-3">
                <label class="form-label">Mã danh mục</label>
                <input type="text" name="madanhmuc" class="form-control"
                       value="<?= htmlspecialchars($old['madanhmuc'] ?? '') ?>"
                       placeholder="<?= X.Y ?>AB" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="tendanhmuc" class="form-control"
                       value="<?= htmlspecialchars($old['tendanhmuc'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="mota" class="form-control" rows="3"><?= htmlspecialchars($old['mota'] ?? '') ?></textarea>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="<?= BASE_URL ?>/danhmuc/index" class="btn btn-secondary">Huỷ</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>