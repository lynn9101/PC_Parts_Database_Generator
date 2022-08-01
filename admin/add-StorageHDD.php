<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Storage - HDD</h1>
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
                    $itemmodel = $_GET['model'];
                    $itemsize = $_GET['size'];

                    // Get all information of that SSD Storage
                    $sql = "SELECT h3.model, h3.storagesizeGB modelsize, h2.writespeedMBps writespeed, h2.readspeedMBps readspeed, h1.rpm rpm 
                            FROM HDDStorage3 h3 
                            INNER JOIN HDDStorage2 h2
                            ON h3.model = h2.model AND h3.model='$itemmodel' AND h3.storagesizeGB=$itemsize
                            INNER JOIN HDDStorage1 h1
                            ON h2.writespeedMBps = h1.writespeedMBps AND h2.readspeedMBps = h1.readspeedMBps";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $modelname = $row['model'];
                            $modelsize = $row['modelsize'];
                            $writespeed = $row['writespeed'];
                            $readspeed = $row['readspeed'];
                            $modelrpm = $row['rpm'];
                        }
                    }
                    ?>
                    <h2 class="activity-title"><?php echo $title2; ?></h2>
                    <?php
                }
            ?>    

            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Model</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="model" placeholder="enter model name">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="model" value="<?php echo $modelname; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Storage Size</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="storage_size" placeholder="enter model storage size in GB">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="storage_size" value="<?php echo $modelsize; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Write Speed</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="write_speed" placeholder="enter write speed of model in GB/s">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="write_speed" value="<?php echo $writespeed; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Read Speed</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="read_speed" placeholder="enter read speed of models in GB/s">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="read_speed" value="<?php echo $readspeed; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>RPM</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="model_rpm" placeholder="enter RPM of model">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="model_rpm" value="<?php echo $modelrpm; ?>">
                                    <?php
                                }
                            ?>
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
        $model_name = $_POST['model'];
        $storage_size = $_POST['storage_size'];
        $write_speed = $_POST['write_speed'];
        $read_speed = $_POST['read_speed'];
        $model_rpm = $_POST['model_rpm'];

        // Create the SQL queries
        $sql1 = "INSERT INTO HDDStorage3 VALUES ($storage_size,'$model_name');";
        $sql2 = "INSERT INTO HDDStorage2 VALUES ('$model_name',$write_speed, $read_speed);";
        $sql3 = "INSERT INTO HDDStorage1 VALUES ($write_speed, $read_speed, $model_rpm);";
        $conn = OpenCon();
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/add-component.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/add-StorageHDD.php");
        }
    }

    // Check whether the UPDATE button is clicked or not
    if (isset($_POST['update'])) {
        $model_name = $_POST['model'];
        $storage_size = $_POST['storage_size'];
        $write_speed = $_POST['write_speed'];
        $read_speed = $_POST['read_speed'];
        $model_rpm = $_POST['model_rpm'];

        // Create the SQL queries
        $sql1 = "UPDATE HDDStorage1 SET
                writespeedMBps='$write_speed',
                readspeedMBps='$read_speed',
                rpm='$model_rpm'
                WHERE writespeedMBps='$writespeed' AND readspeedMBps='$readspeed'";

        $sql2 = "UPDATE HDDStorage2 SET
                model='$model_name'
                WHERE model = '$modelname'";

        $sql3 = "UPDATE HDDStorage3 SET
                storagesizeGB='$storage_size'
                WHERE model='$modelname' AND storagesizeGB='$itemsize'";

        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE && $result3 == true) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-Storage.php");
        }
    }
?>