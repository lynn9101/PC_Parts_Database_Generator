<?php include('../config/connect.php'); ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Admin Home Page - PC Components Tracker</title>
       
        <link rel="stylesheet" href="../css/newModel.css">
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
                    </ul>
                </div>

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- End Header Section -->

        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Motherboard</h1>
            </div>
        </div>
        <!-- End Banner Section -->

        <!--Main Content Section-->
        <section class="form-content text-center">
            <h2 class="activity-title">
                NEW MODEL
            </h2>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>ID</td>
                        <td><input required type="number" name="id" placeholder="enter model ID"></td>
                    </tr>
                    <tr>
                        <td>Form Factor</td>
                        <td><input required type="text" name="form_factor" placeholder="enter model Form Factor"></td>
                    </tr>
                    <tr>
                        <td>Chipset</td>
                        <td><input required type="text" name="chipset" placeholder="enter model chipset"></td>
                    </tr>
                    <tr>
                        <td>Memory Slots</td>
                        <td><input required type="number" name="memory_slots" placeholder="enter model memory slots"></td>
                    </tr>
                    <tr>
                        <td>Supported Memory Size</td>
                        <td><input required type="number" name="memory_size" placeholder="enter model supported memory size"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>