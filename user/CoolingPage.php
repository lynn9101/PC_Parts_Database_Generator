<?php include('partials-frontend/header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <div class="product-banner-text">
            <h1>Cooling</h1>
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
                <h3>Noise Level</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model Name</th>
                    <th>Colour</th>
                    <th>Noise Level</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT c1.modelname model, c1.noiseleveldB noise, c2.colour 
                    FROM coolingsystem1 c1, coolingsystem2 c2 
                    WHERE c1.modelname = c2.modelname";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $noise = $rows['noise'];
                                $color = $rows['colour'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $color; ?></td>
                                    <td><?php echo $noise; ?>dB</td>
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