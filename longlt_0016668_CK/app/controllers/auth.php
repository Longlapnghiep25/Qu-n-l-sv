<?php
class auth extends Controller {

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $username_clean = strtolower(preg_replace('/\s+/', '', $username));

            if ($username_clean === 'letuanlong' && $password === '0016668') {
                $_SESSION['user'] = [
                    'hoten' => 'Lê Tuấn Long',
                    'mssv'  => '0016668',
                ];
                header("Location: " . BASE_URL . "/sanpham/index");
                exit;
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
            }
        }

        $__view__ = __DIR__ . '/../views/auth/login.php';
        include __DIR__ . '/../views/layout/guest.php';
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    public function index() {
        $this->login();
    }
}