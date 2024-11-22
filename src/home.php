<?php 
    @include("../DB/connection.php");
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
    }
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
                                    <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Thêm vào giỏ</a>
                                    <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-search" title="Xem nhanh"></a>
                                </div>';?>
                            </div>
                            <div class="content">
                            <?php echo '<a href="product-details.php?id='.$product['flower_id'].'">';?>
                                        <h3><?php echo $product['name'];?></h3>
                                    </a>
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

                <?php 
                $str = "SELECT oi.flower_id, f.*, SUM(oi.quantity) AS total_quantity_sold
                        FROM Order_Items oi
                        JOIN Flowers f ON oi.flower_id = f.flower_id
                        GROUP BY oi.flower_id, f.name
                        ORDER BY total_quantity_sold DESC
                        LIMIT 10;";
                $result = $conn->query($str);
            
                $productsList = [];
                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $productsList[] = $row;
                    }
                }

                foreach($productsList as $product):
                ?>
                <div class="swiper-slide">
                    <div class="box">
                    <?php if($product['discount'] > 0){
                            echo '<span class="discount">'.$product['discount'].'%</span>';
                        }?>
                        <?php
                            echo '<div class="image">
                                <img src="../images/img_products/'.$product['image_url'].'" alt="">
                                <div class="icons">
                                    <a data-id="'.$product['flower_id'].'" href="#" class="fas fa-heart '.(in_array($product['flower_id'],$fv) ? "fv-active" : "").'"></a>
                                    <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Thêm vào giỏ</a>
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
                </div>
                <?php endforeach;?>
                

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
                                        <a data-id="'.$product['flower_id'].'" href="#" class="cart-btn">Thêm vào giỏ</a>
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