<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/GPU wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>GPU</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/admin/manage-GPU.php" method="POST">
            <div class="filter">
                <h3>Memory Size</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(memorysizeGB) min, MAX(memorysizeGB) max
                FROM gpu_contains3";
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
                <h3>Memory Type</h3>
            </div>
            <select name="memType" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT memorytype 
                    FROM gpu_contains1";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $mem = $rows['memorytype'];
                                ?>
                                <option value="<?php echo $mem?>"><?php echo $mem?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="filter">
                <h3>Boost Clock</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(boostclock) min, MAX(boostclock) max
                FROM gpu_contains1";
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
            <label for="min-b">min:</label>
            <input type="number" name="min-b" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-b">max:</label>
            <input type="number" name="max-b" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Core Clock</h3>
            </div>
            <?php
                // Query to get all suppliers in the database
                $sql = "SELECT MIN(coreclock) min, MAX(coreclock) max
                FROM gpu_contains1";
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
            <label for="min-c">min:</label>
            <input type="number" name="min-c" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $min;?>>
            <br>
            <label for="max-c">max:</label>
            <input type="number" name="max-c" min=<?php echo $min;?> min=<?php echo $max;?> value=<?php echo $max;?>>
            <p class="text-center range-text">(min: <?php echo $min;?> max: <?php echo $max;?>)</p>

            <div class="filter">
                <h3>Integrated/Dedicated</h3>
            </div>
            <select name="integrate" class="filter-dropdown">
                <option value="-1">All</option>
                <option value="0">Dedicated</option>
                <option value="1">Integrated</option>
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
                    <th>Memory Size</th>
                    <th>Memory Type</th>
                    <th>Boost Clock</th>
                    <th>Core Clock</th>
                    <th>Integrated/Dedicated</th>
                    <th>CPU</th>
                    <th>Action</th>
                </tr>
                <?php
                    $cond = [];
                    if(isset($_POST['memType'])){
                        $mType = 'g1.memorytype = "' . $_POST['memType'] . '"';
                        if($_POST['memType'] != 0){
                            array_push($cond, $mType);
                        }
                    }
                    if(isset($_POST['integrate'])){
                        $integrate = 'g2.integrated = ' . $_POST['integrate'];
                        if($_POST['integrate'] != -1){
                            array_push($cond, $integrate);
                        }
                    }

                    $condStr2 = "";
                    $condStr = "";
                    if(isset($_POST['min-s'])){
                        $minS = $_POST['min-s'];
                        $maxS = $_POST['max-s'];
                        $minB = $_POST['min-b'];
                        $maxB = $_POST['max-b'];
                        $minC = $_POST['min-c'];
                        $maxC = $_POST['max-c'];
                        $condStr2 = "WHERE g3.memorysizeGB >= $minS AND g3.memorysizeGB <= $maxS 
                        AND g1.boostclock >= $minB AND g1.boostclock <= $maxB 
                        AND g1.coreclock >= $minC AND g1.coreclock <= $maxC";
                        if(count($cond) > 0){
                            $condStr = " AND g1.gpuid IN (SELECT g1.gpuid
                            FROM gpu_contains1 g1 
                            INNER JOIN gpu_contains3 g3
                            ON g1.gpuid = g3.gpuid
                            INNER JOIN gpu_contains2 g2
                            ON g2.cpuid = g3.cpuid
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
                    $sql = "SELECT g1.gpuid, g1.model, g1.memorytype memtype, g1.boostclock boost, g1.coreclock core, 
                    g3.memorysizeGB memsize, g2.integrated, cpu.brandname cpu 
                    FROM gpu_contains1 g1 
                    INNER JOIN gpu_contains3 g3
                    ON g1.gpuid = g3.gpuid
                    INNER JOIN gpu_contains2 g2
                    ON g2.cpuid = g3.cpuid
                    INNER JOIN cpu
                    ON cpu.partid = g3.cpuid $condStr2";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $id = $rows['gpuid'];
                                $model = $rows['model'];
                                $memSize = $rows['memsize'];
                                $memType = $rows['memtype'];
                                $boost = $rows['boost'];
                                $core = $rows['core'];
                                $integrated = $rows['integrated'];
                                $cpu = $rows['cpu'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $memSize; ?>GB</td>
                                    <td><?php echo $memType; ?></td>
                                    <td><?php echo $boost; ?>MHz</td>
                                    <td><?php echo $core; ?>MHz</td>
                                    <td><?php 
                                        if($integrated == 1){
                                            echo "Integrated";
                                        } else{
                                            echo "Dedicated";
                                        }
                                    ?></td>
                                    <td><?php echo $cpu; ?></td>

                                    <td>
                                        <a href="../admin/add-GPU.php?type=update&id=<?php echo $id; ?>&model=<?php echo $model; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-GPU.php?id=<?php echo $id; ?>&model=<?php echo $model; ?>" class="btn-danger">Delete</a>
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