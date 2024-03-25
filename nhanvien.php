<?php
// session_start();
include('./layouts/header.php');
require_once('./models/nhanvien.class.php');

if (isset($_SESSION['username'])) {
    $fullname = $_SESSION['fullname'];
    $role = $_SESSION['role'];
} else {
    $fullname = "Khách";
    $role = "Khách";
}

// Thực hiện logic phân trang
$records_per_page = 5;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$nhanvien = new NhanVien();

$total_records = count($nhanvien->getAllNhanVien());
$total_pages = ceil($total_records / $records_per_page);

$offset = ($current_page - 1) * $records_per_page;
$nv_list = $nhanvien->getAllNhanVienPaging($offset, $records_per_page);

?>

<div class="container mt-4">
    <h2 class="fw-bold">DANH SÁCH NHÂN VIÊN</h2>

    <?php
    if ($role == 'user') {
        echo "<p>$fullname - Role: $role</p>";
    } elseif ($role == 'admin') {
        echo "<p>$fullname - Role: $role</p>";
    } else {
        echo "<p>Bạn đang là $fullname. Hãy đăng nhập để trải nghiệm</p>";
    }
    ?>

    <?php if ($role == 'admin') : ?>
        <div class="text-right mb-3">
            <a href="themnhanvien.php" class="btn btn-primary">THÊM NHÂN VIÊN</a>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">MÃ NHÂN VIÊN</th>
                    <th scope="col">TÊN NHÂN VIÊN</th>
                    <th scope="col">GIỚI TÍNH</th>
                    <th scope="col">NƠI SINH</th>
                    <th scope="col">TÊN PHÒNG</th>
                    <th scope="col">LƯƠNG</th>
                    <?php if ($role == 'admin') : ?>
                        <th scope="col">ACTION</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nv_list as $nv) : ?>
                    <tr>
                        <td><?php echo $nv['Ma_NV']; ?></td>
                        <td><?php echo $nv['Ten_NV']; ?></td>
                        <td>
                            <?php if ($nv['Phai'] == 'NU') : ?>
                                <img src="images/woman.jpg" alt="Woman" width="50">
                            <?php else : ?>
                                <img src="images/man.jpg" alt="Man" width="50">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $nv['Noi_Sinh']; ?></td>
                        <td><?php echo $nv['Ten_Phong']; ?></td>
                        <td><?php echo number_format($nv['Luong']); ?></td>
                        <?php if ($role == 'admin') : ?>
                            <td>
                                <a href="chinhsuanhanvien.php?ma_nv=<?php echo $nv['Ma_NV']; ?>"><i class="fas fa-edit"></i></a>
                                <a href="xoanhanvien.php?ma_nv=<?php echo $nv['Ma_NV']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá nhân viên này không?')"><i class="fas fa-trash-alt"></i></a> <!-- Icon xoá -->
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>"><a class="page-link" href="nhanvien.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php
$db = new Db();
$db->close_connection();
include('./layouts/footer.php');
?>