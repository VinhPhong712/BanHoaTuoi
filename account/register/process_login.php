<?php 
$fullname = $email = $msg = '';
if(!empty($_POST)) {
    $fullname = getPost('fullname');
    $email = getPost('email');
    $pwd = getPost('password');
    $phone_user = getPost('phone_user');
    $address_user = getPost('address_user');
    if(empty($fullname) || empty($email) || empty($pwd) || strlen($pwd) <6 || empty($phone_user) || empty($address_user)) {
    } else {
        $userExist = executeResult("SELECT * FROM users WHERE email = '$email'",true);
        if($userExist != null) {
            $msg = '*Email đã được đăng ký,vui lòng đăng ký lại';
            echo "<script language='javascript'>
                alert('Đăng kí không thành công')
            </script>";
        } else {
            $sql = "INSERT INTO users (fullname,email,password,role_id,phone_user,address_user) 
                VALUES ('$fullname','$email','$pwd',2,'$phone_user','$address_user')";
            execute($sql);
            $_SESSION['email'] = $email;
            echo "<script language='javascript'>
                alert('Đăng kí thành công')
            </script>";
            header('Location: ../../');
            die();
        }
    }
}