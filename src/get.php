<?php
@include("../DB/connection.php");
$sql = "SELECT name FROM flowers LIMIT 1"; // Ví dụ lấy sản phẩm đầu tiên
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo $row['name']; // Trả về tên sản phẩm
} else {
    echo "Không có sản phẩm nào.";
}

?>