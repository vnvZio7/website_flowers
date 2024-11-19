<?php 
    @include("../DB/connection.php");

$categoryResult = $conn->query("SELECT * FROM categories");
$categories = [];
if ($categoryResult && $categoryResult->num_rows > 0) {
    while($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}
$category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 1;
$sql = "SELECT * FROM flowers WHERE category_id = $category_id LIMIT 6";
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
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

    <title>Trang chủ</title>
</head>

<body>
<?php @include 'header.php'; ?>

    <!-- popup starts -->

    <div class="popup non-display">
        <div class="popup-content">
            <button style="position: absolute;top: 0;right: 0;font-size: 20px;cursor: pointer;padding: 5px 10px;background-color: transparent;"><i class="fa-solid fa-xmark"></i></button>
            <div class="image">
                <img src="https://bizweb.dktcdn.net/thumb/large/100/034/381/products/party-1-fix2.jpg?v=1474354998807" alt="">
            </div>
            <div class="info">
                <div><span class="name">Hoa Hồng</span></div>
                <div>
                    <p style="font-size: 16px;margin: 20px 0;">Tình trạng: <span style="color: red;">Còn hàng</span></p>
                </div>
                <div style="display: flex;align-items: center;">
                    <p class="name">240.000<span>đ</span></p>
                    <p
                        style="text-decoration: line-through!important;font-size: 14px;color: #7a7878; padding-left: 10px;">
                        300.000<span>đ</span></p>
                </div>
                <div style="margin: 20px 0;"><span style="font-size: 16px;">Số lượng:</span></div>
                <div><input type="number" name="" id="" min="1" max="999" oninput="limitInput(this)" value="1"></div>
                <div style="margin: 10px 0;"><button class="btn" type="submit">Thêm vào giỏ hàng</button></div>
            </div>
        </div>
    </div>
    <!-- popup ends -->

    <!-- popup starts -->

    <div class="popup non-display">
        <div class="popup-content thanhtoan">
            <form>
                <p>Vui lòng điền đầy đủ các thông tin sau:</p>
                <p>Họ và tên: </p>
                <div><input type="text" name="" placeholder="Họ và tên" id=""></div>
                <p>Số điện thoại: </p>
                <div> <input type="number" name="" placeholder="Số điện thoại" id=""></div>
                <p>Địa chỉ:</p>
                <div> <input type="text" name="" placeholder="Địa chỉ" id=""></div>
                <div class="flex"><button class="btn" type="submit">Thanh toán</button></div>
            </form>
        </div>
    </div>
    <!-- popup ends -->


    <!-- home section starts -->
    <!-- <div class="home" id="home">
        <div class="bgr-opacity"></div>
        <div class="slide">
            <img class="image display" src="../images/bgrHome.jpg" alt="">
            <img class="image " src="../images/bgrHome1.jpg" alt="">
            <div class="abs">
                <div class="box">
                    <div class="box-item">
                        <h3>Hoa tươi mỗi ngày</h3>
                        <p>Giảm đến 20% khi đặt hàng online</p>
                        <button class="btn"><a href="">Xem ngay</a></button>
                    </div>
                </div>
                <form action="">
                    <input type="text" name="" placeholder="Tìm kiếm sản phẩm" id="">
                    <button class="btn" type="submit">Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div> -->
    <!-- home section ends -->

    <!-- icons section starts -->
    <section>
        <div class="icons-container">
            <div class="icons">
                <img src="https://bizweb.dktcdn.net/100/512/203/themes/943792/assets/chinhsach_1.png?1727784692442"
                    alt="">
                <div class="info">
                    <p>Miễn phí vận chuyển</p>
                    <span>Cho tất cả các đơn hàng trong nội thành Hà Nội</span>
                </div>
            </div>

            <div class="icons">
                <img src="https://bizweb.dktcdn.net/100/512/203/themes/943792/assets/chinhsach_2.png?1727784692442"
                    alt="">
                <div class="info">
                    <p>Miễn phí đổi - trả</p>
                    <span>Đối với sản phẩm lỗi sản xuất hoặc vận chuyển</span>
                </div>
            </div>

            <div class="icons">
                <img src="https://bizweb.dktcdn.net/100/512/203/themes/943792/assets/chinhsach_3.png?1727784692442"
                    alt="">
                <div class="info">
                    <p>Hỗ trợ nhanh chóng</p>
                    <span>Gọi Hotline: 19006750 để được hỗ trợ ngay lập tức</span>
                </div>
            </div>

            <div class="icons">
                <img src="https://bizweb.dktcdn.net/100/512/203/themes/943792/assets/chinhsach_4.png?1727784692442"
                    alt="">
                <div class="info">
                    <p>Ưu đãi thành viên</p>
                    <span>Đăng ký thành viên để được nhận nhiều khuyến mãi</span>
                </div>
            </div>
        </div>
    </section>
    <!-- icons section ends -->

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

    <!-- flashsale section starts -->

    <section>
        <div class="flashsale">
            <div class="couwndown">
                <div class="time">
                    <div class="block-time">
                        <p id="h">24</p>
                        <span>Giờ</span>
                    </div>
                    <div class="block-time">
                        <p id="m">00</p>
                        <span>Phút</span>
                    </div>
                    <div class="block-time">
                        <p id="s">00</p>
                        <span>Giây</span>
                    </div>
                </div>
            </div>
            <div class="title-heading">
                <a href="">
                    <h3 class="h3-heading">Hoa đang giảm giá</h3>
                </a>
                <div class="img-heading">
                    <img src="../images/iconHeading.png" alt="">
                </div>
            </div>
            <div class="products">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-10%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-15%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-5%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-20%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-17%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-3%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-18%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-13%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="box">
                            <span class="discount">-11%</span>
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
                                    <h3>Tình yêu ngọt ngào</h3>
                                </a>
                                <div class="price"> 250.000<span>đ</span>
                                    <div class="span"><span>300.000<span>đ</span></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Thêm nút điều hướng -->
                <div class="swiper-button-next"><i class="fa-solid fa-caret-right"></i></div>
                <div class="swiper-button-prev"><i class="fa-solid fa-caret-left"></i></div>
            </div>
        </div>
    </section>
    <!-- flashsale section ends -->

    <!-- sp noi bat section starts -->

    <section>
        <div class="title-heading">
            <a href="">
                <h3 class="h3-heading">Được mua nhiều nhất</h3>
            </a>
            <div class="img-heading">
                <img src="../images/iconHeading.png" alt="">
            </div>
        </div>
        <div class="products">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="box">
                        <span class="discount">-10%</span>
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
                                <h3>Tình yêu ngọt ngào</h3>
                            </a>
                            <div class="price"> 250.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <span class="discount">-15%</span>
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
                                <h3>Tình yêu ngọt ngào</h3>
                            </a>
                            <div class="price"> 250.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <span class="discount">-5%</span>
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
                                <h3>Tình yêu ngọt ngào</h3>
                            </a>
                            <div class="price"> 250.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="box">
                        <span class="discount">-20%</span>
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
                                <h3>Tình yêu ngọt ngào</h3>
                            </a>
                            <div class="price"> 250.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Thêm nút điều hướng -->
                <div class="swiper-button-next"><i class="fa-solid fa-caret-right"></i></div>
                <div class="swiper-button-prev"><i class="fa-solid fa-caret-left"></i></div>
            </div>
        </div>
    </section>
    <!-- sp noi bat section ends -->

    <!-- bgr-image -->
    <section>
        <div class="bgr-image">
            <div class="bd">
                <img src="../images/bgrImg.jpg" alt="">
            </div>
        </div>
    </section>

    <!-- all products section starts -->

    <section>
        <div class="all-products" id="view">
            <div class="title-heading">
                <a href="">
                    <h3 class="h3-heading">Tất cả hoa</h3>
                </a>
                <div class="img-heading">
                    <img src="../images/iconHeading.png" alt="">
                </div>
            </div>
            <div class="e-tabs" data-section="ajax-tab-1">
                <div class="tabs">
                    <?php
                        $i =0;
                        foreach($categories as $category):
                            echo '<div class="tab" ><a class="click-a '. ($i == 0 ? 'tab-active' : '').'" data-id="'.$category['category_id'].'" href="#">'.$category['name'].'</a></div>';
                            // echo '<li class="nav-item"><a data-sort="'.$sort_order.'" data-sort-by="'.$sort_by.'" class="category-link" data-category-id="'.$category['category_id'].'" href="#">'.$category['name'].'</a></li>';
                            $i++;
                        endforeach;    
                    ?>
                </div>
                <div style="flex: 1 1 80rem;" id="refresh">
                    <div class="contents">
                        <?php foreach($products as $product):?>
                            <div class="box">
                                <?php if($product['discount'] > 0){
                                    echo '<span class="discount">'.$product['discount'].'%</span>';
                                }?>
                                <?php
                                echo '<div class="image">
                                    <img src="../images/img_products/'.$product['image_url'].'" alt="">
                                    <div class="icons">
                                        <a data-id="'.$product['flower_id'].'" href="#" class="add-fv fas fa-heart"></a>
                                        <a href="#" class="cart-btn">Add to cart</a>
                                        <a href="#" class="fas fa-search" title="Xem nhanh"></a>
                                    </div>
                                </div>';
                                ?>
                                <div class="content">
                                    <?php echo '<a href="product-details.php?id='.$product['flower_id'].'">';?>
                                        <h3><?php echo $product['name'];?></h3>
                                    </a>
                                    <div class="price"><?php echo $product['price'] * ($product['discount']/100 + 1);?><span>đ</span>
                                        <?php if($product['discount'] > 0){
                                            echo '<div class="span"><span>'.($product['price'] * 1).'<span>đ</span></span></div>';
                                        }?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <?php
                        echo '<div class="flex"><button class="btn"><a href="products.php?category_id='.$category_id.'">Xem tất cả</a></button></div>';
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- all products section ends -->



    <!-- Contact section starts -->
    <section class="contact" id="contact">
        <div class="title-heading">
            <a href="">
                <h3 class="h3-heading">Liên hệ</h3>
            </a>
            <div class="img-heading">
                <img src="../images/iconHeading.png" alt="">
            </div>
        </div>

        <div class="row">
            <form action="">
                <input type="text" placeholder="name" class="box">
                <input type="email" placeholder="email" class="box">
                <input type="number" placeholder="number" class="box">
                <textarea name="" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
                <div class="flex"><input type="submit" value="send message" class="btn"></div>
            </form>

            <div class="image">
                <img src="../images/bgrHome.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- Contact section ends -->


    <?php @include 'footer.php'; ?>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>
    <script src="../js/header.js"></script>





</body>

</html>