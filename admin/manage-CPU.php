<?php include('partials/manage-header.php'); ?>

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
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-CPU.php" method="POST">
            <div class="filter">
                <h3>Core Clock Speed</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(coreclock) min, MAX(coreclock) max
                FROM cpu";
                $conn = OpenCon();
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                if ($result == TRUE) {
                    // Count the number of rows needed in the table
                    $numRows = mysqli_num_rows($result);

                    if ($numRows > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            // Get data from each row
                            $min = $rows['min'];
                            $max = $rows['max'];
                        }
                    }
                }
            ?>
            <br>
            <label for="min-s">min:</label>
            <input type="number" name="min-s" step="0.1" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-s">max:</label>
            <input type="number" name="max-s" step="0.1" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Number of Cores</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(coresnumber) min, MAX(coresnumber) max
                FROM cpu";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                if ($result == TRUE) {
                    // Count the number of rows needed in the table
                    $numRows = mysqli_num_rows($result);

                    if ($numRows > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            // Get data from each row
                            $min = $rows['min'];
                            $max = $rows['max'];
                        }
                    }
                }
            ?>
            <br>
            <label for="min-n">min:</label>
            <input type="number" name="min-n" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-n">max:</label>
            <input type="number" name="max-n" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model Name</th>
                    <th>Number of cores</th>
                    <th>Core Clock Speed</th>
                    <th>Action</th>
                </tr>
                <?php
                    $condStr = "";
                    if(isset($_POST['min-s'])){
                        $minS = $_POST['min-s'];
                        $maxS = $_POST['max-s'];
                        $minN = $_POST['min-n'];
                        $maxN = $_POST['max-n'];
                        $condStr = "WHERE coreclock >= $minS AND coreclock <= $maxS AND coresnumber >= $minN AND coresnumber <= $maxN";
                    }

                    // Query to get all suppliers in the database
                    $sql = "SELECT * FROM cpu $condStr";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $id = $rows['partid'];
                                $model = $rows['brandname'];
                                $cores = $rows['coresnumber'];
                                $core_speed = $rows['coreclock'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $cores; ?></td>
                                    <td><?php echo $core_speed; ?>GHz</td>

                                    <td>
                                        <a href="../admin/add-CPU.php?type=update&id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-CPU.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
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