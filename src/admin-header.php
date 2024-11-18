<?php

@include("../DB/connection.php");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page name

?>

<div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="admin.php">Flowers</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item ">
                        <a href="admin.php" class="sidebar-link <?php echo $current_page == 'admin.php' ? 'active' : ''; ?>">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin-products.php" class="sidebar-link <?php echo $current_page == 'admin-products.php' ? 'active' : ''; ?>"><i class="fa-solid fa-file-lines pe-2"></i>
                            Quản lý hoa
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin-categories.php" class="sidebar-link <?php echo $current_page == 'admin-categories.php' ? 'active' : ''; ?>"><i class="fa-solid fa-file-lines pe-2"></i>
                            Quản lý danh mục
                        </a>
                    </li>
                    
                    <li class="sidebar-item">
                        <a href="admin-invoices.php" class="sidebar-link <?php echo $current_page == 'admin-invoices.php' ? 'active' : ''; ?>" ><i class="fa-solid fa-sack-dollar pe-2"></i>
                            Quản lý hóa đơn
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin-message.php" class="sidebar-link <?php echo $current_page == 'admin-message.php' ? 'active' : ''; ?>" ><i class="fa-regular fa-envelope pe-2"></i>
                            Thông báo
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="logout.php" class="nav-icon pe-md-0">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>