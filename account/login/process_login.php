<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$email = $msg = '';
if (!empty($_POST)) {
    $email = $_POST['email'];
    $pwd = $_POST['password']; 
    
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pwd'";
    $userExist = executeResult($sql, true); 
    
    if ($userExist == null) {
        $msg = '*Đăng nhập không thành công, vui lòng kiểm tra lại thông tin';
        echo "<script>
                alert('Đăng nhập không thành công');
              </script>";
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['role_id'] = $userExist['role_id']; 
        
       
        if ($userExist['role_id'] == 1) {  
            echo "<script>alert('Đăng nhập thành công');</script>";
            header('Location: /admin/index.php');  
            exit();  
        } else {
            
            echo "<script>alert('Bạn không phải là admin!');</script>";
            header('Location: ../');  
            exit(); 
        }
    }
}
?>
