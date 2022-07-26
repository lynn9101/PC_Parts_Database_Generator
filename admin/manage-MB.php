<?php include('../config/connect.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Motherboards</title>
    <link rel="stylesheet" href="../css/MBstyle.css">
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
    <div class="product-banner">
        <div class="product-banner-text">
            <h1>Motherboard</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Form Factor</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Chipset</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Memory Slots</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Memory Size</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Form Factor</th>
                    <th>Chipset</th>
                    <th>Memory Slots</th>
                    <th>Supported<br/>Memory Size</th>
                </tr>
                <tr>
                    <td>712</td>
                    <td>Intel Q570</td>
                    <td>AT</td>
                    <td>10</td>
                    <td>512 GB</td>
                </tr>
                <tr>
                    <td>878</td>
                    <td>Intel Z690</td>
                    <td>SSI CEB</td>
                    <td>8</td>
                    <td>4096 GB</td>
                </tr>
            </table>
        </div>
    </section>
    <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>