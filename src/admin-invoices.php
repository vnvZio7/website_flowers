<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hóa đơn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
    <link rel="stylesheet" href="../css/admin-products.css">
</head>

<body>

    <div class="popup flex non-display">
        <div class="bgr" style="background-color: rgb(216, 227, 237);">
            <h4 style="font-weight: bold;padding: 20px 0;">Thông tin chi tiết về hóa đơn</h4>
            <div class="card border-0">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Discount(%)</th>
                                <th scope="col">Giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Hoa cưới</td>
                                <td>3</td>
                                <td>15 <span>%</span></td>
                                <td>1.000.000 <span>đ</span></td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Hoa cưới</td>
                                <td>3</td>
                                <td>15 <span>%</span></td>
                                <td>1.000.000 <span>đ</span></td>
                            </tr><tr>
                                <th scope="row">1</th>
                                <td>Hoa cưới</td>
                                <td>3</td>
                                <td>15 <span>%</span></td>
                                <td>1.000.000 <span>đ</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <button>Đóng</button>
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
                        <a href="#" class="sidebar-link"><i class="fa-solid fa-file-lines pe-2"></i>
                            Quản lý danh mục
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link active" ><i class="fa-solid fa-sack-dollar pe-2"></i>
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
                        <h4>Tìm kiếm theo người dùng hoặc số điện thoại</h4>
                    </div>
                    <div>
                        <input type="text" name="" id="search-category" placeholder="Tìm kiếm...">
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                Danh sách hóa đơn
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">id</th>
                                        <th scope="col">Tổng hóa đơn</th>
                                        <th scope="col">Thời gian tạo</th>
                                        <th scope="col">Tên người dùng</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                        @include '../DB/connection.php';
                                        $invoices = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                                        $i = 1;
                                        foreach ($invoices as $invoices):
                                            $user_id = $invoices['user_id'];
                                            $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE user_id = '$user_id'") or die('query failed');
                                            $row = mysqli_fetch_assoc($select_user);
                                            echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$invoices['order_id'].'</td>
                                        <td>'.$invoices['total_amount'].'<span>đ</span></td>
                                        <td>'.$invoices['created_at'].'</td>
                                        <td>'.$row['name'].'</td>
                                        <td>'.$invoices['address'].'</td>
                                        <td>
                                            <button>Xem</button>
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