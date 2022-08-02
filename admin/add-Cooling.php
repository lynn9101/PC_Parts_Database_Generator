<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Cooling</h1>
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
                    $itemcolor = $_GET['color'];

                    // Get all information of that Memory
                    $sql = "SELECT c1.modelname model, c1.noiseleveldB noise, c2.colour 
                    FROM coolingsystem1 c1, coolingsystem2 c2 
                    WHERE c1.modelname = c2.modelname AND c1.modelname='$itemmodel' AND c2.colour='$itemcolor'";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $modelname = $row['model'];
                            $modelnoise = $row['noise'];
                            $modelcolor = $row['colour'];
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
                        <td>Colour</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="colour" placeholder="enter model colour">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="colour" value="<?php echo $modelcolor; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Noise Level</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="noise_level" placeholder="enter model noise level in dB">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="noise_level" value="<?php echo $modelnoise; ?>">
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
        $model_name = $_POST['model_name'];
        $colour = $_POST['colour'];
        $noise_level = $_POST['noise_level'];
    
        // Create the SQL queries
        $sql1 = "INSERT INTO CoolingSystem1 VALUES ('$model_name','$noise_level');";
        $sql2 = "INSERT INTO CoolingSystem2 VALUES ('$model_name','$colour');";
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-Cooling.php");
        }
    }

    if (isset($_POST['update'])) {
        // Get the data from the form
        $model_name = $_POST['model_name'];
        $colour = $_POST['colour'];
        $noise_level = $_POST['noise_level'];

        // Create the SQL queries
        $sql2 = "UPDATE CoolingSystem1 SET
                modelname='$model_name',
                noiseleveldB='$noise_level'
                WHERE modelname ='$itemmodel'";

        $sql3 = "UPDATE CoolingSystem2 SET
                colour = '$colour'
                WHERE modelname ='$model_name' AND colour = '$itemcolor'";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-Cooling.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-Cooling.php");
        }
    }
?>