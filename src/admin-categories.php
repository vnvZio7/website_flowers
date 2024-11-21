<?php 
@include("../DB/connection.php");


?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
</head>

<body>

    <div class="popup flex non-display" id="productPopup">
        <div class="bgr">
            <h4>Nhập tên danh mục:</h4>
            <input type="text" id="categoryName" placeholder="Tên danh mục">
            <div class="flex">
                <button type="button" id="submitButton">Thêm mới</button>
                <button type="button" id="cancelButton">Hủy</button>
            </div>
        </div>
    </div>
    <?php @include("admin-header.php") ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Tìm kiếm theo tên danh mục</h4>
                    </div>
                    <div>
                        <input type="text" name="" class="search" id="search-category" placeholder="Tìm kiếm...">
                        <button id="add">Thêm</button>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách danh mục
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">id</th>
                                        <th scope="col">Tên danh mục</th>
                                        <th scope="col">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id='categorys'>
                                    <?php 
                                        @include '../DB/connection.php';
                                        $categories = mysqli_query($conn, "SELECT * FROM `categories`") or die('query failed');
                                        $i = 1;
                                        foreach ($categories as $category):
                                            echo '<tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$category['category_id'].'</td>
                                            <td>'.$category['name'].'</td>
                                        <td>
                                            <button data-name="'.$category['name'].'" data-id="'.$category['category_id'].'" class="update">Cập nhật</button>
                                            <button data-id="'.$category['category_id'].'" class="del" type="submit">Xóa</button>
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
    <script src="../js/admin-category.js"></script>
</body>

</html>
