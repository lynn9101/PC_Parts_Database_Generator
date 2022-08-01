<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>CPU</h1>
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
                    $itemid = $_GET['id'];

                    // Get all information of that Memory
                    $sql = "SELECT c1.partid modelid, c1.coreclock modelclock, c1.coresnumber modelcores, c1.brandname modelname, c2.integrated modelintegrated 
                            FROM Cpu c1, GPU_Contains2 c2 
                            WHERE c1.partid = c2.cpuid AND c1.partid = $itemid";

                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $modelid = $row['modelid'];
                            $modelclock = $row['modelclock'];
                            $modelcores = $row['modelcores'];
                            $modelname = $row['modelname'];
                            $modelintegrated = $row['modelintegrated'];
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
                                    <input required type="text" name="model_name" placeholder="enter model name">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="model_name" value="<?php echo $modelname; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Number of Cores</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="cores_number" placeholder="enter the number of cores in model">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="cores_number" value="<?php echo $modelcores; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Core Speed</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="core_speed" placeholder="enter model core clock speed in GHz">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="core_speed" value="<?php echo $modelclock; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Integrated/ Dedicated</td>
                        <td>
                            <select name="dedicated">
                                <?php
                                    if ($type == 'add') {
                                        ?>
                                        <option value="1">Integrated</option>
                                        <option value="0">Dedicated</option>
                                        <?php
                                    } else {
                                        $option = $modelintegrated;
                                        if ($option == 1) {
                                            ?>
                                            <option value="1" selected>Integrated</option>
                                            <option value="0">Dedicated</option>
                                            <?php
                                        } else if ($option == 0) {
                                            ?>
                                            <option value="1">Integrated</option>
                                            <option value="0" selected>Dedicated</option>
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
    // Check whether the confirm button is clicked or nor
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $model_name = $_POST['model_name'];
        $cores_number = $_POST['cores_number'];
        $core_speed = $_POST['core_speed'];
        $integrated = $_POST['dedicated'];

        // Create the SQL queries
        $sql2 = "INSERT INTO Cpu VALUES ($id,$core_speed,$cores_number,'$model_name');";
        $sql3 = "INSERT INTO GPU_Contains2 VALUES ($integrated,$id)";
        $conn = OpenCon();
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-CPU.php");
        }
    }

    // Check whether the UPDATE button is clicked or not
    if (isset($_POST['update'])) {
        $model_name = $_POST['model_name'];
        $cores_number = $_POST['cores_number'];
        $core_speed = $_POST['core_speed'];
        $integrated = $_POST['dedicated'];
        // Create the SQL queries
        $sql2 = "UPDATE Cpu SET
                coreclock='$core_speed',
                coresnumber='$cores_number',
                brandname='$model_name'
                WHERE partid='$itemid'";

        $sql3 = "UPDATE GPU_Contains2 SET
                integrated=$integrated
                WHERE cpuid='$itemid'";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-CPU.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-CPU.php");
        }
    }
?>