<?php include('partials-frontend/header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/CPU wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>CPU</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Core Clock Speed</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Number of Cores</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Noise Level</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model Name</th>
                    <th>Cores</th>
                    <th>Core Clock Speed</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT * FROM cpu";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['brandname'];
                                $cores = $rows['coresnumber'];
                                $core_speed = $rows['coreclock'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $cores; ?></td>
                                    <td><?php echo $core_speed; ?>GHz</td>
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

<?php include('partials-frontend/footer.php'); ?>