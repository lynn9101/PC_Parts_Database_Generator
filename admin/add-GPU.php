<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>GPU</h1>
            </div>
        </div>
        <!-- End Banner Section -->
        <!--Main Content Section-->
        <section class="form-content text-center">
            <?php
                $type = $_GET['type'];
                if ($type == 'add') {
                    $title = 'NEW MODEL';
                    ?>
                    <h2 class="activity-title"><?php echo $title; ?></h2>
                    <?php
                } else {
                    $title2 = 'UPDATE MODEL';
                    $id = $_GET['id'];
                    $model = $_GET['model'];

                    // Get all information of that GPU
                    $sql = "SELECT g1.gpuid, g1.model, g1.memorytype memtype, g1.boostclock boost, g1.coreclock core, 
                    g3.memorysizeGB memsize, g2.integrated, cpu.partid, cpu.brandname cpu 
                    FROM gpu_contains1 g1
                    INNER JOIN gpu_contains3 g3
                    ON g1.gpuid = g3.gpuid AND g1.gpuid = $id
                    INNER JOIN gpu_contains2 g2
                    ON g2.cpuid = g3.cpuid
                    INNER JOIN cpu
                    ON cpu.partid = g3.cpuid";

                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $gpuid = $row['gpuid'];
                            $gpumodel = $row['model'];
                            $memtype = $row['memtype'];
                            $boost = $row['boost'];
                            $core = $row['core'];
                            $memsize = $row['memsize'];
                            $cpuid = $row['partid'];
                        }
                    }
                    ?>
                    <h2 class="activity-title"><?php echo $title2; ?></h2>
                    <?php
                }
            ?>
            
            <form action="" method="POST">
                <table>
                    <?php
                        if ($type == 'add') {
                            ?>
                            <td>ID</td>
                            <td><input required type="number" name="id" placeholder="enter model ID"></td>
                            <?php
                        }
                    ?>
                    <tr>
                        <td>Model Name</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="model" placeholder="enter model name">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="model" value="<?php echo $gpumodel; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Memory Size</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="memory_size" placeholder="enter model memory size in GB">
                                    <?php
                                } else {
                                    ?>
                                    <input required type="number" name="memory_size" value="<?php echo $memsize; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Memory Type</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="memory_type" placeholder="enter memory type of the model">
                                    <?php
                                } else {
                                    ?>
                                    <input required type="text" name="memory_type" value="<?php echo $memtype; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Boost Clock</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="boost_clock" placeholder="enter boost clock of model in MHz">
                                    <?php
                                } else {
                                    ?>
                                    <input required type="number" name="boost_clock" value="<?php echo $boost; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Core Clock</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="core_clock" placeholder="enter core clock of model in MHz">
                                    <?php
                                } else {
                                    ?>
                                    <input required type="number" name="core_clock" value="<?php echo $core; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>CPU contains in GPU</td>
                        <td>
                            <select name="cpu_goes_with">
                                <?php
                                    // Create PHP Code to display all CPUs from database
                                    // Create SQL to get all CPU
                                    $sql = "SELECT * FROM Cpu";
                                    $conn = OpenCon();
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    if ($result == TRUE) {
                                        // Count the number of rows needed in the table
                                        $numRows = mysqli_num_rows($result);
                                        if ($numRows > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Get details of each CPU
                                                $id = $row['partid'];
                                                $brand_name = $row['brandname'];
                                                if ($id == $cpuid) {
                                                    ?>
                                                    <option value="<?php echo $id; ?>" selected><?php echo $brand_name; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $brand_name; ?></option>
                                                    <?php
                                                }
                                            }
                                        } else {
                                            ?>
                                            <option value="0">No CPU found</option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>         
                </table>
                <!--confirm button-->
                <br>
                <?php
                    if ($type == 'add') {
                        ?>
                        <input type="submit" name="submit" value="Confirm" class="btn">
                        <?php
                    } else {
                        ?>
                        <input type="submit" name="update" value="Update" class="btn">
                        <?php
                    }
                ?>
            </form>
        </section>
        <!--End Main Content Section-->
<?php include('partials/footer.php'); ?>
<?php
    ob_start();
    // Check whether the confirm button is clicked or not
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $model = $_POST['model'];
        $mem_size = $_POST['memory_size'];
        $mem_type = $_POST['memory_type'];
        $boost_clock = $_POST['boost_clock'];
        $core_clock = $_POST['core_clock'];
        $cpu_id = $_POST['cpu_goes_with'];

        // Create the SQL queries
        $sql2 = "INSERT INTO GPU_Contains1 VALUES ($id,'$model','$mem_type',$boost_clock,$core_clock);";
        $sql3 = "INSERT INTO GPU_Contains3 VALUES ($id,'$model',$mem_size,$cpu_id)";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/add-component.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/add-GPU.php");
        }
    }

    // Check whether the ADD button is clicked or not
    if (isset($_POST['update'])) {
        $id = $gpuid;
        $model = $_POST['model'];
        $mem_size = $_POST['memory_size'];
        $mem_type = $_POST['memory_type'];
        $boost_clock = $_POST['boost_clock'];
        $core_clock = $_POST['core_clock'];
        $cpu_id = $_POST['cpu_goes_with'];
        // Create the SQL queries
        $sql2 = "UPDATE GPU_Contains1 SET
                model='$model',
                memorytype='$mem_type',
                boostclock='$boost_clock',
                coreclock='$core_clock'
                WHERE gpuid='$id'";
        $sql3 = "UPDATE GPU_Contains3 SET
                model='$model',
                memorysizeGB='$mem_size',
                cpuid='$cpu_id'
                WHERE gpuid='$id'";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-GPU.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-GPU.php");
        }
    }
?>