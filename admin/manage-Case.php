<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/case wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Case</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection text-center">
        <form action="http://localhost/pc_parts_database_generator/user/CasePage.php" method="POST">
            <div class="filter">
                <h3>Colour</h3>
            </div>
            <select name="color" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT colour 
                    FROM case2";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $color = $rows['colour'];
                                ?>
                                <option value=<?php echo $color?>><?php echo $color?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="filter">
                <h3>Form Factor</h3>
            </div>
            <select name="ff" class="filter-dropdown">
                <option value="0">All</option>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT formfactor 
                    FROM case1";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $ff = $rows['formfactor'];
                                ?>

                                <option value="<?php echo $ff?>"><?php echo $ff?></option>

                                <?php
                            }
                        }
                    }
                    ?>
            </select>

            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model</th>
                    <th>Colour</th>
                    <th>Form Factor</th>
                    <th>Action</th>
                </tr>
                <?php
                    $cond = [];
                    if(isset($_POST['color'])){
                        $color = 'c2.colour = "' . $_POST['color'] . '"';
                        if($_POST['color'] != 0){
                            array_push($cond, $color);
                        }
                    }
                    if(isset($_POST['ff'])){
                        $ff = 'c1.formfactor = "' . $_POST['ff'] . '"';
                        if($_POST['ff'] != 0){
                            array_push($cond, $ff);
                        }
                    }

                    $condStr = "";
                    if(count($cond) > 0){
                        $condStr = "WHERE ";
                        for($x = 0; $x < count($cond); $x++){
                            $condStr .= $cond[$x];
                            if($x + 1 != count($cond)){
                                $condStr .= " OR ";
                            }
                        }
                    }

                    // Query to get all suppliers in the database
                    $sql = "SELECT c1.modelname model, c1.formfactor ff, c2.colour color 
                    FROM case1 c1
                    INNER JOIN case2 c2 
                    ON c1.modelname = c2.modelname $condStr";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $color = $rows['color'];
                                $ff = $rows['ff'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $color; ?></td>
                                    <td><?php echo $ff; ?></td>

                                    <td>
                                        <a href="../admin/add-Case.php?type=update&model=<?php echo $model; ?>&color=<?php echo $color; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-Case.php?model=<?php echo $model; ?>&color=<?php echo $color; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                    }
                ?>
            </table>
        </div>
    </section>
    <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>