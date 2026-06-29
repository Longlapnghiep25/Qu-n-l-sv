<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background:#f5f7fb; font-family:'Segoe UI',sans-serif; }
        .navbar { background:linear-gradient(135deg,#0d6efd,#0dcaf0)!important; }
        .table thead { background:#343a40; color:white; }
        .table th,.table td { vertical-align:middle; }
        .btn { border-radius:8px; }
        footer { margin-top:40px; padding:16px 0; text-align:center; color:#888; font-size:13px; }
    </style>
</head>
<body>
<?php include __DIR__ . '/partial/header.php'; ?>
<div class="container py-4">
    <?php include $__view__; ?>
</div>
<footer>© <?= date('Y') ?> Quản lý SP — Lê Tuấn Long — MSSV: 0016668</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>