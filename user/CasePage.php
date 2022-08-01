<?php include('partials-frontend/header.php'); ?>

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
        <form action="" method="POST">
            <div class="filter">
                <h3>Colour</h3>
            </div>
            <ul>
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
                            $count = 0;
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $color = $rows['colour'];
                                $inputID = "color$count";
                                ?>
                                <li class="filter-item">
                                    <input type="checkbox" id=<?php echo $inputID?> name=<?php echo $inputID?> value=<?php echo $count?>>
                                    <label for=<?php echo $inputID?>><?php echo $color?></label>
                                </li>

                                <?php
                                $count++;
                            }
                        }
                    }
                    ?>
            </ul>
            <div class="filter">
                <h3>Form Factor</h3>
            </div>
            <ul>
                <?php
                    // Query to get all suppliers in the database
                    $sql = "SELECT DISTINCT formfactor 
                    FROM case1";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        // Count the number of rows needed in the table
                        $numRows = mysqli_num_rows($result);

                        if ($numRows > 0) {
                            $count = 0;
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Get data from each row
                                $ff = $rows['formfactor'];
                                $inputID = "ff$count";
                                ?>

                                <li class="filter-item">
                                    <input type="checkbox" id=<?php echo $inputID?> name=<?php echo $inputID?> value=<?php echo $count?>>
                                    <label for=<?php echo $inputID?>><?php echo $ff?></label>
                                </li>

                                <?php
                                $count++;
                            }
                        }
                    }
                    ?>
            </ul>
            <div class="confirm-section">
                <input type="submit" name="confirm-filter" value="Confirm" class="confirm-btn">
            </div>
        </form>
        </div>

        <div class="results-section">
            <?php 
                $query = "WHERE c2.colour='Silver'";
                include('table-assets/caseTable.php');
            ?>
        </div>
    </section>
    <!-- End Main Content Section -->

<?php include('partials-frontend/footer.php'); ?>