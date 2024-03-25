<?php
// session_start();
include_once("./layouts/header.php");

if (isset($_SESSION['username'])) {
    $fullname = $_SESSION['fullname'];
    $role = $_SESSION['role'];
} else {
    $fullname = "Khách";
    $role = "Khách";
}

?>

<div class="jumbotron">
    <div class="container">
        <div>
            <h1 class="display-4 fw-bold">TRANG CHỦ</h1>
            <p class="lead">KIỂM TRA GIỮA KỲ - MÔN PHP MÃ NGUỒN MỞ</p>
            <p>Bài làm của Sinh Viên TRƯƠNG THỤC VÂN</p>
            <p>MSSV: 2080600803</p>
            <p>Lớp: 20DTHD3</p>
        </div>

        <hr />

        <!-- Kiểm tra phân quyền -->
        <?php
        if ($role == 'user') {
            echo "<h3>Chào mừng $fullname - Role: $role</h3>";
        } elseif ($role == 'admin') {
            echo "<h3>Chào mừng $fullname - Role: $role</h3>";
        } else {
            echo "<h3>Chào mừng $fullname</h3>";
        }
        ?>
    </div>
</div>

<?php include_once("./layouts/footer.php"); ?>