<?php 
    @include("../DB/connection.php");
    // Lấy danh mục sản phẩm
    session_start();
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $limit = 4; // Số sản phẩm trên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $totalResult = $conn->query("SELECT COUNT(*) as count FROM flowers where name LIKE '%$search%'");
        $totalCount = $totalResult ? $totalResult->fetch_assoc()['count'] : 0;
        $totalPages = ceil($totalCount / $limit); // Tính tổng số trang

        // Truy vấn sản phẩm theo danh mục với phân trang
        $sql = "SELECT * FROM flowers where name LIKE '%$search%' LIMIT $limit OFFSET $offset";
        $result = $conn->query($sql);

        $products1 = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $products1[] = $row;
            }
        }
    }
    $sql3 = "SELECT flower_id FROM favourites where user_id = $user_id"; // Thay đổi tên bảng nếu cần
    $result3 = $conn->query($sql3);

    // Mảng chứa ID sản phẩm
    $fv = [];

    if ($result3->num_rows > 0) {
        // Lặp qua từng hàng và thêm ID vào mảng
        while ($row = $result3->fetch_assoc()) {
            $fv[] = $row['flower_id'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/trangchu.css">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/favourite.css">
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

    <title>Tìm kiếm</title>
</head>

<body>
    <?php @include("header.php");?>
    <!-- all products section starts -->

    <section>
        <div class="all-products" id="refresh">
            <?php if ($products1): ?>   
                <h3>Có <?php echo $totalCount;?> sản phẩm được tìm thấy.</h3>   
            <div class="row row-cols-4">
                <?php foreach($products1 as $product):?>
                    <div class="col-6 col-md-4 col-lg-3 col-fix swiper-slide">
                    <div class="box">
                        <?php if($product['discount'] > 0){
                            echo '<span class="discount">'.$product['discount'].'%</span>';
                        }?>
                        <?php
                        echo '<div class="image">
                            <img src="../images/img_products/'.$product['image_url'].'" alt="">
                            <div class="icons">
                                <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-heart '.(in_array($product['flower_id'],$fv) ? "fv-active" : "").'"></a>
                                <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Add to cart</a>
                                <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-search" title="Xem nhanh"></a>
                            </div>
                        </div>';
                        ?>
                        <div class="content">
                        <?php echo '<a href="product-details.php?id='.$product['flower_id'].'">';?>
                                        <h3><?php echo $product['name'];?></h3>
                                    </a>
                            <div class="price"> <?php echo $product['price'] * ($product['discount']/100 + 1);?><span>đ</span>
                                                    <?php if($product['discount'] > 0){
                                                        echo '<div class="span"><span>'.$product['price'].'<span>đ</span></span></div>';
                                                    }?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            
            </div>
            <div class="pagenav">
                <nav class="collection-paginate clearfix relative nav_pagi w_100">
                    <ul class="pagination clearfix" id="pagination">
                        <?php if($page > 1) echo '<li><a data-search="'.$search.'" data-page="1" href="#" class="page-item">«</a></li>';?>
                        <?php
                        // Hiển thị liên kết phân trang
                        for ($i = 1; $i <= $totalPages; $i++) {
                            // echo '<a href="?page=' . $i . '" class="' . ($i === $page ? 'page-active' : '') . '">' . $i . '</a>';
                            echo '<li><a data-search="'.$search.'" data-page="'.$i.'" href="#" class="page-item '.($i === $page ? 'page-active' : '') .'">'.$i.'</a></li>';
                        }
                        ?>
                        <?php if($page < $totalPages) echo '<li><a data-search="'.$search.'" data-page="'.$totalPages.'" href="#" class="page-item">»</a></li>';?>
                    </ul>
                </nav>
            </div>
            <?php else: ?>
                <h3>Không có sản phẩm nào.</h3>
            <?php endif; ?>

        </div>
    </section>

    <!-- all products section ends -->


    <?php @include("footer.php");?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>


</body>

</html>