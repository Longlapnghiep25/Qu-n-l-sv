<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>/sanpham/index">🛒 Quản lý SP</a>
        <div class="ms-auto d-flex align-items-center gap-2">
            <?php if (isset($_SESSION['user'])): ?>
                <span class="text-light small">
                    Xin chào <b><?= htmlspecialchars($_SESSION['user']['hoten']) ?></b>,
                    MSSV: <b><?= htmlspecialchars($_SESSION['user']['mssv']) ?></b>,
                    bạn đang làm Đề 01 — X = <?= X ?>, Y = <?= Y ?>
                </span>
                <a href="<?= BASE_URL ?>/sanpham/index" class="btn btn-outline-light btn-sm">Sản phẩm</a>
                <a href="<?= BASE_URL ?>/danhmuc/index" class="btn btn-outline-light btn-sm">Danh mục</a>
                <a href="<?= BASE_URL ?>/danhmuc/thongke" class="btn btn-outline-light btn-sm">Thống kê</a>
                <a href="<?= BASE_URL ?>/auth/logout" class="btn btn-danger btn-sm">Đăng xuất</a>
            <?php endif; ?>
        </div>
    </div>
</nav>