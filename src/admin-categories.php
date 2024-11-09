<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
</head>

<body>

    <div class="popup flex non-display">
        <div class="bgr">
            <h4>Nhập tên danh mục: </h4>
            <input type="text" name="" id="">
            <div class="flex">
                <button type="submit">Thêm mới</button>
                <button >Hủy</button>
            </div>
        </div>
    </div>
    <div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Flowers</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link"><i class="fa-solid fa-file-lines pe-2"></i>
                            Quản lý hoa
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link active"><i class="fa-solid fa-file-lines pe-2"></i>
                            Quản lý danh mục
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" ><i class="fa-solid fa-sack-dollar pe-2"></i>
                            Quản lý hóa đơn
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" ><i class="fa-regular fa-envelope pe-2"></i>
                            Thông báo
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Tìm kiếm theo tên danh mục</h4>
                    </div>
                    <div>
                        <input type="text" name="" id="search-category" placeholder="Tìm kiếm...">
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
                                <tbody>
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
                                            <button id="update" type="submit">Cập nhật</button>
                                            <button id="del" type="submit">Xóa</button>
                                        </td>
                                        </tr>
                                        ';
                                        $i++;
                                        endforeach;
                                    ?>
                                    <!-- <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>
                                            <button id="update" type="submit">Cập nhật</button>
                                            <button id="del" type="submit">Xóa</button>
                                        </td>
                                    </tr> -->
                                    
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
