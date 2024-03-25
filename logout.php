<?php
session_start();

unset($_SESSION['user_id']);
unset($_SESSION['username']);
// unset($_SESSION['password']);
unset($_SESSION['role']);
unset($_SESSION['fullname']);

session_destroy();

header("Location: login.php");
exit();
