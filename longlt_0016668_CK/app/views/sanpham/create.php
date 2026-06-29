<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm">
    <div class="card-header bg-success text-white fw-bold">➕ Thêm sản phẩm</div>
    <div class="card-body">
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger"><ul class="mb-0">
            <?php foreach($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
        </ul></div>
        <?php endif; ?>
        <p class="text-muted small">Mã SP tự sinh (SP<?= X.Y ?>001, SP<?= X.Y ?>002,...). Số lượng mặc định = <?= X+1 ?> nếu để trống.</p>
        <form method="POST" action="<?= BASE_URL ?>/sanpham/create">
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="tensanpham" class="form-control"
                       value="<?= htmlspecialchars($_POST['tensanpham'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá (> 0)</label>
                <input type="number" name="gia" class="form-control" min="1"
                       value="<?= htmlspecialchars($_POST['gia'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng (để trống = <?= X+1 ?>)</label>
                <input type="number" name="soluong" class="form-control" min="0"
                       value="<?= htmlspecialchars($_POST['soluong'] ?? '') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <select name="madanhmuc" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($danhmuc_list as $dm): ?>
                        <option value="<?= htmlspecialchars($dm['madanhmuc']) ?>"
                            <?= (($_POST['madanhmuc']??'')===$dm['madanhmuc'])?'selected':'' ?>>
                            <?= htmlspecialchars($dm['tendanhmuc']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Lưu</button>
                <a href="<?= BASE_URL ?>/sanpham/index" class="btn btn-secondary">Huỷ</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>