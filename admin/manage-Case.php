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
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Model</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Colour</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Form Factor</h3>
            </div>
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
                    // Query to get all suppliers in the database
                    $sql = "SELECT c1.modelname model, c1.formfactor ff, c2.colour color FROM case1 c1, case2 c2 WHERE c1.modelname = c2.modelname";
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