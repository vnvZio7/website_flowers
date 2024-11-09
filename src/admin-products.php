<?php

@include("../DB/connection.php");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

$products = mysqli_query($conn, "SELECT * FROM `flowers`") or die('query failed');

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
    <link rel="stylesheet" href="../css/admin-products.css">
</head>

<body>

    <div class="popup flex non-display">
        <div class="bgr">
            <h4>Nhập đầy đủ thông tin sản phẩm: </h4>
            <input type="text" name="" id="" placeholder="Tên sản phẩm ">
            <input type="text" name="" id="" placeholder="Mô tả ">
            <div class="flex input">
                <input type="text" name="" id="" placeholder="Giá ">
                <input type="text" name="" id="" placeholder="Giảm giá (%)">
                <input type="text" name="" id="" placeholder="Số lượng">
            </div>
            <select name="" id="" >
                <option value="" selected>Hoa cưới</option>
                <option value="">Hoa A</option>
                <option value="">Hoa B</option>
                <option value="">Hoa C</option>
            </select>
            <br>
            <div class="flex">
                <button type="submit">Thêm mới</button>
                <button >Hủy</button>
            </div>
        </div>
    </div>
    <?php @include("admin-header.php") ?>
        <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Tìm kiếm theo tên sản phẩm </h4>
                    </div>
                    <div>
                        <input type="text" name="" id="search-category" placeholder="Tìm kiếm...">
                        <button id="add">Thêm</button>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách sản phẩm
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">id</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Giá gốc</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i = 1;
                                        foreach ($products as $products):
                                            $category_id = $products['category_id'];
                                            $select_category = mysqli_query($conn, "SELECT * FROM `categories` WHERE category_id = '$category_id'") or die('query failed');
                                            $row = mysqli_fetch_assoc($select_category);
                                            echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$products['flower_id'].'</td>
                                            <td>'.$products['name'].'</td>
                                            <td>'.$products['description'].'</td>
                                            <td>'.(int)$products['price'].' <span>đ</span></td>
                                            <td>'.$products['discount'].'</td>
                                            <td>'.$products['stock'].'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>
                                                <button id="update" type="submit">Cập nhật</button>
                                                <button id="del" type="submit">Xóa</button>
                                            </td>
                                        </tr>
                                        ';
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
