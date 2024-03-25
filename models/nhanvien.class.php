<?php
require_once("./config/db.class.php");

class NhanVien
{
    protected $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function getAllNhanVien()
    {
        $queryString = "SELECT nhanvien.Ma_NV, nhanvien.Ten_NV, nhanvien.Phai, nhanvien.Noi_Sinh, nhanvien.Luong, phongban.Ten_Phong 
                    FROM nhanvien 
                    INNER JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong";
        return $this->db->select_to_array($queryString);
    }


    public function getAllNhanVienPaging($offset, $limit)
    {
        $queryString = "SELECT nhanvien.Ma_NV, nhanvien.Ten_NV, nhanvien.Phai, nhanvien.Noi_Sinh, nhanvien.Luong, phongban.Ten_Phong 
                    FROM nhanvien 
                    INNER JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong 
                    LIMIT $offset, $limit";
        return $this->db->select_to_array($queryString);
    }


    public function getNhanVienByMaNV($maNV)
    {
        $maNV = $this->db->connect()->real_escape_string($maNV);
        $queryString = "SELECT * FROM nhanvien WHERE Ma_NV = '$maNV'";
        return $this->db->select_to_array($queryString);
    }

    public function addNhanVien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)
    {
        $maNV = $this->db->connect()->real_escape_string($maNV);
        $tenNV = $this->db->connect()->real_escape_string($tenNV);
        $phai = $this->db->connect()->real_escape_string($phai);
        $noiSinh = $this->db->connect()->real_escape_string($noiSinh);
        $maPhong = $this->db->connect()->real_escape_string($maPhong);
        $luong = (int)$luong;

        $queryString = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES ('$maNV', '$tenNV', '$phai', '$noiSinh', '$maPhong', $luong)";
        return $this->db->query_execute($queryString);
    }

    public function updateNhanVien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong)
    {
        $maNV = $this->db->connect()->real_escape_string($maNV);
        $tenNV = $this->db->connect()->real_escape_string($tenNV);
        $phai = $this->db->connect()->real_escape_string($phai);
        $noiSinh = $this->db->connect()->real_escape_string($noiSinh);
        $maPhong = $this->db->connect()->real_escape_string($maPhong);
        $luong = (int)$luong;

        $queryString = "UPDATE nhanvien SET Ten_NV = '$tenNV', Phai = '$phai', Noi_Sinh = '$noiSinh', Ma_Phong = '$maPhong', Luong = $luong WHERE Ma_NV = '$maNV'";
        return $this->db->query_execute($queryString);
    }

    public function deleteNhanVien($maNV)
    {
        $maNV = $this->db->connect()->real_escape_string($maNV);

        $queryString = "DELETE FROM nhanvien WHERE Ma_NV = '$maNV'";
        return $this->db->query_execute($queryString);
    }
}
