<?php
    @include("../DB/connection.php");
    $messageResult = $conn->query("SELECT * FROM message");
    $message = [];
    if ($messageResult && $messageResult->num_rows > 0) {
        while($row = $messageResult->fetch_assoc()) {
            $message[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
    <link rel="stylesheet" href="../css/admin-products.css">
</head>

<body>

    <div class="popup flex non-display">
        <div class="bgr">
            <h4>Nhập đầy đủ thông tin dưới đây: </h4>
            <h5>Tên người dùng: </h5>
            <input type="text" name="" id="" placeholder="Tên người dùng">
            <h5>Email: </h5>
            <input type="text" name="" id="" placeholder="Email">
            <h5>Mật khẩu: </h5>
            <div class="bgr-pw">
                <input type="password" name="" id="" placeholder="Mật khẩu">
                <button class="btn-eye flex" onclick="btn_eye()" ><i id="btn-eye" class="fa-solid fa-eye"></i></button>
            </div>
            <div class="flex">
                <button class="non-display" type="submit">Cập nhật</button>
                <button type="submit">Thêm mới</button>
                <button >Hủy</button>
            </div>
        </div>
    </div>
    <?php @include("admin-header.php") ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách tin nhắn phản hồi từ khách hàng 
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên người dùng</th>
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tin nhắn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i=1;
                                    foreach($message as $message):
                                        echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$message['name'].'</td>
                                        <td>'.$message['phone_number'].'</td>
                                        <td>'.$message['email'].'</td>
                                        <td>'.$message['message'].'</td>
                                    </tr>';
                                    $i++;
                                    endforeach; 
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
           
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/admin.js"></script>
</body>

</html>
