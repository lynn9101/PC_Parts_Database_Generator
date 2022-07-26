<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Categories</h1>

                <table class="admin-table">
                    <tr>
                        <!-- Table Heading -->
                        <th>Category ID</th>
                        <th>Category Name</th>
                    </tr>

                    <?php
                        // Query to get all suppliers in the database
                        $sql = "SELECT * FROM categories";
                        $conn = OpenCon();
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                        if ($result == TRUE) {
                            // Count the number of rows needed in the table
                            $numRows = mysqli_num_rows($result);

                            if ($numRows > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    // Get data from each row
                                    $categories_id = $rows['id'];
                                    $title = $rows['title'];
                                    ?>

                                    <tr>
                                        <td><?php echo $categories_id; ?></td>
                                        <td><?php echo $title; ?></td>
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