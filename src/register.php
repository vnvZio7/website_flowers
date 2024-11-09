<?php

@include '../DB/connection.php';
session_start();
$message = "";
if(isset($_POST['register'])){

   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_STRING);
   $phone_number = mysqli_real_escape_string($conn, $filter_phone_number);
   $filter_address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
   $address = mysqli_real_escape_string($conn, $filter_address);
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message = 'Email đã tồn tại!';
   }else{
      if($pass != $cpass){
         $message = 'Xác nhận mật khẩu không khớp!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password,phone_number,address) VALUES('$name', '$email', '$pass', '$phone_number', '$address')") or die('query failed');
         $_SESSION['success_message'] = "Đăng ký thành công! Bạn có thể đăng nhập.";
         header('location:login.php');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/register.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <div id="page">
        <div class="logo">
            <ion-icon name="logo-electron"></ion-icon>
        </div>
        <div class="content">
            <div class="left">
                <div class="title">
                    <h1></h1>
                </div>
                <p>Chào mừng bạn đến với thế giới hoa của chúng tôi nơi mang đến những bó hoa tươi đẹp và ý nghĩa, giúp bạn gửi gắm cảm xúc và yêu thương đến người thân yêu trong những dịp đặc biệt!</p>
                <button>Explore</button>
            </div>
            <div class="right">
                <form action="" method="POST">
                    <h1>REGISTER</h1>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="text" placeholder="Your name" name="name" required>
                    <input type="number" placeholder="Phone Number" name="phone_number" required>
                    <input type="text" placeholder="Address" name="address" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <input type="password" placeholder="Confirm Password" name="cpassword" required>
                    <?php echo '<div class="message"><p style="color: red;" id="message">'.$message.'</p></div>';?>
                    <input type="submit" value="REGISTER" name="register" >
                    <div><p>Bạn đã có tài khoản?</p><a href="login.html">Đăng nhập</a> </div>
                </form>
                
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>

