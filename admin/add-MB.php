<?php 
    include('partials/add-header.php');
?>
        <!-- Banner Section -->
        <div class="page-banner">
            <div class="banner-text">
                <h1>Motherboard</h1>
            </div>
        </div>
        <!-- End Banner Section -->
        <!--Main Content Section-->
        <section class="form-content text-center">
            <?php
                $type = $_GET['type'];
                if ($type == 'add') {
                    $title = 'NEW MODEL';
                    ?>
                    <h2 class="activity-title"><?php echo $title; ?></h2>
                    <?php
                } else {
                    $title2 = 'UPDATE MODEL';
                    $itemid = $_GET['id'];
                    $itemff = $_GET['formfactor'];

                    // Get all information of that Memory
                    $sql = "SELECT m2.id, m2.chipset, m1.formfactor ff, m3.memoryslots memslots, m1.supportedmemorysize memsize
                            FROM motherboard2 m2 
                            INNER JOIN motherboard3 m3
                            ON m2.id = m3.id AND m2.id = $itemid
                            INNER JOIN motherboard1 m1
                            ON m2.formfactor = m1.formfactor AND m2.formfactor = '$itemff'";
                    $conn = OpenCon();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                    if ($result == TRUE) {
                        $numRows = mysqli_num_rows($result);

                        if ($numRows == 1) {
                            // Get the details of that supplier
                            $row = mysqli_fetch_assoc($result);

                            $modelid = $row['id'];
                            $modelchipset = $row['chipset'];
                            $modelff = $row['ff'];
                            $modelmemslots = $row['memslots'];
                            $modelmemsize  = $row['memsize'];
                        }
                    }
                    ?>
                    <h2 class="activity-title"><?php echo $title2; ?></h2>
                    <?php
                }
            ?>

            <form action="" method="POST">
                <table>
                    <?php
                        if ($type == 'add') {
                            ?>
                            <tr>
                            <td>ID</td>
                            <td><input required type="number" name="id" placeholder="enter model ID"></td>
                            </tr>
                            <?php
                        }
                    ?>
                    <?php
                        if ($type == 'add') {
                            ?>
                            <tr>
                            <td>Form Factor</td>
                            <td><input required type="text" name="form_factor" placeholder="enter model Form Factor"></td>
                            </tr>
                            <?php
                        }
                    ?>
                    <tr>
                        <td>Chipset</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="text" name="chipset" placeholder="enter model chipset">
                                    <?php
                                } else {
                                    ?>
                                    <input type="text" name="chipset" value="<?php echo $modelchipset; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Memory Slots</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="memory_slots" placeholder="enter model memory slots">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="memory_slots" value="<?php echo $modelmemslots; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Supported Memory Size</td>
                        <td>
                            <?php
                                if ($type == 'add') {
                                    ?>
                                    <input required type="number" name="memory_size" placeholder="enter model supported memory size in GB">
                                    <?php
                                } else {
                                    ?>
                                    <input type="number" name="memory_size" value="<?php echo $modelmemsize; ?>">
                                    <?php
                                }
                            ?>
                        </td>
                    </tr>
                </table>
                <!--confirm button-->
                <br>
                <?php
                    if ($type == 'add') {
                        ?>
                        <input type="submit" name="submit" value="Confirm" class="btn">
                        <?php
                    } else {
                        ?>
                        <input type="submit" name="update" value="Update" class="btn">
                        <?php
                    }
                ?>
            </form>
        </section>
        <!--End Main Content Section-->
<?php include('partials/footer.php'); ?>
<?php
    ob_start();
    // Check whether the confirm button is clicked or nor
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $id = $_POST['id'];
        $form_factor = $_POST['form_factor'];
        $chipset = $_POST['chipset'];
        $memory_slots = $_POST['memory_slots'];
        $memory_size = $_POST['memory_size'];

        // Create the SQL queries
        $sql1 = "INSERT INTO Motherboard1 VALUES ('$form_factor',$memory_size);";
        $sql2 = "INSERT INTO Motherboard2 VALUES ($id,'$chipset','$form_factor');";
        $sql3 = "INSERT INTO Motherboard3 VALUES ($id,$memory_slots)";
        $conn = OpenCon();
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/add-component.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/add-MB.php");
        }
    }

    // Check whether the UPDATE button is clicked or not
    if (isset($_POST['update'])) {
        $chipset = $_POST['chipset'];
        $memory_slots = $_POST['memory_slots'];
        $memory_size = $_POST['memory_size'];
        // Create the SQL queries
        $sql1 = "UPDATE Motherboard1 SET
                supportedmemorysize='$memory_size'
                WHERE formfactor='$modelff'";

        $sql2 = "UPDATE Motherboard2 SET
                chipset='$chipset'
                WHERE id='$itemid'";

        $sql3 = "UPDATE Motherboard3 SET
                memoryslots='$memory_slots'
                WHERE id='$itemid'";
        $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
        $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
        $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
        // Insert data into database
        if ($result1 == TRUE && $result2 == TRUE && $result3 == TRUE) {
            // Redirect to previous page
            if (!headers_sent()) {
                header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");
            }
            ob_end_flush();
        } else {
            // Redirect to previous page
            header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");
        }
    }
?>