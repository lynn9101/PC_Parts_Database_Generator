<?php include('partials-frontend/header.php'); ?>

    <!-- Banner Section -->
    <section class="supplier-banner">
        <div class="supplier-banner-contain container">
            <div class="supplier-banner-left">
                <h1>SUPPLIER LOGIN</h1>
                
                <?php
                    if (isset($_SESSION['login'])) {
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                    }
                ?>

                <br>
                <form action="" method="POST">

                    <table class="supplier-table-container">
                        <tr>
                            <td>Supplier Name: </td>
                            <td><input type="text" name="supplier_name" placeholder="Enter your supplier name"></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" placeholder="Enter password"></td>
                        </tr>
                        
                        <!-- Add a SIGN IN button -->
                        <tr>
                            <td><input type="submit" name="submit" value="SIGN IN" class="btn-login"></td>
                        </tr>
                    </table>
                </form>
            </div>

            <div class="supplier-banner-right">
                <img src="../images/supplier-banner-logo.png" alt="Banner Logo" class="img-contain">
            </div>
        </div>
    </section>
    <!-- End Banner Section -->

<?php include('partials-frontend/footer.php'); ?>

<?php
    // Process the value from the above form and save it to Database
    // First check whether the button is clicked or not
    if (isset($_POST['submit'])) {
        // Process the data from the form
        $supplier_name = $_POST['supplier_name'];
        $password = $_POST['password'];

        // Create SQL Query to check whether username and password exist
        $sql = "SELECT * FROM manufacturer_supplies WHERE
                    name='$supplier_name' AND password='$password'";

        // Execute query
        $conn = OpenCon();
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Check the number of rows to check whether user exists or not
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $_SESSION['login'] = "Supplier Login Successfully";
            $_SESSION['supplier'] = $supplier_name;

            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/suppliers-list.php");
        } else {
            $_SESSION['login'] = "Falied to Login Supplier";

            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/user/supplier-login.php");
        }
    }
?>