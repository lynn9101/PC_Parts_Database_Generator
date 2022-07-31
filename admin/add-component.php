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
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li>
                                    <a href="add-MB.php">Motherboard</a>
                                </li>
                                <li>
                                    <a href="add-Memory.php">Memory</a>
                                </li>

                                <li>
                                    <a href="add-Storage.php">Storage</a>
                                </li>

                                <li>
                                    <a href="add-Cooling.php">Cooling System</a>
                                </li>
                                <li>
                                    <a href="add-CPU.php">CPU</a>
                                </li>
                                <li>
                                    <a href="add-GPU.php">GPU</a>
                                </li>
                                <li>
                                    <a href="add-Case.php">Case</a>
                                </li>
                                <li>
                                    <a href="add-PSU.php">Power Supply</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                </form>
                <!-- Section 2: Manage the List of Components -->       
                </br></br></br></br></br>
                <h1 class="main-title text-left">Manage List of Components by Category</h1>
                <form action="" method="POST">
                <table class="table-container">
                    <!-- Drop down list to choose category -->
                    <tr>
                        <td>Choose Category to Manage: </td>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                <li>
                                    <a href="manage-MB.php">Motherboard</a>
                                </li>
                                <li>
                                    <a href="manage-Memory.php">Memory</a>
                                </li>

                                <li>
                                    <a href="manage-Storage.php">Storage</a>
                                </li>

                                <li>
                                    <a href="manage-Cooling.php">Cooling System</a>
                                </li>
                                <li>
                                    <a href="manage-CPU.php">CPU</a>
                                </li>
                                <li>
                                    <a href="manage-GPU.php">GPU</a>
                                </li>
                                <li>
                                    <a href="manage-Case.php">Case</a>
                                </li>
                                <li>
                                    <a href="manage-PSU.php">Power Supply</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
        </section>
        <!-- End Main Content Section -->
<?php include('partials/footer.php'); ?>

