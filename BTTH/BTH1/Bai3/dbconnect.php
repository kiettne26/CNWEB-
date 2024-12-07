<?php
$servername = "localhost";
$username = "root";  // Thay đổi theo thông tin của bạn
$password = "";  // Thay đổi theo mật khẩu của bạn
$dbname = "bth1";  // Thay đổi tên CSDL của bạn

// Kết nối đến CSDL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
