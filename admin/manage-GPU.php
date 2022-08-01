<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/GPU wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>GPU</h1>
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
                <h3>Memory Size</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Memory Type</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Boost Clock</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Core Clock</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Integrated/Dedicated</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Model</th>
                    <th>Memory Size</th>
                    <th>Memory Type</th>
                    <th>Boost Clock</th>
                    <th>Core Clock</th>
                    <th>Integrated/Dedicated</th>
                    <th>CPU</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT g1.gpuid, g1.model, g1.memorytype memtype, g1.boostclock boost, g1.coreclock core, 
                    g3.memorysizeGB memsize, g2.integrated, cpu.brandname cpu 
                    FROM gpu_contains1 g1 
                    INNER JOIN gpu_contains3 g3
                    ON g1.gpuid = g3.gpuid
                    INNER JOIN gpu_contains2 g2
                    ON g2.cpuid = g3.cpuid
                    INNER JOIN cpu
                    ON cpu.partid = g3.cpuid";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $id = $rows['gpuid'];
                                $model = $rows['model'];
                                $memSize = $rows['memsize'];
                                $memType = $rows['memtype'];
                                $boost = $rows['boost'];
                                $core = $rows['core'];
                                $integrated = $rows['integrated'];
                                $cpu = $rows['cpu'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $memSize; ?>GB</td>
                                    <td><?php echo $memType; ?></td>
                                    <td><?php echo $boost; ?>MHz</td>
                                    <td><?php echo $core; ?>MHz</td>
                                    <td><?php 
                                        if($integrated == 1){
                                            echo "Integrated";
                                        } else{
                                            echo "Dedicated";
                                        }
                                    ?></td>
                                    <td><?php echo $cpu; ?></td>

                                    <td>
                                        <a href="../admin/add-GPU.php?type=update&id=<?php echo $id; ?>&model=<?php echo $model; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-GPU.php?id=<?php echo $id; ?>&model=<?php echo $model; ?>" class="btn-danger">Delete</a>
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