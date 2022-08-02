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
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-Memory.php" method="POST">
            <div class="filter">
                <h3>Size</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(sizeGB) min, MAX(sizeGB) max
                FROM memory2";
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
            <input type="number" name="min-s" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-s">max:</label>
            <input type="number" name="max-s" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Speed</h3>
            </div>
            <select name="speed" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT speed 
                    FROM memory2";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $speed = $rows['speed'];
                                ?>
                                <option value="<?php echo $speed?>"><?php echo $speed?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="filter">
                <h3>Form Factor</h3>
            </div>
            <select name="ff" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT formfactor 
                    FROM memory1";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $ff = $rows['formfactor'];
                                ?>
                                <option value="<?php echo $ff?>"><?php echo $ff?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Speed</th>
                    <th>Form Factor</th>
                    <th>Action</th>
                </tr>
                <?php
                    $cond = [];
                    if(isset($_POST['ff'])){
                        $ff = 'm1.formfactor = "' . $_POST['ff'] . '"';
                        if($_POST['ff'] != 0){
                            array_push($cond, $ff);
                        }
                    }
                    if(isset($_POST['speed'])){
                        $speed = 'm2.speed = "' . $_POST['speed'] . '"';
                        if($_POST['speed'] != 0){
                            array_push($cond, $speed);
                        }
                    }

                    $condStr2 = "";
                    $condStr = "";
                    if(isset($_POST['min-s'])){
                        $min = $_POST['min-s'];
                        $max = $_POST['max-s'];
                        $condStr2 = "WHERE m2.sizeGB >= $min AND m2.sizeGB <= $max";
                        if(count($cond) > 0){
                            $condStr = " AND m1.partid IN (SELECT m1.partid
                            FROM memory1 m1
                            INNER JOIN memory2 m2
                            ON m1.partid = m2.partid
                            WHERE ";
                            for($x = 0; $x < count($cond); $x++){
                                $condStr .= $cond[$x];
                                if($x + 1 != count($cond)){
                                    $condStr .= " OR ";
                                }
                            }
                            $condStr .= ")";
                            $condStr2 .= $condStr;
                        }
                    }

                    // Query to get all suppliers in the database
                    $sql = "SELECT m1.partid id, m1.formfactor ff, m2.modelname model, m2.sizeGB size, m2.speed 
                    FROM memory1 m1, memory2 m2 
                    WHERE m1.partid = m2.partid $condStr2";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $id = $rows['id'];
                                $model = $rows['model'];
                                $ff = $rows['ff'];
                                $size = $rows['size'];
                                $speed = $rows['speed'];
                                ?>

                                <tr>
                                    <th><?php echo $model; ?></td>
                                    <td><?php echo $size; ?>GB</td>
                                    <td><?php echo $speed; ?></td>
                                    <td><?php echo $ff; ?></td>

                                    <td>
                                        <a href="../admin/add-Memory.php?type=update&id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-Memory.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
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