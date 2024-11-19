<?php
    @include("../DB/connection.php");
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($product_id > 0) {
        $stmt = $conn->prepare("SELECT * FROM flowers WHERE flower_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
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
    <link rel="stylesheet" href="../css/product-details.css">
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

    <title>Chi tiết sản phẩm</title>
</head>

<body>
    <?php @include('header.php');?>

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

    <!-- details section starts -->

    <section>
        <div class="row">
            <?php if ($product_id > 0): ?>
                <div class="col-lg-4 col-left">
                    <div class="image-container">
                        <div class="image">
                            <?php
                                echo '<div class="img-pri"><img width="400px" height="400px" src="../images/img_products/'.$product['image_url'].'" alt=""></div>';
                            ?>
                            <!-- <div class="short-image flex">
                                <img src="../images/danhmuc-1.jpg" alt="">
                                <img src="../images/danhmuc-1.jpg" alt="">
                                <img src="../images/danhmuc-1.jpg" alt="">
                            </div> -->
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6 col-right">
                    <p class="productname"><?php echo $product['name'];?></p>
                    <div class="infopro">
                        <p>Loại: <span>Hoa Hồng</span></p>
                        <p>Tình trạng: <span><?php if($product['stock'] > 0){echo 'Còn hàng';} else{echo 'Hết hàng';}?></span></p>
                    </div>
                    <p class="quantity" style="line-height: 1.5;">Mô tả sản phẩm : <span><?php echo $product['description'] ?></span></p>

                    <div class="price" style="display: flex;"><?php echo $product['price'] * ($product['discount']/100 + 1);?><span>đ</span>
                    <?php if($product['discount'] > 0){
                        echo '<p
                        style="text-decoration: line-through!important;font-size: 14px;color: #7a7878; padding-left: 10px;">
                        '.($product['price'] * 1).'<span>đ</span></p>';
                        // echo '<div class="span"><span>'.($product['price'] * 1).'<span>đ</span></span></div>';
                    }?>    
                    </div>
                    <p class="quantity">Số lượng:</p>
                    <input class="number" type="text" id="qtym" name="quantity" value="1" maxlength="3" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == 0)this.value=1;">
                    <div class="flex">
                        <div class="button">
                            <button type="submit" class="flex add">
                                <div class="icon"><a href="" class="fas fa-shopping-cart"></a></div>
                                <div class="title">
                                    <p>Thêm vào giỏ</p>
                                    <span>Thêm vào giỏ</span>
                                </div>
                            </button>
                        </div>
                        <div class="button">
                            <button class="flex favourite">
                                <div class="icon"><a href="" class="fas fa-heart"></a></div>
                                <div class="title">
                                    <p>Yêu thích</p>
                                    <span>Yêu thích</span>
                                </div>
                            </button>
                        </div>
                    </div>
                    
                </div>
            <?php else: ?>
                <h3>Không tìm thấy sản phẩm.</h3>
            <?php endif; ?>
        </div>
    </section>

    <!-- details section ends -->


    <?php @include('footer.php');?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>


</body>

</html>