<?php

@include("../DB/connection.php");

session_start();

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result1 = $stmt->get_result();
$user = $result1->fetch_assoc();
if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_GET['id_cart'])){
    $id = (int)$_GET['id_cart'];
    $quantity = (int)$_GET['update_cart'];
    $stmt = $conn->prepare("UPDATE spcart set quantity = ? WHERE flower_id = ? and user_id = ?");
    $stmt->bind_param("iii",$quantity ,$id, $user_id);
    $stmt->execute();
}
if(isset($_GET['del_cart'])){
    $id = (int)$_GET['del_cart'];
    $stmt = $conn->prepare("DELETE FROM spcart WHERE id = ?");
    $stmt->bind_param("i" ,$id);
    $stmt->execute();
}
    $carts_length = 0;
    $sql = "SELECT p.*, s.id,s.quantity FROM flowers p join spcart s on p.flower_id = s.flower_id where s.user_id = $user_id";
    $result = $conn->query($sql);
    $products = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
            $carts_length += $row['quantity'];
        }
    }
    $favourites = mysqli_query($conn, "SELECT * FROM `favourites` where user_id = $user_id") or die('query failed');
    $favourites_length = mysqli_num_rows($favourites);

    $sql1 = "SELECT SUM(p.price *(1 - p.discount/100) * c.quantity) AS total 
        FROM spcart c 
        JOIN flowers p ON c.flower_id = p.flower_id WHERE c.user_id = $user_id;";
    $result1 = $conn->query($sql1);

    // Biến để lưu tổng giá trị giỏ hàng
    $total = 0;

    if ($result1->num_rows > 0) {
        // Lấy tổng giá trị từ kết quả
        $row = $result1->fetch_assoc();
        $total = $row['total'] * 1;
    }

    
?>


<!-- btn đầu trang -->
<button id="myBtn" title="Lên đầu trang"><i class="fa-solid fa-caret-up"></i></button>
<!-- Đồng hồ thực tế -->
<div id="clock">
    <span id="hour" class="hand"></span>
    <span id="minute" class="hand"></span>
    <span id="second" class="hand"></span>
    <span class="border-tops"></span>
    <span class="border-rights"></span>
    <span class="border-bottoms"></span>
    <span class="border-lefts"></span>
</div>
<!-- header section starts -->
<header id="header">
    <a href="#" class="logo">flower</a>

    <nav class="navbar">
        <a href="home.php#home">home</a>
        <a href="products.php">Sản phẩm</a>
        <a href="news.php">Tin tức</a>
        <a href="introduce.php">Giới thiệu</a>
        <a href="home.php#contact">Liên hệ</a>
    </nav>
    <div class="icons flex">
        <div><a id="search" href="home.php#home" class="fas fa-search non-display"></a></div>
        <div><a id="favourites" href="favourites.php" class="fas fa-heart"><?php echo '<span>'.$favourites_length.'</span>';?></a></div>

        <div class="dr dr-tt" id="carts">
            <a href="cart.php" class="fas fa-shopping-cart"><?php echo '<span>'.$carts_length.'</span>';?></a>
            <div class="dropdown tt">
                <i class="fa-solid fa-caret-up dricon"></i>
                <?php if($carts_length > 0){?>
                    <div class="items">
                        <?php foreach($products as $product):?>
                        <div class="item">
                            <div class="item-image">
                                <?php echo '<img src="../images/img_products/'.$product['image_url'].'" alt="">';?>
                            </div>
                            <div class="info">
                                <p><?php echo $product['name']?></p>
                                <button <?php echo 'data-id="'.$product['id'].'"';?> class="del">
                                    Xóa
                                </button>
                                <div class="flex">
                                    <p>Số lượng</p>
                                    <p><?php echo ($product['price'] *(1-$product['discount']/100) * $product['quantity']);?>đ</p>
                                </div>
                                <div class="tt-form flex">
                                    <input <?php echo 'data-id="'.$product['flower_id'].'"';?> oninput="limitInput(this)" class="inpsl" type="number" name="" <?php echo'value="'.$product['quantity'].'"';?> min="1" max="999" required>
                                    <button <?php echo 'data-id="'.$product['flower_id'].'"';?> <?php echo 'data-input="'.$product['quantity'].'"';?> class="minus"><i class="fa-solid fa-minus"></i></button>
                                    <button <?php echo 'data-id="'.$product['flower_id'].'"';?> <?php echo 'data-input="'.$product['quantity'].'"';?> class="plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php endforeach;?>
                    </div>
                    <div class="total">
                        <p>Tổng tiền: </p>
                        <p class="tt-price"><?php echo $total;?>đ</p>
                    </div>
                    <div class="flex"><button class="btn"><a href="cart.php">Thanh toán</a></button></div>
                    <?php }else{
                        echo '<p style="font-size:14px">Không có sản phẩm nào trong giỏ hàng của bạn</p>';
                    }?>
            </div>
        </div>
        <div class="dr dr-user"><a href="" class="fas fa-user"></a>
            <div class="dropdown user">
                <i class="fa-solid fa-caret-up dricon"></i>
                <hr>
                <div class="items">
                    <div class="item">
                        <div class="info">
                            <p>Username: <span><?php echo $user['name']; ?></span></p>
                            <p>Email: <span><?php echo $user['email']; ?></span></p>
                            <p>Phone: <span><?php echo $user['phone_number']; ?></span></p>
                            <p>Address: <span><?php echo $user['address']; ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="flex"><button class="btn"><a style="font-size: 16px;" href="logout.php">Đăng xuất</a></button></div>
                <hr>
            </div>
        </div>
    </div>


    </div>
</header>
<!-- header section ends -->

<!-- home section starts -->
<div class="home non-display" id="home_page">
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
            <form action="search.php" method="GET">
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm">
                <button class="btn" type="submit">Tìm kiếm</button>
            </form>
        </div>
    </div>
</div>
<!-- home section ends -->

<!-- home section starts -->
<div class="home non-display" id="home">
    <div class="bgr-opacity bgr-unit"></div>
    <div class="slide slide-unit">
        <img class="img" src="../images/bgrHome1.jpg" alt="">
        <div class="absolute flex title">
            <h3 id="title_page"></h3>
        </div>
    </div>
</div>
<!-- home section ends -->
