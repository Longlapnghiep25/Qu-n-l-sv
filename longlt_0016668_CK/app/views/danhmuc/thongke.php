<h4 class="fw-bold mb-3">📊 Thống kê theo danh mục</h4>
<table class="table table-bordered bg-white shadow-sm">
    <thead>
        <tr><th>STT</th><th>Mã DM</th><th>Tên danh mục</th><th>Số lượng SP</th><th>Tổng thành tiền</th></tr>
    </thead>
    <tbody>
        <?php foreach ($stats as $i => $row): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><span class="badge bg-info text-dark"><?= htmlspecialchars($row['madanhmuc']) ?></span></td>
            <td><?= htmlspecialchars($row['tendanhmuc']) ?></td>
            <td><?= number_format($row['soluong_sp']) ?></td>
            <td class="fw-bold text-success"><?= number_format($row['tong_thanhtien'], 0, ',', '.') ?> đ</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>