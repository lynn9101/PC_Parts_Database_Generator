<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/storage wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Storage</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Storage Type (HDD/SSD)</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Size</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Speed</h3>
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
                    <th>Storage Size</th>
                    <th>Write Speed</th>
                    <th>Read Speed</th>
                    <th>Form Factor</th>
                    <th>RPM</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Query to get all SSD in the database
                    $sql = "SELECT s1.model, s2.storagesizeGB modelsize, s1.writespeedMBps writespeed, s1.readspeedMBps readspeed, s2.formfactor ff
                            FROM SSDStorage1 s1, SSDStorage2 s2 
                            WHERE s1.model = s2.model";

                    $sql2 = "SELECT h3.model, h3.storagesizeGB modelsize, h2.writespeedMBps writespeed, h2.readspeedMBps readspeed, h1.rpm rpm 
                            FROM HDDStorage3 h3 
                            INNER JOIN HDDStorage2 h2
                            ON h3.model = h2.model
                            INNER JOIN HDDStorage1 h1
                            ON h2.writespeedMBps = h1.writespeedMBps AND h2.readspeedMBps = h1.readspeedMBps";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

                    if ($result == TRUE && $result2 == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);
                        $numRows2 = mysqli_num_rows($result2);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $model = $rows['model'];
                                $modelsize = $rows['modelsize'];
                                $writespeed = $rows['writespeed'];
                                $readspeed = $rows['readspeed'];
                                $ff = $rows['ff'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $modelsize; ?>GB</td>
                                    <td><?php echo $writespeed; ?>MB/s</td>
                                    <td><?php echo $readspeed; ?>MB/s</td>
                                    <td><?php echo $ff; ?></td>
                                    <td><?php echo 'N/A'; ?></td>

                                    <td>
                                        <a href="../admin/add-StorageSSD.php?type=update&model=<?php echo $model; ?>&size=<?php echo $modelsize; ?>&ff=<?php echo $ff; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-StorageSSD.php?model=<?php echo $model; ?>&size=<?php echo $modelsize; ?>&ff=<?php echo $ff; ?>" class="btn-danger">Delete</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        if ($numRows2 > 0) {
                            while ($rows2 = mysqli_fetch_assoc($result2)) {
                                // Get data from each row
                                $model = $rows2['model'];
                                $modelsize = $rows2['modelsize'];
                                $writespeed = $rows2['writespeed'];
                                $readspeed = $rows2['readspeed'];
                                $rpm = $rows2['rpm'];
                                ?>

                                <tr>
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $modelsize; ?>GB</td>
                                    <td><?php echo $writespeed; ?>GB/s</td>
                                    <td><?php echo $readspeed; ?>GB/s</td>
                                    <td><?php echo 'N/A'; ?></td>
                                    <td><?php echo $rpm; ?>RPM</td>

                                    <td>
                                        <a href="../admin/add-StorageHDD.php?type=update&model=<?php echo $model; ?>&size=<?php echo $modelsize; ?>" class="btn-secondary">Update</a>
                                        <!-- ?id= the id of supplier that we need to pass into another page -->
                                        <a href="../admin/delete/delete-StorageHDD.php?model=<?php echo $model; ?>&size=<?php echo $modelsize; ?>" class="btn-danger">Delete</a>
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