<?php
session_start();
require_once('./models/user.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userModel = new User();
    $user = $userModel->getUserByUsername($username);

    if ($user !== false && $user->num_rows > 0) {
        $userData = $user->fetch_assoc();
        if ($password == $userData['password']) {
            $_SESSION['user_id'] = $userData['Id'];
            $_SESSION['username'] = $userData['username'];
            $_SESSION['role'] = $userData['role'];
            $_SESSION['fullname'] = $userData['fullname'];

            if ($userData['role'] == 'admin' || $userData['role'] == 'user') {
                header("Location: index.php");
                // exit();
            } else {
                $error = "Vai trò của tài khoản không hợp lệ.";
            }
        } else {
            $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
        }
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h3>ĐĂNG NHẬP</h3>
                        <h6>Hệ thống Quản Lý Nhân Sự</h6>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label fw-bold">Tên đăng nhập:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Mật khẩu:</label>
                                <input type="password" id="password" name="password" class="form-control" autocomplete="password" required>
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="col-md-8 btn btn-success btn-block">TIẾP TỤC</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>