<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold">Danh sách Sản phẩm <span class="badge bg-secondary"><?= $total ?></span></h4>
    <a href="<?= BASE_URL ?>/sanpham/create" class="btn btn-success">+ Thêm sản phẩm</a>
</div>

<form method="GET" action="<?= BASE_URL ?>/sanpham/index" class="row g-2 mb-3">
    <div class="col-md-4">
        <input type="text" name="q" class="form-control"
               placeholder="Tìm theo tên hoặc mã SP..."
               value="<?= htmlspecialchars($search) ?>">
    </div>
    <div class="col-md-3">
        <select name="madanhmuc" class="form-select">
            <option value="">-- Tất cả danh mục --</option>
            <?php foreach ($danhmuc_list as $dm): ?>
                <option value="<?= htmlspecialchars($dm['madanhmuc']) ?>"
                    <?= ($madanhmuc === $dm['madanhmuc']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dm['tendanhmuc']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fa fa-search"></i> Tìm kiếm
        </button>
    </div>
    <div class="col-md-2">
        <a href="<?= BASE_URL ?>/sanpham/index" class="btn btn-outline-secondary w-100">
            <i class="fa fa-rotate-left"></i> Đặt lại
        </a>
    </div>
    <div class="col-md-1">
        <select name="pagesize" class="form-select" onchange="this.form.submit()">
            <?php foreach ($pageSizes as $sz): ?>
                <option value="<?= $sz ?>" <?= $pageSize==$sz ? 'selected':'' ?>>
                    <?= $sz ?>/trang
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<table class="table table-bordered table-hover bg-white shadow-sm">
    <thead>
        <tr>
            <th>ID</th><th>Mã SP</th><th>Tên SP</th>
            <th>Giá</th><th>Số lượng</th><th>Tên danh mục</th>
            <th>Thành tiền</th><th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sanphams as $sp): ?>
        <tr>
            <td><?= $sp['id'] ?></td>
            <td><span class="badge bg-primary"><?= htmlspecialchars($sp['masanpham']) ?></span></td>
            <td><?= htmlspecialchars($sp['tensanpham']) ?></td>
            <td><?= number_format($sp['gia'], 0, ',', '.') ?> đ</td>
            <td><?= $sp['soluong'] ?></td>
            <td><?= htmlspecialchars($sp['tendanhmuc'] ?? '—') ?></td>
            <td class="text-success fw-bold">
                <?= number_format($sp['gia'] * $sp['soluong'], 0, ',', '.') ?> đ
            </td>
            <td>
                <a href="<?= BASE_URL ?>/sanpham/edit/<?= $sp['id'] ?>"
                   class="btn btn-primary btn-sm">Sửa</a>
                <a href="<?= BASE_URL ?>/sanpham/delete/<?= $sp['id'] ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Xác nhận xoá?')">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($sanphams)): ?>
        <tr><td colspan="8" class="text-center text-muted">Không tìm thấy sản phẩm nào.</td></tr>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <tr class="table-dark fw-bold">
            <td colspan="6" class="text-end">Tổng thành tiền (trang này):</td>
            <td colspan="2" class="text-warning"><?= number_format($tongHienThi, 0, ',', '.') ?> đ</td>
        </tr>
    </tfoot>
</table>

<div class="mt-3">
    <?php
    $extra = http_build_query(['q'=>$search,'madanhmuc'=>$madanhmuc,'pagesize'=>$pageSize]);
    for ($i = 1; $i <= $totalpage; $i++):
        $active = $i==$currentPage ? 'btn-primary':'btn-outline-primary';
    ?>
        <a class="btn <?= $active ?> btn-sm ms-1"
           href="<?= BASE_URL ?>/sanpham/index/<?= $i ?>?<?= $extra ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>