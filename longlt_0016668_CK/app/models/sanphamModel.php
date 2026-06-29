<?php
class sanphamModel {
    private $conn;

    public function __construct() {
        $this->conn = DB::getInstance();
    }

    public function generateMaSP() {
        $prefix = 'SP' . X . Y; 
        $result = $this->conn->query(
            "SELECT masanpham FROM sanpham WHERE masanpham LIKE '$prefix%'
             ORDER BY masanpham DESC LIMIT 1"
        );
        if ($result->num_rows === 0) {
            return $prefix . '001';
        }
        $last = $result->fetch_assoc()['masanpham'];
        $num  = (int)substr($last, strlen($prefix)) + 1;
        return $prefix . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    public function getAll($offset, $limit, $search = '', $madanhmuc = '', $sort = 'default') {
        $where  = "WHERE 1=1";
        $types  = '';
        $params = [];

        if ($search !== '') {
            $kw = "%$search%";
            $where .= " AND (s.masanpham LIKE ? OR s.tensanpham LIKE ?)";
            $types .= "ss";
            $params[] = $kw;
            $params[] = $kw;
        }
        if ($madanhmuc !== '') {
            $where .= " AND s.madanhmuc = ?";
            $types .= "s";
            $params[] = $madanhmuc;
        }

        $orderBy = (X % 2 === 0) ? "s.gia DESC" : "s.tensanpham ASC";

        $sql = "SELECT s.*, d.tendanhmuc
                FROM sanpham s
                LEFT JOIN danhmuc d ON s.madanhmuc = d.madanhmuc
                $where
                ORDER BY $orderBy
                LIMIT ? OFFSET ?";
        $types .= "ii";
        $params[] = $limit;
        $params[] = $offset;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function countAll($search = '', $madanhmuc = '') {
        $where  = "WHERE 1=1";
        $types  = '';
        $params = [];

        if ($search !== '') {
            $kw = "%$search%";
            $where .= " AND (masanpham LIKE ? OR tensanpham LIKE ?)";
            $types .= "ss";
            $params[] = $kw;
            $params[] = $kw;
        }
        if ($madanhmuc !== '') {
            $where .= " AND madanhmuc = ?";
            $types .= "s";
            $params[] = $madanhmuc;
        }

        $sql = "SELECT COUNT(*) AS total FROM sanpham $where";
        if ($types) {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            return (int)$stmt->get_result()->fetch_assoc()['total'];
        }
        return (int)$this->conn->query($sql)->fetch_assoc()['total'];
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM sanpham WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($masanpham, $tensanpham, $gia, $soluong, $madanhmuc) {
        $ngaytao = date('Y-m-d H:i:s');
        $stmt = $this->conn->prepare(
            "INSERT INTO sanpham (masanpham,tensanpham,gia,soluong,madanhmuc,ngaytao)
             VALUES (?,?,?,?,?,?)"
        );
        $stmt->bind_param("ssdiss", $masanpham, $tensanpham, $gia, $soluong, $madanhmuc, $ngaytao);
        return $stmt->execute();
    }

    public function update($id, $tensanpham, $gia, $soluong, $madanhmuc) {
        $stmt = $this->conn->prepare(
            "UPDATE sanpham SET tensanpham=?, gia=?, soluong=?, madanhmuc=? WHERE id=?"
        );
        $stmt->bind_param("sdisi", $tensanpham, $gia, $soluong, $madanhmuc, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM sanpham WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}