<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Memory</h1>
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
                    $sql = "SELECT m1.partid memid, m1.formfactor memff, m2.modelname memmodel, m2.sizeGB memsize, m2.speed memspeed 
                            FROM memory1 m1, memory2 m2 
                            WHERE m1.partid = m2.partid AND m1.partid = $itemid";

                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $memid = $row['memid'];
                            $memff = $row['memff'];
                            $memmodel = $row['memmodel'];
                            $memsize = $row['memsize'];
                            $memspeed = $row['memspeed'];
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
                                    <input type="text" name="model" value="<?php echo $memmodel; ?>">
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
                                    <input required type="number" name="size" placeholder="enter memory size in GB">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="size" value="<?php echo $memsize; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Memory Speed</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="speed" placeholder="enter memory speed (e.g. 3600MHz)">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="speed" value="<?php echo $memspeed; ?>">
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
                                    <input required type="text" name="form_factor" placeholder="enter model Form Factor">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="form_factor" value="<?php echo $memff; ?>">
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
    // Check whether the confirm button is clicked or not
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $model = $_POST['model'];
        $size = $_POST['size'];
        $speed = $_POST['speed'];
        $form_factor = $_POST['form_factor'];
        // Create the SQL queries
        $sql2 = "INSERT INTO Memory1 VALUES ($id,'$form_factor')";
        $sql3 = "INSERT INTO Memory2 VALUES ($id,'$model',$size,'$speed')";
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-Memory.php");
        }
    }

    if (isset($_POST['update'])) {
        // Get the data from the form
        $id = $memid;
        $model = $_POST['model'];
        $size = $_POST['size'];
        $speed = $_POST['speed'];
        $form_factor = $_POST['form_factor'];
        // Create the SQL queries
        $sql2 = "UPDATE Memory1 SET
                formfactor='$form_factor'
                WHERE partid='$id'";
        $sql3 = "UPDATE Memory2 SET
                modelname='$model',
                sizeGB='$size',
                speed='$speed'
                WHERE partid='$id'";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-Memory.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-Memory.php");
        }
    }
?>