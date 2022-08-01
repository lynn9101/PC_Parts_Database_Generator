<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Case</h1>
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
                    $sql = "SELECT c1.modelname model, c1.formfactor ff, c2.colour color 
                            FROM case1 c1, case2 c2 
                            WHERE c1.modelname = c2.modelname AND c1.modelname='$itemmodel' AND c2.colour='$itemcolor'";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $modelname = $row['model'];
                            $modelff = $row['ff'];
                            $modelcolor = $row['color'];
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
                        <td>Model Colour</td>
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
                        <td>Form Factor</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="form_factor" placeholder="enter model form factor">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="form_factor" value="<?php echo $modelff; ?>">
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
        $model_name = $_POST['model_name'];
        $colour = $_POST['colour'];
        $form_factor = $_POST['form_factor'];

        // Create the SQL queries
        $sql1 = "INSERT INTO Case1 VALUES ('$model_name','$form_factor');";
        $sql2 = "INSERT INTO Case2 VALUES ('$model_name','$colour');";
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-Case.php");
        }
    }

    // Check whether the UPDATE button is clicked or not
    if (isset($_POST['update'])) {
        $model_name = $_POST['model_name'];
        $colour = $_POST['colour'];
        $form_factor = $_POST['form_factor'];

        // Create the SQL queries
        $sql1 = "UPDATE Case1 SET
                modelname='$model_name',
                formfactor='$form_factor'
                WHERE modelname='$itemmodel'";

        $sql2 = "UPDATE Case2 SET
                colour='$colour'
                WHERE modelname='$model_name' AND colour='$itemcolor'";

        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-Case.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-Case.php");
        }
    }
?>