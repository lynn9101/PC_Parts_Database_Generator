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
                        <td><input required type="number" name="memory_size" placeholder="enter model memory size in GB"></td>
                    </tr>
                    <tr>
                        <td>Memory Type</td>
                        <td><input required type="text" name="memory_type" placeholder="enter memory type of the model"></td>
                    </tr>
                    <tr>
                        <td>Boost Clock</td>
                        <td><input required type="number" name="boost_clock" placeholder="enter boost clock of model in MHz"></td>
                    </tr>
                    <tr>
                        <td>Core Clock</td>
                        <td><input required type="number" name="core_clock" placeholder="enter core clock of model in MHz"></td>
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
                                                ?>
                                                <option value="<?php echo $id; ?>"><?php echo $brand_name; ?></option>
                                                <?php
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
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>
        <!--End Main Content Section-->
<?php include('partials/footer.php'); ?>
<?php
    ob_start();
    // Check whetehr the confirm button is clicked or nor
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $model = $_POST['model'];
        $mem_size = $_POST['memory_size'];
        $mem_type = $_POST['memory_type'];
        $boost_clock = $_POST['boost_clock'];
        $core_clock = $_POST['core_clock'];
        $cpu_id = $_POST['cpu_goes_with'];
        $integrated = $_POST['dedicated'];
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
?>