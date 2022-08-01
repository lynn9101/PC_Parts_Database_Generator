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
                    <th>Action</th>
                </tr>
                <tr>
                    <!-- TODO: Insert the SQL query -->
                    <td>Seagate Barracuda</td>
                    <td>1TB</td>
                    <td>6GB/s</td>
                    <td>6GB/s</td>

                    <td>
                        <a href="#" class="btn-secondary">Update</a>
                        <!-- ?id= the id of supplier that we need to pass into another page -->
                        <a href="#" class="btn-danger">Delete</a>
                    </td>
                </tr>

            </table>
        </div>
    </section>
    <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>