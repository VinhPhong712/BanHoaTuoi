<?php
  // Đảm bảo rằng $baseUrl trỏ tới thư mục gốc của ứng dụng
  $baseUrl = 'D:/ThucHanhLT-Web/myweb/admin/'; // Điều chỉnh lại đường dẫn này theo đúng cấu trúc thư mục của bạn
session_start();
include_once $baseUrl.'../utils/ulitity.php'; // Đảm bảo đường dẫn chính xác
require_once $baseUrl.'../database/dbhelper.php'; // Đảm bảo đường dẫn chính xác

  if($_SESSION['email']) {
      $email = $_SESSION['email'];
      $sql = "SELECT role_id FROM users WHERE email = '$email'";
      $data = executeResult($sql,1);
      if($data['role_id'] == 1) {
         echo '123';
      } else {
          header('Location: ../');
      }
  } else {
    header('Location: ../');
  }
?>


<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="https://gokisoft.com/uploads/2021/03/s-568-ico-web.jpg" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?=$baseUrl?>../assets/css/dashboard.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">BÁN HOA</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Tìm kiếm" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    <a class="nav-link" href="/account/logout.php">Thoát</a>

  </ul>
</nav>	
<div class="container-fluid" style="margin-top: 60px;">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="<?=$baseUrl?>">
              <i class="bi bi-house-fill"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="/admin/product/index.php">
              <i class="bi bi-file-earmark-text"></i>
              Sản Phẩm
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/order/index.php">
              <i class="bi bi-people-fill"></i>
              Quản Lý đơn hàng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/feedback/index.php">
              <i class="bi bi-people-fill"></i>
              Quản lý tài khoản
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/category/index.php">
              <i class="bi bi-people-fill"></i>
              Quản lý danh mục
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/statistics/index.php">
              <i class="bi bi-people-fill"></i>
              Thống kê Doanh thu
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <!-- hien thi tung chuc nang cua trang quan tri START-->