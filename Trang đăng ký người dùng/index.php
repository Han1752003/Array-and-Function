<?php
$nameError = $emailError = $phoneError = "";
$name = $email = $phone = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    if (empty($name)) {
        $nameError = "Tên không được để trống.";
    }
    if (empty($email)) {
        $emailError = "Email không được để trống.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Email không hợp lệ.";
    }
    if (empty($phone)) {
        $phoneError = "Điện thoại không được để trống.";
    }
    if (empty($nameError) && empty($emailError) && empty($phoneError)) {
        if (saveDataJSON('users.json', $name, $email, $phone)) {
            echo "<script>alert('Đăng ký thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi khi lưu dữ liệu!');</script>";
        }
    }
}
function saveDataJSON($filename, $name, $email, $phone) {
    $data = json_decode(file_get_contents($filename), true) ?: [];
    $contact = [
        'name'=> $name,
        'email' => $email,
        'phone'=> $phone
    ];
    $data[] = $contact;
    return file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT)) !== false;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký người dùng</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: whitesmoke;
                color: whitesmoke;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(1, 1, 1, 1);
            
        }   
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        h2 {
            text-align: center;
            color: red;
        }
        input[type="text"],
        input[type="email"],
        input[type="phone"] {
            width: 95%;
            padding: 10px;
            margin: 10px 0;
            border:0 solid;
            border-radius: 5px;
            box-shadow: 0 1px 5px rgba(1, 1, 1, 0.5);
        }
        button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            background-color: red;
            color: whitesmoke;
            font-size: 15px;
        }
        button:hover {
            background-color: rosybrown;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>ĐĂNG KÝ NGƯỜI DÙNG</h2>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Tên người dùng" value="<?php echo htmlspecialchars($name)?>">
            <div class="error"><?php echo $nameError; ?></div>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email)?>">
            <div class="error"><?php echo $emailError; ?></div>
            <input type="phone" name="phone" placeholder="Số điện thoại" value="<?php echo htmlspecialchars($phone)?>">
            <div class="error"><?php echo $phoneError; ?></div>
            <button type="submit">Đăng ký</button>
        </form>
        
    </div>
</body>
</html>