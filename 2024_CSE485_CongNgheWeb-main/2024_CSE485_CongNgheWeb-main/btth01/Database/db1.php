<?php
$host = '127.0.0.1';
$db   = 'btth01_cse485';
$user = 'root';  // Tên người dùng MySQL
$pass = '';  // Mật khẩu MySQL
$charset = 'utf8mb4';
$port = '3307';//mặc định là 3306 còn đâu nó đổi thì mở xampp chỗ cột "Port" của MySql 

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    //echo "<script>alert('Kết nối thành công');</script>";
    
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>