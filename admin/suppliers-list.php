<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Manage Suppliers</h1>

                <!-- Add button for new Admin -->
                <a href="supplier-signup.php" class="btn-primary">Add New Supplier</a>
                
                <table class="admin-table">
                    <tr>
                        <!-- Table Heading -->
                        <th>Supplier ID</th>
                        <th>Name</th>
                        <th>Contact Information</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        // Query to get all suppliers in the database
                        $sql = "SELECT * FROM manufacturer_supplies";
                        $conn = OpenCon();
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                        if ($result == TRUE) {
                            // Count the number of rows needed in the table
                            $numRows = mysqli_num_rows($result);

                            if ($numRows > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    // Get data from each row
                                    $supplier_id = $rows['id'];
                                    $name = $rows['name'];
                                    $contact_info = $rows['contactinfo'];
                                    $address = $rows['address'];
                                    ?>

                                    <tr>
                                        <td><?php echo $supplier_id; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $contact_info; ?></td>
                                        <td><?php echo $address; ?></td>
                                        <td>
                                            <a href="../admin/update-supplier.php?id=<?php echo $supplier_id; ?>" class="btn-secondary">Update Supplier</a>
                                            <!-- ?id= the id of supplier that we need to pass into another page -->
                                            <a href="../admin/delete-supplier.php?id=<?php echo $supplier_id; ?>" class="btn-danger">Delete Supplier</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                    ?>

                </table>
                
            </div>
        </section>
        <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>