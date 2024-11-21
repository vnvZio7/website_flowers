<?php

@include 'config.php';

session_start();

if(isset($_POST['action'])){

//    $name = mysqli_real_escape_string($conn, $_POST['name']);
//    $price = mysqli_real_escape_string($conn, $_POST['price']);
//    $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = '../images/img_products/'.$image;

            move_uploaded_file($image_tmp_name, $image_folter);


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-products">

   <!-- <form action="" method="POST" enctype="multipart/form-data">
      <h3>add new product</h3>
      <input type="text" class="box" required placeholder="enter product name" name="name">
      <input type="number" min="0" class="box" required placeholder="enter product price" name="price">
      <textarea name="details" class="box" required placeholder="enter product details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">
   </form> -->
   <form action="" method="POST" enctype="multipart/form-data">
                <div style="width: 100%;"><input style="width: 100%;" type="text" name="name" id="productName" placeholder="Tên sản phẩm "></div>
                <div style="width: 100%;"><input style="width: 100%;" type="text" name="des" id="productDes" placeholder="Mô tả "></div>
                <div class="flex input">
                    <input type="text" id="productPrice" name="price" placeholder="Giá " require>
                    <input type="text" id="productDis" name="dis" placeholder="Giảm giá (%)" require>
                    <input type="text" id="productQuan" name="quan" placeholder="Số lượng" require>
                </div>
                <div class="image">
                    <img id="productImg"  src=""  alt="">
                    <input id="productNameImg" type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
                </div>

                <input type="hidden" name="action" id="action" value="p-add">
                <br>
                <div class="flex">
                    <button type="submit"  id="submitButton">Thêm mới</button>
                    <button type="button" id="cancelButton">Hủy</button>
                </div>
            </form>
</section>















</body>
</html>