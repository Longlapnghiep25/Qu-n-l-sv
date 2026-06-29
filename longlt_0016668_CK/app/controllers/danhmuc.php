<?php
class danhmuc extends Controller {
    public function __construct() { $this->requireLogin(); }

    public function index() {
        $model = $this->model('danhmucModel');
        $this->render('danhmuc/index', [
            'danhmuc_list' => $model->getAll(),
        ]);
    }

    public function create() {
        $model  = $this->model('danhmucModel');
        $errors = [];
        $old    = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $madanhmuc  = strtoupper(trim($_POST['madanhmuc'] ?? ''));
            $tendanhmuc = trim($_POST['tendanhmuc'] ?? '');
            $mota       = trim($_POST['mota'] ?? '');
            $old = compact('madanhmuc', 'tendanhmuc', 'mota');

          
            if (!preg_match('/^' . X . Y . '[A-Z0-9]+$/i', $madanhmuc)) {
                $errors[] = "Mã danh mục phải bắt đầu bằng " . X . Y . " (vd: 66AB).";
            } elseif ($model->isExists($madanhmuc)) {
                $errors[] = "Mã danh mục đã tồn tại.";
            }
            if (!$tendanhmuc) $errors[] = "Tên danh mục không được trống.";

            if (empty($errors)) {
                $model->create($madanhmuc, $tendanhmuc, $mota);
                $this->redirect('/danhmuc/index');
            }
        }

        $this->render('danhmuc/create', ['errors' => $errors, 'old' => $old]);
    }

    public function delete($id = null) {
        $model  = $this->model('danhmucModel');
        $id     = (int)$id;
        $dm     = $model->getById($id);

        if (!$dm) {
            $this->redirect('/danhmuc/index');
        }

        if ($model->hasSanpham($dm['madanhmuc'])) {
            $_SESSION['error_dm'] = "Không thể xoá! Danh mục <b>{$dm['tendanhmuc']}</b> đang chứa sản phẩm.";
            $this->redirect('/danhmuc/index');
        }

        $model->delete($id);
        $this->redirect('/danhmuc/index');
    }

    public function thongke() {
        $model = $this->model('danhmucModel');
        $this->render('danhmuc/thongke', [
            'stats' => $model->getThongKe(),
        ]);
    }
}