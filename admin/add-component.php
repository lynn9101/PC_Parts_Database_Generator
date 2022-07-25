<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Add New Component by Category</h1>

                <form action="" method="POST">

                <table class="table-container">
                    <!-- Drop down list to choose category -->
                    <tr>
                        <td>Choose Category to Add Model: </td>
                        <td>
                            <select name="category">
                                <?php
                                    // Get all category names
                                    $sql = "SELECT * FROM categories";
                                    $conn = OpenCon();
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                                    $numRows = mysqli_num_rows($result);
                                    if ($numRows > 0) {
                                        // Get the details of that supplier
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <!-- Add a Confirm button -->
                    <tr>
                        <td><input type="submit" name="submit-add" value="Add New Model" class="btn-primary"></td>
                    </tr>
                </table>
                </form>

                <!-- Section 2: Manage the List of Components -->
                <br><br><br>
                <h1 class="main-title text-left">Manage List of Components by Category</h1>

                <form action="" method="POST">

                <table class="table-container">
                    <!-- Drop down list to choose category -->
                    <tr>
                        <td>Choose Category to Manage: </td>
                        <td>
                            <select name="category_2">
                                <?php
                                    // Get all category names
                                    $sql = "SELECT * FROM categories";
                                    $conn = OpenCon();
                                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                                    $numRows = mysqli_num_rows($result);
                                    if ($numRows > 0) {
                                        // Get the details of that supplier
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }

                                    }
                
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <!-- Add a Confirm button -->
                    <tr>
                        <td><input type="submit" name="submit-manage" value="Manage List" class="btn-secondary"></td>
                    </tr>
                </table>
                </form>

                <!-- Manage Button clicked -->
                <?php
                    if (isset($_POST['submit-add'])) {
                        //echo $category_id = $_POST['category'];

                        
                    }

                    if (isset($_POST['submit-manage'])) {
                        //echo $category_id_2 = $_POST['category_2'];
                    }
                ?>
                
            </div>
        </section>
        <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>

