
<?php
    ob_start();
    if(session_id() === '') {
        session_start();
    }
    $baseUrl = '../';
    $title = 'Tài khoản';
    include_once $baseUrl.'layouts/header.php';
    require_once ('../database/dbhelper.php');

    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $data = executeResult($sql,true);

        $id = $data['id'];
        $email = $data['email'];
        $fullname = $data['fullname'];
        $password = $data['password'];
    }

?>

<?php
         include_once $baseUrl.'layouts/header.php';
        require_once ('../database/dbhelper.php');
        

        if(isset($_POST['capnhat'])){
            $id = $_POST['id'];
            $email = $_POST['email'];
            $fullname = $_POST['fullname']; 
            $password = $_POST['password'];
            $oldPassword = $_POST['old_password'];

            if($id > 0 && !$password && !$oldPassword) {
                $sql = "UPDATE users SET fullname = '$fullname',email = '$email' WHERE id =$id";            
                execute($sql);
                header('Location: http://localhost/weborganic/account/');
                die();
            }else{

                    if(!$oldPassword){
                        echo '<script language="javascript">';
                        echo 'alert("Vui lòng nhập mật khẩu cũ")';
                        echo '</script>';
                    }else{
                        $id = $_POST['id'];
                        $sql = "SELECT * FROM users WHERE id='$id'";
                            $data1 = executeResult($sql);
                        if($oldPassword == $data1[0]['password']){
                            if(!$password){
                                echo '<script language="javascript">';
                                echo 'alert("Vui lòng nhập mật khẩu mới")';
                                echo '</script>';
                            }else{
                                $sql = "UPDATE users SET password = '$password' WHERE id =$id";            
                            execute($sql);
                            echo '<script language="javascript">';
                            echo 'alert("Mật khẩu được cập nhật")';
                            echo '</script>';
                            }
                        }else{
                            echo '<script language="javascript">';
                            echo 'alert("Sai mật khẩu")';
                            echo '</script>';
                        }
                    }
                
            }

        }

?>

<link rel="stylesheet" href="<?=$baseUrl?>assets/css/custom.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="breadcrumb_bg">
    <div class="breadcrumb-box-img">
        <img src="<?=$baseUrl?>assets/img/bg_breadcrumb.png" alt="">
    </div>
    <div class="title-full">
        <div class="container">
            <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
            <p class="title-page">Tài khoản</p>
        </div>
    </div>
</div>
<div class="main">
    <form action="index.php" method="post">
        <div class="container" style="margin-top: 60px;">
            <div class="row">
                <div class="col-6 mt-4">
                    <div class="form-input">
                        <label for="">Họ tên</label>
                        <input type="text"  name="fullname" class="form-input-item">
                        <input type="text"  name="id" class="form-input-item">
                    </div>
                </div>
                <div class="col-6 mt-4">
                    <div class="form-input">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-input-item">
                    </div>
                </div>
                <div class="col-6 mt-4">
                    <div class="form-input">
                        <label for="">Nhập mật khẩu cũ</label>
                        <input type="password" name="old_password" class="form-input-item">
                    </div>
                </div>
                <div class="col-6 mt-4">
                    <div class="form-input">
                        <label for="">Nhập mật khẩu mới</label>
                        <input type="password" name="password" class="form-input-item">
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-center justify-content-center">
                <div class="new-letter-btn mt-4">
                    <button class="button_gradient" name="capnhat" type="submit">Cập nhật</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
    include_once $baseUrl.'layouts/footer.php';
?>