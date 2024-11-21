<?php
    @include("../DB/connection.php");
    $invoicesDetails = [];
    if(isset($_GET['id_x'])){
        $id = (int)$_GET['id_x'];
        $invoicesDetailsResult = $conn->query("SELECT f.*,o.quantity,o.price as o_price FROM order_items o join flowers f on f.flower_id = o.flower_id where o.order_id = $id");
        if ($invoicesDetailsResult && $invoicesDetailsResult->num_rows > 0) {
            while($row = $invoicesDetailsResult->fetch_assoc()) {
                $invoicesDetails[] = $row;
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý hóa đơn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin-categories.css">
    <link rel="stylesheet" href="../css/admin-products.css">
</head>

<body>

    <div class="popup flex non-display" id="form-info">
        <div class="bgr" style="background-color: rgb(216, 227, 237);">
            <?php if($invoicesDetails){?>
                <h4 style="font-weight: bold;padding: 20px 0;">Thông tin chi tiết về hóa đơn</h4>
                <div class="card border-0">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá gốc</th>
                                    <th scope="col">Discount(%)</th>
                                    <th scope="col">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach($invoicesDetails as $invoice):?>
                                    <tr>
                                        <th scope="row"><?php echo $i;?></th>
                                        <td><?php echo $invoice['name'];?></td>
                                        <td><?php echo $invoice['quantity'];?></td>
                                        <td><?php echo $invoice['price'] * 1;?><span>đ</span></td>
                                        <td><?php echo $invoice['discount'];?><span>%</span></td>
                                        <td><?php echo $invoice['o_price'] * 1;?><span>đ</span></td>
                                    </tr>
                                <?php $i++;
                                 endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php }?>
            <button id="close">Đóng</button>
        </div>
    </div>
    <?php @include("admin-header.php") ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Tìm kiếm theo người dùng hoặc số điện thoại</h4>
                    </div>
                    <div>
                        <input type="text" name="" class="search" id="search-invoices" placeholder="Tìm kiếm...">
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
                                        <th scope="col">Số điện thoại</th>
                                        <th scope="col">Địa chỉ</th>
                                        <th scope="col">Lựa chọn</th>
                                    </tr>
                                </thead>
                                <tbody id="invoices">
                                <?php 
                                        @include '../DB/connection.php';
                                        $invoices = mysqli_query($conn, "SELECT * FROM orders o join users u on o.user_id = u.user_id") or die('query failed');
                                        $i = 1;
                                        foreach ($invoices as $invoices):
                                            $user_id = $invoices['user_id'];
                                            echo '<tr>
                                        <th scope="row">'.$i.'</th>
                                        <td>'.$invoices['order_id'].'</td>
                                        <td>'.$invoices['total_amount'].'<span>đ</span></td>
                                        <td>'.$invoices['created_at'].'</td>
                                        <td>'.$invoices['name'].'</td>
                                        <td>'.$invoices['phone_number'].'</td>
                                        <td>'.$invoices['address'].'</td>
                                        <td>
                                            <button class="btn-click" data-id="'.$invoices['order_id'].'" >Xem</button>
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
    <script src="../js/admin-invoices.js"></script>
</body>

</html>
