<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Manage Suppliers</h1>

                <!-- Add button for new Admin -->
                <a href="supplier-signup.php" class="btn-primary">Add New Supplier</a>
                
                <table class="admin-table">
                    <tr>
                        <!-- Table Heading -->
                        <th>Supplier ID</th>
                        <th>Name</th>
                        <th>Contact Information</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng@gmail.com</td>
                        <td>Vancouver BC</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Supplier</a>
                            <a href="#" class="btn-danger">Delete Supplier</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng@gmail.com</td>
                        <td>Vancouver BC</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Supplier</a>
                            <a href="#" class="btn-danger">Delete Supplier</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng@gmail.com</td>
                        <td>Vancouver BC</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Supplier</a>
                            <a href="#" class="btn-danger">Delete Supplier</a>
                        </td>
                    </tr>
                </table>
                
            </div>
        </section>
        <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>