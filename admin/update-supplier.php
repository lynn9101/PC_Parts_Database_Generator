<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Update Supplier</h1>

                <?php
                    // Get the id from the current supplier
                    $supplier_id = $_GET['id'];

                    // Get all information of that supplier
                    $sql = "SELECT * FROM manufacturer_supplies WHERE id = $supplier_id";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $name = $row['name'];
                            $contact_info = $row['contactinfo'];
                            $address = $row['address'];
                            $password = $row['password'];
                        }
                    }
                ?>

                <form action="" method="POST">

                    <table class="table-container">
                        <tr>
                            <td>Supplier Name: </td>
                            <td><input type="text" name="supplier_name" value="<?php echo $name; ?>"></td>
                        </tr>

                        <tr>
                            <td>Contact Information: </td>
                            <td><input type="text" name="contact_info" value="<?php echo $contact_info; ?>"></td>
                        </tr>

                        <tr>
                            <td>Address: </td>
                            <td><input type="text" name="supplier_address" value="<?php echo $address; ?>"></td>
                        </tr>

                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" value="<?php echo $password; ?>"></td>
                        </tr>
                        
                        <!-- Add a Confirm button -->
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $supplier_id; ?>">
                                <input type="submit" name="submit" value="Update Supplier" class="btn-secondary">
                            </td>
                        </tr>
                    </table>
                </form>
                
            </div>
        </section>
        <!-- End Main Content Section -->

<?php
    // Process the value from the above form and update into Database
    // First check whether the Update Supplier button is clicked or not
    if (isset($_POST['submit'])) {
        // Process the data from the form
        $id = $_POST['id'];
        $supplier_name = $_POST['supplier_name'];
        $contact_info = $_POST['contact_info'];
        $address = $_POST['supplier_address'];
        $password = $_POST['password'];

        // Create SQL Query to save the data into the database
        $sql = "UPDATE manufacturer_supplies SET
                name='$supplier_name',
                contactinfo='$contact_info',
                address='$address',
                password='$password'
                WHERE id='$id'";

        // Execute query
        $conn = OpenCon();
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        // Check if the query is excecuted properly
        if ($result == TRUE) {
            $_SESSION['update'] = "Supplier Updated Successfully";

            // Redirect to previous page
            header("location:".$home_page_url.'suppliers-list.php');
            
        } else {
            $_SESSION['update'] = "Falied to Update the Current Supplier";

            // Redirect to previous page
            header("location:".$home_page_url.'supplier-signup.php');
        }
    }
?>

<?php include('partials/footer.php'); ?>
