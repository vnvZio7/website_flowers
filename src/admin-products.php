<?php

@include("../DB/connection.php");

$products = mysqli_query($conn, "SELECT f.*,c.name as c_name FROM `flowers` f join categories c on f.category_id = c.category_id") or die('query failed');
$categories = mysqli_query($conn, "SELECT * FROM `categories`") or die('query failed');

if ($_POST['action'] === 'p-add') {
    $name = $_POST['name'];
    $des = $_POST['des'];
    $price = $_POST['price'];
    $dis = $_POST['dis'];
    $quan = $_POST['quan'];
    // $image = $_POST['image'];
    $category = $_POST['category'];
    // Xử lý ảnh (nếu có)
    // $image = null;
    echo "bắt đầu ảnh";
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folter = '../images/img_products/'.$image;
    move_uploaded_file($image_tmp_name, $image_folter);
    echo $name;
    echo $des;
    echo $dis;
    // echo $image;
    // // Thêm danh mục mới
    // $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    // $stmt->bind_param("s", $categoryName);

    // if ($stmt->execute()) {
    //     echo json_encode(['success' => true]);
    // } else {
    //     echo json_encode(['success' => false, 'error' => $stmt->error]);
    // }

    // exit; // Dừng thực thi
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body>

    <div class="popup flex non-display" id="productPopup">
        <div class="bgr">
        <h4>Nhập đầy đủ thông tin sản phẩm: </h4>
            <form action="" method="post">
                <div style="width: 100%;"><input style="width: 100%;" type="text" name="name" id="productName" placeholder="Tên sản phẩm "></div>
                <div style="width: 100%;"><input style="width: 100%;" type="text" name="des" id="productDes" placeholder="Mô tả "></div>
                <div class="flex input">
                    <input type="text" id="productPrice" name="price" placeholder="Giá " require>
                    <input type="text" id="productDis" name="dis" placeholder="Giảm giá (%)" require>
                    <input type="text" id="productQuan" name="quan" placeholder="Số lượng" require>
                </div>
                <div class="image">
                    <img id="productImg"  src=""  alt="">
                    <input id="productNameImg" type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
                </div>
                <select id="category" name="category">
                    <?php 
                    $i = 0;
                    while ($category = mysqli_fetch_assoc($categories)) {
                        echo '<option value="'.$category['category_id'].'" '.($i == 0 ? "selected" : "").' >'.$category['name'].'</option>';
                        $i++;
                    }
                    
                    ?>
                </select>
                <input type="hidden" name="action" id="action" value="p-add">
                <br>
                <div class="flex">
                    <button type="submit" id="submitButton">Thêm mới</button>
                    <button type="button" id="cancelButton">Hủy</button>
                </div>
            </form>
        </div>
    </div>
    <?php @include("admin-header.php") ?>
        <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Tìm kiếm theo tên sản phẩm </h4>
                    </div>
                    <div>
                        <input type="text" name="" class="search" id="search-product" placeholder="Tìm kiếm...">
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
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Giá gốc</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="product-items">
                                    <?php 
                                        $i = 1;
                                        foreach ($products as $products):
                                            echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$products['name'].'</td>
                                            <td>'.$products['description'].'</td>
                                            <td><img class="row-image" src="../images/img_products/'.$products['image_url'].'" alt="'.$products['image_url'].'"></td>
                                            <td>'.(int)$products['price'].' <span>đ</span></td>
                                            <td>'.$products['discount'].'</td>
                                            <td>'.$products['stock'].'</td>
                                            <td>'.$products['name'].'</td>
                                            <td>
                                                <button data-id="'.$products['flower_id'].'" data-name="'.$products['name'].'" data-des="'.$products['description'].'" data-price="'.$products['price'].'" data-dis="'.$products['discount'].'" data-quan="'.$products['stock'].'" data-category="'.$products['category_id'].'" data-img="'.$products['image_url'].'" class="update" type="submit">Cập nhật</button>
                                                <button data-id="'.$products['flower_id'].'" class="del" type="submit">Xóa</button>
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
    <script src="../js/admin-products.js"></script>
</body>

</html>
