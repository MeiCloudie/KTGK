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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ma_nv']) && isset($_POST['ten_nv']) && isset($_POST['phai']) && isset($_POST['noi_sinh']) && isset($_POST['ma_phong']) && isset($_POST['luong'])) {
        $maNV = $_POST['ma_nv'];
        $tenNV = $_POST['ten_nv'];
        $phai = $_POST['phai'];
        $noiSinh = $_POST['noi_sinh'];
        $maPhong = $_POST['ma_phong'];
        $luong = $_POST['luong'];

        $nhanvien = new NhanVien();

        $result = $nhanvien->addNhanVien($maNV, $tenNV, $phai, $noiSinh, $maPhong, $luong);

        if ($result) {
            echo '<div class="alert alert-success" role="alert">Thêm nhân viên thành công!</div>';
            echo '<meta http-equiv="refresh" content="2;url=nhanvien.php">';
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Thêm nhân viên thất bại!</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Vui lòng nhập đầy đủ thông tin!</div>';
    }
}
?>

<div class="container mt-4">
    <h2 class="fw-bold">THÊM NHÂN VIÊN</h2>
    <hr />

    <?php if ($role != 'admin') : ?>
        <h3>Bạn không có quyền thực hiện chức năng này!</h3>
    <?php endif; ?>

    <?php if ($role == 'admin') : ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
            <div class="form-group">
                <label for="ma_nv">Mã nhân viên:</label>
                <input type="text" class="form-control" id="ma_nv" name="ma_nv">
            </div>
            <div class="form-group">
                <label for="ten_nv">Tên nhân viên:</label>
                <input type="text" class="form-control" id="ten_nv" name="ten_nv">
            </div>
            <div class="form-group">
                <label for="phai">Giới tính:</label>
                <select class="form-control" id="phai" name="phai">
                    <option value="NU">Nữ</option>
                    <option value="NAM">Nam</option>
                </select>
            </div>
            <div class="form-group">
                <label for="noi_sinh">Nơi sinh:</label>
                <input type="text" class="form-control" id="noi_sinh" name="noi_sinh">
            </div>
            <div class="form-group">
                <label for="ma_phong">Tên Phòng:</label>
                <select class="form-control" id="ma_phong" name="ma_phong">
                    <?php
                    $phongban = new PhongBan();
                    $phongban_list = $phongban->getAllPhongBan();
                    foreach ($phongban_list as $phong) {
                        echo '<option value="' . $phong['Ma_Phong'] . '">' . $phong['Ten_Phong'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="luong">Lương:</label>
                <input type="text" class="form-control" id="luong" name="luong">
            </div>
            <button type="submit" class="btn btn-primary">Xác Nhận Thêm</button>
        </form>
    <?php endif; ?>
</div>

<script>
    function validateForm() {
        var maNV = document.getElementById('ma_nv').value;
        var tenNV = document.getElementById('ten_nv').value;
        var noiSinh = document.getElementById('noi_sinh').value;
        var luong = document.getElementById('luong').value;

        if (maNV == '' || tenNV == '' || noiSinh == '' || luong == '') {
            alert('Vui lòng nhập đầy đủ thông tin!');
            return false;
        }

        return true;
    }
</script>

<?php
include('./layouts/footer.php');
?>