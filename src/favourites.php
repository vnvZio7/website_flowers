<?php 
    @include("../DB/connection.php");
    // Lấy danh mục sản phẩm
    session_start();
    $user_id = $_SESSION['user_id'];
    if(isset($_GET['id']) || isset($_GET['del_id'])){
        if(isset($_GET['id'])){
            $id = (int)$_GET['id'];
            $stmt = $conn->prepare("INSERT INTO favourites (flower_id,user_id) VALUES (?,?)");
        }
        if(isset($_GET['del_id'])){
            $id = (int)$_GET['del_id'];
            $stmt = $conn->prepare("DELETE FROM favourites WHERE flower_id = ? and user_id = ?");
        }
        $stmt->bind_param("ii", $id, $user_id);
        $stmt->execute();
    }
    // $favouriteResult = $conn->query("SELECT * FROM favourites where user_id = " + $user_id);
    // $favourites = [];
    // if ($favouriteResult && $favouriteResult->num_rows > 0) {
    //     while($row = $favouriteResult->fetch_assoc()) {
    //         $favourites[] = $row;
    //     }
    // }
    $limit = 4; // Số sản phẩm trên mỗi trang
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $totalResult = $conn->query("SELECT COUNT(*) as count FROM favourites where user_id = $user_id");
    $totalCount = $totalResult ? $totalResult->fetch_assoc()['count'] : 0;
    $totalPages = ceil($totalCount / $limit); // Tính tổng số trang

    // Truy vấn sản phẩm theo danh mục với phân trang
    $sql = "SELECT p.* FROM flowers p join favourites f on p.flower_id = f.flower_id where f.user_id = $user_id LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    $products1 = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products1[] = $row;
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

    <title>Sản phẩm yêu thích</title>
</head>

<body>
    <?php @include("header.php");?>
    <!-- all products section starts -->

    <section>
        <div class="all-products" id="refresh">
            <div class="row row-cols-4">
            <?php if ($products1): ?>      
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
                                <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-heart fv-active"></a>
                                <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Thêm vào giỏ</a>
                                <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-search" title="Xem nhanh"></a>
                            
                            </div>
                        </div>';
                        ?>
                        <div class="content">
                            <?php echo '<a href="product-details.php?id='.$product['flower_id'].'">';?>
                                <h3><?php echo $product['name'];?></h3>
                            </a>
                            <div class="price"> <?php echo $product['price'] * (1- $product['discount']/100);?><span>đ</span>
                                                    <?php if($product['discount'] > 0){
                                                        echo '<div class="span"><span>'.$product['price'].'<span>đ</span></span></div>';
                                                    }?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            <?php else: ?>
                <h3>Không có sản phẩm nào.</h3>
            <?php endif; ?>
            </div>
            <div class="pagenav">
                <nav class="collection-paginate clearfix relative nav_pagi w_100">
                    <ul class="pagination clearfix" id="pagination">
                        <?php if($page > 1) echo '<li><a data-page="1" href="#" class="page-item">«</a></li>';?>
                        <?php
                        // Hiển thị liên kết phân trang
                        for ($i = 1; $i <= $totalPages; $i++) {
                            // echo '<a href="?page=' . $i . '" class="' . ($i === $page ? 'page-active' : '') . '">' . $i . '</a>';
                            echo '<li><a data-page="'.$i.'" href="#" class="page-item '.($i === $page ? 'page-active' : '') .'">'.$i.'</a></li>';
                        }
                        ?>
                        <?php if($page < $totalPages) echo '<li><a data-page="'.$totalPages.'" href="#" class="page-item">»</a></li>';?>
                    </ul>
                </nav>
            </div>

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