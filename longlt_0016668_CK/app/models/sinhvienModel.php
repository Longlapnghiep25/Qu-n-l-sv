<?php
class sinhvienModel {
    private $conn;

    public function __construct() {
        $this->conn = DB::getInstance();
    }

   
    public function getByUsername($username) {
        
        $result = $this->conn->query("SELECT * FROM sinhvien");
        if (!$result) return null;
        while ($row = $result->fetch_assoc()) {
            if (strtolower($this->removeAccents($row['ten'])) === strtolower($username)) {
                return $row;
            }
        }
        return null;
    }

    private function removeAccents($str) {
        $str = preg_replace('/[áàảãạăắằẳẵặâấầẩẫậ]/u', 'a', $str);
        $str = preg_replace('/[ÁÀẢÃẠĂẮẰẲẴẶÂẤẦẨẪẬ]/u', 'A', $str);
        $str = preg_replace('/[éèẻẽẹêếềểễệ]/u', 'e', $str);
        $str = preg_replace('/[ÉÈẺẼẸÊẾỀỂỄỆ]/u', 'E', $str);
        $str = preg_replace('/[íìỉĩị]/u', 'i', $str);
        $str = preg_replace('/[ÍÌỈĨỊ]/u', 'I', $str);
        $str = preg_replace('/[óòỏõọôốồổỗộơớờởỡợ]/u', 'o', $str);
        $str = preg_replace('/[ÓÒỎÕỌÔỐỒỔỖỘƠỚỜỞỠỢ]/u', 'O', $str);
        $str = preg_replace('/[úùủũụưứừửữự]/u', 'u', $str);
        $str = preg_replace('/[ÚÙỦŨỤƯỨỪỬỮỰ]/u', 'U', $str);
        $str = preg_replace('/[ýỳỷỹỵ]/u', 'y', $str);
        $str = preg_replace('/[ÝỲỶỸỴ]/u', 'Y', $str);
        $str = preg_replace('/[đ]/u', 'd', $str);
        $str = preg_replace('/[Đ]/u', 'D', $str);
        return preg_replace('/\s+/', '', $str); 
    }
}