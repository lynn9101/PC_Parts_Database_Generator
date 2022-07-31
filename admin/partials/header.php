<?php 
    include('../config/connect.php'); 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Admin Home Page - PC Components Tracker</title>
       
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../css/util.css">
        
    </head>

    <body>
        <!-- Header Section -->
        <!-- Include Logo and Menu Option-->
        <section class="header">
            <div class="container">
                <div class="logo">
                    <a href="#" title="Logo">
                        <img src="../images/header-logo.png" alt="Website Logo" class="img-contain">
                    </a>
                </div>

                <div class="menu text-right">
                    <ul>
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="suppliers-list.php">Suppliers</a>
                        </li>

                        <li>
                            <a href="categories-list.php">Categories</a>
                        </li>

                        <li>
                            <a href="add-component.php">Component</a>
                        </li>
                        <li>
                            <a href="orders-list.php">Orders</a>
                        </li>
                        <li>
                            <a href="supplier-logout.php">Logout</a>
                        </li>
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- End Header Section -->