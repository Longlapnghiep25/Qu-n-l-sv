<?php
class danhmucModel {
    private $conn;

    public function __construct() {
        $this->conn = DB::getInstance();
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM danhmuc ORDER BY id ASC")
                          ->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM danhmuc WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function isExists($madanhmuc, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->conn->prepare("SELECT id FROM danhmuc WHERE madanhmuc=? AND id!=?");
            $stmt->bind_param("si", $madanhmuc, $excludeId);
        } else {
            $stmt = $this->conn->prepare("SELECT id FROM danhmuc WHERE madanhmuc=?");
            $stmt->bind_param("s", $madanhmuc);
        }
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function hasSanpham($madanhmuc) {
        $stmt = $this->conn->prepare("SELECT id FROM sanpham WHERE madanhmuc=? LIMIT 1");
        $stmt->bind_param("s", $madanhmuc);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }

    public function create($madanhmuc, $tendanhmuc, $mota) {
        $stmt = $this->conn->prepare(
            "INSERT INTO danhmuc (madanhmuc, tendanhmuc, mota) VALUES (?,?,?)"
        );
        $stmt->bind_param("sss", $madanhmuc, $tendanhmuc, $mota);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM danhmuc WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Thống kê
    public function getThongKe() {
        $result = $this->conn->query(
            "SELECT d.madanhmuc, d.tendanhmuc,
                    COUNT(s.id) AS soluong_sp,
                    COALESCE(SUM(s.gia * s.soluong), 0) AS tong_thanhtien
             FROM danhmuc d
             LEFT JOIN sanpham s ON d.madanhmuc = s.madanhmuc
             GROUP BY d.madanhmuc, d.tendanhmuc
             ORDER BY d.id ASC"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}