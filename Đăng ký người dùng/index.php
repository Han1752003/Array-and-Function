<?php
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username)) {
        $message = 'Tên người dùng không được để trống.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Email không hợp lệ.';
    } elseif (empty($password) || strlen($password) < 8) {
        $message = 'Mật khẩu phải có ít nhất 8 ký tự.';
    } else {
        if (saveDataJSON('users.json', $username, $email, $password)) {
            $message = 'Đăng ký thành công!';
        } else {
            $message = 'Có lỗi xảy ra khi lưu dữ liệu.';
        }
    }
}

function saveDataJSON($filename, $username, $email, $password) {
    $data = json_decode(file_get_contents($filename), true) ?? [];
    $data[] = ['username' => $username, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)];
    return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký</title>
</head>
<body>

<h2>Đăng Ký Người Dùng</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Tên người dùng" required>
    <br>
    <input type="email" name="email" placeholder="Email" required>
    <br>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <br>
    <button type="submit">Đăng Ký</button>
</form>
<div><?php echo $message; ?></div>

</body>
</html>