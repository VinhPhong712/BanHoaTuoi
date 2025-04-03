<?php
$baseUrl = 'D:/myweb/admin/';
require_once($baseUrl.'layouts/header.php');	
require_once('../database/dbhelper.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $password = $_POST['password'];
    $oldPassword = $_POST['old_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Email không hợp lệ");</script>';
        exit();
    }

    if ($id > 0 && empty($password)) {
        $sql = "UPDATE users SET fullname = ?, email = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $fullname, $email, $id);
        $stmt->execute();
        header('Location: /weborganic/account/');
        exit();
    } elseif (!empty($password) && !empty($oldPassword)) {
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($hashedPasswordFromDB);
        $stmt->fetch();

        if (password_verify($oldPassword, $hashedPasswordFromDB)) {
            
            $newHashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $newHashedPassword, $id);
            $stmt->execute();
            header('Location: /weborganic/account/');
            exit();
        } else {
            echo '<script>alert("Sai mật khẩu cũ");</script>';
            exit();
        }
    } else {
        echo '<script>alert("Dữ liệu không hợp lệ");</script>';
        exit();
    }
}
?>
