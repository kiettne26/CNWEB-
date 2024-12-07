<?php
// db.php
$host = 'localhost'; // Thay đổi nếu cần
$dbname = 'bth1'; // Tên cơ sở dữ liệu
$username = 'root'; // Tên người dùng cơ sở dữ liệu
$password = ''; // Mật khẩu (nếu có)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Kết nối thất bại: ' . $e->getMessage();
}
?>
