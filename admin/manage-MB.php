<?php include('partials/manage-header.php'); ?>

    <!-- Banner Section -->
    <div class="product-banner">
        <img src="../images/motherboard wallpaper.jpg" class="banner-img">
        <div class="product-banner-text">
            <h1>Motherboard</h1>
        </div>
    </div>
    <!-- End Banner Section -->

    <!-- Main Content Section -->
    <section class="product-main-content">
        <div class="filter-selection">
            <div class="filter">
                <h3>></h3>
                <h3>Form Factor</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Chipset</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Memory Slots</h3>
            </div>
            <div class="filter">
                <h3>></h3>
                <h3>Memory Size</h3>
            </div>
        </div>
        
        <div class="results-section">
            <table>
                <tr>
                    <th>Chipset</th>
                    <th>Form Factor</th>
                    <th>Memory Slots</th>
                    <th>Supported<br/>Memory Size</th>
                    <th>Action</th>
                </tr>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT m2.chipset, m1.formfactor ff, m3.memoryslots memslots, m1.supportedmemorysize memsize
                    FROM motherboard2 m2 
                    INNER JOIN motherboard3 m3
                    ON m2.id = m3.id
                    INNER JOIN motherboard1 m1
                    ON m2.formfactor = m1.formfactor";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $chipset = $rows['chipset'];
                                $ff = $rows['ff'];
                                $memslots = $rows['memslots'];
                                $memsize = $rows['memsize'];
                                ?>

                                <tr>
                                    <td><?php echo $chipset; ?></td>
                                    <td><?php echo $ff; ?></td>
                                    <td><?php echo $memslots; ?></td>
                                    <td><?php echo $memsize; ?>GB</td>

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

<?php include('partials/footer.php'); ?>