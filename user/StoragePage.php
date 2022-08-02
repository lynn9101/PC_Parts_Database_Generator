<?php include('partials-frontend/header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/storage wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Storage</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">

        <form action="http://localhost/pc_parts_database_generator/user/StoragePage.php" method="POST">
            <div class="filter">
                <h3>Storage Type (HDD/SSD)</h3>
            </div>
            <select name="type" class="filter-dropdown" id="storageType">
                <option value="0">All</option>
                <option value="1">SSD</option>
                <option value="2">HDD</option>
            </select>

            <div id="ff">
                <label for="ff">Form Factor</label>
                <select name="ff" class="filter-dropdown">
                    <option value="0">All</option>
                    <?php
                        $sql = "SELECT DISTINCT formfactor 
                        FROM SSDStorage2";
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
            </div>
            
            <?php
                $sql = "SELECT MIN(rpm) min, MAX(rpm) max
                FROM HDDStorage1";
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
            <div id="RPM">
                <label>RPM</label>
                <br>
                <label for="min-RPM">min:</label>
                <input type="number" name="min-RPM" id="RPMmin" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
                <br>
                <label for="max-RPM">max:</label>
                <input type="number" name="max-RPM" id="RPMmax" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
                <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>
            </div>
            <!-- <script>
                RPMmax = <?php echo $max?>;
                RPMmin = <?php echo $min?>;
            </script> -->

            <div class="filter">
                <h3>Size</h3>
            </div>
            <?php
                $sql = "SELECT MIN(storagesizeGB) min, MAX(storagesizeGB) max
                FROM SSDStorage2";
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

                $sql = "SELECT MIN(storagesizeGB) min, MAX(storagesizeGB) max
                FROM HDDStorage3";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                if ($result == TRUE) {
                    // Count the number of rows needed in the table
                    $numRows = mysqli_num_rows($result);

                    if ($numRows > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            // Get data from each row
                            $min = min($rows['min'], $min);
                            $max = max($rows['max'], $max);
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
                <h3>Write Speed</h3>
            </div>

            <div class="filter">
                <h3>Read Speed</h3>
            </div>

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>

        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model</th>
                    <th>Storage Size</th>
                    <th>Write Speed</th>
                    <th>Read Speed</th>
                    <th>Form Factor</th>
                    <th>RPM</th>
                </tr>
                <?php
                    // Query to get all SSD in the database
                    $sql = "SELECT s1.model, s2.storagesizeGB modelsize, s1.writespeedMBps writespeed, s1.readspeedMBps readspeed, s2.formfactor ff
                            FROM SSDStorage1 s1, SSDStorage2 s2 
                            WHERE s1.model = s2.model";

                    $sql2 = "SELECT h3.model, h3.storagesizeGB modelsize, h2.writespeedMBps writespeed, h2.readspeedMBps readspeed, h1.rpm rpm 
                            FROM HDDStorage3 h3 
                            INNER JOIN HDDStorage2 h2
                            ON h3.model = h2.model
                            INNER JOIN HDDStorage1 h1
                            ON h2.writespeedMBps = h1.writespeedMBps AND h2.readspeedMBps = h1.readspeedMBps";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

                    if ($result == TRUE && $result2 == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);
                        $numRows2 = mysqli_num_rows($result2);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $modelsize = $rows['modelsize'];
                                $writespeed = $rows['writespeed'];
                                $readspeed = $rows['readspeed'];
                                $ff = $rows['ff'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $modelsize; ?>GB</td>
                                    <td><?php echo $writespeed; ?>GB/s</td>
                                    <td><?php echo $readspeed; ?>GB/s</td>
                                    <td><?php echo $ff; ?></td>
                                    <td><?php echo 'N/A'; ?></td>
                                </tr>

                                <?php
                            }
                        }
                        if ($numRows2 > 0) {
                            while ($rows2 = mysqli_fetch_assoc($result2)) {
                                // Get data from each row
                                $model = $rows2['model'];
                                $modelsize = $rows2['modelsize'];
                                $writespeed = $rows2['writespeed'];
                                $readspeed = $rows2['readspeed'];
                                $rpm = $rows2['rpm'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $modelsize; ?>GB</td>
                                    <td><?php echo $writespeed; ?>GB/s</td>
                                    <td><?php echo $readspeed; ?>GB/s</td>
                                    <td><?php echo 'N/A'; ?></td>
                                    <td><?php echo $rpm; ?>RPM</td>
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

<script src="storage.js" defer></script>

<?php include('partials-frontend/footer.php'); ?>