<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the GPU ID to be deleted
    echo $PSUmodel = $_GET['model'];
    echo $PSUcolor = $_GET['color'];

    // Create SQL Query
    $sql = "DELETE FROM PowerSupply1 WHERE modelname='$PSUmodel'";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "Power Supply Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-PSU.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete Power Supply";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-PSU.php");
    }
?>