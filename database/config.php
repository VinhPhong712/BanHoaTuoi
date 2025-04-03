<?php
$host = getenv("mysql.railway.internal");
$user = getenv("root");
$pass = getenv("ZoloNNImfLiTeGzTAmDNpXPnObGceJDX");
$dbname = getenv("railway");

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

?>
