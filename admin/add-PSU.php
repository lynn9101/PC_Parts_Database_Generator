<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Power Supply</h1>
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
                    $modelname = $_GET['model'];
                    // Get all information of that Power Supply
                    $sql = "SELECT p1.modelname model, p1.watts watts, p1.modularity modularity, p2.colour color 
                            FROM powersupply1 p1, powersupply2 p2 
                            WHERE p1.modelname = p2.modelname AND p1.modelname = '$modelname';";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $psumodel = $row['model'];
                            $psuwatts = $row['watts'];
                            $psumodul = $row['modularity'];
                            $psucolor = $row['color'];
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
                                    <input required type="text" name="model" placeholder="enter model name">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="model" value="<?php echo $psumodel; ?>">
                                    <?php
                                }
                            ?>  
                        </td>
                    </tr>
                    <tr>
                        <td>Watts</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="watts" placeholder="enter the number in Watts">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="watts" value="<?php echo $psuwatts; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Modularity</td>
                        <td>
                            <select name="modularity">
                                <?php
                                    if ($type == 'add') {
                                        ?>
                                        <option value="1">No</option>
                                        <option value="2">Semi</option>
                                        <option value="3">Full</option>
                                        <?php
                                    } else {
                                        if ($psumodul == 'No') {
                                            ?>
                                            <option value="1" selected>No</option>
                                            <option value="2">Semi</option>
                                            <option value="3">Full</option>
                                            <?php
                                        } else if ($psumodul == "Semi") {
                                            ?>
                                            <option value="1">No</option>
                                            <option value="2" selected>Semi</option>
                                            <option value="3">Full</option>
                                            <?php
                                        } else if ($psumodul == "Full") {
                                            ?>
                                            <option value="1">No</option>
                                            <option value="2">Semi</option>
                                            <option value="3" selected>Full</option>
                                            <?php
                                        }
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Model Colour</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="colour" placeholder="enter colour of model">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="colour" value="<?php echo $psucolor; ?>">
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
        $model = $_POST['model'];
        $watts = $_POST['watts'];
        $modularity = $_POST['modularity'];
        if ($modularity == 1) {
            $option = 'No';
        } else if ($modularity == 2) {
            $option = 'Semi';
        } else if ($modularity == 3) {
            $option = 'Full';
        }
        $colour = $_POST['colour'];

        // Create the SQL queries
        $sql2 = "INSERT INTO PowerSupply1 VALUES ('$model',$watts,'$option')";
        $sql3 = "INSERT INTO PowerSupply2 VALUES ('$model','$colour')";
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-PSU.php");
        }
    }

    if (isset($_POST['update'])) {
        // Get the data from the form
        $model = $_POST['model'];
        $watts = $_POST['watts'];
        $modularity = $_POST['modularity'];
        if ($modularity == 1) {
            $option = 'No';
        } else if ($modularity == 2) {
            $option = 'Semi';
        } else if ($modularity == 3) {
            $option = 'Full';
        }
        $colour = $_POST['colour'];
        // Create the SQL queries
        $sql2 = "UPDATE PowerSupply1 SET
                modelname='$model',
                watts='$watts',
                modularity='$option'
                WHERE modelname='$psumodel'";

        $sql3 = "UPDATE PowerSupply2 SET
                modelname='$model',
                colour='$colour'
                WHERE modelname='$psumodel'";
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-PSU.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-PSU.php");
        }
    }
?>