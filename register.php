<?php
require 'db.php';
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_BCRYPT);
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
  echo json_encode(["message" => "Tên đăng nhập đã tồn tại"]);
} else {
  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password);
  $stmt->execute();
  echo json_encode(["message" => "Đăng ký thành công"]);
}
?>