<?php include('partials/header.php'); ?>

        <!-- Main Content Section -->
        <!-- Include header, add button, table of admins -->
        <section class="main-content">
            <div class="container">
                <h1 class="main-title text-left">Adminstration</h1>

                <!-- Add button for new Admin -->
                <a href="admin-signup.php" class="btn-primary">Add New Admin</a>
                
                <table class="admin-table">
                    <tr>
                        <!-- Table Heading -->
                        <th>Admin ID</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Action</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Lynn Nguyen</td>
                        <td>lynnng</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                </table>
                
            </div>
        </section>
        <!-- End Main Content Section -->

<?php include('partials/footer.php'); ?>