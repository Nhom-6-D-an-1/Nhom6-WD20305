<?php
require './configs/env.php';
require './configs/helper.php';

$conn = connectDB();

$hash = password_hash("123456", PASSWORD_DEFAULT);

$sql = "UPDATE users SET password_hash = :hash WHERE username = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->execute([':hash' => $hash]);

echo "Đã cập nhật mật khẩu admin thành công!<br>";
echo "Hash mới: " . $hash;
