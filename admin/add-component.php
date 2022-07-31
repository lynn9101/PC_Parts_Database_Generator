<?php include('partials/header.php'); ?>
<script src="component-manage.js" defer></script>

        <!-- Banner Section -->
        <div class="product-banner">
                <img src="../images/components wallpaper.jpg" class="banner-img">
                <div class="product-banner-text">
                    <h1>Components Dashboard</h1>
                </div>
            </div>
        <!-- End Banner Section -->

        <!-- Main Content Section -->
        <div class="main-section">
            <div class="visual-display central-align">
                <img src="../images/components wallpaper.jpg" class="visual-banner">
                <div class="current-selection-text text-center">
                    Current Selection
                </div>
            </div>
            <div class="selection-container central-align">
                <form action="" method="POST">
                <select name="category" class="selection" id="selection">
                    <option value="0">None</option>
                    <option value="1">Motherboard</option>
                    <option value="2">Memory</option>
                    <option value="3">Storage</option>
                    <option value="4">Cooling System</option>
                    <option value="5">Central Processing Unit</option>
                    <option value="6">Graphics Card</option>
                    <option value="7">Case</option>
                    <option value="8">Power Supply</option>
                </select>
                
                <input type="submit" name="submit-add" value="Add" class="btn-secondary btn">
                <input type="submit" name="submit-manage" value="Edit" class="btn-primary btn">
                </form>

                <?php
                    if (isset($_POST['submit-add'])) {
                        $id = $_POST['category'];
                        if ($id == 1) {
                            header("location: http://localhost/pc_parts_database_generator/admin/add-MB.php");
                        }
                    } elseif (isset($_POST['submit-manage'])) {
                        $id = $_POST['category'];
                        if ($id == 1) {
                            header("location: http://localhost/pc_parts_database_generator/admin/manage-MB.php");
                        }
                    }
                ?>
            </div>
        </div>
        <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>

