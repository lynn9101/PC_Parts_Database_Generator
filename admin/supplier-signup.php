<?php include('partials/header.php'); ?>

<!-- Banner Section -->
<section class="banner">
    <div class="banner-contain container">
        <div class="banner-left">
            <h1>Add Supplier</h1>
            
            <br>
            <form action="" method="POST">

                <table class="table-container">
                    <tr>
                        <td>Supplier Name: </td>
                        <td><input type="text" name="supplier_name" placeholder="Enter your supplier name"></td>
                    </tr>

                    <tr>
                        <td>Contact Information: </td>
                        <td><input type="text" name="contact_info" placeholder="Enter your email here"></td>
                    </tr>

                    <tr>
                        <td>Address: </td>
                        <td><input type="text" name="supplier_address" placeholder="Enter your address here"></td>
                    </tr>

                    <tr>
                        <td>Password: </td>
                        <td><input type="password" name="password" placeholder="Enter password"></td>
                    </tr>
                    
                    <!-- Add a Confirm button -->
                    <tr>
                        <td><input type="submit" name="submit" value="Add Supplier" class="btn-primary"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="banner-right">
            <img src="../images/banner-logo.png" alt="Banner Logo" class="img-contain">
        </div>
    </div>
</section>
<!-- End Banner Section -->

<?php include('partials/footer.php'); ?>


<?php
    // Process the value from the above form and save it to Database
    // First check whether the Add Admin button is clicked or not
    if (isset($_POST['submit'])) {
        // Process the data from the form
        $supplier_name = $_POST['supplier_name'];
        $contact_info = $_POST['contact_info'];
        $address = $_POST['supplier_address'];
        $password = $_POST['password'];

        // Create SQL Query to save the data into the database
        $sql = "INSERT INTO manufacturer_supplies SET
                name='$supplier_name',
                contactinfo='$contact_info',
                address='$address',
                password='$password'";

        // Execute query
        $conn = OpenCon();
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Check if the query is excecuted properly
        if ($result == TRUE) {
            echo 'Data inserted';
        } else {
            echo 'Failed to insert data';
        }
    }
?>