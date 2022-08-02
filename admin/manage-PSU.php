<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/power supply wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Power Supply</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-PSU.php" method="POST">
            <div class="filter">
                <h3>Colour</h3>
            </div>
            <select name="color" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT colour 
                    FROM powersupply2";
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
                <h3>Watts</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(watts) min, MAX(watts) max
                FROM powersupply1";
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
            <label for="min-w">min:</label>
            <input type="number" name="min-w" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-w">max:</label>
            <input type="number" name="max-w" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Modularity</h3>
            </div>
            <select name="modular" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT modularity 
                    FROM powersupply1";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $modular = $rows['modularity'];
                                ?>
                                <option value=<?php echo $modular?>><?php echo $modular?></option>

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
                    <th>Model name</th>
                    <th>Watts</th>
                    <th>Modularity</th>
                    <th>Colour</th>
                    <th>Action</th>
                </tr>
                <?php
                    $cond = [];
                    if(isset($_POST['color'])){
                        $color = 'p2.colour = "' . $_POST['color'] . '"';
                        if($_POST['color'] != 0){
                            array_push($cond, $color);
                        }
                    }
                    if(isset($_POST['modular'])){
                        $modular = 'p1.modularity = "' . $_POST['modular'] . '"';
                        if($_POST['modular'] != 0){
                            array_push($cond, $modular);
                        }
                    }

                    $condStr2 = "";
                    $condStr = "";
                    if(isset($_POST['min-w'])){
                        $min = $_POST['min-w'];
                        $max = $_POST['max-w'];
                        $condStr2 = "WHERE p1.watts >= $min AND p1.watts <= $max";
                        if(count($cond) > 0){
                            $condStr = " AND p1.modelname IN (SELECT p1.modelname
                            FROM powersupply1 p1
                            INNER JOIN powersupply2 p2
                            ON p1.modelname = p2.modelname
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
                    $sql = "SELECT p1.modelname model, p1.watts watts, p1.modularity modularity, p2.colour color 
                    FROM powersupply1 p1
                    INNER JOIN powersupply2 p2 
                    ON p1.modelname = p2.modelname $condStr2";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $watts = $rows['watts'];
                                $modularity = $rows['modularity'];
                                $color = $rows['color'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $watts; ?>W</td>
                                    <td><?php echo $modularity; ?></td>
                                    <td><?php echo $color; ?></td>

                                    <td>
                                        <a href="../admin/add-PSU.php?type=update&model=<?php echo $model; ?>&color='<?php echo $color; ?>'" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-PSU.php?type=update&model=<?php echo $model; ?>&color='<?php echo $color; ?>'" class="btn-danger">Delete</a>
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