<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/motherboard wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Motherboard</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-MB.php" method="POST">
            <div class="filter">
                <h3>Form Factor</h3>
            </div>
            <select name="ff" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT formfactor 
                    FROM motherboard1";
                    $conn = OpenCon();
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

            <div class="filter">
                <h3>Memory Slots</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(memoryslots) min, MAX(memoryslots) max
                FROM motherboard3";
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
            <label for="min-sl">min:</label>
            <input type="number" name="min-sl" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-sl">max:</label>
            <input type="number" name="max-sl" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Memory Size</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(supportedmemorysize) min, MAX(supportedmemorysize) max
                FROM motherboard1";
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

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Chipset</th>
                    <th>Form Factor</th>
                    <th>Memory Slots</th>
                    <th>Supported<br/>Memory Size</th>
                    <th>Action</th>
                </tr>
                <?php
                    $condStr = "";
                    if(isset($_POST['min-s'])){
                        $minS = $_POST['min-s'];
                        $maxS = $_POST['max-s'];
                        $minSl = $_POST['min-sl'];
                        $maxSl = $_POST['max-sl'];
                        $condStr = "WHERE m1.supportedmemorysize >= $minS AND m1.supportedmemorysize <= $maxS AND m3.memoryslots >= $minSl AND m3.memoryslots <= $maxSl";
                        if($_POST['ff'] != 0){
                            $condStr .= ' AND m1.formfactor = "' . $_POST['ff'] . '"';
                        }
                    }

                    // Query to get all suppliers in the database
                    $sql = "SELECT m2.id, m2.chipset, m1.formfactor ff, m3.memoryslots memslots, m1.supportedmemorysize memsize
                    FROM motherboard2 m2 
                    INNER JOIN motherboard3 m3
                    ON m2.id = m3.id
                    INNER JOIN motherboard1 m1
                    ON m2.formfactor = m1.formfactor $condStr";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $mbid = $rows['id'];
                                $chipset = $rows['chipset'];
                                $ff = $rows['ff'];
                                $memslots = $rows['memslots'];
                                $memsize = $rows['memsize'];
                                ?>

                                <tr>
                                    <td><?php echo $chipset; ?></td>
                                    <td><?php echo $ff; ?></td>
                                    <td><?php echo $memslots; ?></td>
                                    <td><?php echo $memsize; ?>GB</td>

                                    <td>
                                        <a href="../admin/add-MB.php?type=update&id=<?php echo $mbid; ?>&formfactor=<?php echo $ff; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-MB.php?&id=<?php echo $mbid; ?>&formfactor=<?php echo $ff; ?>" class="btn-danger">Delete</a>
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