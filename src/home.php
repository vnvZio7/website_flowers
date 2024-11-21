<?php 
    @include("../DB/connection.php");
    session_start();
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $user = $result1->fetch_assoc();
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

    $products1 = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products1[] = $row;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $response = '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        if(isset($_POST['message'])){
        // Kiểm tra xem tin nhắn có rỗng hay không
            if (empty($message)) {
                $response = 'Tin nhắn không được để trống.';
            } else {
                // Gửi tin nhắn đến admin (có thể sử dụng email, lưu vào DB, v.v.)
                $phone_number = $_POST['number'];
                $email = $_POST['email'];
                $name = $_POST['name'];
                $stmt = $conn->prepare("INSERT INTO message (phone_number,email,name,message) VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $phone_number, $email, $name, $message);
        
                if ($stmt->execute()) {
                    $response = 'Tin nhắn đã được gửi thành công.';
                } else {
                    $response = 'Có lỗi xảy ra khi gửi tin nhắn.';
                }
            }
        }
    }
    $productXN = [];
    if(isset($_GET['xemnhanh'])){
        $id = (int)$_GET['xemnhanh'];
        $stmt = $conn->prepare("SELECT * FROM flowers WHERE flower_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productXN = $result->fetch_assoc();
        $stmt->close();
    }
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

    if(isset($_GET['cart'])){
        $id = (int)$_GET['cart'];
        $sqlt = "SELECT * FROM spcart WHERE flower_id = ? AND user_id = ?";
        $stmtt = $conn->prepare($sqlt);
        $stmtt->bind_param("ii", $id, $user_id);
        $stmtt->execute();
        $resultt = $stmtt->get_result();

        // Kiểm tra kết quả
        if ($resultt->num_rows > 0) {
            $stmt = $conn->prepare("UPDATE spcart SET quantity = quantity + 1 WHERE flower_id = ? and user_id = ?");
            $stmt->bind_param("ii", $id, $user_id);

            // Execute the statement
            $stmt->execute();
        }else{
            $stmt = $conn->prepare("INSERT INTO spcart (flower_id,user_id,quantity) VALUES (?,?,1)");
            $stmt->bind_param("ii", $id, $user_id);
            $stmt->execute();
        }
    }
    $sql2 = "SELECT * FROM flowers WHERE discount > 0";
    $result2 = $conn->query($sql2);

    $productsdis = [];
    if ($result2 && $result2->num_rows > 0) {
        while($row = $result2->fetch_assoc()) {
            $productsdis[] = $row;
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
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">

    <title>Trang chủ</title>
</head>

<body>
<?php @include 'header.php'; ?>

    <!-- popup xem nhanh starts -->

    <div class="popup non-display" id="xemnhanh">
        <div class="popup-content">
            <button id='close' style="position: absolute;top: 0;right: 0;font-size: 20px;cursor: pointer;padding: 5px 10px;background-color: transparent;"><i class="fa-solid fa-xmark"></i></button>
            <?php if ($productXN): ?> 
            <div class="image">
            <?php echo '<img src="../images/img_products/'.$productXN['image_url'].'" alt="">';?>
                
            </div>
            <div class="info">
                <div><span class="name"><?php echo $productXN['name'];?></span></div>
                <div>
                    <p style="font-size: 16px;margin: 20px 0;">Tình trạng: <span style="color: red;"><?php if($productXN['stock'] > 0){echo 'Còn hàng';} else{echo 'Hết hàng';}?></span></p>
                </div>
                <p class="quantity" style="line-height: 1.5;font-size:14px">Mô tả sản phẩm : <span><?php echo $productXN['description'] ?></span></p>

                <div style="display: flex;align-items: center;">
                    <p class="name"><?php echo $productXN['price'] * (1 - $productXN['discount']/100);?><span>đ</span></p>
                    <?php if($productXN['discount'] > 0){
                        echo '<p
                        style="text-decoration: line-through!important;font-size: 14px;color: #7a7878; padding-left: 10px;">
                        '.($productXN['price'] * 1).'<span>đ</span></p>';
                    }?>    
                </div>
                <div style="margin: 20px 0;"><span style="font-size: 16px;">Số lượng:</span></div>
                <div><input type="number" name="" id="" min="1" max="999"onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" onchange="if(this.value == 0)this.value=1;" value="1"></div>
                <div style="margin: 10px 0;"><button <?php echo 'data-id="'.$productXN['flower_id'].'"';?> class="btn cart-btn" >Thêm vào giỏ hàng</button></div>
            </div>
            <?php endif; ?>
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
                    <a href="products.php?category_id=5">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-2.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa cưới</h3>
                    <a href="products.php?category_id=1">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-3.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa sinh nhật</h3>
                    <a href="products.php?category_id=2">Xem ngay</a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="thumb"><img src="../images/danhmuc-4.jpg" alt=""></div>
                <div class="info">
                    <h3>Hoa kỷ niệm</h3>
                    <a href="products.php?category_id=3">Xem ngay</a>
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
                        <p id="h"></p>
                        <span>Giờ</span>
                    </div>
                    <div class="block-time">
                        <p id="m"></p>
                        <span>Phút</span>
                    </div>
                    <div class="block-time">
                        <p id="s"></p>
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
                    <?php
                    foreach($productsdis as $product):?>
                    <div class="swiper-slide">
                        <div class="box">
                        <?php echo '<span class="discount">'.$product['discount'].'%</span>';?>
                            <div class="image">
                            <?php
                                echo '<img src="../images/img_products/'.$product['image_url'].'" alt="">
                                <div class="icons">
                                    <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-heart '.(in_array($product['flower_id'],$fv) ? "fv-active" : "").'"></a>
                                    <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Add to cart</a>
                                    <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-search" title="Xem nhanh"></a>
                                </div>';?>
                            </div>
                            <div class="content">
                            <?php echo'<a href="#">
                                    <h3>'.$product['name'].'</h3>
                                </a>';?>
                                <div class="price"> <?php echo $product['price'] * (1 - $product['discount']/100);?><span>đ</span>
                                                    <?php if($product['discount'] > 0){
                                                        echo '<div class="span"><span>'.$product['price'].'<span>đ</span></span></div>';
                                                    }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
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
                        <?php foreach($products1 as $product):?>
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
                                    <div class="price"><?php echo $product['price'] * (1- $product['discount']/100);?><span>đ</span>
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
            <form action="" method="POST">
                <?php echo 
                '<input name="name" type="text" placeholder="name" class="box" value="'.$user['name'].'" required>
                <input name="email" type="email" placeholder="email" class="box" value="'.$user['email'].'" required>
                <input name="number" type="number" placeholder="number" class="box" value="'.$user['phone_number'].'" required>';
                ?>
                <textarea name="message" class="box" placeholder="message" id="" cols="30" rows="10" required></textarea>
                <div class="flex"><input type="submit" value="send message" class="btn"></div>
            </form>

            <div class="image">
                <img src="../images/bgrHome.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- Contact section ends -->

    <script>
        // Hiển thị thông báo dạng alert nếu có
        <?php if ($response): ?>
            alert('<?php echo addslashes($response); ?>');
        <?php endif; ?>
    </script>

    <?php @include 'footer.php'; ?>

    <?php if (isset($_SESSION['success_message'])) {
        $success = $_SESSION['success_message'];
        echo "<script type='text/javascript'>alert('$success');</script>";
        unset($_SESSION['success_message']); // Xóa thông báo sau khi đã hiển thị
    }
    ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>
    <script src="../js/header.js"></script>





</body>

</html>