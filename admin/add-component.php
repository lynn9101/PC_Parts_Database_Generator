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
                                <option value="1">Motherboard</option>
                                <option value="2">Memory</option>
                                <option value="3">Storage</option>
                                <option value="4">Cooling System</option>
                                <option value="5">CPU</option>
                                <option value="6">GPU</option>
                                <option value="7">Case</option>
                                <option value="8">Power Supply</option>
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
                                <option value="1">Motherboard</option>
                                <option value="2">Memory</option>
                                <option value="3">Storage</option>
                                <option value="4">Cooling System</option>
                                <option value="5">CPU</option>
                                <option value="6">GPU</option>
                                <option value="7">Case</option>
                                <option value="8">Power Supply</option>
                            </select>
                        </td>
                    </tr>
                    
                    <!-- Add a Confirm button -->
                    <tr>
                        <td><input type="submit" name="submit-manage" value="Manage List" class="btn-secondary btn-outline"></td>
                    </tr>
                </table>
                </form>
                <!-- Manage Button clicked -->
                
            </div>
        </section>
        <!-- End Main Content Section -->
<?php include('partials/footer.php'); ?>

<?php
    if (isset($_POST['submit-add'])) {
        $id = $_POST['category'];

        if ($id == 1) {
            header("location: http://localhost/pc_parts_database_generator/admin/add-MB.php");
        }       
    }

    if (isset($_POST['submit-manage'])) {
        $category_id_2 = $_POST['category_2'];
        header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");
    }
?>

