<?php
class sanpham extends Controller {
    public function __construct() { $this->requireLogin(); }

    public function index($page = 1) {
        $model    = $this->model('sanphamModel');
        $dmModel  = $this->model('danhmucModel');

        $page      = max(1, (int)$page);
        $search    = trim($_GET['q'] ?? '');
        $madanhmuc = trim($_GET['madanhmuc'] ?? '');
        $pageSize  = (int)($_GET['pagesize'] ?? (Y+2));

        $pageSizes = [Y+2, Y+5, Y+10]; 
        if (!in_array($pageSize, $pageSizes)) $pageSize = Y+2;

        $total     = $model->countAll($search, $madanhmuc);
        $totalpage = max(1, ceil($total / $pageSize));
        if ($page > $totalpage) $page = $totalpage;
        $offset    = ($page - 1) * $pageSize;

        $sanphams = $model->getAll($offset, $pageSize, $search, $madanhmuc);

      
        $tongHienThi = array_sum(array_map(fn($sp) => $sp['gia'] * $sp['soluong'], $sanphams));

        $this->render('sanpham/index', [
            'sanphams'    => $sanphams,
            'totalpage'   => $totalpage,
            'currentPage' => $page,
            'total'       => $total,
            'search'      => $search,
            'madanhmuc'   => $madanhmuc,
            'pageSize'    => $pageSize,
            'pageSizes'   => $pageSizes,
            'tongHienThi' => $tongHienThi,
            'danhmuc_list'=> $dmModel->getAll(),
        ]);
    }

    public function create() {
        $model   = $this->model('sanphamModel');
        $dmModel = $this->model('danhmucModel');
        $errors  = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tensanpham = trim($_POST['tensanpham'] ?? '');
            $gia        = $_POST['gia'] ?? '';
            $soluong    = $_POST['soluong'] ?? '';
            $madanhmuc  = $_POST['madanhmuc'] ?? '';

            if (!$tensanpham) $errors[] = "Tên sản phẩm không được trống.";
            if ($gia === '' || $gia <= 0) $errors[] = "Giá phải > 0.";
            if (!$madanhmuc)  $errors[] = "Vui lòng chọn danh mục.";

            // soluong mặc định = X+1 = 7 nếu để trống
            $soluong = ($soluong === '' || $soluong === null) ? (X+1) : (int)$soluong;

            if (empty($errors)) {
                $masanpham = $model->generateMaSP();
                $model->create($masanpham, $tensanpham, (float)$gia, $soluong, $madanhmuc);
                $this->redirect('/sanpham/index');
            }
        }

        $this->render('sanpham/create', [
            'errors'       => $errors,
            'danhmuc_list' => $dmModel->getAll(),
        ]);
    }

    public function edit($id = null) {
        $model   = $this->model('sanphamModel');
        $dmModel = $this->model('danhmucModel');
        $id      = (int)$id;
        $sp      = $model->getById($id);

        if (!$sp) { echo "Không tìm thấy sản phẩm!"; exit; }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tensanpham = trim($_POST['tensanpham'] ?? '');
            $gia        = $_POST['gia'] ?? '';
            $soluong    = (int)($_POST['soluong'] ?? 0);
            $madanhmuc  = $_POST['madanhmuc'] ?? '';

            if (!$tensanpham) $errors[] = "Tên sản phẩm không được trống.";
            if ($gia === '' || $gia <= 0) $errors[] = "Giá phải > 0.";
            if (!$madanhmuc)  $errors[] = "Vui lòng chọn danh mục.";

            if (empty($errors)) {
                $model->update($id, $tensanpham, (float)$gia, $soluong, $madanhmuc);
                $this->redirect('/sanpham/index');
            }
        }

        $this->render('sanpham/edit', [
            'sp'           => $sp,
            'errors'       => $errors,
            'danhmuc_list' => $dmModel->getAll(),
        ]);
    }

    public function delete($id = null) {
        $model = $this->model('sanphamModel');
        $model->delete((int)$id);
        $this->redirect('/sanpham/index');
    }
}