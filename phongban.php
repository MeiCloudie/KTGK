<?php
include('./layouts/header.php');
require_once('./models/phongban.class.php');

$phongban = new PhongBan();

$phongban_list = $phongban->getAllPhongBan();

?>

<div class="container mt-4">
    <h2 class="fw-bold mb-4">DANH SÁCH PHÒNG BAN</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Mã phòng</th>
                    <th scope="col">Tên phòng</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($phongban_list as $phong) : ?>
                    <tr>
                        <td><?php echo $phong['Ma_Phong']; ?></td>
                        <td><?php echo $phong['Ten_Phong']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include('./layouts/footer.php'); ?>