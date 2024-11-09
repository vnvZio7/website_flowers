<?php

@include("../DB/connection.php");

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<?php
    @include '../DB/connection.php';
    $carts = mysqli_query($conn, "SELECT * FROM `SPCart`") or die('query failed');
    $carts_length = mysqli_num_rows($carts);
    $favourites = mysqli_query($conn, "SELECT * FROM `Favourites`") or die('query failed');
    $favourites_length = mysqli_num_rows($carts);



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
        <a href="#">Tin tức</a>
        <a href="">Giới thiệu</a>
        <a href="home.php#contact">Liên hệ</a>
    </nav>
    <div class="icons flex">
        <div><a id="search" href="#home" class="fas fa-search non-display"></a></div>
        <div><a href="" class="fas fa-heart"><?php echo '<span>'.$favourites_length.'</span>';?></a></div>

        <div class="dr dr-tt">
            <a href="" class="fas fa-shopping-cart"><?php echo '<span>'.$carts_length.'</span>';?></a>
            <div class="dropdown tt">
                <i class="fa-solid fa-caret-up dricon"></i>
                <?php if($carts_length > 0){?>
                    <div class="items">
                        <div class="item">
                            <div class="item-image">
                                <img src="../images/bgrHome.jpg" alt="">
                            </div>
                            <div class="info">
                                <p>Hoa tình yêu tuổi trẻ</p>
                                <button class="del">
                                    Xóa
                                </button>
                                <div class="flex">
                                    <p>Số lượng</p>
                                    <p>15.000đ</p>
                                </div>
                                <div class="tt-form flex">
                                    <input class="inpsl" type="text" name="" id="" value="1">
                                    <button class="minus"><i class="fa-solid fa-minus"></i></button>
                                    <button class="plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="item">
                            <div class="item-image">
                                <img src="../images/bgrHome.jpg" alt="">
                            </div>
                            <div class="info">
                                <p>Hoa tình yêu tuổi trẻ</p>
                                <button class="del">
                                    Xóa
                                </button>
                                <div class="flex">
                                    <p>Số lượng</p>
                                    <p>15.000đ</p>
                                </div>
                                <div class="tt-form flex">
    
                                    <input class="inpsl" type="text" name="" id="">
                                    <button class="minus"><i class="fa-solid fa-minus"></i></button>
                                    <button class="plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="total">
                        <p>Tổng tiền: </p>
                        <p class="tt-price">0đ</p>
                    </div>
                    <div class="flex"><button class="btn" type="submit">Thanh toán</button></div>
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
                            <p>Username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                            <p>Email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                        </div>
                    </div>
                </div>
                <div class="flex"><button class="btn"><a href="logout.php">Đăng xuất</a></button></div>
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
            <form action="">
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm" id="">
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
