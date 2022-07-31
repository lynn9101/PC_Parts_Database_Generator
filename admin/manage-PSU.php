<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/power supply wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Power Supply</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Model Name</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Colour</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Watts</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Modularity</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model name</th>
                    <th>Watts</th>
                    <th>Modularity</th>
                    <th>Colour</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT p1.modelname model, p1.watts watts, p1.modularity modularity, p2.colour color FROM powersupply1 p1, powersupply2 p2 WHERE p1.modelname = p2.modelname";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $watts = $rows['watts'];
                                $modularity = $rows['modularity'];
                                $color = $rows['color'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $watts; ?>W</td>
                                    <td><?php echo $modularity; ?></td>
                                    <td><?php echo $color; ?></td>

                                    <td>
                                        <a href="#" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="#" class="btn-danger">Delete</a>
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

<?php include('partials-frontend/footer.php'); ?>