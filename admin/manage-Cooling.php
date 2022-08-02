<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/cooling system wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Cooling</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-Cooling.php" method="POST">
            <div class="filter">
                <h3>Colour</h3>
            </div>
            <select name="color" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT colour 
                    FROM coolingsystem2";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $color = $rows['colour'];
                                ?>
                                <option value=<?php echo $color?>><?php echo $color?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="filter">
                <h3>Noise Level</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(noiseleveldB) min, MAX(noiseleveldB) max
                FROM coolingsystem1";
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
            <p class="text-center">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model Name</th>
                    <th>Colour</th>
                    <th>Noise Level</th>
                    <th>Action</th>
                </tr>
                <?php
                    $condStr = "";
                    if(isset($_POST['min-n'])){
                        $min = $_POST['min-n'];
                        $max = $_POST['max-n'];
                        $condStr = "WHERE c1.noiseleveldB >= $min AND c1.noiseleveldB <= $max";
                        if($_POST['color'] != 0){
                            $condStr .= ' AND c2.colour = "' . $_POST['color'] . '"';
                        }
                    }

                    // Query to get all suppliers in the database
                    $sql = "SELECT c1.modelname model, c1.noiseleveldB noise, c2.colour 
                    FROM coolingsystem1 c1
                    INNER JOIN coolingsystem2 c2 
                    ON c1.modelname = c2.modelname $condStr";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $noise = $rows['noise'];
                                $color = $rows['colour'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $color; ?></td>
                                    <td><?php echo $noise; ?>dB</td>

                                    <td>
                                        <a href="../admin/add-Cooling.php?type=update&model=<?php echo $model; ?>&color=<?php echo $color; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-Cooling.php?model=<?php echo $model; ?>&color=<?php echo $color; ?>" class="btn-danger">Delete</a>
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