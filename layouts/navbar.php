<?php
session_start();
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">TTV-HUTECH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="nhanvien.php">Nhân viên</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="phongban.php">Phòng ban</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['username'])) : ?>
                    <li class="nav-item mr-2">
                        <span class="navbar-text me-3">Chào <?php echo $_SESSION['fullname']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-danger" href="logout.php">Đăng Xuất</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary" href="login.php">Đăng Nhập</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>