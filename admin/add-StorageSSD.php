<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Storage - SSD</h1>
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
                    $itemff = $_GET['ff'];

                    // Get all information of that SSD Storage
                    $sql = "SELECT s1.model, s2.storagesizeGB modelsize, s1.writespeedMBps writespeed, s1.readspeedMBps readspeed, s2.formfactor ff
                            FROM SSDStorage1 s1, SSDStorage2 s2 
                            WHERE s1.model = s2.model AND s1.model = '$itemmodel' AND s2.storagesizeGB = $itemsize AND s2.formfactor = '$itemff'";
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
                            $formfactor = $row['ff'];
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
                                    <input required type="number" name="storage_size" placeholder="enter model storage size in TB">
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
                        <td>Form Factor</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="form_factor" placeholder="enter form factor of model">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="form_factor" value="<?php echo $formfactor; ?>">
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
        $form_factor = $_POST['form_factor'];

        // Create the SQL queries
        $sql1 = "INSERT INTO SSDStorage1 VALUES ('$model_name',$write_speed, $read_speed);";
        $sql2 = "INSERT INTO SSDStorage2 VALUES ($storage_size,'$model_name', '$form_factor');";
        $conn = OpenCon();
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/add-component.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/add-StorageSSD.php");
        }
    }

    // Check whether the UPDATE button is clicked or not
    if (isset($_POST['update'])) {
        $model_name = $_POST['model'];
        $storage_size = $_POST['storage_size'];
        $write_speed = $_POST['write_speed'];
        $read_speed = $_POST['read_speed'];
        $form_factor = $_POST['form_factor'];

        // Create the SQL queries
        $sql1 = "UPDATE SSDStorage1 SET
                model='$model_name',
                writespeedMBps='$write_speed',
                readspeedMBps='$read_speed'
                WHERE model='$itemmodel'";

        $sql2 = "UPDATE SSDStorage2 SET
                storagesizeGB='$storage_size',
                formfactor='$form_factor'
                WHERE model = '$model_name' AND storagesizeGB = '$itemsize' AND formfactor = '$itemff'";

        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE) {
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