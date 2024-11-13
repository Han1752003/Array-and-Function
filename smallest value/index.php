<?php
    // Giả sử phần tử đầu tiên là nhỏ nhất
    $arr = [3,5,2,7,4,1];
    $min = $arr[0];
    $index = 0;

    // Duyệt mảng từ phần tử thứ 2 đến hết mảng
    for ($i = 1; $i < count($arr); $i++) {
        if ($arr[$i] < $min) {
            $min = $arr[$i]; // Cập nhật giá trị nhỏ nhất
            $index = $i;     // Cập nhật vị trí của giá trị nhỏ nhất
        }
    }
// Gọi phương thức và lấy vị trí của phần tử nhỏ nhất
$minIndex = $index;

// In kết quả
echo "Vị trí của phần tử nhỏ nhất là: " . $minIndex . "<br>";
echo "Giá trị nhỏ nhất là: " . $arr[$minIndex] . "<br>";
?>