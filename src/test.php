<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối cho phù hợp)
@include("../DB/connection.php");

// Hàm lấy thông tin sản phẩm (có thể gọi qua AJAX)
function getProduct() {
    global $conn;
    $sql = "SELECT name FROM flowers LIMIT 1"; // Ví dụ lấy sản phẩm đầu tiên
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['name']; // Trả về tên sản phẩm
    } else {
        return "Không có sản phẩm nào.";
    }
}

// Nếu có yêu cầu AJAX
if (isset($_GET['action']) && $_GET['action'] === 'get_product') {
    echo getProduct();
    exit; // Ngừng thực thi để tránh gửi thêm HTML
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Thêm Sản Phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        .close-btn {
            cursor: pointer;
            color: red;
        }
    </style>
</head>
<body>

<button id="addProductBtn">Thêm Sản Phẩm</button>

<div id="productPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopup()">×</span>
        <h2>Thông Tin Sản Phẩm</h2>
        <div id="productDetails"></div>
    </div>
</div>

<script>
    function openPopup(product) {
        document.getElementById('productDetails').innerText = product;
        document.getElementById('productPopup').style.display = 'flex';
    }

    function closePopup() {
        document.getElementById('productPopup').style.display = 'none';
    }

    document.getElementById('addProductBtn').onclick = function() {
        // Gọi AJAX để lấy thông tin sản phẩm
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '?action=get_product', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                openPopup(xhr.responseText);
            }
        };
        xhr.send();
    };
</script>

</body>
</html>