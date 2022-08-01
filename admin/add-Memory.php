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
            <h2 class="activity-title">
                NEW MODEL
            </h2>
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>ID</td>
                        <td><input required type="number" name="id" placeholder="enter model ID"></td>
                    </tr>
                    <tr>
                        <td>Model Name</td>
                        <td><input required type="text" name="model" placeholder="enter model name"></td>
                    </tr>
                    <tr>
                        <td>Memory Size</td>
                        <td><input required type="number" name="size" placeholder="enter memory size in GB"></td>
                    </tr>
                    <tr>
                        <td>Memory Speed</td>
                        <td><input required type="text" name="speed" placeholder="enter memory speed (e.g. 3600MHz)"></td>
                    </tr>
                    <tr>
                        <td>Form Factor</td>
                        <td><input required type="text" name="form_factor" placeholder="enter model Form Factor"></td>
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
    // Check whether the confirm button is clicked or nor
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
?>