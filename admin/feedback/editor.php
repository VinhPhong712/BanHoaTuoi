<?php   
    $title = "Sửa tài khoản";
    $baseUrl = '../';
    require_once('../layouts/header.php');
    $id = $userItem = $fullName = $email = $password = '';

    require_once('./form_save.php');
    $id = getGet('id');

    if($id != null && $id > 0) {
        $sql = "select * from users where id = '$id'";
        $userItem = executeResult($sql,true);
        if($userItem != null) {
            $fullName = $userItem['fullname'];
            $email = $userItem['email'];
            $password = $userItem['password'];
          
        }
        else {
            $id = 0;
        }
    }else {
        $id = 0;
    }

    
?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<!-- <script src="../../ckfinder/ckfinder.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<div class="row">
	<div class="col-md-12" style="margin: 30px 0;">
		<h3>Sửa tài khoản</h3>
        <div class="panel panel-primary">
            <div class="panel-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Tên tài khoản:</label>
                        <input type="text" required="true" class="form-control" name="fullName" value="<?=$fullName?>" placeholder="Nhập tên tài khoản">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Email:</label>
                        <input type="text" required="true" class="form-control" name="email" value="<?=$email?>" placeholder="Nhập tên tài khoản">
                    </div>
                    <div class="form-group">
                        <label for="" style="font-weight: bold;">Password:</label>
                        <input type="password" required="true" class="form-control" name="password" value="<?=$password?>" placeholder="Nhập tên tài khoản">
                        <input type="text" class="form-control" name="id" value="<?=$id?>" hidden="true" >
                    </div>

                    <button type="submit" class="btn btn-success">Lưu</button>
                </form>
            </div>
        </div>
	</div>
</div>