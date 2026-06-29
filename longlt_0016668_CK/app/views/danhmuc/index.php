<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Danh sách Danh mục</h4>
    <a href="<?= BASE_URL ?>/danhmuc/create" class="btn btn-success">+ Thêm danh mục</a>
</div>

<?php if (!empty($_SESSION['error_dm'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error_dm'] ?></div>
    <?php unset($_SESSION['error_dm']); ?>
<?php endif; ?>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead>
        <tr><th>STT</th><th>Mã DM</th><th>Tên danh mục</th><th>Mô tả</th><th>Thao tác</th></tr>
    </thead>
    <tbody>
        <?php foreach ($danhmuc_list as $i => $dm): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($dm['madanhmuc']) ?></span></td>
            <td><?= htmlspecialchars($dm['tendanhmuc']) ?></td>
            <td><?= htmlspecialchars($dm['mota']) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/danhmuc/delete/<?= $dm['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Xác nhận xoá?')">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($danhmuc_list)): ?>
        <tr><td colspan="5" class="text-center text-muted">Chưa có danh mục nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>