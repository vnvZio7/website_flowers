<?php
    @include("../DB/connection.php");
    // Lấy danh mục sản phẩm
    $categoryResult = $conn->query("SELECT * FROM categories");
    $categories = [];
    if ($categoryResult && $categoryResult->num_rows > 0) {
        while($row = $categoryResult->fetch_assoc()) {
            $categories[] = $row;
        }
    }

    // Kiểm tra xem có yêu cầu category_id không
    $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;
    $limit = 6; // Số sản phẩm trên mỗi trang
    $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Truy vấn tổng số sản phẩm trong danh mục
    $totalResult = $conn->query("SELECT COUNT(*) as count FROM flowers WHERE category_id = $category_id");
    $totalCount = $totalResult ? $totalResult->fetch_assoc()['count'] : 0;
    $totalPages = ceil($totalCount / $limit); // Tính tổng số trang

    // Truy vấn sản phẩm theo danh mục với phân trang
    $sql = "SELECT * FROM flowers WHERE category_id = $category_id ORDER BY $sort_by $sort_order LIMIT $limit OFFSET $offset";
    echo $sql;
    $result = $conn->query($sql);

    $products = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
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
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <script src="../js/trangchu.js"></script>
    <script src="../js/header.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

    <title>Tất cả sản phẩm</title>
</head>

<body>
    <?php @include('header.php');?>

    <!-- danhmuc section starts -->

    <section class="danhmuc">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-1.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa văn phòng</h3>
                    <a href="#">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-2.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa hội nghị</h3>
                    <a href="#">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-3.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa để bàn</h3>
                    <a href="#">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-4.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa khác</h3>
                    <a href="#">Xem ngay</a>
                </div>
            </div>
        </div>

    </section>

    <!-- danhmuc section ends -->

    <!-- all products section starts -->

    <section>
        <div class="all-products" id="view">
            <div class="title-heading">
                <a href="">
                    <h3 class="h3-heading">Tất cả sản phẩm</h3>
                </a>
                <div class="img-heading">
                    <img src="../images/iconHeading.png" alt="">
                </div>
            </div>
            <div class="row">
                <div class="sidebar col-lg-3 p-15">
                    <div class="sidebar--content">
                        <div class="title">Danh mục sản phẩm</div>
                        <nav class="category" id="category-list">
                            <ul>
                                <?php
                                    foreach($categories as $category):
                                        echo '<li class="nav-item"><a data-sort="'.$sort_order.'" data-sort-by="'.$sort_by.'" class="category-link" data-category-id="'.$category['category_id'].'" href="#">'.$category['name'].'</a></li>';
                                    endforeach;    
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="block-collection col-lg-9 p-15" id="refresh">
                    <div class="sort">
                        <div class="flex left">
                            <p class="title">Sắp xếp theo: </p>
                            <ul class="flex">
                                <li><button data-category-id="<?php echo $category_id;?>" href="" class="item sort-by <?php if($sort_order === "asc" && $sort_by === "name") echo "sort-active";?>" data-sort="asc" data-sort-by="name">Tên A-Z </button></li>
                                <li><button data-category-id="<?php echo $category_id;?>" href="" class="item sort-by <?php if($sort_order === "desc" && $sort_by === "name") echo "sort-active";?>" data-sort="desc" data-sort-by="name">Tên Z-A </button></li>
                                <li><button data-category-id="<?php echo $category_id;?>" href="" class="item sort-by <?php if($sort_order === "desc" && $sort_by === "price") echo "sort-active";?>" data-sort="desc" data-sort-by="price">Giá cao đến thấp</button></li>
                                <li><button data-category-id="<?php echo $category_id;?>" href="" class="item sort-by <?php if($sort_order === "asc" && $sort_by === "price") echo "sort-active";?>" data-sort="asc" data-sort-by="price">Giá thấp đến cao</button></li>
                            </ul>
                        </div>
                    </div>
                    <div class="">
                        <div class="row" id=product-list>
                            <?php foreach($products as $product):?>
                                    <div class="col-6 col-md-4 col-xl-3 col-fix swiper-slide">
                                            <div class="box">
                                                <?php if($product['discount'] > 0){
                                                    echo '<span class="discount">'.$product['discount'].'%</span>';
                                                }?>
                                                <div class="image">
                                                    <img src="../images/product-1.jpg" alt="">
                                                    <div class="icons">
                                                        <a href="#" class="fas fa-heart"></a>
                                                        <a href="#" class="cart-btn">Add to cart</a>
                                                        <a href="#" class="fas fa-search" title="Xem nhanh"></a>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <a href="#">
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
                    </div>
                    <div class="pagenav">
                        <nav class="collection-paginate clearfix relative nav_pagi w_100">
                            <ul class="pagination clearfix" id="pagination">
                                <?php if($page > 1) echo '<li><a data-sort="'.$sort_order.'" data-sort-by="'.$sort_by.'" data-category-id="'.$category_id.'" data-page="1" href="#" class="page-item">«</a></li>';?>
                                <?php
                                // Hiển thị liên kết phân trang
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    // echo '<a href="?page=' . $i . '" class="' . ($i === $page ? 'page-active' : '') . '">' . $i . '</a>';
                                    echo '<li><a data-sort="'.$sort_order.'" data-sort-by="'.$sort_by.'" data-category-id="'.$category_id.'" data-page="'.$i.'" href="#" class="page-item '.($i === $page ? 'page-active' : '') .'">'.$i.'</a></li>';
                                }
                                ?>
                                <?php if($page < $totalPages) echo '<li><a data-sort="'.$sort_order.'" data-sort-by="'.$sort_by.'" data-category-id="'.$category_id.'" data-page="'.$totalPages.'" href="#" class="page-item">»</a></li>';?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- all products section ends -->


    <?php @include('footer.php');?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        
    </script>


</body>

</html>