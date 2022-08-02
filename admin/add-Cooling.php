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
            <h2 class="activity-title">
                NEW MODEL
            </h2>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Model Name</td>
                        <td><input required type="text" name="model_name" placeholder="enter cooling model name"></td>
                    </tr>
                    <tr>
                        <td>Colour</td>
                        <td><input required type="text" name="colour" placeholder="enter model colour"></td>
                    </tr>
                    <tr>
                        <td>Noise Level</td>
                        <td><input required type="text" name="noise_level" placeholder="enter model noise level (e.g. 15Db)"></td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
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
        $sql1 = "INSERT INTO Cooling1 VALUES ('$model_name','$form_factor');";
        $sql2 = "INSERT INTO Cooling2 VALUES ('$model_name','$noise_level');";
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
            header("location: http://localhost/pc_parts_database_generator/admin/add-MB.php");
        }
    }

    if (isset($_POST['update'])) {
        // Get the data from the form
        $model_name = $_POST['model_name'];
        $colour = $_POST['colour'];
        $noise_level = $_POST['noise_level'];

        // Create the SQL queries
        $sql2 = "UPDATE Cooling1 SET
                noise_level='$noise_level'
                WHERE partid='$id'";
        $sql3 = "UPDATE Cooling2 SET
                model_name='$model_name',
                colour ='$colour',
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