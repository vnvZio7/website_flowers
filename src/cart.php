<?php 
    @include("../DB/connection.php");
    // Lấy danh mục sản phẩm
    session_start();
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $user = $result1->fetch_assoc();
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
    $sql = "SELECT p.*,s.id ,s.quantity FROM flowers p join spcart s on p.flower_id = s.flower_id where s.user_id = $user_id";
    $result = $conn->query($sql);
    $products1 = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products1[] = $row;
        }
    }
    $sql1 = "SELECT SUM(p.price *(1 - p.discount/100)* c.quantity) AS total 
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

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $number = $_POST['number'];
        $address = $_POST['address'];
        $productNew = $products1;
        $stmt = $conn->prepare("INSERT INTO orders (user_id,total_amount,address) VALUES (?,?,?)");
        $stmt->bind_param("iis", $user_id,$total, $address);
        $stmt->execute();
        $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? and total_amount = ? and address = ?");
        $stmt->bind_param("iis", $user_id,$total, $address);
        $stmt->execute();
        $result1 = $stmt->get_result();
        $order = $result1->fetch_assoc();
        $order_id = $order['order_id'];
        foreach($productNew as $product):
            $product_id = (int)$product['flower_id'];
            $quantity = (int)$product['quantity'];
            $price = (int)($product['price'] * (1-$product['discount']/100)* $quantity);
            $stmt = $conn->prepare("INSERT INTO order_items (order_id,flower_id,quantity,price) VALUES (?,?,?,?)");
            $stmt->bind_param("iiii", $order_id,$product_id,$quantity,$price);
            $stmt->execute();
            $id = (int)$product['id'];
            $stmt = $conn->prepare("DELETE FROM spcart where id = ?");
            $stmt->bind_param("i",$id );
            $stmt->execute();
        endforeach;
        $message = "Thanh toán thành công";
        $_SESSION['success_message'] = "Thanh toán thành công! Tiếp tục mua sắm nào.";
         header('location:home.php');
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
    <link rel="stylesheet" href="../css/cart.css">
    <link href="https://fonts.googleapis.com/css2?family=Playball&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css">
    
    <title>Giỏ hàng</title>
</head>

<body>
<?php @include("header.php");?>

    <!-- popup starts -->

    <div class="popup non-display" id="form-tt">
        <div class="popup-content thanhtoan">
        <button id='close' style="position: absolute;top: 0;right: 0;font-size: 20px;cursor: pointer;padding: 5px 10px;background-color: transparent;"><i class="fa-solid fa-xmark"></i></button>
            <form action="" method="POST">
                <p>Vui lòng điền đầy đủ các thông tin sau:</p>
                <p>Họ và tên: </p>
                <div><input type="text" name="name" placeholder="Họ và tên" id="" <?php echo 'value="'.$user['name'].'"';?> required></div>
                <p>Số điện thoại: </p>
                <div> <input type="number" name="number" placeholder="Số điện thoại" id="" <?php echo 'value="'.$user['phone_number'].'"';?> required></div>
                <p>Địa chỉ:</p>
                <div> <input type="text" name="address" placeholder="Địa chỉ" id="" <?php echo 'value="'.$user['address'].'"';?> required></div>
                <div class="flex"><button class="btn" type="submit">Thanh toán</button></div>
            </form>
        </div>
    </div>
    <!-- popup ends -->
    <!-- Giohang section starts -->
    <section id="thanhtoan">
        <?php if ($products1): ?>      
        <div class="giohang-title">
            <span class="fl-55">Thông tin sản phẩm</span>
            <span class="fl-15">Đơn giá</span>
            <span class="fl-15">Số lượng</span>
            <span class="fl-15">Thành tiền</span>
        </div>
        <div class="giohang-items">
                <div class="items">
                    <?php foreach($products1 as $product):?>
                    <div class="item">
                        <div class="item-image info fl-55">
                            <?php echo '<img src="../images/img_products/'.$product['image_url'].'" alt="">';?>
                            <div>
                                <p><?php echo $product['name']?></p>
                                <button <?php echo 'data-id="'.$product['id'].'"';?> class="del">
                                    <p>Xóa</p>
                                </button>
                            </div>
                        </div>
                        <div class="info fl-15" style="flex-direction: column">
                            <span style="text-decoration: line-through!important;color:#333;"><?php echo ($product['price'] * 1);?>đ</span>
                            <span><?php echo ($product['price'] * (1 -$product['discount']/100) );?>đ</span>
                        </div>
                        <div class="info fl-15">
                            <div class="tt-form flex">
                            <input <?php echo 'data-id="'.$product['flower_id'].'"';?> oninput="limitInput(this)" class="inpsl" type="number" name="" <?php echo'value="'.$product['quantity'].'"';?> min="1" max="999" required>
                                    <button <?php echo 'data-id="'.$product['flower_id'].'"';?> <?php echo 'data-input="'.$product['quantity'].'"';?> class="minus"><i class="fa-solid fa-minus"></i></button>
                                    <button <?php echo 'data-id="'.$product['flower_id'].'"';?> <?php echo 'data-input="'.$product['quantity'].'"';?> class="plus"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="info fl-15">
                            <span><?php echo ($product['price'] *(1-$product['discount']/100) *  $product['quantity']);?></span><span>đ</span>
                        </div>
                    </div>
                <?php endforeach;?>
                
                    
                </div>
                <div class="total right">
                    <p>Tổng tiền: </p>
                    <span class="tt-price"><?php echo $total;?>đ</span>
                </div>
                <div class="flex right"><button class="btn" id="button-tt">Thanh toán</button></div>
            </div>
            <?php else: ?>
                <h3>Không có sản phẩm nào.</h3>
            <?php endif; ?>
    </section>
    <!-- Giohang section ends -->

    


    <?php @include("footer.php");?>
    


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../js/trangchu.js"></script>





</body>

</html>