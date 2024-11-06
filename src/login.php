<?php

@include '../DB/connection.php';

session_start();

$message = "";
if(isset($_POST['login'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['role'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin.php');

      }elseif($row['role'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message = 'no user found!';
      }

   }else{
      $message = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/login.css">
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
                <form action="#" method="POST" name="login">
                    <h1>LOGIN</h1>
                    <input type="email" placeholder="Email" id="email" name="email" required>
                    <input type="password" placeholder="Password" id="password" name="password" required>
                    <?php echo '<div class="message"><p style="color: red;">'.$message.'</p></div>'; ?>
                    <input type="submit" value="LOGIN" name="login" >
                    <div><p>Bạn chưa có tài khoản?</p><a href="register.php">Đăng ký</a> </div>
                    <div><a href="">Quên mật khẩu</a></div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>
