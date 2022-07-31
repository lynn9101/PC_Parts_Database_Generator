<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/RAM wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Memory</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Size</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Speed</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Form Factor</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Size</th>
                    <th>Speed</th>
                    <th>Form Factor</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT m1.partid id, m1.formfactor ff, m2.sizeGB size, m2.speed 
                    FROM memory1 m1, memory2 m2 
                    WHERE m1.partid = m2.partid";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $ff = $rows['ff'];
                                $size = $rows['size'];
                                $speed = $rows['speed'];
                                ?>

                                <tr>
                                    <td><?php echo $size; ?>GB</td>
                                    <td><?php echo $speed; ?></td>
                                    <td><?php echo $ff; ?></td>
                                    
                                    <td>
                                    <a href="#" class="btn-secondary">Update</a>
                                    <!-- ?id= the id of supplier that we need to pass into another page -->
                                    <a href="#" class="btn-danger">Delete</a>
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