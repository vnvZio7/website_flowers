<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../css/trangchu.css">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    
    <title>Giỏ hàng</title>
</head>

<body>
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
    <!-- popup starts -->

    <div class="popup">
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
    <!-- header section starts -->
    <header id="header">
        <a href="#" class="logo">flower</a>

        <nav class="navbar">
            <a href="#home" class="header-active">home</a>
            <a href="#">Sản phẩm</a>
            <a href="#">Tin tức</a>
            <a href="#review">Giới thiệu</a>
            <a href="#contact">Liên hệ</a>
        </nav>
        <div class="icons flex">
            <div><a id="search" href="#home" class="fas fa-search non-display"></a></div>
            <div><a href="" class="fas fa-heart"><span>3</span></a></div>
            
            <div class="dr dr-tt">
                <a href="" class="fas fa-shopping-cart"><span>2</span></a>
                <div class="dropdown tt">
                    <i class="fa-solid fa-caret-up dricon"></i>
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
                </div>
            </div>
            <div class="dr dr-user"><a href="" class="fas fa-user"></a>
                <div class="dropdown user">
                    <i class="fa-solid fa-caret-up dricon"></i>
                    <hr>
                    <div class="items">
                        <div class="item">
                            <div class="info">
                                <p>Username: <span>Phạm Xuân Trường</span></p>
                                <p>Email: <span>ptx@gmail.com</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex"><button class="btn" type="submit">Đăng xuất</button></div>
                    <hr>
                </div>
            </div>
            </div>
            
            
        </div>
    </header>

    <!-- header section ends -->

    <!-- home section starts -->
    <div class="home" id="home">
        <div class="bgr-opacity bgr-unit"></div>
        <div class="slide slide-unit">
            <img class="img" src="../images/bgrHome1.jpg" alt="">
            <div class="absolute flex title">
                <h3>Giỏ hàng</h3>
            </div>
        </div>
    </div>
    <!-- home section ends -->

    <!-- Giohang section starts -->
    <section>
        <div class="giohang-title">
            <span class="fl-55">Thông tin sản phẩm</span>
            <span class="fl-15">Đơn giá</span>
            <span class="fl-15">Số lượng</span>
            <span class="fl-15">Thành tiền</span>
        </div>
        <div class="giohang-items">
                <div class="items">
                    <div class="item">
                        <div class="item-image info fl-55">
                            <img src="https://bizweb.dktcdn.net/thumb/large/100/034/381/products/party-1-fix2.jpg?v=1474354998807g" alt="">
                            <div>
                                <p>Hoa hồng</p>
                                <button class="del">
                                    <p>Xóa</p>
                                </button>
                            </div>
                        </div>
                        <div class="info fl-15">
                            <span>240.000đ</span>
                        </div>
                        <div class="info fl-15">
                            <div class="tt-form flex">
                                <input class="inpsl" type="text" name="" id="" value="1">
                                <button class="minus"><i class="fa-solid fa-minus"></i></button>
                                <button class="plus"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="info fl-15">
                            <span>240.000</span><span>đ</span>
                        </div>
                    </div>
                    <div class="item">
                        <div class="item-image info fl-55">
                            <img src="https://bizweb.dktcdn.net/thumb/large/100/034/381/products/am-ap-yeu-thuong-1-fix2.jpg?v=1474359839473" alt="">
                            <div>
                                <p>Ấm áp yêu thương</p>
                                <button class="del">
                                    <p>Xóa</p>
                                </button>
                            </div>
                        </div>
                        <div class="info fl-15">
                            <span>225.000đ</span>
                        </div>
                        <div class="info fl-15">
                            <div class="tt-form flex">
                                <input class="inpsl" type="text" name="" id="" value="1">
                                <button class="minus"><i class="fa-solid fa-minus"></i></button>
                                <button class="plus"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="info fl-15">
                            <span>450.000</span><span>đ</span>
                        </div>
                    </div>
                    
                </div>
                <div class="total right">
                    <p>Tổng tiền: </p>
                    <span class="tt-price">675.000đ</span>
                </div>
                <div class="flex right"><button class="btn" type="submit">Thanh toán</button></div>
                
        </div>
    </section>
    <!-- Giohang section ends -->

    


    <!-- footer section starts -->
    <section class="footer">
        <div class="box-container">
            <div class="ft-box">
                <h2>quick links</h2>
                <div><a href="#">home</a></div>
                <div><a href="#">about</a></div>
                <div><a href="#">products</a></div>
                <div><a href="#">preview</a></div>
                <div><a href="#">contact</a></div>
            </div>

            <div class="ft-box">
                <h2>group members</h2>
                <p>Phạm Xuân Trường</p>
                <p>Phạm Xuân Trường</p>
                <p>Phạm Xuân Trường</p>
            </div>
        </div>
    </section>
    <!-- footer section ends -->


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>





</body>

</html>