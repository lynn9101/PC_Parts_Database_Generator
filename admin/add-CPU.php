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
                        <td><input required type="text" name="model_name" placeholder="enter model name"></td>
                    </tr>
                    <tr>
                        <td>Number of Cores</td>
                        <td><input required type="text" name="cores_number" placeholder="enter the number of cores in model"></td>
                    </tr>
                    <tr>
                        <td>Core Speed</td>
                        <td><input required type="number" name="core_speed" placeholder="enter model core clock speed in GHz"></td>
                    </tr>
                    <tr>
                        <td>Integrated/ Dedicated</td>
                        <td>
                            <select name="dedicated">
                                <option value="1">Integrated</option>
                                <option value="0">Dedicated</option>
                            </select>
                        </td>
                    </tr> 
                </table>
                <!--confirm button-->
                <br>
                <input type="submit" name="submit" value="Confirm" class="btn">
            </form>
        </section>

        <?php
                    
                    $ID = $_POST['ID'];
                    $ModelName = $_POST['ModelName'];
                    $Cores = $_POST['Cores'];
                    $CoreSpeed = $_POST['Core Speed'];
                    $Integrated = $_POST['Integrated'];
                    $sql = "INSERT INTO cpu (ID, ModelName, Cores, Core Speed, Integrated/Dedicated) /*VALUES (a, b, c, d, e)*/";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['brandname'];
                                $cores = $rows['coresnumber'];
                                $core_speed = $rows['coreclock'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $cores; ?></td>
                                    <td><?php echo $core_speed; ?>GHz</td>
                                </tr>

                                <?php
                            }
                        }
                    }
                ?>
        <!--End Main Content Section-->

<?php include('partials/footer.php'); ?>