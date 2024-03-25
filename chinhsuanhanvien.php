<?php
include('./layouts/header.php');
require_once('./models/nhanvien.class.php');
require_once('./models/phongban.class.php');
if (isset($_SESSION['username'])) {
    $fullname = $_SESSION['fullname'];
    $role = $_SESSION['role'];
} else {
    $fullname = "Khách";
    $role = "Khách";
}

$nv_info = array();

if (isset($_GET['ma_nv'])) {
    $maNV = $_GET['ma_nv'];

    $nhanvien = new NhanVien();

    $nv_info = $nhanvien->getNhanVienByMaNV($maNV);

    if (!$nv_info) {
        echo '<div class="alert alert-danger" role="alert">Không tìm thấy thông tin nhân viên!</div>';
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ma_nv'], $_POST['ten_nv'], $_POST['phai'], $_POST['noi_sinh'], $_POST['ma_phong'], $_POST['luong'])) {
        $maNV = $_POST['ma_nv'];
        $tenNV = $_POST['ten_nv'];
        $phai = $_POST['phai'];
        $noiSinh = $_POST['noi_sinh'];
        $maPhong = $_POST['ma_phong'];
        $luong = $_POST['luong'];

        $nhanvien = new NhanVien();

        $result = $nhanvien->updateNhanVien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong);

        if ($result) {
            echo '<div class="alert alert-success" role="alert">Cập nhật thông tin nhân viên thành công!</div>';
            echo '<meta http-equiv="refresh" content="2;url=nhanvien.php">';
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Cập nhật thông tin nhân viên thất bại!</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Vui lòng nhập đầy đủ thông tin!</div>';
    }
}
?>

<div class="container mt-4">
    <h2 class="fw-bold">CHỈNH SỬA NHÂN VIÊN</h2>
    <hr />

    <?php if ($role != 'admin') : ?>
        <h3>Bạn không có quyền thực hiện chức năng này!</h3>
    <?php endif; ?>

    <?php if ($role == 'admin') : ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
            <input type="hidden" name="ma_nv" value="<?php echo $nv_info[0]['Ma_NV']; ?>">
            <div class="form-group">
                <label for="ten_nv">Tên nhân viên:</label>
                <input type="text" class="form-control" id="ten_nv" name="ten_nv" value="<?php echo $nv_info[0]['Ten_NV']; ?>">
            </div>
            <div class="form-group">
                <label for="phai">Giới tính:</label>
                <select class="form-control" id="phai" name="phai">
                    <option value="NU" <?php if ($nv_info[0]['Phai'] == 'NU') echo 'selected'; ?>>Nữ</option>
                    <option value="NAM" <?php if ($nv_info[0]['Phai'] == 'NAM') echo 'selected'; ?>>Nam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi sinh:</label>
                <input type="text" class="form-control" id="noi_sinh" name="noi_sinh" value="<?php echo $nv_info[0]['Noi_Sinh']; ?>">
            </div>
            <div class="form-group">
                <label for="ma_phong">Tên Phòng:</label>
                <select class="form-control" id="ma_phong" name="ma_phong">
                    <?php
                    $phongban = new PhongBan();
                    $phongban_list = $phongban->getAllPhongBan();
                    foreach ($phongban_list as $phong) {
                        echo '<option value="' . $phong['Ma_Phong'] . '"';
                        if ($nv_info[0]['Ma_Phong'] == $phong['Ma_Phong']) {
                            echo ' selected';
                        }
                        echo '>' . $phong['Ten_Phong'] . '</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="text" class="form-control" id="luong" name="luong" value="<?php echo $nv_info[0]['Luong']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    <?php endif; ?>
</div>

<script>
    function validateForm() {
        var tenNV = document.getElementById('ten_nv').value;
        var noiSinh = document.getElementById('noi_sinh').value;
        var luong = document.getElementById('luong').value;

        if (tenNV == '' || noiSinh == '' || luong == '') {
            alert('Vui lòng nhập đầy đủ thông tin!');
            return false;
        }

        return true;
    }
</script>

<?php include('./layouts/footer.php'); ?>