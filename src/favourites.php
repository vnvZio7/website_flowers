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

    <title>Tất cả sản phẩm</title>
</head>

<body>
    <?php @include("header.php");?>
    <!-- all products section starts -->

    <section>
        <div class="all-products">
            <div class="row row-cols-4">
                <div class="col-6 col-md-4 col-lg-3 col-fix swiper-slide">
                    <div class="box">
                        <span class="discount">-10%</span>
                        <div class="image">
                            <img src="../images/product-1.jpg" alt="">
                            <div class="icons">
                                <a href="#" class="fas fa-heart fv-active"></a>
                                <a href="#" class="cart-btn">Add to cart</a>
                                <a href="#" class="fas fa-search" title="Xem nhanh"></a>
                            </div>
                        </div>
                        <div class="content">
                            <a href="#">
                                <h3>Tình yêu ngọt ngào</h3>
                            </a>
                            <div class="price"> 270.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-fix swiper-slide">
                    <div class="box">
                        <span class="discount">-20%</span>
                        <div class="image">
                            <img src="https://bizweb.dktcdn.net/thumb/large/100/034/381/products/party-1-fix2.jpg?v=1474354998807" alt="">
                            <div class="icons">
                                <a href="#" class="fas fa-heart fv-active"></a>
                                <a href="#" class="cart-btn">Add to cart</a>
                                <a href="#" class="fas fa-search" title="Xem nhanh"></a>
                            </div>
                        </div>
                        <div class="content">
                            <a href="#">
                                <h3>Hoa Hồng</h3>
                            </a>
                            <div class="price"> 240.000<span>đ</span>
                                <div class="span"><span>300.000<span>đ</span></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3 col-fix swiper-slide">
                    <div class="box">
                        <!-- <span class="discount">-10%</span> -->
                        <div class="image">
                            <img src="../images/danhmuc-3.jpg" alt="">
                            <div class="icons">
                                <a href="#" class="fas fa-heart fv-active"></a>
                                <a href="#" class="cart-btn">Add to cart</a>
                                <a href="#" class="fas fa-search" title="Xem nhanh"></a>
                            </div>
                        </div>
                        <div class="content">
                            <a href="#">
                                <h3>Hoa TuyLip</h3>
                            </a>
                            <div class="price"> 250.000<span>đ</span>
                                <!-- <div class="span"><span>300.000<span>đ</span></span></div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagenav">
                <nav class="collection-paginate clearfix relative nav_pagi w_100">
                    <ul class="pagination clearfix" id="pagination">
                        <li><a href="" class="page-item non-display">«</a></li>
                        <li><a href="" class="page-item page-active">1</a></li>
                        <!-- <li><a href="" class="page-item">2</a></li>
                        <li><a href="" class="page-item">»</a></li> -->
                    </ul>
                </nav>
            </div>

        </div>
    </section>

    <!-- all products section ends -->


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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>


</body>

</html>