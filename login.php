<?php
session_start();
require 'db.php'; // Đảm bảo file này kết nối đúng DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Bảo mật bằng chuẩn bị câu lệnh
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // So sánh mật khẩu (đơn giản)
        if ($password == $row['password']) {
            $_SESSION['username'] = $username;
            header("Location: wed.html"); 
            exit();
        } else {
            echo "Sai mật khẩu!";
        }
    } else {
        echo "Tài khoản không tồn tại!";
    }

    $stmt->close();
}
?>
