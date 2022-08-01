<?php
    include('C:\xampp\htdocs\pc_parts_database_generator\config\connect.php');
    // Get the Memory ID to be deleted
    echo $partid = $_GET['id'];

    // Create SQL Query
    $sql = "DELETE FROM Memory1 WHERE partid=$partid";
    $conn = OpenCon();
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // Redirect back to the suppliers-list.php after deletion
    if ($result == TRUE) {
        $_SESSION['delete'] = "Memory Deleted Successfully";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Memory.php");

    } else {
        $_SESSION['delete'] = "Failed to Delete GPU";

        // Redirect to previous page
        header("location: http://localhost/pc_parts_database_generator/admin/manage-Memory.php");
    }
?>