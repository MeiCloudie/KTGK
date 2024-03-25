<?php
include('./layouts/header.php');
require_once('./models/nhanvien.class.php');

if (isset($_GET['ma_nv'])) {
    $maNV = $_GET['ma_nv'];

    $nhanvien = new NhanVien();

    $result = $nhanvien->deleteNhanVien($maNV);

    if ($result) {
        echo '<div class="alert alert-success" role="alert">Xoá nhân viên thành công!</div>';
        echo '<meta http-equiv="refresh" content="2;url=nhanvien.php">';
        exit();
    } else {
        echo '<div class="alert alert-danger" role="alert">Xoá nhân viên thất bại!</div>';
    }
}

$db = new Db();
$db->close_connection();

include('./layouts/footer.php');
