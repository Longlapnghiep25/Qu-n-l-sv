<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">✏️ Sửa sản phẩm</div>
    <div class="card-body">
        <?php if (!empty($errors)): ?>
        <div class="alert alert-danger"><ul class="mb-0">
            <?php foreach($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
        </ul></div>
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label">Mã SP (không thể sửa)</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($sp['masanpham']) ?>" disabled>
        </div>
        <form method="POST" action="<?= BASE_URL ?>/sanpham/edit/<?= $sp['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="tensanpham" class="form-control"
                       value="<?= htmlspecialchars($_POST['tensanpham'] ?? $sp['tensanpham']) ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number" name="gia" class="form-control" min="1"
                       value="<?= htmlspecialchars($_POST['gia'] ?? $sp['gia']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="soluong" class="form-control" min="0"
                       value="<?= htmlspecialchars($_POST['soluong'] ?? $sp['soluong']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Danh mục</label>
                <?php $curDM = $_POST['madanhmuc'] ?? $sp['madanhmuc']; ?>
                <select name="madanhmuc" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($danhmuc_list as $dm): ?>
                        <option value="<?= htmlspecialchars($dm['madanhmuc']) ?>"
                            <?= ($curDM===$dm['madanhmuc'])?'selected':'' ?>>
                            <?= htmlspecialchars($dm['tendanhmuc']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="<?= BASE_URL ?>/sanpham/index" class="btn btn-secondary">Huỷ</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>